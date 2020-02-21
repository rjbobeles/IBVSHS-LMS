<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('librarian.books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'callnumber' => ['required'],
            'title' => ['required'],
            'author' => ['required'],
            'isbn' => ['required'],
            'year_published' => ['required'],
            'publisher' => ['required'],
            'genre' => ['required'],
            'condition' => ['required', 'in:Find,Very Good,Good,Fair,Poor'],
            'status' => ['required', 'in:Available,Reserved,Borrowed,Archived'],
            'book_image' => ['image', 'nullable', 'max:200']
        ]);
        
        $getLastBarcodeNo = DB::table('books')->select('barcodeno')->orderBy('barcodeno', 'desc')->take(1)->first();
        if ($getLastBarcodeNo != null) $newBarcodeNo = $getLastBarcodeNo->barcodeno + 1;
        else $newBarcodeNo = 202000000001;
        
        if ($request->hasFile('book_image')){
            $fileNameWithExt = $request->file('book_image')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $Ext = $request->file('book_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $Ext;
            $path = $request->file('book_image')->storeAs('public/book_images', $fileNameToStore);
        } else $fileNameToStore = 'no-image.jpg';
        
        $book = Book::create([
            'callnumber' => $request->input('callnumber'),
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'isbn' => $request->input('isbn'),
            'volume' => $request->input('volume'),
            'edition' => $request->input('edition'),
            'year_published' => $request->input('year_published'),
            'publisher' => $request->input('publisher'),
            'genre' => $request->input('genre'),
            'condition' => $request->input('condition'),
            'status' => $request->input('status'),
            'barcodeno' => $newBarcodeNo,
            'book_image' => $fileNameToStore
        ]);

        return redirect()->route('books.index')->with('success', 'New book has been added to the system!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $books = Book::find($id);
        return view('librarian.books.edit')->with('books', $books);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'callnumber' => ['required'],
            'title' => ['required'],
            'author' => ['required'],
            'isbn' => ['required'],
            'year_published' => ['required'],
            'publisher' => ['required'],
            'genre' => ['required'],
            'condition' => ['required', 'in:Find,Very Good,Good,Fair,Poor'],
            'status' => ['required', 'in:Available,Reserved,Borrowed,Archived'],
            'book_image' => ['image', 'nullable', 'max:200']
        ]);
         
        $book = Book::find($id);
        $book->callnumber = $request->input('callnumber');
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->isbn = $request->input('isbn');
        $book->volume = $request->input('volume');
        $book->edition = $request->input('edition');
        $book->year_published = $request->input('year_published');
        $book->publisher = $request->input('publisher');
        $book->genre = $request->input('genre');
        $book->condition = $request->input('condition');
        $book->status = $request->input('status');

        if ($request->hasFile('book_image')){
            $fileNameWithExt = $request->file('book_image')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $Ext = $request->file('book_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $Ext;
            $path = $request->file('book_image')->storeAs('public/book_images', $fileNameToStore);
        } else $fileNameToStore = 'no-image.jpg';

        if ($request->hasFile('book_image')){
            Storage::delete('public/book_images/'.$book->book_image);
            $book->book_image = $fileNameToStore;
        }
    
        $book->save();
        return redirect()->route('books.index')->with('success', 'Book has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
