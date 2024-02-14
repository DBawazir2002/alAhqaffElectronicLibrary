<?php

namespace App\Http\Controllers;

use App\Mail\InsertNewBookMail;
use App\Mail\WelcomeMail;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\Searchable\Search;

class HomeController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    // protected $guard;

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
    //  * @return void
    //  */
    // public function __construct(StatefulGuard $guard)
    // {
    //     $this->guard = $guard;
    // }

    public function t()
    {
        // $t = (new Search())
        //     ->registerModel(User::class, 'name')
        //     ->registerModel(Book::class,'title')
        //     ->search('Lara');
        // return view('t',compact('t'));
        $data =(Book::orderBy('id','DESC')->count() > 0 ) ?  Book::where('title','LIKE','%'.request()->search.'%')->orWhere('authorName','LIKE','%'.request()->search.'%')->paginate(9) : null;
            // $output = '';
            // if(count($data) > 0){
            //     $output ='
            //     <ul class="list-group">';
            //     foreach ($data as $book)
            //         {
            //             '<li class="list-group-item"><a href="/book/'.$book->id.'">'.$book->title.'</a></li>';

            //         }


            //     $output.='</ul>';
            // }
      //  return $data;
       return view('t',compact('data'));

    }


    public function search(Request $request)
    {
            $data = Book::where('title','LIKE','%'.$request->search.'%')->get();
            $output = '';
            if(count($data) > 0){
                $output .='
                <ul class="list-group">';
                foreach ($data as $book)
                    {
                        '<li class="list-group-item"><a href="/book/'.$book->id.'">'.$book->title.'</a></li>';

                    }


                $output.='</ul>';
            }
       // return $output;
       return $data;
    }

    public function index()
    {
        $books = Book::orderBy('id','DESC')->paginate(9);
        return view('index',compact('books'));
    }

    public function checkUser()
    {
        $role = Auth::user()->role;

        if ($role != '1') {
            return redirect()->to('/nUser/dashboard');
        } else {
            return redirect()->to('/admin/dashboard');
        }
    }

    public function show(Book $book)
    {
        $relatedBooks = Book::where('category_id','=',$book->category_id)->where('id','!=',$book->id)->paginate(9);
        $comments = $book->comments()->where('approved',1)->get();
        $cartBookExist = false;
        if(Auth::check() and ! is_null(auth()->user()->cart)){
        foreach(auth()->user()->cart->books as $bok){
            if($bok->id == $book->id){
                $cartBookExist = true;
            }
        }
    }
        return view('showBook',compact(['book', 'relatedBooks', 'comments', 'cartBookExist']));
    }

    public function showAuthorBooks(Request $request,$authorName)
    {
        $authorBooks = Book::where('authorName', '=', $authorName)->paginate(9);
        return view('author',compact('authorBooks'));
    }

    public function downloadBook(Book $book, User $user)
    {
        //Book number of downloads privies. and after plus 1
        $numberOfDownloadsPrivies = $book->numberOfDownloads +1;
        $book->update([
            'numberOfDownloads' => $numberOfDownloadsPrivies
        ]);

        //User number of downloads privies. and after plus 1
        $number_of_downloads_books_privies = $user->number_of_downloads_books + 1;
        $user->update([
            'number_of_downloads_books' => $number_of_downloads_books_privies
        ]);

        $user->downloadsBooks()->attach($book->id);

        return response()->download('storage/'.$book->book);
    }



    public function showCategories()
    {
        $categories = Category::paginate(9);
        return view('categories',compact('categories'));
    }

    public function showRelatedBookCategory(Category $category)
    {
        $books = Book::where('category_id','=',$category->id)->paginate(9);
        $categoryName = $category->categoryName;
        return view('category',compact(['books','categoryName']));
    }



}
