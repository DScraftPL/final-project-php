<?php

namespace App\Constants;

class ProfilePictures
{
    const IMAGES = [
        1 => '/images/avatar1.png',
        2 => '/images/avatar2.png',
        3 => '/images/avatar3.png',
        4 => '/images/avatar4.png',
        5 => '/images/avatar5.png'
    ];

    public static function getImagePath($imageId)
    {
        return self::IMAGES[$imageId] ?? self::IMAGES[1];
    }
}


