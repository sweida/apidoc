<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApidocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apidocs', function (Blueprint $table) {
            // 接口属于哪个分类下的 classify
            // 接口名 url
            // 接口描叙 title
            // 请求类型 requestType
            // 请求参数 requestParams
            // 接口返回值 results
            // 接口作者 user_id
            // unique 唯一
            // nullable 可以为空
            $table->Increments('id');
            $table->unsignedInteger('project_id');
            $table->string('url');
            $table->string('title')->nullable();
            $table->string('requestType');
            $table->string('requestParams')->nullable();
            $table->string('results')->nullable();
            $table->unsignedInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apidocs');
    }
}
