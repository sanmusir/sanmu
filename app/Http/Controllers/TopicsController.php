<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Models\Favorite;
use Auth;
use App\Handlers\ImageUploadHandler;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    //话题首页
	public function index(Request $request, Topic $topic)
	{
        $topics = $topic->withOrder($request->order)->paginate();
		return view('topics.index', compact('topics'));
	}

	//展示话题
    public function show(Topic $topic)
    {
        $favorite_ids = Favorite::where('user_id',Auth::id())->pluck('topic_id')->toArray();
        return view('topics.show', compact('topic','favorite_ids'));
    }

    //创建话题
	public function create(Topic $topic,Category $category)
	{
	    $categories = $category->all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	//保存话题
	public function store(TopicRequest $request,Topic $topic)
	{
	    $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();

		return redirect()->route('topics.show', $topic->id)->with('success', '发布话题成功！');
	}

	//编辑话题
	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	//更新话题
	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('success', '更新成功！');
	}

	//删除话题
	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('users.show',Auth::id())->with('success', '删除成功！');
	}

	//上传图片
	public function uploadImage(Request $request,ImageUploadHandler $uploader)
    {
        //初始化返回数据,默认是失败
        $data = [
            'success' => 'false',
            'msg'     => '上传图片失败！',
            'file_path' => '',
        ];
        //判断是否有图片上传
        if($request->upload_pic){
            $result = $uploader->save($request->upload_pic,'topics',Auth::id(),800);
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }

        return $data;
    }

    //收藏文章
    public function favoritePost(Topic $topic)
    {
        Auth::user()->favorites()->attach($topic->id);
        return ;
    }

    //取消收藏
    public function unFavoritePost(Topic $topic)
    {
        Auth::user()->favorites()->detach($topic->id);
        return ;
    }

}