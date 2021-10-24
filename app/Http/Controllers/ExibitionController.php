<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exibition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ExibitionController extends Controller
{
    public function index()
    {
        $exibitions = Exibition::all();

        return view('admin.exibition.index',compact('exibitions'));


    }
    public function edit($id)
    {

        $exibition = Exibition::findOrFail($id);

        return view('admin.exibition.edit', compact(['exibition']));
    }
    public function create()
    {
        return view('admin.exibition.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required|string|max:225',
            'location' => 'required|string|max:225',


        ]);
        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->storeAs('public/exibition', $name);


        $exibition= new Exibition();
        $exibition->title = $request->input('title');
        $exibition->image = $name;
        $exibition->date = $request->input('date');
        $exibition->location = $request->input('location');





        $exibition->save();
        return redirect()->route('exibition.index')
            ->with('success', 'exibition created successfully.');
    }

    public function update(Request $request, Exibition $exibition)
    {
        $this->validate($request, [

            'title' => 'required|string|max:50',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required|string|max:225',
            'location' => 'required|string|max:225',

        ]);

        if ($request->file('image') != '') {
            $path = public_path('\storage\exibition\\') . $exibition->image;


            if (File::exists($path)) {
                File::delete($path);
            }


            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/exibition', $name);
        } else {
            $name = $exibition->image;
        }

        $exibition->title = $request->input('title');
        $exibition->image = $name;
        $exibition->date = $request->input('date');
        $exibition->location = $request->input('location');





        $exibition->update();
        return redirect()->route('exibition.index')
            ->with('success', 'exibition created successfully.');
    }



    public function destroy($id)
    {
        $exibition = Exibition::findOrFail($id);

        $exibition->delete($id);
        $path = public_path("\storage\exibition\\") . $exibition->image;
        File::delete($path);


        return redirect()->route('exibition.index')
            ->with('success', 'Posts deleted successfully');
    }
}
