@extends('layouts.app')

@section('content')
<div class="container">
   <div class="center-align">
       <div class="col m12">
           <div class="card">
               <h4>{{ __('Login') }}</h4>
               <div class="card-content">
                   <form method="POST" action="{{ route('login') }}">
                       @csrf
                       <div class="row">
                           <div class="input-field">
                               <input id="email" type="email" class="validate @error('email') invalid @enderror" name="email" required autocomplete="email" autofocus>
                               <label for="email">{{ __('E-Mail Address') }}</label>
                           </div>
                       </div>
                       <div class="row">
                           <div class="input-field">
                               <input id="password" type="password" class="validate @error('password') invalid @enderror" name="password" required autocomplete="current-password">
                               <label for="password">{{ __('Password') }}</label>

                               @if ($errors->any())
                               <span class="red-text" role="alert">
                                   @foreach ($errors->all() as $error)
                                       {{ $error }}
                                       <br/>
                                   @endforeach
                               </span>
                               @endif

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
