@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row center">
       <div class="col m12">
           <div class="card">
               <h4>Login</h4>
               <div class="card-content">
                   <form method="POST" action="{{ route('login') }}">
                       @csrf
                       <div class="row">
                           <div class="input-field">
                               <input id="email" type="email" class="validate" name="email" required autocomplete="email" autofocus>
                               <label for="email">Email</label>
                               <span class="helper-text" data-error="Wrong email format" data-success=""> </span>
                           </div>
                       </div>
                       <div class="row">
                           <div class="input-field">
                               <input id="password" type="password" class="validate" name="password" required autocomplete="current-password">
                               <label for="password">Password</label>
                           </div>
                       </div>
                       <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                           <i class="material-icons right">send</i>
                       </button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
