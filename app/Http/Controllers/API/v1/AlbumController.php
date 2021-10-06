<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{

    public function index()
    {
        $album = Album::get();
        return view('album.index', compact('album'));
    }
    public function get($id)
    {
        $album = Album::with('images')->find($id);
        return view('album',compact('album'));

    }
    public function create()
    {
        return view('createalbum');
    }
    public function upload(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string|max:225',
            'album_id' => 'required|exists:albums,id',

        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'gallery_image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        Album::create($input);


        return back()
            ->with('success', 'Image Uploaded successfully.');
    }


    public function destroy(Album $album)
    {
        $album->delete();
        return back()
            ->with('success', 'Image removed successfully.');
    }
}
