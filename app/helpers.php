<?php

/**
 * Create GD resource from file.
 *
 * @param $path
 * @return resource
 * @throws InvalidArgumentException
 */
function imagecreatefromfile($path)
{
    if (! file_exists($path)) {
        throw new InvalidArgumentException($path . ' not found');
    }

    $fileType = getimagesize($path)[2];

    switch ($fileType) {
        case IMAGETYPE_PNG:
            return imagecreatefrompng($path);
        case IMAGETYPE_JPEG:
            return imagecreatefromjpeg($path);
        case IMAGETYPE_GIF:
            return imagecreatefromgif($path);
        case IMAGETYPE_BMP:
            return imagecreatefrombmp($path);
        default:
            throw new InvalidArgumentException('File type not supported');
    }
}

function imagecreatefrombmp($filename) {
    $file = fopen( $filename, "rb" );
    $read = fread( $file, 10 );
    while( !feof( $file ) && $read != "" )
    {
        $read .= fread( $file, 1024 );
    }
    $temp = unpack( "H*", $read );
    $hex = $temp[1];
    $header = substr( $hex, 0, 104 );
    $body = str_split( substr( $hex, 108 ), 6 );
    if( substr( $header, 0, 4 ) == "424d" )
    {
        $header = substr( $header, 4 );
        // Remove some stuff?
        $header = substr( $header, 32 );
        // Get the width
        $width = hexdec( substr( $header, 0, 2 ) );
        // Remove some stuff?
        $header = substr( $header, 8 );
        // Get the height
        $height = hexdec( substr( $header, 0, 2 ) );
        unset( $header );
    }
    $x = 0;
    $y = 1;
    $image = imagecreatetruecolor( $width, $height );
    foreach( $body as $rgb )
    {
        $r = hexdec( substr( $rgb, 4, 2 ) );
        $g = hexdec( substr( $rgb, 2, 2 ) );
        $b = hexdec( substr( $rgb, 0, 2 ) );
        $color = imagecolorallocate( $image, $r, $g, $b );
        imagesetpixel( $image, $x, $height-$y, $color );
        $x++;
        if( $x >= $width )
        {
            $x = 0;
            $y++;
        }
    }
    return $image;
}

function redirectBasedOnUserRole($user)
{
    if ($user->isAdmin()) {
        return redirect('/dashboard/admin');
    }

    if ($user->hasRole('hostess') || $user->hasRole('unihostess')) {
        return redirect('/dashboard/hostess');
    }

    if ($user->hasRole('editor')) {
        return redirect('/dashboard/editor');
    }

    return redirect('/profile');
}