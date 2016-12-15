<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use Illuminate\Http\Request;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;

class QuoteController extends Controller
{

  //method for get to index
  public function getIndex($author = NULL){
      $quotes = array();
    //if user not nulll
    if (!is_null($author)) {
      //we get name of author
      $quote_author = Author::where('name',$author)->first();

      if ($quote_author) {
        //set all quote by that name and also set 6 for each page
    $quotes = $quote_author->quotes()->orderBy('created_at','desc')->paginate(6);
  }else{
    return redirect()->route('index')->with([
      'fail' => 'That User Is Not Exists'
      ]);
  }
}else{
    $quotes = Quote::orderBy('created_at','desc')->paginate(6);
}
    return view('index',['quotes'=>$quotes]);
}

  //method for post user input quote
  public function postQuote(Request $request){
    //vaildation
      $this->validate($request , [
        'movie'  => 'required|min:3|max:40|regex:/^[\pL\s\-\0-9]+$/u',
         'author' => 'required|min:3|max:30|regex:/^[\pL\s\-\0-9]+$/u',
         'email'  => 'required|E-Mail',
         'quote'  => 'required|min:5|max:120|regex:/^[\pL\s\-\0-9]+$/u'
      ]);

      //user input
      $authorText = ucfirst($request['author']);
      $emailText = $request['email'] ;
      $movieText = ucfirst($request['movie']) ;
      $quoteText = $request['quote'] ;

      //here we make author if not exists
      $author = Author::where('name', $authorText)->first();
      if(!$author){
        $author = new Author();
        $author->name = $authorText;
        $author->email = $emailText;
        $author->save();
      }
      //create quote
      $quote = new Quote();
      $quote->quote = $quoteText;
      $quote->movie = $movieText;
      $author->quotes()->save($quote);
      //declare our event when quote saved
      Event::fire(new QuoteCreated($author));
      //redirect to index with session success message
      return redirect()->route('index')->with([
        'success' => 'Quote Saved!'
      ]);
  }

}
