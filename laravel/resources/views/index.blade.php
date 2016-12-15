@extends('layouts.master')
@section('title')
  Cinema Quotes
@endsection
@section('content')
   <!--this is fo rcheck if after main url there is anything or not like
   username and as if shows only first argue after main link 1-->
    @if(!empty(Request::segment(1)))
         <section class="filter-bar">
    <!--if user goes to his page he can come back to main page with this link-->
            <a href="{{route('index')}}">Show All Quotes</a>
         </section>
    @endif
    <!--out put error-->
    @if(count($errors) > 0)
      <section class="info-box fail" style="font-size:20px;text-shadow:1px 1px 2px black;">
             @foreach($errors->all() as $error)
                 {{$error}}<br>
             @endforeach

      </section>
    @endif
    <!--this is for Not Exists User-->
    @if(Session::has('fail'))
    <section class="info-box fail" style="font-size:30px;  text-shadow: 2px 2px 2px black;">
            {{Session::get('fail')}}
       </section>
    @endif
    <!--out put success-->
    @if(Session::has('success'))
      <section class="info-box success" style="font-size:20px;text-shadow:1px 1px 2px black;">
         {{Session::get('success')}}
      </section>
    @endif
<!--main part that we show quotes-->
    <section class="quotes">
        <h1 style="font-size:60px;color:#75d6ff">Latest Cinema Quotes</h1>
         @for($i = 0;$i < count($quotes);$i++)
        <article class="quote">

           <span class="title">{{$quotes[$i]->movie}}</span><br>
          <span class="quote-text">{{$quotes[$i]->quote}}</span>
           <div class="info">
              Created By <a href="{{route('index',['author'=>$quotes[$i]->author->name])}}">{{$quotes[$i]->author->name }}</a> on {{$quotes[$i]->created_at->diffForHumans()}}
           </div>
        </article>
        @endfor
        <!--pagination part-->
        <div class="pagination">
          @if($quotes->currentPage() !== 1)
            <a href="{{$quotes->previousPageUrl()}}"><span> <- </span></a>
          @endif
          @if($quotes->currentPage() !== $quotes->lastPage() && $quotes->hasPages())
          <a href="{{$quotes->nextPageUrl()}}"><span> -> </span></a>
          @endif
        </div>
    </section>
    <!--form for user add quotes-->
    <section class="edit-quote">
       <h1 style="font-size:40px;color:#75d6ff;text-shadow:2px 2px 4px black">Add New Quotes</h1>
       <form method="post" action="{{ route('create') }}">
         <div class="input-group">
            <label for="movie">Title Of Movie</label>
            <input type="text" name="movie" id="movie" placeholder="Title Of Movie" autocomplete="off">
         </div>
          <div class="input-group">
             <label for="author">Your Name</label>
             <input type="text" name="author" id="author" placeholder="Your Name" autocomplete="off">
          </div>
          <div class="input-group">
             <label for="email">Your Email</label>
             <input type="email" name="email" id="email" placeholder="Your Email" autocomplete="off">
          </div>
          <div class="input-group">
             <label for="quote">Your Quote</label>
             <textarea name="quote" rows="5" id="quote" placeholder="Your Quote Should be Maximum 120 Character"></textarea>
          </div>
          <button type="submit" class="btn">Submit Quote</button>
          <input type="hidden" name="_token" value="{{Session::token()}}">

       </form>
    </section>


@endsection
