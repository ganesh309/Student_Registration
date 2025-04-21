
            document.addEventListener("DOMContentLoaded", function() {
        const url = new URL(window.location.href);
        if (url.searchParams.has("error")) {
            setTimeout(() => {
                url.searchParams.delete("error");
                window.history.replaceState({}, document.title, url.pathname + url.search);
            }, 1); 
        }
    });

    var cropperImage, cropperSignature;
var currentInput;

function openCropperImage() {
    currentInput = document.getElementById('image');
    var reader = new FileReader();
    reader.onload = function (e) {
        var img = document.getElementById('cropper-image');
        img.src = e.target.result;

        // Destroy the previous cropper instance if it exists
        if (cropperImage) {
            cropperImage.destroy();
        }

        // Show the modal
        $('#cropper-modal-image').modal('show');
    };
    reader.readAsDataURL(currentInput.files[0]);
}

function openCropperSignature() {
    currentInput = document.getElementById('signature');
    var reader = new FileReader();
    reader.onload = function (e) {
        var img = document.getElementById('cropper-signature');
        img.src = e.target.result;

        // Destroy the previous cropper instance if it exists
        if (cropperSignature) {
            cropperSignature.destroy();
        }


        $('#cropper-modal-signature').modal('show');
    };
    reader.readAsDataURL(currentInput.files[0]);
}

// Initialize Cropper.js for Image
$('#cropper-modal-image').on('shown.bs.modal', function () {
    var img = document.getElementById('cropper-image');
    cropperImage = new Cropper(img, {
        aspectRatio: 1,
        viewMode: 2,
        autoCropArea: 0.8
    });
});

// Initialize Cropper.js for Signature
$('#cropper-modal-signature').on('shown.bs.modal', function () {
    var img = document.getElementById('cropper-signature');
    cropperSignature = new Cropper(img, {
        aspectRatio: 2,
        viewMode: 2,
        autoCropArea: 0.8
    });
});

// Crop the image and set the cropped image as thumbnail
$('#crop-image').click(function () {
    var canvas = cropperImage.getCroppedCanvas();
    canvas.toBlob(function (blob) {
        var url = URL.createObjectURL(blob);
        var thumbnail = document.getElementById('image-thumbnail');
        thumbnail.src = url;
        thumbnail.style.display = 'block';

        // Set the cropped image as the value for the input
        var dataTransfer = new DataTransfer();
        var file = new File([blob], currentInput.files[0].name, { type: currentInput.files[0].type });
        dataTransfer.items.add(file);
        currentInput.files = dataTransfer.files;
    });
    $('#cropper-modal-image').modal('hide');
});

// Crop the signature and set the cropped signature as thumbnail
$('#crop-signature').click(function () {
    var canvas = cropperSignature.getCroppedCanvas();
    canvas.toBlob(function (blob) {
        var url = URL.createObjectURL(blob);
        var thumbnail = document.getElementById('signature-thumbnail');
        thumbnail.src = url;
        thumbnail.style.display = 'block';

        // Set the cropped signature as the value for the input
        var dataTransfer = new DataTransfer();
        var file = new File([blob], currentInput.files[0].name, { type: currentInput.files[0].type });
        dataTransfer.items.add(file);
        currentInput.files = dataTransfer.files;
    });
    $('#cropper-modal-signature').modal('hide');
});

$('#image').change(function () {
    openCropperImage();
});

$('#signature').change(function () {
    openCropperSignature();
});


document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const image = document.getElementById('image-thumbnail');
                image.src = e.target.result;
                image.style.display = 'block';

                // Hide the old image if it exists
                const oldImage = document.getElementById('old-image-thumbnail');
                if (oldImage) {
                    oldImage.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }
    });


    document.getElementById('signature').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const signature = document.getElementById('signature-thumbnail');
                signature.src = e.target.result;
                signature.style.display = 'block';

                // Hide the old signature if it exists
                const oldSignature = document.getElementById('old-signature-thumbnail');
                if (oldSignature) {
                    oldSignature.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }
    });
});