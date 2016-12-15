@extends('layouts.master')
@section('title')
  No Page Found
@endsection
@section('content')
<span class="nfp">
       <h3>Oops, Page Not Found</h3>
       <a href="{{route('index')}}">Go Back Home</a>
</span>
@endsection
