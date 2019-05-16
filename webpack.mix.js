let mix = require("laravel-mix");

mix.styles(
    [
        "resources/assets/fonts/feather/feather.min.css",
        "resources/assets/libs/highlight/styles/vs2015.min.css",
        "resources/assets/libs/quill/dist/quill.core.css",
        "resources/assets/libs/select2/dist/css/select2.min.css",
        "resources/assets/libs/flatpickr/dist/flatpickr.min.css",
        "resources/assets/css/theme.min.css",
        "resources/assets/css/custom.css"
    ],
    "public/css/app.css"
)
    .scripts(
        [
            "resources/assets/libs/jquery/dist/jquery.min.js",
            "resources/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js",
            "resources/assets/libs/chart.js/dist/Chart.min.js",
            "resources/assets/libs/chart.js/Chart.extension.min.js",
            "resources/assets/libs/highlight/highlight.pack.min.js",
            "resources/assets/libs/flatpickr/dist/flatpickr.min.js",
            "resources/assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js",
            "resources/assets/libs/list.js/dist/list.min.js",
            "resources/assets/libs/quill/dist/quill.min.js",
            "resources/assets/libs/dropzone/dist/min/dropzone.min.js",
            "resources/assets/libs/select2/dist/js/select2.min.js",
            "resources/assets/js/theme.js"
        ],
        "public/js/app.js"
    )
    .copyDirectory(["resources/assets/img"], "public/img")
    .copyDirectory("resources/assets/fonts", "public/fonts")
    .copyDirectory("resources/assets/fonts/feather/fonts", "public/css/fonts");
