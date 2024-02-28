<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Mail\InsertNewBookMail;
use App\Mail\SpecificBookInfoMail;
use App\Mail\WelcomeMail;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(auth()->user()->role != '1', 403);
        $books = (Book::orderBy('id','DESC')->count() > 0 ) ? Book::orderBy('id','DESC')->with('category')->paginate(10) : null;


        return view('admin.dashboard.books.books', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(auth()->user()->role != '1', 403);
        $categories = (Category::get()->count() > 0) ? Category::get() : null;
        return view('admin.dashboard.books.newBook', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        if ($request->validated()) {
            // if(Book::where('title',$request->title)){
                $data = $request->all();
                $bookCover_name = $request->title . '.' . $request->bookCover->getClientOriginalExtension();
                $bookCover_path = $request->file('bookCover')->storeAs('booksCover', $bookCover_name, 'public');

                $book_name = $request->title . '.' . $request->book->getClientOriginalExtension();
                $book_path = $request->file('book')->storeAs('books', $book_name, 'public');

                $data['bookCover'] = 'booksCover/' . $bookCover_name;
                $data['book'] = 'books/' . $book_name;

                $bookID =  Book::insertGetId([
                    'title' => $request->title,
                    'authorName' => $request->authorName,
                    'category_id' => $request->category_id,
                    'cost' => $request->cost,
                    'brief' => $request->brief,
                    'size' => $request->book->getSize(),
                    'bookCover' => 'booksCover/' . $bookCover_name,
                    'book' => 'books/' . $book_name,
                    'created_at' => Carbon::now()
                ]);
                $data['book'] = '/book/' . $bookID;
                $users = User::get('email');
                foreach ($users as $user) {
                    Mail::to($user->email)->send(new InsertNewBookMail($data));
                }
            // }
            // return back()->with('msg','  يرجى التحقق من عنوان الكتاب لقد تم اضافة هذا الكتاب مسبقا');
        }
        return to_route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        abort_if(auth()->user()->role != '1', 403);
        return view('admin.dashboard.books.book', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        abort_if(auth()->user()->role != '1', 403);
        $categories = Category::get();
        return view('admin.dashboard.books.editBook', compact(['book', 'categories']));
        return $book;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        if ($request->validated()) {
            $data = $request->all();
            $bookCover_name = $request->has('bookCover') ? $request->title . '.' . $request->bookCover->getClientOriginalExtension() : 'default.jpg';
            $bookCover_path = $request->has('bookCover') ? $request->file('bookCover')->storeAs('booksCover', $bookCover_name, 'public') : 'booksCover/default.jpg';

            $book_name = $request->title . '.' . $request->book->getClientOriginalExtension();
            $book_path = $request->file('book')->storeAs('books', $book_name, 'public');

            $data['bookCover'] = $bookCover_path;
            $data['book'] = $book_path;

            $book->update([
                'title' => $request->title,
                'authorName' => $request->authorName,
                'category_id' => $request->category_id,
                'cost' => $request->cost,
                'brief' => $request->brief,
                'size' => $request->book->getSize(),
                'bookCover' => $data['bookCover'],
                'book' => $data['book'] = $book_path,
                'updated_at' => Carbon::now()
            ]);
        }



        return to_route('books.index');
    }

    /**
     * Update the rate of specific book.
     */
    public function updateRateBook(Book $book, Request $request)
    {
        if ($request->rate == 0) {
            return back();
        } else {
            if ($request->rate >= $book->rate)
                $book->update(['rate' => $request->rate]);
            return back();
        }

        return back();
    }

    /**
     * Send specific info of book to all users
     */
    public function sendSpecificInfoBook(Book $book)
    {
        $book->book = '/book/' . $book->id;
        $users = User::get('email');
        foreach ($users as $user) {
            Mail::to($user->email)->send(new SpecificBookInfoMail($book));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        Storage::delete($book->book);
        $book->delete();
        return to_route('books.index');
    }
}
