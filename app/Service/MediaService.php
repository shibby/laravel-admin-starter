<?php

namespace App\Service;

use App\Model\Media;
use Shibby\Loilerplate\Util\StringUtil;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaService
{
    public function saveMedia($path, $title = null): Media
    {
        //todo: thumbnails etc
        $media = new Media();
        $media->path = $path;
        $media->title = $title;
        if ($user = auth()->user()) {
            $media->user_id = $user->id;
        }
        $media->save();

        return $media;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param $folder
     * @param null|string $filename filename with extension
     *
     * @return string
     *
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    public function uploadMedia(UploadedFile $uploadedFile, $folder, $filename = null)
    {
        if (null === $filename) {
            $filename = StringUtil::slug($uploadedFile->getClientOriginalName(), '_').'_'.str_random(6).'.'.$uploadedFile->getClientOriginalExtension();
        }

        if (!\File::exists(storage_path('app'.$folder))) {
            \File::makeDirectory(storage_path('app'.$folder));
        }
        $uploadedFile->move(storage_path('app'.$folder), $filename);

        return $folder.'/'.$filename;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param $folder
     * @param null $filename
     *
     * @return Media
     *
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    public function uploadAndSaveMedia(UploadedFile $uploadedFile, $folder, $filename = null)
    {
        $uploadedPath = $this->uploadMedia($uploadedFile, $folder, $filename);

        return $this->saveMedia($uploadedPath);
    }
}
