<?php

return [
    'allowedFileTypes' => [
        "zip",
        "gz",
        "tar",
        "rar",
        "7z",
    ],

    'fileType' => env('COMPRESSION_FILE_TYPE', 'zip'),
    'filePath' => env('COMPRESSION_FILE_PATH', storage_path('app/public')),
    'fileName' => env('COMPRESSION_FILE_NAME', 'lendo'),
    'fileToCompress' => env(
        'COMPRESSION_FILE_TO_COMPRESS',
        base_path('public/lendo.jpeg')
    ),
];
