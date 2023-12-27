<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Plank\Mediable\Facades\MediaUploader;

trait Upload
{
    public static function uploadBase64Avatar($base64Image, $path = '')
    {
        $extension = explode('/', explode(':', substr($base64Image, 0, strpos($base64Image, ';')))[1])[1]; // .jpg .png .pdf
        $replace = substr($base64Image, 0, strpos($base64Image, ',') + 1);
        // find substring fro replace here eg: data:image/png;base64,
        $image = str_replace($replace, '', $base64Image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10).'.'.$extension;
        Storage::disk('public')->put($path.'/'.$imageName, base64_decode($image));

        return $imageName;
    }

    public static function uploadBase64AvatarAndResize($base64Image, $path)
    {
        $extension = explode('/', explode(':', substr($base64Image, 0, strpos($base64Image, ';')))[1])[1];

        $image = Image::make(file_get_contents($base64Image))->orientate()
            ->resize(250, 250, function ($constraints) {
                $constraints->upsize();
                $constraints->aspectRatio();
            });
        $imageName = Str::random(10).'.'.$extension;
        Storage::disk('public')->put($path.'/'.$imageName, $image->encode());

        return $imageName;
    }

    public static function uploadAvatarAndResize($image, $path)
    {

        $filename = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();

        $image = Image::make($image->getRealPath())->orientate()
            ->resize(250, 250, function ($constraints) {
                $constraints->upsize();
                $constraints->aspectRatio();
            });
        $imageName = Str::random(10).'.'.$extension;
        Storage::put($path.'/'.$imageName, $image->encode());

        return $imageName;
    }

    public function uploadMultipleFiles($request, $model, $type)
    {
        foreach ($request->file('files') as $key => $file) {

            $media = MediaUploader::fromSource($file)
                ->setMaximumSize(1024 * 1024 * 20)
                ->setStrictTypeChecking(true)
                ->setAllowedMimeTypes([
                    'text/csv',
                    'image/jpg',
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                    'application/pdf',
                    'application/msword',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                ])
                ->setAllowedExtensions(['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'gif'])
                ->toDisk('public')
                ->useOriginalFilename()
                ->toDirectory($type.'/'.$model->id)
                ->upload();

            $model->attachMedia($media, 'files');

        }
    }
}
