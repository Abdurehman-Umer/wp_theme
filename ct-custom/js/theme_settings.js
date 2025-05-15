jQuery(document).ready(function ($) {
    var mediaUploader;

    $('#upload-logo-button').click(function (e) {
        e.preventDefault();

        // If the uploader instance exists, reopen it.
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        // Create a new media uploader instance.
        mediaUploader = wp.media({
            title: 'Choose Logo',
            button: {
                text: 'Use this logo',
            },
            multiple: false,
        });

        // When an image is selected, run this callback.
        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#theme_logo').val(attachment.url);
            $('#theme-logo-preview').attr('src', attachment.url);
        });

        // Open the uploader dialog.
        mediaUploader.open();
    });

    $('#remove-logo-button').click(function (e) {
        e.preventDefault();
        $('#theme_logo').val('');
        $('#theme-logo-preview').attr('src', 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png');
    });
});
