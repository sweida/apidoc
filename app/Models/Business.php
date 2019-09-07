<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class business extends Model
{
    // 接受的字段
    protected $fillable = [
        'name', 'license', 'type'
    ];
    

}
