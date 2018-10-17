<?php

return $configuration =  [
    'database' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'dbname' => 'fileuploader',
        'username' => 'root',
        'password' => ''
    ],
    'allowed-files' => [
        'png',
        'jpg',
        'jpeg'
    ],
    'allowed-file-size' => 2000000,
    'root_path' => 'C:\laragon\www\fileuploader\\'
];