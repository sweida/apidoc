<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apidoc extends Model
{
    // 软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    // 接受的字段
    protected $fillable = [
        'project_id', 'url', 'title', 'requestType', 'requestParams', 'results', 'user_id'
    ];

    // 表格隐藏的字段
    protected $hidden = [
        'updated_at'
    ];

    public function project() {
        return $this->belongsTo('App\Models\Project');
    }
}
