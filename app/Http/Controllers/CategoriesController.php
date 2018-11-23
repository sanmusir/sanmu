<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{
    //分类话题展示
    public function show(Category $category, Request $request,Topic $topic)
    {
        $topics = $topic->withOrder($request->order)
            ->where('category_id', $category->id)
            ->paginate();
        return view('topics.index',compact('topics','category'));
    }
}
