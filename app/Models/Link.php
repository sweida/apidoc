<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    // 接受的字段
    protected $fillable = [
        'title', 'url', 'username', 'password', 'type'
    ];

    // 表格隐藏的字段
    protected $hidden = [
        'updated_at'
    ];
}
