<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $image = Image::get();
        return view('image-gallery', compact('image'));
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
        Image::create($input);


        return back()
            ->with('success', 'Image Uploaded successfully.');
    }


    public function destroy(Image $image)
    {
        $image->delete();
        return back()
            ->with('success', 'Image removed successfully.');
    }
}
