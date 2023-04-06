<?php

namespace App\Interfaces;


interface FileInterface
{

    public function createFile($file_details);

    public function showFileDetails($file_uuid);

    public function UpdateFileDetails($file_uuid);

    public function deleteFile($file_uuid);


}
