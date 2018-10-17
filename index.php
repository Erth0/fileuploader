<?php

use App\FileUpload;
require 'app/Autoloader.php';
require 'config/config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

Autoloader::register($configuration['root_path']);

if (isset($_FILES['file-upload'])) {
    $fileUpload = new FileUpload($_FILES['file-upload'], $configuration);
}
