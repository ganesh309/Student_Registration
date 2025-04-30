
document.addEventListener('DOMContentLoaded', function () {
    const collapseFilterEl = document.getElementById('collapseFilter');
    const searchInput = document.getElementById('search');

    const bsCollapse = new bootstrap.Collapse(collapseFilterEl, {
        toggle: false
    });

    const shouldStayOpen = localStorage.getItem('advanceFilterOpen');
    if (shouldStayOpen === 'true') {
        bsCollapse.show();
        if (searchInput) searchInput.disabled = true;
    }

    collapseFilterEl.addEventListener('show.bs.collapse', () => {
        localStorage.setItem('advanceFilterOpen', 'true');
        if (searchInput) searchInput.disabled = true;
    });

    collapseFilterEl.addEventListener('hide.bs.collapse', () => {
        localStorage.setItem('advanceFilterOpen', 'false');
        if (searchInput) searchInput.disabled = false;
    });
});