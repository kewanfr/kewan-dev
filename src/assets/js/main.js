document.addEventListener("DOMContentLoaded", () => {
  // Reveal on scroll
  const revealEls = document.querySelectorAll(".reveal");
  const io = new IntersectionObserver(
    (entries) => {
      for (const e of entries) {
        if (e.isIntersecting) {
          e.target.classList.add("is-visible");
          io.unobserve(e.target);
        }
      }
    },
    { threshold: 0.12 },
  );
  revealEls.forEach((el) => io.observe(el));

  // Nav active section highlight
  const navLinks = Array.from(
    document.querySelectorAll(".nav a[data-section]"),
  );
  const sections = navLinks
    .map((a) => document.querySelector(a.getAttribute("href")))
    .filter(Boolean);

  const setActive = (id) => {
    navLinks.forEach((a) =>
      a.classList.toggle("is-active", a.getAttribute("href") === `#${id}`),
    );
  };

  const updateActiveSection = () => {
    const scrollPos = window.scrollY + 100; // offset pour le header

    let currentSection = sections[0]?.id;

    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;

      if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
        currentSection = section.id;
      }
    });

    setActive(currentSection);
  };

  let scrollTimeout;
  window.addEventListener(
    "scroll",
    () => {
      clearTimeout(scrollTimeout);
      scrollTimeout = setTimeout(updateActiveSection, 50);
    },
    { passive: true },
  );

  updateActiveSection(); // Initial check

  // Smooth scroll fallback + focus (améliore l’accessibilité)
  navLinks.forEach((a) => {
    a.addEventListener("click", (ev) => {
      const href = a.getAttribute("href");
      if (!href || !href.startsWith("#")) return;
      const target = document.querySelector(href);
      if (!target) return;
      ev.preventDefault();
      target.scrollIntoView({ behavior: "smooth", block: "start" });
      target.setAttribute("tabindex", "-1");
      target.focus({ preventScroll: true });
    });
  });

  // Year
  const y = document.getElementById("year");
  if (y) y.textContent = String(new Date().getFullYear());
});
