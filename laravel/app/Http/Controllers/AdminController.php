<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Author;
use App\Quote;
use App\Events\QuoteCreated;


class AdminController extends Controller
{
    //method for go login page
   public function getLogIn()
   {
     return view('admin.login');
   }

   //method for logout
  public function getLogOut()
  {
     Auth::logout();
     return redirect()->route('admin.login');
  }

   //method for go to Quotes
   public function getQuotes($author = NULL)
   {
     //if user not nulll
     if (!is_null($author)) {
       //we get name of author
       $quote_author = Author::where('name',$author)->first();

       if ($quote_author) {
         //set all quote by that name and also set 6 for each page
     $quotes = $quote_author->quotes()->orderBy('created_at','desc')->paginate(6);
   }
     }else{
     $quotes = Quote::orderBy('created_at','desc')->paginate(6);
 }
     return view('admin.quotes',['quotes'=>$quotes]);

   }

   //method for go to see Users
   public function getUsers()
   {
     $authors = Author::orderBy('created_at','desc')->paginate(3);
     return view('admin.users',['authors' => $authors]);
   }

   //method for login User
   public function postLogIn(Request $request)
   {
     //validation
     $this->validate($request,[
        'name'     => 'required|min:3|max:10|regex:/^[\pL\s\-\0-9]+$/u',
        'password' => 'required|min:3|max:10|regex:/^[\pL\s\-\0-9]+$/u'
     ]);
        //using Laravel Auth to Check User and Password
       if (!Auth::attempt(
         ['name' => $request['name'],
          'password' => $request['password'] ])) {
            //error to show
         return redirect()->route('admin.login')->with([
           'fail' => 'LogIn Failed Username Or Password Is Wrong'
           ]);
       }

       return redirect()->route('admin.quotes');

   }

   //method for remove quotes
   public function getDeleteQuote($quote_id)
   {
      //find quote
      $quote = Quote::find($quote_id);
      $author_deleted = false;
      //if user has only 1 quote we remove that user
      if (count($quote->author->quotes) === 1) {
        $quote->author->delete();
        $author_deleted = true;
      }
      $quote->delete();
      //remove messages
      $msg = $author_deleted ?
       'Quote and Author is Removed Succefully' : 'Quote Succefully Removed';
      return redirect()->route('admin.quotes')->with([
        'success' => $msg
      ]);
   }
}
