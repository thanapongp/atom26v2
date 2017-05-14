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
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

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
}
