<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();

        return view('admin.images.index', compact('images'));
    }
//    public function get($id)
//    {
//        $album = Album::with('images')->find($id);
//        return view('album',compact('album'));
//
//    }
    public function edit($id)
    {

        $image =Image::findOrFail($id);

        return view('admin.images.edit', compact(['image']));
    }
    public function create()
    {
        $albums=Album::all();
        return view('admin.images.create',compact('albums'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [

            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'album_id' => 'required|exists:albums,id',


        ]);

        $name = $request->file('photo')->getClientOriginalName();

        $path = $request->file('photo')->storeAs('public/images', $name);


        $image= new Image();
        $image->album_id = $request->input('album_id');


        $image->photo = $name;

        $image->save();
        return redirect()->route('images.index')
            ->with('success', 'images created successfully.');
    }
//    public function update(Request $request, Album $album)
//    {
//        $this->validate($request, [
//            'title' => 'required|string|max:50',
//            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'body' => 'required|string|max:225',
//
//
//        ]);
//
//        if ($request->file('image') != '') {
//            $path = public_path("\storage\album\\") . $album->image;
//
//
//            if (File::exists($path)) {
//                File::delete($path);
//            }
//
//
//            $name = $request->file('image')->getClientOriginalName();
//            $path = $request->file('image')->storeAs('public/album', $name);
//        } else {
//            $name = $album->image;
//        }
//
//        $album->image = $name;
//        $album->title = $request->input('title');
//        $album->body = $request->input('body');
//
//
//
//
//
//        $album->update();
//        return redirect()->route('album.index')
//            ->with('success', 'album created successfully.');
//    }


    public function destroy($id)
    {
        $photo = Image::findOrFail($id);

        $photo->delete($id);
        $path = public_path("\storage\images\\") . $photo->image;
        File::delete($path);


        return redirect()->route('images.index')
            ->with('success', 'Posts deleted successfully');
    }
}
