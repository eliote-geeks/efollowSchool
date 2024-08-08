<?php
return [
    'pdf' => [
        'enabled' => true,
        'binary' => env('SNAPPY_PDF_BINARY', '/usr/local/bin/wkhtmltopdf'),
        'options' => [],
        'env' => [],
    ],
    'image' => [
        'enabled' => true,
        'binary' => env('SNAPPY_IMAGE_BINARY', '/usr/local/bin/wkhtmltoimage'),
        'options' => [],
        'env' => [],
    ],
];
