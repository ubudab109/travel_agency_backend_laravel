<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;


trait UploadTrait
{
    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);
        $file = $uploadedFile->storeAs($folder, $name . '.' . $uploadedFile->getClientOriginalExtension(), $disk);
        return $file;
    }

    function uploadMultiple(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = [])
    {
        $data = [];

        // if (is_array($filename)) {
        foreach ($filename as $image) {
            $name = !is_null($image) ? $image : Str::random(25);
            $file = $uploadedFile->storeAs($folder, $name . '.' . $uploadedFile->getClientOriginalExtension(), $disk);
            array_push($data, $file);
            // $data[] = $file;
        }
        // }
        return $data;
    }
}
