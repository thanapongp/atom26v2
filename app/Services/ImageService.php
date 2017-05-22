<?php

namespace Atom26\Services;

class ImageService
{
    /**
     * Optimize an image and move it to desired path.
     * 
     * @param  string  $path
     * @param  string  $intendedPath
     * @param  integer $quality
     * @return string  Where the optimized image is now located.
     */
    public function optimize($path, $intendedPath, $quality = 50, $deleteOriginal = false)
    {
        $filename = pathinfo($path)['filename'];
        $extension = pathinfo($path)['extension'];

        $image = imagecreatefromfile(public_path() . $path);
        $newFilename = $intendedPath . $filename . '.' . $extension;

        if (! file_exists(public_path() . $intendedPath)) {
            mkdir(public_path() . $intendedPath, 0775, true);
        }

        imagejpeg($image, public_path() . $newFilename, $quality);

        imagedestroy($image);

        if ($deleteOriginal) {
            chmod(public_path() . $path, 0777);
            unlink(public_path() . $path);
        }

        return $newFilename;
    }

    public function resize($path, $intendedPath, $newWidth = 500, $newHeight = 500)
    {
        $sourceImage = imagecreatefromfile(public_path() . '/' . $path);

        $newFilename = $intendedPath . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];

        if (! file_exists(public_path() . '/' . $intendedPath)) {
            mkdir(public_path() . '/' . $intendedPath, 0775, true);
        }

        $sourceImageW = imagesx($sourceImage);
        $sourceImageH = imagesy($sourceImage);

        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $sourceImageW, $sourceImageH);

        imagejpeg($resizedImage, public_path() . '/' . $newFilename, 50);
        imagedestroy($resizedImage);
        imagedestroy($sourceImage);

        chmod(public_path() . '/' . $path, 0777);
        unlink(public_path() . '/' . $path);

        return $newFilename;
    }
}
