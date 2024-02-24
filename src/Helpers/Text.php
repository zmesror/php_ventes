<?php
namespace App\Helpers;

class Text {

    public static function excerpt(string $description, int $limit = 10)
    {
        if (mb_strlen($description) <= $limit) {
            return $description;
        }
        return substr($description, 0, $limit) . '...';
    }

}