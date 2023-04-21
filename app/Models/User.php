<?php

namespace App\Models;

use DB, Session, Cache;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\MailQueue;

class User extends Authenticatable {

    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    //protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function weightType(){
        return [
            ["id"=>1, "type"=>"G"],
            ["id"=>2, "type"=>"Cts"],
            ["id"=>3, "type"=>"Ratti"]
        ];
    }

    public static function mesurementType(){
        return [
            ["id"=>1, "type"=>"MM"],
            ["id"=>2, "type"=>"CM"],
            ["id"=>3, "type"=>"INCH"]
        ];
    }
    
}
