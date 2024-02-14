<?php

namespace App\Http\Controllers;

use App\Http\Requests\NUserProfileRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Database\Eloquent\Builder;
use  Illuminate\Pagination\Paginator;
use  Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class NormalUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(auth()->user()->role != '0', 403);
        $user = Auth::user();
        $usersNo = count(User::where('id', '!=', auth()->user()->id)->get());
        $users = (User::where('id', '!=', auth()->user()->id)->count() > 0 ) ? User::where('id', '!=', auth()->user()->id)->limit(5)->get() : null;
        $booksNo = count(Book::get());
        $categoriesNo = count(Category::get());
        $books = (Book::orderBy('id','DESC')->count() > 0 ) ? Book::orderBy('id','DESC')->limit(5)->get() : null;
        $rateBook = Book::max('rate');
        $bigRateBook = ($rateBook > 0) ? Book::where('rate', '=', $rateBook)->first() : null;
        $book_downloaded_by_useR = array();
        for ($i = 0; $i < $user->downloadsBooks->count(); $i++) {
            $book_downloaded_by_useR[$i] = Book::where('id', '=', $user->downloadsBooks[$i]->pivot->book_id)->first();
        }
        $arrayCategoriesDownloadedByUser = array();
        for ($i = 0; $i < count($book_downloaded_by_useR); $i++) {
            $arrayCategoriesDownloadedByUser[$i] = $book_downloaded_by_useR[$i]->category_id;
        }
        $categoriesDownloadedByUserFiltered = array_unique($arrayCategoriesDownloadedByUser);
        $relatedDownloads = array();
        for ($i=0; $i < count($categoriesDownloadedByUserFiltered); $i++) {
            $relatedDownloads[$i] = Book::where('category_id','=',$categoriesDownloadedByUserFiltered[$i])->with('category')->limit(3)->get();
        }
        return view('normalUser.dashboard', compact(['usersNo', 'users', 'booksNo', 'categoriesNo', 'books', 'rateBook', 'bigRateBook', 'relatedDownloads']));
    }

    public function profileIndex()
    {
        abort_if(auth()->user()->role != '0', 403);
        $user = Auth::user();
        return view('normalUser.profile', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showDownloads()
    {
        abort_if(auth()->user()->role != '0', 403);
        $user = Auth::user();
        $book_downloaded_by_useR = array();
        for ($i = 0; $i < $user->downloadsBooks->count(); $i++) {
            $book_downloaded_by_useR[$i] = Book::where('id', '=', $user->downloadsBooks[$i]->pivot->book_id)->with('category')->first();
        }
        $book_downloaded_by_user = $this->paginate($book_downloaded_by_useR);
        return view('normalUser.mydownloads', compact(['book_downloaded_by_user']));
    }

    public function paginate(
        $items,
        $perPage = 10,
        $page = null,
        $options = []
    ) {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $options['path'] = '/nUser/mydownloads';
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NUserProfileRequest $request)
    {
        $userId = auth()->user()->id;
        if ($request->validated()) {
            $data = $request->all();
            $data['password'] = $request->has('password') ? Hash::make($request->password) : auth()->user()->password;
            User::findOrFail($userId)->update($data);
        }
        return redirect('/nUser/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/');
    }
}
