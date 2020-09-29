<?php

namespace App;

use App\Service;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function services()
    {
        return $this
            ->belongsToMany('App\Service')
            ->withTimestamps();
    }
}
