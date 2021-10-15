<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Exibition;
use Illuminate\Http\Request;

class ExibitionController extends Controller
{
    public function index()
    {
        $exhibitions = Exibition::latest()->paginate(10);

        return view('posts.index',compact('exhibitions'))
            ->with('i', (request()->input('page', 1) - 1) * 10);


    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'exhibitions_title' => 'required|string|max:50',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'exhibitions_description' => 'required|string|max:225',
            'exhibitions_date' => 'required|string|max:225',
            'exhibitions_location' => 'required|string|max:225',


        ]);

        $input = $request->all();

        if ($image = $request->file('cover_image')) {
            $destinationPath = 'exhibitions_image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['cover_image'] = "$profileImage";
        }
        Exibition::create($input);


        return back()
            ->with('success', 'exhibitions made successfully.');
    }


    public function destroy(Exibition $exhibition)
    {
        $exhibition->delete();
        return back()
            ->with('success', 'Exhibition removed successfully.');
    }
}
