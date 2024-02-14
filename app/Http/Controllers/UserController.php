<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Book;
use App\Models\Cart;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Jetstream;

class UserController extends Controller
{

    use PasswordValidationRules;
    /**
     * Display a listing of the resource.
     */
    private $userID;
    public function index()
    {
        abort_if(auth()->user()->role != '1', 403);

        $users = (User::where('id', '!=', auth()->user()->id)->count() > 0 ) ? User::where('id', '!=', auth()->user()->id)->paginate(10) : null;
        return view('admin.dashboard.users.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(auth()->user()->role != '1', 403);
        return view('admin.dashboard.users.newUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        if ($request->validated()) {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            $uid = User::insertGetId([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $data['role'],
                'created_at' => Carbon::now(),
            ]);
            Cart::insert([
                'user_id' => $uid,
                'created_at' => Carbon::now()
            ]);
        }

        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        abort_if(auth()->user()->role != '1', 403);
        $this->userID = $user->id;
        $book_downloaded_by_useR = array();
        for ($i = 0; $i < $user->downloadsBooks->count(); $i++) {
            $book_downloaded_by_useR[$i] = Book::where('id', '=', $user->downloadsBooks[$i]->pivot->book_id)->first();
        }
        $book_downloaded_by_user = $this->paginate($book_downloaded_by_useR);
        return view('admin.dashboard.users.user', compact(['user', 'book_downloaded_by_user']));
    }



    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $options['path'] = '/admin/users/' . $this->userID;
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        abort_if(auth()->user()->role != '1', 403);
        return view('admin.dashboard.users.editUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $request->validated();
        $data = $request->all();
        $data['password'] = ($request->password) ? Hash::make($request->password) : $user->password;
        $user->update($data);
        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
