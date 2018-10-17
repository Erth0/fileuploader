<?php

namespace App;

class Validator
{
    /**
     * Allowed File Extensions
     *
     * @var array
     */
    protected $allowedFileExtensions;

    /**
     * Maximu File Size Allowed
     *
     * @var integer
     */
    protected $maxAllowedFileSize; 

    public function __construct ($allowedFileExtensions, $maxAllowedFileSize)
    {
        $this->allowedFileExtensions = $allowedFileExtensions;
        $this->maxAllowedFileSize = $maxAllowedFileSize;
    }

    /**
     * Validates The File
     *
     * @param array $file
     * @return void
     */
    public function validateFile ($file)
    {
        if (!in_array($this->getFileExtension($file), $this->allowedFileExtensions)) {
            echo json_encode([
                'success' => false,
                'type' => 'Warning',
                'classType' => 'warning',
                'message' => 'File format is not allowed please upload only type (' . $this->allowedFilesTypes() . ')'
            ]);

            return false;
        }else if($file['size'] > $this->maxAllowedFileSize){
            echo json_encode([
                'success' => false,
                'type' => 'Warning',
                'classType' => 'warning',
                'message' => 'File size has exeeded 2MB'
            ]);
            
            return false;
        }else {
            echo json_encode([
                'success' => true,
                'type' => 'Success',
                'classType' => 'success',
                'message' => 'File has been uploaded successfully'
            ]);

            return true;
        }
    }

    /**
     * Returns the file types in a string
     *
     * @return string
     */
    public function allowedFilesTypes ()
    {
        return implode(', ', $this->allowedFileExtensions);
    }

    /**
     * Get the file extension
     *
     * @param array $file
     * @return void
     */
    public function getFileExtension ($file)
    {
        return pathinfo($file["name"], PATHINFO_EXTENSION);
    }
}
