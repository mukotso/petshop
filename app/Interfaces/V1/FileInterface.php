<?php

namespace App\Interfaces\V1;


interface FileInterface
{

    public function createFile(array $file_details);

    public function showFileDetails($file_uuid);

    public function UpdateFileDetails($file_uuid);

    public function deleteFile($file_uuid);


}
