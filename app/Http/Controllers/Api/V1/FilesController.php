<?php

namespace App\Http\Controllers\Api\V1;

use App\Interfaces\V1\FileInterface;
use App\Models\File;
use Illuminate\Http\Request;

class FilesController extends Controller
{

    protected FileInterface $fileRepository;

    public function __construct(FileInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function upload(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }


}
