<?php

namespace App\Http\Controllers\Api;

use App\Models\Apidoc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ApidocRequest;

class ApidocController extends Controller
{
    public function add(Request $request) {
        // 接口属于哪个分类下的 classify
        // 接口名 url
        // 接口描叙 title
        // 请求类型 requestType
        // 请求参数 RequestParams
        // 接口返回值 results
        // 接口作者 user_id

        $user = Auth::guard('api')->user();
        $array = $request->all();
        $array['user_id'] = $user['id'];

        Apidoc::create($array);
        return $this->message("api添加成功！");
    }

    public function edit(Request $request) {
        // 要可以修改下架的文章
        $doc = Apidoc::findOrFail($request->id);
        $doc->update($request->all());
        return $this->message("api修改成功！");
        
    }

    // 软删除
    public function delete(Request $request) {
        Apidoc::findOrFail($request->id)->delete();
        return $this->message('api下架成功');
    }

    // 恢复软删除
    public function restored(Request $request){
        Apidoc::withTrashed()->findOrFail($request->id)->restore();
        return $this->message('api恢复成功');
    }

    // 获取列表
    public function list(Request $request) {
        $docs = Apidoc::orderBy('classify', 'desc')->paginate(20);
        return $this->success($docs);  
    }
    // 按分类查询
    public function query(Request $request) {
        $docs = Apidoc::where("classify", $request->classify)->orderBy('created_at', 'desc')->paginate(20);
        return $this->success($docs);
    }

    // 获取软删除列表
    public function deleteList(Request $request) {
        $docs = Apidoc::onlyTrashed()->orderBy('created_at', 'desc')->paginate(20);
        return $this->success($docs);
    }

    // 查看个人列表
    public function person(Request $request) {
        $user = Auth::guard('api')->user();
        $docs = Apidoc::where("user_id", $user['id'])->orderBy('created_at', 'desc')->paginate(20);
        return $this->success($docs);
    }
}
