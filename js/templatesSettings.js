
(function (CKEDITOR) {
    "use strict";
    
    // Load templates
    CKEDITOR.on("instanceReady", function () {
        if (CKEDITOR.plugins.get('templates')) {
            CKEDITOR.config.templates_replaceContent = false;
            CKEDITOR.config.templates_files = [
                '/modules/ckeditor_templates/default.js'
            ];
        }
    });

})(CKEDITOR);
