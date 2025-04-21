$(document).ready(function() {

   // Load schools on page load
   function loadSchools() {
    $.ajax({
        url: '/schools',
        type: 'GET',
        data: { type: 'school' },
        success: function(response) {
            console.log(response);
            $("#school_id").html(response);

        },
        error: function(xhr, status, error) {
console.error("Error loading schools: " + error); // Log specific error
}
    });
}
loadSchools();

// Load coursess on page load
function loadCourses() {
    $.ajax({
        url: '/courses',
        type: 'GET',
        data: { type: 'course' },
        success: function(response) {
            console.log(response);
            $("#course_id").html(response);

        },
        error: function(xhr, status, error) {
console.error("Error loading courses: " + error); // Log specific error
}
    });
}
loadCourses();

// Load specializations when course is selected
$('#course_id').change(function() {
    var course_id = $(this).val();
    if (course_id != '') {
    $.ajax({
        url: '/specializations/' + course_id,
        type: 'GET',
        data: { course_id: course_id },
        success: function(response) {
            $("#specialization_id").html(response);
        },
        error: function(xhr, status, error) {
            console.error("Error loading specialization: " + error);
        }
    });
    }
    });



    // Load countries on page load
    function loadCountries() {
        $.ajax({
            url: '/countries',
            type: 'GET',
            data: { type: 'country' },
            success: function(response) {
                console.log(response);
                $("#country_id").html(response);

            },
            error: function(xhr, status, error) {
console.error("Error loading countries: " + error); // Log specific error
}
        });
    }
    loadCountries();

    // Load states when country is selected
    $('#country_id').change(function() {
var country_id = $(this).val();
if (country_id != '') {
$.ajax({
    url: '/states/' + country_id,
    type: 'GET',
    data: { country_id: country_id },
    success: function(response) {
        $("#state_id").html(response);
        $('#district_id').html('<option value="">Select</option>');
    },
    error: function(xhr, status, error) {
        console.error("Error loading states: " + error);
    }
});
}
});
    // Load districts when state is selected
    $('#state_id').change(function() {
        var state_id = $(this).val();
        if (state_id != '') {
            $.ajax({
                url: '/districts/'+ state_id,
                type: 'GET',
                data: {state_id: state_id },
                success: function(response) {
                    
                    $("#district_id").html(response);
                   
                },
                error: function(xhr, status, error) {
console.error("Error loading districts: " + error); // Log specific error
}
            });
        } else {
            $("#district_id").html('<option value="">Select District</option>');
        }
    });
});
/***********************************Password Validation*************************************** */

document.addEventListener('DOMContentLoaded', function() {
// Password toggle functionality
const togglePassword = document.getElementById('toggle-password');
const toggleConfirmPassword = document.getElementById('toggle-password-confirmation');
const password = document.getElementById('password');
const passwordConfirmation = document.getElementById('password_confirmation');
const passwordError = document.getElementById('password-error');

// Toggle password visibility
function toggleVisibility(input, button) {
    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
    input.setAttribute('type', type);
    
    // Toggle eye icon
    const icon = button.querySelector('i');
    icon.classList.toggle('fa-eye-slash');
    icon.classList.toggle('fa-eye');
}

togglePassword.addEventListener('click', function() {
    toggleVisibility(password, this);
});

toggleConfirmPassword.addEventListener('click', function() {
    toggleVisibility(passwordConfirmation, this);
});

// Existing validation code
passwordConfirmation.addEventListener('input', function() {
    if (password.value !== passwordConfirmation.value) {
        passwordError.style.display = 'block';
    } else {
        passwordError.style.display = 'none';
    }
});

document.querySelector('form').addEventListener('submit', function(e) {
    if (password.value !== passwordConfirmation.value) {
        e.preventDefault();
        alert("Passwords do not match!");
    }
});
});