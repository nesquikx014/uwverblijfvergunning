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
