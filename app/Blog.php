<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
    
    public function histories() {
        //関連づいているレコードを全部取得する
        return $this->hasmany('App\History');
    }
    
}
