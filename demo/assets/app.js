(function(){
  const $ = (s, el=document)=>el.querySelector(s);
  const $$ = (s, el=document)=>Array.from(el.querySelectorAll(s));

  const menuBtn = $('#menuBtn');
  const nav = $('#nav');
  if(menuBtn && nav){
    menuBtn.addEventListener('click', ()=>{
      nav.classList.toggle('open');
      menuBtn.setAttribute('aria-expanded', nav.classList.contains('open') ? 'true' : 'false');
    });
  }

  $$('.dropdown > button').forEach(btn=>{
    btn.addEventListener('click', (e)=>{
      e.preventDefault();
      const wrap = btn.closest('.dropdown');
      const isOpen = wrap.classList.contains('open');
      // close others
      $$('.dropdown').forEach(d=>d.classList.remove('open'));
      if(!isOpen) wrap.classList.add('open');
    });
  });

  document.addEventListener('click', (e)=>{
    const inside = e.target.closest('.dropdown');
    if(!inside) $$('.dropdown').forEach(d=>d.classList.remove('open'));
  });

  // search filter on directory pages
  const filter = $('#filterInput');
  if(filter){
    const cards = $$('.filter-item');
    filter.addEventListener('input', ()=>{
      const q = filter.value.trim().toLowerCase();
      cards.forEach(c=>{
        const txt = (c.getAttribute('data-filter')||'').toLowerCase();
        c.style.display = txt.includes(q) ? '' : 'none';
      });
    });
  }
})();