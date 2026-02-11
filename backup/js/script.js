/* AlignPoint site interactions (lightweight) */
(function(){
  const year = document.getElementById("year");
  if(year) year.textContent = new Date().getFullYear();

  // Mobile nav toggle
  const toggle = document.querySelector(".nav-toggle");
  const nav = document.getElementById("siteNav");
  
  if(toggle && nav){
    toggle.addEventListener("click", () => {
      const open = nav.classList.toggle("open");
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
  }

  // Dropdown button accessibility (desktop)
  document.querySelectorAll(".has-dropdown > .nav-btn").forEach(btn => {
    btn.addEventListener("click", (e) => {
      // prevent navigation; toggle aria state only
      e.preventDefault();
      const expanded = btn.getAttribute("aria-expanded") === "true";
      btn.setAttribute("aria-expanded", expanded ? "false" : "true");
      // We rely on CSS hover for display; aria is for screen readers.
    });
  });

  // Accordions
  document.querySelectorAll("[data-accordion]").forEach(acc => {
    acc.querySelectorAll(".acc-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        const panel = btn.parentElement.querySelector(".acc-panel");
        const open = panel.classList.toggle("open");
        btn.setAttribute("aria-expanded", open ? "true" : "false");
      });
    });
  });
})();
