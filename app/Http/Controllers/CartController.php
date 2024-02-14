<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ZanySoft\Zip\Zip;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $totalPrice = 0.0;
        $book_enrolled_in_cart_by_useR = array();
        if(! is_null($user->cart)){
            for ($i = 0; $i < $user->cart->books->count(); $i++) {
                $book_enrolled_in_cart_by_useR[$i] = Book::where('id', '=', $user->cart->books[$i]->pivot->book_id)->with('category')->first();
                $totalPrice += $book_enrolled_in_cart_by_useR[$i]->cost;
            }
            return view('cart', compact(['book_enrolled_in_cart_by_useR','totalPrice']));
        }
        $book_enrolled_in_cart_by_useR = false;
        return view('cart', compact(['book_enrolled_in_cart_by_useR','totalPrice']));
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
    public function store(Book $book)
    {
        $user = auth()->user();
        if ($cartID = Cart::where('user_id', '=', $user->id)->first()) {
            $cartID->books()->attach($book->id);
        } else {
            $cartID = Cart::insert([
                'user_id' => $user->id
            ]);
            $cartID->books()->attach($book->id);
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Remove the specified book from cart.
     */
    public function removeBookFromCart(Book $book)
    {
        $user = auth()->user();
        $user->cart->books()->detach($book->id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(array $booksIDS)
    {
        $user = auth()->user();
        //parameter , array $booksTitles
    //     $zip = new Zip('/storage/zipFolder/Al_Ahqaffe_Lectronic_Library_Books.zip');
    //    $zip->open('/storage/zipFolder/Al_Ahqaffe_Lectronic_Library_Books.zip');
    //    foreach($booksTitles as $bt){
    //     $zip->delete($bt);
    //     }
    //     $zip->close();
        foreach($booksIDS as $bid){
            $user->cart->books()->detach($bid);
        }
    }

    public function downloadBooks(User $user)
    {
        //Book number of downloads privies. and after plus 1
        $zip = new Zip();
        $zip->create('storage/zipFolder/Al_Ahqaffe_Lectronic_Library_Books.zip');

        //$zip->open('/storage/zipFolder/Al_Ahqaffe_Lectronic_Library_Books.zip');
        //$newZipFile = $zip->create('storage/zipFolder/Al_Ahqaffe_Lectronic_Library_Books.zip',true);
       // $booksTitles = array();
        $booksIDS = array();
        for ($i = 0; $i < $user->cart->books->count(); $i++) {
            $book_enrolled_in_cart_by_useR[$i] = Book::where('id', '=', $user->cart->books[$i]->pivot->book_id)->with('category')->first();
            if($book_enrolled_in_cart_by_useR[$i]->cost == 0){
                $numberOfDownloadsPrivies = $book_enrolled_in_cart_by_useR[$i]->numberOfDownloads + 1;
                $book_enrolled_in_cart_by_useR[$i]->update([
                    'numberOfDownloads' => $numberOfDownloadsPrivies
                ]);

                //User number of downloads privies. and after plus 1
                $number_of_downloads_books_privies = $user->number_of_downloads_books + 1;
                $user->update([
                    'number_of_downloads_books' => $number_of_downloads_books_privies
                ]);

                $user->downloadsBooks()->attach($book_enrolled_in_cart_by_useR[$i]->id);

                $booksIDS[$i] = $book_enrolled_in_cart_by_useR[$i]->id;
                // $booksTitles[$i] = $book_enrolled_in_cart_by_useR[$i]->title.' .pdf';
                $zip->add('storage/'.$book_enrolled_in_cart_by_useR[$i]->book);
            }
        }
        $zip->close();
        $this->destroy($booksIDS);
        return (file_exists('storage/zipFolder/Al_Ahqaffe_Lectronic_Library_Books.zip')) ? response()->download('storage/zipFolder/Al_Ahqaffe_Lectronic_Library_Books.zip')->deleteFileAfterSend() : back()->with('msg', 'السلة لا تحتوي على كتب مجانية');
    }

    /*
    public function gz()
    {
        $books = Book::first();
        $zip = new Zip();

        //$zip->create('storage/zipFolder/Al_Ahqaffe_Lectronic_Library_Books.zip');
       $zip->create('storage/zipFolder/books.zip');

        $zip->add('storage/'.$books->book);

       // return response()->download($zip->extract('storage/zipFolder/Al_Ahqaffe_Lectronic_Library_Books3.zip'));

     // return $zip->listFiles();
      $zip->close();
        return response()->download('storage/zipFolder/books.zip')->deleteFileAfterSend();
    }*/

    public function creditCheckout(Request $request)
    {
        $intent = auth()->user()->createSetupIntent();
        $total = 0.0;
        $user = auth()->user();
        for ($i = 0; $i < $user->cart->books->count(); $i++) {
            $book_enrolled_in_cart_by_useR[$i] = Book::where('id', '=', $user->cart->books[$i]->pivot->book_id)->with('category')->first();
                $total += $book_enrolled_in_cart_by_useR[$i]->cost;
        }

            return view('credit.checkout',compact(['intent','total']));
    }

    public function purchase(Request $request)
    {
        $user = auth()->user();
        $paymentMethod = $request->input('payment_method');
        $total = 0.0;
        $userBooksInCart = auth()->user();
        for ($i = 0; $i < $userBooksInCart->cart->books->count(); $i++) {
            $book_enrolled_in_cart_by_useR[$i] = Book::where('id', '=', $userBooksInCart->cart->books[$i]->pivot->book_id)->with('category')->first();
                $total += $book_enrolled_in_cart_by_useR[$i]->cost;
        }

        try{
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($total * 100,$paymentMethod);


        }catch(\Exception $e){
            return back()->with('حدث خطأ ما أثناء شراء المنتج. ألرجاء التأكد من معلومات البطاقة',$e->getMessage());
        }

        $zip = new Zip();
        $zip->create('storage/zipFolder/Al_Ahqaffe_Lectronic_Library_Books.zip');
        $booksIDS = array();
        for ($i = 0; $i < $user->cart->books->count(); $i++) {
            $book_enrolled_in_cart_by_useR[$i] = Book::where('id', '=', $user->cart->books[$i]->pivot->book_id)->with('category')->first();
            if($book_enrolled_in_cart_by_useR[$i]->cost != 0){
                $numberOfDownloadsPrivies = $book_enrolled_in_cart_by_useR[$i]->numberOfDownloads + 1;
                $book_enrolled_in_cart_by_useR[$i]->update([
                    'numberOfDownloads' => $numberOfDownloadsPrivies
                ]);

                //User number of downloads privies. and after plus 1
                $number_of_downloads_books_privies = $user->number_of_downloads_books + 1;
                $user->update([
                    'number_of_downloads_books' => $number_of_downloads_books_privies
                ]);

                $user->downloadsBooks()->attach($book_enrolled_in_cart_by_useR[$i]->id);

                $booksIDS[$i] = $book_enrolled_in_cart_by_useR[$i]->id;
                // $booksTitles[$i] = $book_enrolled_in_cart_by_useR[$i]->title.' .pdf';
                $zip->add('storage/'.$book_enrolled_in_cart_by_useR[$i]->book);
            }
        }
        $zip->close();
        $this->destroy($booksIDS);
        return response()->download('storage/zipFolder/Al_Ahqaffe_Lectronic_Library_Books.zip')->deleteFileAfterSend();
    }
}
