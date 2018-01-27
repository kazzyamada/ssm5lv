<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    //belongsTo設定
    public function entry()
    {
        // 連結カラムをentry_id ではなく entries_idにしたので、見つからない
//        return $this->belongsTo('App\Entry');
        // Laravel 5.1 Eloquent
        // リレーションする外部キーが暗黙と違う時は、第２引数に指定する。
        // リレーションされるキーがidで無い場合は、第３引数に指定する。
        // https://readouble.com/laravel/5.1/ja/eloquent-relationships.html
        return $this->belongsTo('App\Entry', 'entries_id');
    }

}
