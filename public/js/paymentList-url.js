document.addEventListener("DOMContentLoaded", function () {
    // Basic filter form (search and per_page)
    const basicFilterForm = document.querySelector('form[action="' + window.location.pathname + '"]');
    const perPageSelect = document.getElementById("per_page");
    const advancedFilterForm = document.getElementById("filter-form");

    // Handle basic filter form submission
    if (basicFilterForm) {
        basicFilterForm.addEventListener("submit", function (e) {
            e.preventDefault();
            urlFilter();
        });
    }

    // Handle per_page change
    if (perPageSelect) {
        perPageSelect.addEventListener("change", function () {
            urlFilter();
        });
    }

    // Handle advanced filter form submission
    if (advancedFilterForm) {
        advancedFilterForm.addEventListener("submit", function (e) {
            e.preventDefault();
            urlFilter();
        });
    }

    // Handle pagination links
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
    // Use current pathname to avoid hardcoding
    const baseUrl = window.location.pathname;
    let queryParams = new URLSearchParams();

    // Get values from inputs
    const academicId = document.getElementById("academic_id")?.value;
    const courseId = document.getElementById("course_id")?.value;
    const semesterId = document.getElementById("semester_id")?.value;
    const search = document.getElementById("search")?.value;
    const perPage = parseInt(document.getElementById("per_page")?.value) || 10;
    const startDate = document.querySelector('input[name="start_date"]')?.value;
    const endDate = document.querySelector('input[name="end_date"]')?.value;

    // Add parameters if they exist
    if (academicId) queryParams.set('academic_id', academicId);
    if (courseId) queryParams.set('course_id', courseId);
    if (semesterId) queryParams.set('semester_id', semesterId);
    if (search) queryParams.set('search', search);
    if (perPage) queryParams.set('per_page', perPage);
    if (startDate) queryParams.set('start_date', startDate);
    if (endDate) queryParams.set('end_date', endDate);
    queryParams.set('page', page);

    // Preserve other query parameters
    const currentParams = new URLSearchParams(window.location.search);
    currentParams.forEach((value, key) => {
        if (!['academic_id', 'course_id', 'semester_id', 'search', 'per_page', 'start_date', 'end_date', 'page'].includes(key)) {
            queryParams.set(key, value);
        }
    });

    // Navigate to new URL
    window.location.href = `${baseUrl}?${queryParams.toString()}`;
}