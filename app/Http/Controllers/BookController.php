<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\LogBook;
use App\User;
use App\Rules\AlphaSpace;
use App\Rules\ISBN;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $books = new Book;

        if(request()->has('cndtn')){
            $condition = "";

            switch (request('cndtn')) {
                case 'vgd':
                    $condition = "very good";
                    break;

                case 'gd':
                    $condition = "good";
                    break;

                case 'fn':
                    $condition = "fine";
                    break;
                
                case 'fr':
                    $condition = "fair";
                    break;

                case 'pr':
                    $condition = "poor";
                    break;

                default:
                    abort(403);
                    break;
            }
            $books = $books->where('condition', $condition);
        }

        if(request()->has('stts')){
            $status = "";

            switch (request('stts')) {
                case 'avlbl':
                    $status = "available";
                    break;
                
                case 'rsrvd':
                    $status = "reserved";
                    break;
                
                case 'brrwd':
                    $status = "borrowed";
                    break;

                case 'archv':
                    $status = "archived";
                    break;

                case 'mssng':
                    $status = "missing";
                    break;

                default:
                    abort(403);
                    break;
            }
            $books = $books->where('status', $status);
        }

        if(request()->has('srt')){
            $sort = "";

            switch (request('srt')) {
                case 'asc':
                    $sort = "asc";
                    break;
                
                case 'desc':
                    $sort = "desc";
                    break;
                default:
                    abort(403);
                    break;
            }
            $books = $books->orderBy('title', $sort);
        }
        
        $books = $books->orderBy('title', 'asc');

        $books = $books->paginate(20)->appends([
            'cndtn' => request('cndtn'),
            'stts' => request('stts'),
            'srt' => request('srt'),
        ]);
        
        return view('librarian.books.index')->with(compact('books'));
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
            'author' => ['required', new AlphaSpace],
            'isbn' => ['required', new ISBN],
            'year_published' => ['required', 'integer', 'min:4'],
            'publisher' => ['required', 'max:255'],
            'genre' => ['required'],
            'condition' => ['required', 'in:Fine,Very Good,Good,Fair,Poor'],
            'status' => ['required', 'in:Available,Reserved,Borrowed,Archived'],
            'book_image' => ['image', 'nullable', 'max:10240']
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

        LogBook::create([
            'actor_id' => auth()->user()->id,
            'action' => 'Add Book',
            'book_id' => $book->id,
            'callnumber' => $book->callnumber,
            'title' => $book->title,
            'author' => $book->author,
            'isbn' => $book->isbn,
            'volume' => $book->volume,
            'edition' => $book->edition,
            'year_published' => $book->year_published,
            'publisher' => $book->publisher,
            'genre' => $book->genre,
            'condition' => $book->condition,
            'status' => $book->status,
            'barcodeno' => $book->barcodeno,
            'book_image' => $book->book_image
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
            'author' => ['required', new AlphaSpace],
            'isbn' => ['required', new ISBN],
            'year_published' => ['required', 'integer', 'min:4'],
            'publisher' => ['required', 'max:255'],
            'genre' => ['required'],
            'condition' => ['required', 'in:Fine,Very Good,Good,Fair,Poor'],
            'status' => ['required', 'in:Available,Reserved,Borrowed,Archived'],
            'book_image' => ['image', 'nullable', 'max:10240']
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

        LogBook::create([
            'actor_id' => auth()->user()->id,
            'action' => 'Update Book',
            'book_id' => $book->id,
            'callnumber' => $book->callnumber,
            'title' => $book->title,
            'author' => $book->author,
            'isbn' => $book->isbn,
            'volume' => $book->volume,
            'edition' => $book->edition,
            'year_published' => $book->year_published,
            'publisher' => $book->publisher,
            'genre' => $book->genre,
            'condition' => $book->condition,
            'status' => $book->status,
            'barcodeno' => $book->barcodeno,
            'book_image' => $book->book_image
        ]);

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
