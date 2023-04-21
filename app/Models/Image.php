<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    public static function imageMode(){

        return [
            1 => "Gems",
            2 => "jewellery",
            3 => "Diamond",
            4 => "Rudraksh",
            5 => "Others",
            6 => "Front",
            7 => "Back"
        ];

    }
}

