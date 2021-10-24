<?php

namespace App\Http\Controllers;


use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('admin.book.index', compact('books'));
    }

    public function edit($id)
    {

        $book = Book::findOrFail($id);

        return view('admin.book.edit', compact(['book']));
    }
    public function create()
    {
        return view('admin.book.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'year' => 'required|integer',
            'publisher' => 'required|string|max:50',
            'body' => 'required|string',


        ]);

        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->storeAs('public/book', $name);


        $book= new Book();
        $book->title = $request->input('title');
        $book->image = $name;
        $book->year = $request->input('year');
        $book->publisher = $request->input('publisher');
        $book->body = $request->input('body');





        $book->save();
        return redirect()->route('book.index')
            ->with('success', 'book created successfully.');
    }
    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'year' => 'required|integer',
            'publisher' => 'required|string|max:50',
            'body' => 'required|string',


        ]);

        if ($request->file('image') != '') {
            $path = public_path("\storage\book\\") . $book->image;


            if (File::exists($path)) {
                File::delete($path);
            }


            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/book', $name);
        } else {
            $name = $book->image;
        }

        $book->title = $request->input('title');
        $book->image = $name;
        $book->year = $request->input('year');
        $book->publisher = $request->input('publisher');
        $book->body = $request->input('body');





        $book->update();
        return redirect()->route('book.index')
            ->with('success', 'album created successfully.');
    }


    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete($id);
        $path = public_path("\storage\book\\") . $book->image;
        File::delete($path);


        return redirect()->route('book.index')
            ->with('success', 'Posts deleted successfully');
    }
}
