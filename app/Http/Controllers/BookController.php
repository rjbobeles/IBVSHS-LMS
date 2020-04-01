<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\DamageReport;
use App\LogBook;
use App\Patron;
use App\Transaction;
use App\User;
use App\Rules\AlphaSpace;
use App\Rules\ISBN;
use Yajra\Datatables\Datatables;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

class BookController extends Controller
{    
    public function barcode($id) {
        $book = Book::find($id);
        Storage::disk('barcodes')->put($book->barcodeno . '.png', base64_decode(DNS1D::getBarcodePNG($book->barcodeno, "EAN13", 3, 33, array(1,1,1), true)));
        $path = storage_path('barcodes/' . $book->barcodeno . '.png');
        return response()->download($path, '')->deleteFileAfterSend();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('librarian.books.index');
    }

    public function indexDamageData($id) {
        return Datatables::of(DamageReport::select(['id', 'patron_id', 'book_id', 'actor_id', 'comment'])->where('book_id', $id))
        ->addColumn('patron', function($row) {
            $patron = Patron::find($row->patron_id);
            return $patron->lrn . ' | ' . $patron->lastname . ', ' . $patron->firstname . ' ' . $patron->middlename;
        })
        ->addColumn('actor', function($row) {
            $actor = User::find($row->actor_id);
            return $actor->id . ' | ' . $actor->lastname . ', ' . $actor->firstname . ' ' . $actor->middlename;

        })
        ->make(true);    
    }

    /**
     * Display a datatable of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexData() 
    {
        return Datatables::of(Book::select(['id', 'title', 'author', 'barcodeno', 'condition', 'status']))
        ->addColumn('actions', 'librarian.books.action')
        ->rawColumns(['link', 'actions'])
        ->make(true);      
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
            'author' => ['required', 'max:300'],
            'isbn' => ['required', new ISBN],
            'year_published' => ['required', 'integer', 'min:4'],
            'publisher' => ['required', 'max:255'],
            'genre' => ['required'],
            'condition' => ['required', 'in:Fine,Very Good,Good,Fair,Poor'],
            'status' => ['required', 'in:Available,Reserved,Borrowed,Archived,Missing'],
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
        } else $fileNameToStore = 'no-image.png';
        
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
        $book = Book::find($id);
        return view('librarian.books.single')->with('book', $book);
    }

    /**
     * Display a datatable of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showData($id) 
    {
        return Datatables::of(Transaction::get(['id', 'patron_id', 'book_id', 'date_issued', 'date_due', 'date_returned'])->where('book_id', "==", $id))
            ->addColumn('patron', function($row) {
                $patron = Patron::find($row->patron_id);
                return $patron->lrn . ' | ' . $patron->lastname . ', ' . $patron->firstname . ' ' . $patron->middlename;
            })
            ->make(true);   
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

        if($books->status === "Borrowed") return redirect()->route('books.index')->with('error', 'The book you selected is currently being borrowed, thus cannot be edited!');
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
            'author' => ['required', 'max:300'],
            'isbn' => ['required', new ISBN],
            'year_published' => ['required', 'integer', 'min:4'],
            'publisher' => ['required', 'max:255'],
            'genre' => ['required'],
            'condition' => ['required', 'in:Fine,Very Good,Good,Fair,Poor'],
            'status' => ['required', 'in:Available,Reserved,Borrowed,Archived,Missing'],
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
        } else $fileNameToStore = 'no-image.png';

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

    /**
     * Search for a book based on user input
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PatronBooks(Request $request)
    {
        $message = null;
        if(isset($request->s))
        {
            $input = htmlspecialchars($request->s);
            $input = strip_tags($input, '');

            $books = DB::table('books')->where('title', 'LIKE', "%{$input}%")
                ->orWhere('author', 'LIKE', "%{$input}%")
                ->orWhere('genre', 'LIKE', "%{$input}%")
                ->orWhere('publisher', 'LIKE', "%{$input}%")
                ->orWhere('isbn', 'LIKE', "%{$input}%")
                ->get();

            if(count($books) > 0) return view('patron.books')->with('books', $books)->with('message', '');
            $message = 'No results came from your search. Try again.';
        }
      
        $books = Book::orderBy('title', 'asc')->paginate(10);
        return view('patron.books')->with('books', $books)->with('message', $message);
    }

    /**
     * Show book information to Patron 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PatronBook($id)
    {
        $book = Book::find($id);
        return view('patron.booksSingle')->with('book', $book);
    }
}
