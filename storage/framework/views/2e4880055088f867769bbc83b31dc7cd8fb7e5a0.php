<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <link rel="stylesheet" type="text/css" href="/swagger/swagger-ui.css" />
    <link rel="icon" type="image/png" href="/swagger/favicon-32x32.png" sizes="32x32" />
    <style>
        html {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }
        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }
        body {
            margin: 0;
            background: #fafafa;
        }
    </style>
</head>
<body>
<div id="swagger-ui"></div>
<script src="/swagger/swagger-ui-bundle.js"></script>
<script src="/swagger/swagger-ui-standalone-preset.js"></script>
<script>
    window.onload = function () {
        const ui = SwaggerUIBundle({
            url: "/api/docs",
            dom_id: '#swagger-ui',
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            layout: "StandaloneLayout"
        });
    };
</script>
</body>
</html>
<?php /**PATH /home/dev/Projet/travail/tuto dart/requette.combo.fun/resources/views/swagger.blade.php ENDPATH**/ ?>