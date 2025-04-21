function generateThumbnail(file, previewElement, thumbnailElement) {
    const reader = new FileReader();

    reader.onload = function(e) {
        const img = new Image();
        img.src = e.target.result;
        img.onload = function() {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const MAX_WIDTH = 150;
            const MAX_HEIGHT = 150;

            let width = img.width;
            let height = img.height;
            if (width > height) {
                if (width > MAX_WIDTH) {
                    height = Math.round(height * (MAX_WIDTH / width));
                    width = MAX_WIDTH;
                }
            } else {
                if (height > MAX_HEIGHT) {
                    width = Math.round(width * (MAX_HEIGHT / height));
                    height = MAX_HEIGHT;
                }
            }

            canvas.width = width;
            canvas.height = height;
            ctx.drawImage(img, 0, 0, width, height);
            thumbnailElement.src = canvas.toDataURL('image/jpeg');
            thumbnailElement.style.display = 'block';
        };
    };

    reader.readAsDataURL(file);
}

document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        generateThumbnail(file, '#image-preview', document.getElementById('image-thumbnail'));
    }
});

document.getElementById('signature').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        generateThumbnail(file, '#signature-preview', document.getElementById('signature-thumbnail'));
    }
});
