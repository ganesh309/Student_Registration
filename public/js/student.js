document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('country').addEventListener('change', function() {
        const countryId = this.value;
        const stateDropdown = document.getElementById('state');
        const districtDropdown = document.getElementById('district');

        if (countryId) {
            fetch(`/states/${countryId}`)
                .then(response => response.text())
                .then(data => {
                    stateDropdown.innerHTML = data;
                    stateDropdown.disabled = false;

                    districtDropdown.innerHTML = "<option value=''>Select District</option>";
                    districtDropdown.disabled = true;
                })
                .catch(error => console.error('Error fetching states:', error));
        } else {
            resetDropdowns();
        }
    });

    document.getElementById('state').addEventListener('change', function() {
        const stateId = this.value;
        const districtDropdown = document.getElementById('district');

        if (stateId) {
            fetch(`/districts/${stateId}`)
                .then(response => response.text())
                .then(data => {
                    districtDropdown.innerHTML = data;
                    districtDropdown.disabled = false;
                })
                .catch(error => console.error('Error fetching districts:', error));
        } else {
            districtDropdown.innerHTML = "<option value=''>Select District</option>";
            districtDropdown.disabled = true;
        }
    });

    function resetDropdowns() {
        const stateDropdown = document.getElementById('state');
        const districtDropdown = document.getElementById('district');

        stateDropdown.innerHTML = "<option value=''>Select State</option>";
        districtDropdown.innerHTML = "<option value=''>Select District</option>";

        stateDropdown.disabled = true;
        districtDropdown.disabled = true;
    }

    // After form submission, ensure that the state and district are changeable
    const selectedCountryId = document.getElementById('country').value;
    const selectedStateId = document.getElementById('state').value;
    const selectedDistrictId = document.getElementById('district').value;
    const stateDropdown = document.getElementById('state');
    const districtDropdown = document.getElementById('district');

    if (selectedCountryId) {
        stateDropdown.disabled = false;
        fetch(`/states/${selectedCountryId}`)
            .then(response => response.text())
            .then(data => {
                stateDropdown.innerHTML = data;

                // If a state is already selected, keep it selected
                if (selectedStateId) {
                    stateDropdown.value = selectedStateId;
                    districtDropdown.disabled = false;
                    fetch(`/districts/${selectedStateId}`)
                        .then(response => response.text())
                        .then(districts => {
                            districtDropdown.innerHTML = districts;

                            // Keep the selected district if there was one
                            if (selectedDistrictId) {
                                districtDropdown.value = selectedDistrictId;
                            }
                        })
                        .catch(error => console.error('Error fetching districts:', error));
                }
            })
            .catch(error => console.error('Error fetching states:', error));
    } else {
        resetDropdowns();
    }
});



//....................................image&signature............................................//
document.addEventListener('DOMContentLoaded', function() {
    const imageModal = document.getElementById('imageModal');
    const signatureModal = document.getElementById('signatureModal');


    imageModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const imageUrl = button.getAttribute('data-bs-image');
        const modalImage = imageModal.querySelector('#modal-image');
        modalImage.src = imageUrl;
    });

   
    signatureModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const signatureUrl = button.getAttribute('data-bs-signature');
        const modalSignature = signatureModal.querySelector('#modal-signature');
        modalSignature.src = signatureUrl; 
    });
});



//.....................................Accordion..................................//

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