<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['content'];
    //用户和微博是一对多的数据关联
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
