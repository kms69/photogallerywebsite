<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{


    public function index()
    {
        $posts = Post::all();
        $categories = Category::with('post')->get();


        return view('admin.posts.index', compact('posts', 'categories'));

    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function edit($id)
    {

        $categories = Category::with('post')->get();
        $post = Post::findOrFail($id);

        return view('admin.posts.edit', compact(['post', 'categories']));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish_date' => 'required|string|max:50',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',

        ]);


        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->storeAs('post/images', $name);


        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->publish_date = $request->input('publish_date');
        $post->category_id = $request->input('category_id');

        $post->image = $name;

        $post->save();
        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');

    }


    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish_date' => 'required|string|max:50',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',

        ]);

        if ($request->file('image') != '') {
            $path = public_path("\storage\post\images\\") . $post->image;

            if ($post->image != '' && $post->image != null) {
                $file_old = $path;
                unlink($file_old);
            }

            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('post/images', $name);


            $post->image = $name;
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->publish_date = $request->input('publish_date');
            $post->category_id = $request->input('category_id');

            $post->update();
            return redirect()->route('posts.index')
                ->with('success', 'Post updated successfully');
        }

    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete($id);
        $path = public_path("\storage\post\images\\") . $post->image;
        unlink($path);
        Session::flash('delete_post', 'مطلب با موفقیت حذف شد');

        return redirect()->route('posts.index')
            ->with('success', 'Posts deleted successfully');
    }
}
