@extends('layouts.admin-master')
@section('title')
Admin Dashboard
@endsection
@section('content')

<!--this is fo rcheck if after main url there is anything or not like
username and as if shows only first argue after main link 1-->
 @if(!empty(Request::segment(3)))
      <section class="filter-bar">
 <!--if user goes to his page he can come back to main page with this link-->
         <a href="{{route('admin.quotes')}}">Show All Quotes</a>
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
 <!--out put success-->
 @if(Session::has('success'))
   <section class="info-box success" style="font-size:20px;text-shadow:1px 1px 2px black;">
      {{Session::get('success')}}
   </section>
 @endif
<!--main part that we show quotes-->
 <section class="quotes">
     <h1 style="font-size:60px;color:#75d6ff">Latest Quotes</h1>
      @for($i = 0;$i < count($quotes);$i++)
     <article class="quote">

       <!--delete quote-->
        <div class="delete">
          <a href="{{route('delete',['quote_id' =>$quotes[$i]->id])}}">X</a>
        </div>

        <span class="title">{{$quotes[$i]->movie}}</span><br>
       <span class="quote-text">{{$quotes[$i]->quote}}</span>
        <div class="info">
           Created By <a href="{{route('admin.quotes',['author'=>$quotes[$i]->author->name])}}">{{$quotes[$i]->author->name }}</a> on {{$quotes[$i]->created_at}}
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

@endsection
