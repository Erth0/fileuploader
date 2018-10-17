<?php

namespace App;

use App\Validator;
use Database\Connection;

class FileUpload extends Connection
{
    /**
     * Current file to be uploaded
     *
     * @var array
     */
    protected $file;

    /**
     * File Validator Class
     *
     * @var Validator
     */
    protected $validator;

    public function __construct($file, $configurations)
    {
        $this->file = $file;
        $this->validator = new Validator($configurations['allowed-files'], $configurations['allowed-file-size']);
        parent::__construct($configurations['database']);
        $this->uploadFile();
    }

    /**
     * Handle the upload proccess
     *
     * @return void
     */
    protected function uploadFile ()
    {
        if ($this->exists($this->file['tmp_name'])) {
            if ($this->validator->validateFile($this->file)) {
                move_uploaded_file($this->file['tmp_name'], 'tmp_files/' . $fileName = $this->generateFileName($this->file['name']));
                $this->insertFileIntoDatabase($fileName);
            }
        }
    }

    /**
     * Generates File Name
     *
     * @param string $fileName
     * @return string
     */
    private function generateFileName ($fileName)
    {
        return time() . '-' . $fileName;
    }

    /**
     * Inserts File Path Into the database
     *
     * @param string $fileName
     * @return void
     */
    private function insertFileIntoDatabase ($fileName)
    {
        $result = $this->query("INSERT INTO images(file_path, created_at, updated_at) VALUES('$fileName', NOW(), NOW())");
    }

    /**
     * Checks if the file exists or not
     *
     * @param string $filePath
     * @return boolean
     */
    private function exists ($filePath)
    {
        if (file_exists($filePath)) {
            return true;
        }

        return false;
    }

}