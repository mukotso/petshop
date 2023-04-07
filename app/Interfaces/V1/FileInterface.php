<?php

namespace App\Interfaces\V1;


interface FileInterface
{

    public function uploadFile(array $file_details);

    public function showFileDetails($file_uuid);


}
