<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Url extends Model
{
    protected $fillable = ['url', 'shortened'];
    public $timestamps = false;

    //Creer un short random
    public static function getUniqueShortUrl(){
        $shortened = Str::random(5);

        if(self::whereShortened($shortened)->count() > 0){
            return self::getUniqueShortUrl();
        }

        return $shortened;
    }
}
