const hero = document.querySelector('.hero');
const header = document.querySelector('.site-header');

if (!hero && header) {
  header.classList.add('is-solid');
}

const handleScroll = () => {
  const scrollY = window.scrollY;
  if (hero) {
    const offset = scrollY * 0.3;
    hero.style.backgroundPositionY = `calc(50% + ${offset}px)`;
  }
  if (header) {
    if (!hero) {
      header.classList.add('is-solid');
      return;
    }
    const threshold = hero.offsetHeight * 0.45;
    header.classList.toggle('is-solid', scrollY > threshold);
  }
};

handleScroll();
window.addEventListener('scroll', handleScroll, { passive: true });

const infoSearchInput = document.querySelector('[data-info-search]');
const infoSelect = document.querySelector('[data-info-select]');
const infoEntries = Array.from(document.querySelectorAll('[data-info-entry]'));
const infoGroups = Array.from(document.querySelectorAll('[data-info-group]'));
const infoEmptyState = document.querySelector('[data-info-empty]');

if (infoEntries.length > 0) {
  const escapeRegExp = (str) => str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

  const makeSnippet = (text, rawQuery) => {
    if (!rawQuery) return '';
    const lowerText = text.toLocaleLowerCase('nl-NL');
    const lowerQuery = rawQuery.toLocaleLowerCase('nl-NL');
    const idx = lowerText.indexOf(lowerQuery);
    if (idx < 0) return '';
    const start = Math.max(0, idx - 60);
    const end = Math.min(text.length, idx + rawQuery.length + 60);
    let snippet = text.slice(start, end).trim();
    if (start > 0) snippet = `…${snippet}`;
    if (end < text.length) snippet = `${snippet}…`;
    const highlightRegex = new RegExp(escapeRegExp(rawQuery), 'gi');
    return snippet.replace(highlightRegex, (match) => `<strong>${match}</strong>`);
  };

  const applyFilters = () => {
    const rawQuery = infoSearchInput ? infoSearchInput.value.trim() : '';
    const query = rawQuery.toLocaleLowerCase('nl-NL');
    const category = infoSelect ? infoSelect.value : 'all';
    let matches = 0;

    infoEntries.forEach((entry) => {
      const haystack = (entry.dataset.infoText || '').toLocaleLowerCase('nl-NL');
      const entryCategory = entry.dataset.infoCategory || '';
      const matchesQuery = query === '' || haystack.includes(query);
      const matchesCategory = category === 'all' || entryCategory === category;
      const visible = matchesQuery && matchesCategory;
      const container = entry.closest('.info-entry');
      container.hidden = !visible;
      const snippetElement = container.querySelector('.info-entry__snippet');
      if (snippetElement) {
        if (visible && rawQuery !== '') {
          const snippet = makeSnippet(entry.dataset.infoBody || '', rawQuery);
          snippetElement.innerHTML = snippet;
          snippetElement.hidden = snippet === '';
        } else {
          snippetElement.innerHTML = '';
          snippetElement.hidden = true;
        }
      }
      if (visible) {
        matches += 1;
      }
    });

    infoGroups.forEach((group) => {
      const visibleEntries = group.querySelectorAll('.info-entry:not([hidden])').length;
      group.hidden = visibleEntries === 0;
    });

    if (infoEmptyState) {
      infoEmptyState.hidden = matches > 0;
    }
  };

  if (infoSearchInput) {
    infoSearchInput.addEventListener('input', applyFilters);
  }

  if (infoSelect) {
    infoSelect.addEventListener('change', applyFilters);
  }

  applyFilters();
}

  // Smooth scroll helpers
  window.addEventListener('load', () => {
    // If page was loaded with a hash (e.g. index.php#over), ensure smooth scroll to that element
    if (location.hash) {
      const el = document.querySelector(location.hash);
      if (el) {
        // delay slightly so browser layout has settled
        setTimeout(() => el.scrollIntoView({ behavior: 'smooth', block: 'start' }), 50);
      }
    }
  });

  // Intercept same-page anchor clicks and smooth-scroll
  document.addEventListener('click', (e) => {
    const a = e.target.closest('a');
    if (!a) return;
    const href = a.getAttribute('href') || '';
    // Only handle plain hash links (e.g. #over)
    if (href.startsWith('#') && href.length > 1) {
      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        // Update URL without jumping
        history.pushState(null, '', href);
      }
    }
  });
