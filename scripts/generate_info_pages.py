#!/usr/bin/env python3
"""Scrape uwverblijfsvergunning.nl pages into info/*.php snippets."""

from __future__ import annotations

import json
import re
from pathlib import Path
from typing import List, Tuple
from urllib.request import Request, urlopen

from bs4 import BeautifulSoup
from bs4 import NavigableString as BSNavigableString
from bs4.element import Tag

API_TEMPLATE = "https://uwverblijfsvergunning.nl/wp-json/wp/v2/pages?slug={slug}"
OUTPUT_DIR = Path(__file__).resolve().parents[1] / "info"

PAGES: List[str] = [
    "verblijf-bij-ongehuwde-partner",
    "verblijfsaanvraag-overige-familieleden",
    "verblijf-bij-minderjarige-nederlands-kind-chavez-vilchez",
    "machtiging-voorlopig-verblijf-mvv",
    "arbeid",
    "verblijfsvergunning-als-zelfstandige-ondernemer",
    "studeren-in-nederland",
    "remigreren-naar-nederland-oud-nederlanders",
    "verblijfsvergunning-medische-gronden",
    "verblijfsvergunning-onbepaalde-tijd-aanvragen",
    "chavez-vilchez",
    "eu-burger-en-gezinsleden",
    "toetsing-aan-eu-recht-belgie-route",
    "schengenvisum",
    "spoed-visum",
    "bezwaarschrift-tegen-afgewezen-schengenvisum",
    "nederlander-worden",
    "het-verliezen-van-de-nederlandse-nationaliteit",
    "intrekking-verblijfsvergunning",
    "over-ons",
    "contact",
]

SHORTCODE_PATTERN = re.compile(r"\[(\/)?vc_[^\]]*\]", re.IGNORECASE)
ALLOWED_TAGS = {
    "a",
    "blockquote",
    "em",
    "h2",
    "h3",
    "h4",
    "h5",
    "h6",
    "img",
    "li",
    "ol",
    "p",
    "strong",
    "table",
    "tbody",
    "td",
    "th",
    "thead",
    "tr",
    "ul",
}
BLOCK_LEVEL_CHILDREN = {"p", "h2", "h3", "h4", "h5", "h6", "ul", "ol", "table", "blockquote"}
DROP_TAGS = {
    "button",
    "form",
    "iframe",
    "input",
    "label",
    "script",
    "select",
    "style",
    "textarea",
}


def fetch_from_api(slug: str) -> Tuple[str, str]:
    req = Request(API_TEMPLATE.format(slug=slug), headers={"User-Agent": "CodexScraper/1.0"})
    with urlopen(req) as resp:
        data = json.load(resp)
    if not data:
        raise RuntimeError(f"No payload returned for slug '{slug}'")
    entry = data[0]
    title_html = entry["title"]["rendered"]
    content_html = entry["content"]["rendered"]
    title = BeautifulSoup(title_html, "html.parser").get_text().strip()
    return title, content_html


def _strip_shortcodes(raw_html: str) -> str:
    return SHORTCODE_PATTERN.sub("", raw_html)


def _clean_dom(raw_html: str) -> BeautifulSoup:
    prepared = f"<div>{_strip_shortcodes(raw_html)}</div>"
    soup = BeautifulSoup(prepared, "html.parser")
    root = soup.div
    if root is None:
        root = soup.new_tag("div")
        soup.append(root)

    for tag in root.find_all(DROP_TAGS):
        tag.decompose()

    for br in root.find_all("br"):
        br.replace_with(BSNavigableString("\n"))

    for tag in root.find_all(True):
        if tag.name not in ALLOWED_TAGS:
            tag.unwrap()
            continue
        if tag.name == "a":
            href = tag.get("href")
            tag.attrs = {"href": href} if href else {}
        elif tag.name == "img":
            attrs = {}
            for attr in ("src", "alt"):
                if attr in tag.attrs:
                    attrs[attr] = tag.attrs[attr]
            tag.attrs = attrs
        else:
            tag.attrs = {}

    for p in root.find_all("p"):
        moved = False
        for child in list(p.children):
            if isinstance(child, Tag) and child.name in BLOCK_LEVEL_CHILDREN:
                p.insert_before(child)
                moved = True
        if moved and not p.get_text(strip=True):
            p.decompose()

    for tag in root.find_all(["p", "blockquote", "h2", "h3", "h4", "h5", "h6"]):
        if not tag.get_text(strip=True):
            tag.decompose()

    for tag in root.find_all(["ul", "ol", "table"]):
        if not tag.get_text(strip=True):
            tag.decompose()

    return soup


def _collect_blocks(root: Tag) -> List[str]:
    blocks: List[str] = []
    for child in root.children:
        if isinstance(child, BSNavigableString):
            text = str(child).strip()
            if text:
                blocks.append(f"<p>{text}</p>")
            continue
        text = child.get_text(strip=True)
        if not text:
            continue
        blocks.append(str(child).strip())
    return blocks


def build_section_html(title: str, raw_html: str) -> str:
    soup = _clean_dom(raw_html)
    root = soup.div if soup.div else soup
    blocks = _collect_blocks(root)
    blocks = _drop_duplicate_heading(blocks, title)
    body = "\n\n".join(_indent_block(block) for block in blocks if block)
    if body:
        body = f"\n{body}\n"
    return f'<section class="article-section">\n  <h2>{title}</h2>{body}</section>\n'


def _drop_duplicate_heading(blocks: List[str], title: str) -> List[str]:
    if not blocks:
        return blocks
    snippet = BeautifulSoup(blocks[0], "html.parser").find(["h1", "h2", "h3"])
    if snippet and snippet.get_text(strip=True).casefold() == title.casefold():
        return blocks[1:]
    return blocks


def _indent_block(block: str) -> str:
    prefixed_lines = []
    for line in block.splitlines():
        stripped = line.rstrip()
        if not stripped:
            continue
        prefixed_lines.append(f"  {stripped}")
    return "\n".join(prefixed_lines) if prefixed_lines else ""


def write_file(slug: str, html: str) -> None:
    OUTPUT_DIR.mkdir(parents=True, exist_ok=True)
    path = OUTPUT_DIR / f"{slug}.php"
    path.write_text(html, encoding="utf-8")


def main() -> None:
    for slug in PAGES:
        title, content_html = fetch_from_api(slug)
        section_html = build_section_html(title, content_html)
        write_file(slug, section_html)
        print(f"Wrote info/{slug}.php")


if __name__ == "__main__":
    main()
