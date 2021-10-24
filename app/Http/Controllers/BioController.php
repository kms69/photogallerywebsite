<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BioController extends Controller
{
    public function index()
    {
        $bios = Bio::all();
        return view('admin.bio.index', compact('bios'));
    }

    public function edit($id)
    {

        $bio = Bio::findOrFail($id);

        return view('admin.bio.edit', compact(['bio']));
    }
    public function create()
    {
        return view('admin.bio.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required|string',


        ]);

        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->storeAs('public/bio', $name);


        $bio= new Bio();
        $bio->body = $request->input('body');


        $bio->image = $name;

        $bio->save();
        return redirect()->route('bio.index')
            ->with('success', 'album created successfully.');
    }
    public function update(Request $request, Bio $bio)
    {
        $this->validate($request, [

            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required|string',


        ]);

        if ($request->file('image') != '') {
            $path = public_path("\storage\bio\\") . $bio->image;


            if (File::exists($path)) {
                File::delete($path);
            }


            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/bio', $name);
        } else {
            $name = $bio->image;
        }

        $bio->image = $name;

        $bio->body = $request->input('body');





        $bio->update();
        return redirect()->route('bio.index')
            ->with('success', 'album created successfully.');
    }


    public function destroy($id)
    {
        $bio = Bio::findOrFail($id);

        $bio->delete($id);
        $path = public_path("\storage\bio\\") . $bio->image;
        File::delete($path);


        return redirect()->route('bio.index')
            ->with('success', 'Posts deleted successfully');
    }
}
