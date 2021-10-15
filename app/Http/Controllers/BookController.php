<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);

        return view('books.index',compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 10);


    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'book_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'year' => 'required|bigInteger',
            'publisher' => 'required|string|max:50',
            'body' => 'required|text',


        ]);

        $input = $request->all();

        if ($image = $request->file('book_image')) {
            $destinationPath = 'exhibitions_image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['book_image'] = "$profileImage";
        }
        Book::create($input);


        return back()
            ->with('success', 'exhibitions made successfully.');
    }


    public function destroy(Book $book)
    {
        $book->delete();
        return back()
            ->with('success', 'book removed successfully.');
    }
}
