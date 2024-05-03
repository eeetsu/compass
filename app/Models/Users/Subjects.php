<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Subjects extends Model
{
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];

    public function users(){
        // return;$this->belongsTo('App\User');// リレーションの定義
        return $this->belongsToMany('App\Models\Users\User', 'subject_users', 'subject_id', 'user_id');
        // ２行目は中間テーブル名
        //
    }
}
