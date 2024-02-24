<?php
namespace App;

use \PDO;

class Config {
    
    public static function getPDO(): PDO {
        return new PDO('mysql:host=127.0.0.1;dbname=ensaf_ventes', 'root', '');
    }
}