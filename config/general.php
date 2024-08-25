<?php

return[
    'default_files_path' => trim(
        env('DEFAULT_FILES_PATH', 'default'), '/'
    ),
    'default_files_path_url' =>env('DEFAULT_FILES_PATH_URL', '/'),
];
