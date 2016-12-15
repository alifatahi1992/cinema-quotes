@extends('layouts.admin-master')
@section('title')
Admin Dashboard
@endsection
@section('content')
<div class="all-users">
 @for($i = 0;$i < count($authors);$i++)
<article class="quote">

   <span class="name">{{$authors[$i]->name}}</span><br>
  <span class="email">{{$authors[$i]->email}}</span><br>
  <span><a href="{{route('admin.quotes',['author'=>$authors[$i]->name])}}">See Latest Quotes From This User</a></span>
</article>
@endfor

<!--pagination part-->
<div class="pagination">
  @if($authors->currentPage() !== 1)
    <a href="{{$authors->previousPageUrl()}}"><span> <- </span></a>
  @endif
  @if($authors->currentPage() !== $authors->lastPage() && $authors->hasPages())
  <a href="{{$authors->nextPageUrl()}}"><span> -> </span></a>
  @endif
</div>

</div>
@endsection
