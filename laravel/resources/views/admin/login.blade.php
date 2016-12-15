@extends('layouts.admin-master')
@section('title')
Admin LogIn
@endsection
@section('content')

<!--out put error-->

<!--this is for validation errors-->
@if(count($errors)>0)
<section class="info-box fail">
     @foreach($errors->all() as $error)
       {{$error}} <br>
     @endforeach
   </section>
@endif

<!--this is for authentication or other errors-->
@if(Session::has('fail'))
<section class="info-box fail" style="font-size:20px;  text-shadow: 2px 2px 2px black;">
        {{Session::get('fail')}}
   </section>
@endif

<!--Login Form for admin-->
<form  action="{{route('admin.login')}}" method="post">
  <div class="input-group">
     <label for="name" style="font-size:25px;margin-left:440px;">Your Name</label>
     <input type="text" name="name" id="name" placeholder="Your Name" autocomplete="off">
  </div>
  <div class="input-group" >
     <label for="password" style="font-size:25px;">Your Password</label>
     <input type="password" name="password" id="password" placeholder="Your Password">
  </div>
  <button type="submit" class="btn">Log In</button>
  <input type="hidden" name="_token" value="{{Session::token()}}">
</form>

@endsection
