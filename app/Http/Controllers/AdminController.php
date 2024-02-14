<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminProfileRequest;
use App\Http\Requests\SendMailRequest;
use App\Mail\SendMail;
use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        abort_if(auth()->user()->role != '1', 403);
        $usersNo = count(User::where('id', '!=', auth()->user()->id)->get());
        $users = (User::where('id', '!=', auth()->user()->id)->count() > 0 ) ? User::where('id', '!=', auth()->user()->id)->limit(5)->get() : null;
        $booksNo = count(Book::get());
        $categoriesNo = count(Category::get());
        $books = (Book::orderBy('id','DESC')->count() > 0 ) ? Book::orderBy('id','DESC')->limit(5)->get() : null;
        $rateBook = Book::max('rate');
        $bigRateBook = ( $rateBook > 0) ? Book::where('rate', '=', $rateBook)->first() : null;
        return view('admin.dashboard.dashboard', compact(['usersNo', 'users', 'booksNo', 'categoriesNo', 'books', 'rateBook', 'bigRateBook']));
    }

    public function profileIndex()
    {
        abort_if(auth()->user()->role != '1', 403);
        $user = Auth::user();
        return view('admin.dashboard.profileAdmin', compact('user'));
    }

    public function sendSpecificMail()
    {
        abort_if(auth()->user()->role != '1', 403);
        $users = (User::where('id', '!=', auth()->user()->id)->count() > 0) ? User::where('id', '!=', auth()->user()->id)->get() : null ;
        return view('admin.dashboard.mails', compact('users'));
    }

    public function update(AdminProfileRequest $request)
    {
        $userId = auth()->user()->id;
        if ($request->validated()) {
            $data = $request->all();
            $data['password'] = $request->has('password') ? Hash::make($request->password) : auth()->user()->password;
            User::findOrFail($userId)->update($data);
        }
        return redirect('/admin/dashboard');
    }

    public function sendMail(SendMailRequest $sendMailRequest)
    {
        if ($sendMailRequest->validated()) {
            $data = $sendMailRequest->all();
            if ($sendMailRequest->user == 'all') {
                $users = User::get();
                foreach ($users as $user) {
                    $data['name'] =  $user->name;
                    Mail::to($user->email)->send(new SendMail($data));
                }
            } else {
                $user = User::where('id', '=', $data['user'])->first();
                $data['name'] =  $user->name;
                Mail::to($user->email)->send(new SendMail($data));
            }
        }
        return redirect('/admin/dashboard');
    }
}
