<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait
{
    public function storageTraitUpload(Request $request, $fieldName, $folderName)
    {
        if ($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $request->file($fieldName)->storeAs('public/' . $folderName,$fileName);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($path)
            ];
            return $dataUploadTrait;
        }
        return null;
    }
}
