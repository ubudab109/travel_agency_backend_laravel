<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait DeleteImagesTrait
{

    public function deleteImages($folder = null, $filename = null, $disk = 'public')
    {
        $image = $folder . $filename;
        $exist = Storage::disk($disk)->exists($image);
        if ($exist) {
            $unlink = Storage::disk($disk)->delete($image);
        } else {
            $unlink = "File Not Exist";
        }

        return $unlink;
    }
}
