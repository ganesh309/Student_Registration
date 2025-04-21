document.addEventListener("DOMContentLoaded", function () {
    const successMessage = document.getElementById('success-message').dataset.success;
    const errorMessage = document.getElementById('error-message').dataset.error;

    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: successMessage,
            timer: 3000
        });
    }

    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: errorMessage,
            timer: 3000
        });
    }

    // Handle success message from URL query (if any)
    const querySuccessMessage = new URLSearchParams(window.location.search).get('success_message');
    if (querySuccessMessage) {
        const decodedMessage = decodeURIComponent(querySuccessMessage).replace(/\+/g, ' ');

        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: decodedMessage,
            timer: 3000
        });

        // Remove the message from the URL after displaying the alert
        const url = new URL(window.location.href);
        url.searchParams.delete("success_message");
        window.history.replaceState({}, document.title, url.pathname + url.search);
    }
});

// Confirm Delete Function
function confirmDelete(studentId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + studentId).submit();
        }
    });
}
