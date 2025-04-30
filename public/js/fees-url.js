document.addEventListener("DOMContentLoaded", function () {
    const filterForm = document.querySelector('form[action*="fees-details"]');
    if (filterForm) {
        filterForm.addEventListener("submit", function (e) {
            e.preventDefault();
            urlFilter();
        });
    }

    const perPageForm = document.querySelector('form[action="' + window.location.href.split('?')[0] + '"]');
    if (perPageForm) {
        perPageForm.addEventListener("submit", function (e) {
            e.preventDefault();
        });

        const perPageSelect = document.getElementById("per_page");
        if (perPageSelect) {
            perPageSelect.addEventListener("change", function () {
                urlFilter();
            });
        }
    }

    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const url = new URL(this.href);
            const page = parseInt(url.searchParams.get("page")) || 1;
            urlFilter(page);
        });
    });
});

function urlFilter(page = 1) {
    const baseUrl = "http://127.0.0.1:8000/fees-details/details";
    let queryString = "";

    // Match the input IDs from your Blade file
    const academicId = document.getElementById("academic")?.value;
    const courseId = document.getElementById("course")?.value;
    const semesterId = document.getElementById("semester")?.value;
    const feesHeadId = document.getElementById("fees_head")?.value;
    const search = document.getElementById("search")?.value;
    const perPage = parseInt(document.getElementById("per_page")?.value) || 5;

    const offset = (page - 1) * perPage;

    if (academicId) queryString += `academic_id=${academicId}&`;
    if (courseId) queryString += `course_id=${courseId}&`;
    if (semesterId) queryString += `semester_id=${semesterId}&`;
    if (feesHeadId) queryString += `fees_head_id=${feesHeadId}&`;
    if (search) queryString += `search=${encodeURIComponent(search)}&`;

    queryString += `per_page=${perPage}&offset=${offset}&page=${page}`;

    const finalUrl = `${baseUrl}?${queryString}`;
    window.location.href = finalUrl;
}
