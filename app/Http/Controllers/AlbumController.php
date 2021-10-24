<?php

namespace App\Http\Controllers;


use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AlbumController extends Controller
{

    public function index()
    {
        $albums = Album::all();
        return view('admin.album.index', compact('albums'));
    }
    public function get($id)
    {
        $album = Album::with('images')->find($id);
        return view('album',compact('album'));

    }
    public function edit($id)
    {

        $album = Album::findOrFail($id);

        return view('admin.album.edit', compact(['album']));
    }
    public function create()
    {
        return view('admin.album.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required|string|max:225',


        ]);

        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->storeAs('public/album', $name);


       $album= new Album();
        $album->title = $request->input('title');
        $album->body = $request->input('body');


        $album->image = $name;

        $album->save();
        return redirect()->route('album.index')
            ->with('success', 'album created successfully.');
    }
    public function update(Request $request, Album $album)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required|string|max:225',


        ]);

        if ($request->file('image') != '') {
            $path = public_path("\storage\album\\") . $album->image;


            if (File::exists($path)) {
                File::delete($path);
            }


            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/album', $name);
        } else {
            $name = $album->image;
        }

        $album->image = $name;
        $album->title = $request->input('title');
        $album->body = $request->input('body');





        $album->update();
        return redirect()->route('album.index')
            ->with('success', 'album created successfully.');
    }


    public function destroy($id)
    {
        $album = Album::findOrFail($id);

        $album->delete($id);
        $path = public_path("\storage\album\\") . $album->image;
        File::delete($path);


        return redirect()->route('posts.index')
            ->with('success', 'Posts deleted successfully');
    }
}
