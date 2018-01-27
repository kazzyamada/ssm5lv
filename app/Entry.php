<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    //
    //hasMany設定
    public function task()
    {
        return $this->hasMany('App\Task');
    }

}
