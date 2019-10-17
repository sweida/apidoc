<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\Apidoc;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
        // 新增项目
    public function add(ProjectRequest $request) {
        $project = Project::create($request->all());
        return $this->message("新建项目成功！");
    }

    // 项目列表
    public function list() {
        $projects = Project::orderBy('created_at')->get();
        // 拿回文章的标签和评论总数
        foreach($projects as $item){
            $item->count = Apidoc::where('project_id', $item->id)->count();
        }  
        return $this->success($projects);
    }

    // 修改项目
    public function edit(ProjectRequest $request) {
        $project = Project::findOrFail($request->id);
        $project->update($request->all());
        return $this->message("项目修改成功！");
    }

    // 删除项目
    public function delete(ProjectRequest $request) {
        $counts = Apidoc::where('project_id', $request->id)->count();
        if ($counts != 0) {
            return $this->failed('项目里面不为空，不能删除该项目', 200);
        }
        Project::findOrFail($request->id)->delete();
        return $this->message("项目删除成功！");
    }
}
