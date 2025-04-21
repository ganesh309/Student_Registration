document.addEventListener("DOMContentLoaded", function () {
    const filterForm = document.querySelector('form[action*="students.index"]');
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
    const baseUrl = "http://127.0.0.1:8000/students";
    let queryString = "";

    const countryId = document.getElementById("country")?.value;
    const stateId = document.getElementById("state")?.value;
    const districtId = document.getElementById("district")?.value;
    const schoolId = document.getElementById("school")?.value;
    const dateOfBirthFrom = document.getElementById("date_of_birth_from")?.value;
    const dateOfBirthTo = document.getElementById("date_of_birth_to")?.value;
    const gender = document.getElementById("gender")?.value;
    const search = document.getElementById("search")?.value;
    const perPage = parseInt(document.getElementById("per_page")?.value) || 5;

    const offset = (page - 1) * perPage;

    if (countryId) queryString += `country_id=${countryId}&`;
    if (stateId) queryString += `state_id=${stateId}&`;
    if (districtId) queryString += `district_id=${districtId}&`;
    if (schoolId) queryString += `school_id=${schoolId}&`;
    if (dateOfBirthFrom) queryString += `date_of_birth_from=${dateOfBirthFrom}&`;
    if (dateOfBirthTo) queryString += `date_of_birth_to=${dateOfBirthTo}&`;
    if (gender) queryString += `gender=${gender}&`;
    if (search) queryString += `search=${encodeURIComponent(search)}&`;

    queryString += `per_page=${perPage}&offset=${offset}&page=${page}`;

    const finalUrl = `${baseUrl}?${queryString}`;
    window.location.href = finalUrl;
}
