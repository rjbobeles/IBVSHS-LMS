<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Book;
use DB;
use Carbon\Carbon;

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
        return view('books.addBook');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Form Validations
        $this-> validate($request, [
            'callnumber' => 'required',
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'year_published' => 'required',
            'publisher' => 'required',
            'genre' => 'required',
            'book_image' => 'image|nullable|max:1999'
        ]);
        
        //Add Book
        $book = new Book();
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
        
        //Removes all dash in isbn
        $isbn_arr = str_split($book->isbn);
        $barcodeNo_arr = array();

        foreach ($isbn_arr as $value) {
            if ($value != '-') {
                array_push($barcodeNo_arr, $value);
            }
        }

        $barcodeNo = implode($barcodeNo_arr);
        $book->barcodeno = $barcodeNo;

        //Handle FileUpload
        if ($request->hasFile('book_image')){
            //Get filename with extension
            $fileNameWithExt = $request->file('book_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('book_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('book_image')->storeAs('public/book_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'no-image.jpg';
        }

        $book->book_image = $fileNameToStore;
        $book->save();

        if (strlen(strval($book->id)) != 12) 
        {
            $book->id = Carbon::now()->year.'0000000'.$book->id;
            $book->update();
        }

        return redirect('/books');
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
        return view('books.updateBook')->with('books', $books);
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
        $this->validate($request, [
            'callnumber' => 'required',
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'year_published' => 'required',
            'publisher' => 'required',
            'genre' => 'required',
            'book_image' => 'image|nullable|max:1999'
        ]);
        
        //Update Book
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
        
        //Removes all dash in isbn
        $isbn_arr = str_split($book->isbn);
        $barcodeNo_arr = array();

        foreach ($isbn_arr as $value) {
            if ($value != '-') {
                array_push($barcodeNo_arr, $value);
            }
        }

        $barcodeNo = implode($barcodeNo_arr);
        $book->barcodeno = $barcodeNo;

        //Handle FileUpload
        if ($request->hasFile('book_image')){
            //Get filename with extension
            $fileNameWithExt = $request->file('book_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('book_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('book_image')->storeAs('public/book_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'no-image.jpg';
        }

        if ($request->hasFile('book_image')){
            Storage::delete('public/book_images/'.$book->book_image);
            $book->book_image = $fileNameToStore;
        }
        $book->save();

        return redirect('/books');
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
