const tabs = document.querySelectorAll('.tab');
const tabContent = document.querySelectorAll('.tab-pane');
let currentTab = 0;

window.addEventListener('load', function() {
    showTab(currentTab);
});

function showTab(index) {
    tabs.forEach(tab => tab.classList.remove('active'));
    tabContent.forEach(content => content.classList.remove('active'));

    tabs[index].classList.add('active');
    tabContent[index].classList.add('active');
}

function validateCurrentTab() {
    const currentTabContent = tabContent[currentTab];
    const requiredFields = currentTabContent.querySelectorAll('[required]');
    let isValid = true;
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('is-invalid');
        } else {
            field.classList.remove('is-invalid');
        }
    });

    return isValid;
}
function showValidationError() {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please fill out all required fields before proceeding.',
        confirmButtonText: 'Okay'
    });
}
document.querySelectorAll('.btn-custom-sm[id^="next"]').forEach(button => {
    button.addEventListener('click', function() {
        if (validateCurrentTab()) {
            currentTab++;
            if (currentTab >= tabs.length) currentTab = tabs.length - 1;
            showTab(currentTab);
        } else {
            showValidationError();
        }
    });
});
document.querySelectorAll('.btn-custom-sm[id^="prev"]').forEach(button => {
    button.addEventListener('click', function() {
        currentTab--;
        if (currentTab < 0) currentTab = 0;
        showTab(currentTab);
    });
});
