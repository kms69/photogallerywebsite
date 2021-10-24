<?php

namespace App\Http\Controllers;

use App\Models\Cvper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CvperController extends Controller
{
    public function index()
    {
        $cvs = Cvper::all();
        return view('admin.cvper.index', compact('cvs'));
    }

    public function edit($id)
    {

        $cv = Cvper::findOrFail($id);

        return view('admin.cvper.edit', compact(['cv']));
    }
    public function create()
    {
        return view('admin.cvper.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'body' => 'required|string',


        ]);

        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->storeAs('public/cv', $name);


        $cv= new Cvper();
        $cv->image = $name;
        $cv->body = $request->input('body');







        $cv->save();
        return redirect()->route('cvper.index')
            ->with('success', 'bio created successfully.');
    }
    public function update(Request $request, Cvper $cvper)
    {
        $this->validate($request, [

            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required|string',


        ]);

        if ($request->file('image') != '') {
            $path = public_path("\storage\cv\\") . $cvper->image;


            if (File::exists($path)) {
                File::delete($path);
            }


            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/cv', $name);
        } else {
            $name = $cvper->image;
        }


        $cvper->image = $name;
        $cvper->body = $request->input('body');





        $cvper->update();
        return redirect()->route('cvper.index')
            ->with('success', 'ccv created successfully.');
    }


    public function destroy($id)
    {
        $cv = Cvper::findOrFail($id);

        $cv->delete($id);
        $path = public_path("\storage\cv\\") . $cv->image;
        File::delete($path);


        return redirect()->route('cv.index')
            ->with('success', 'BIo deleted successfully');
    }
}
