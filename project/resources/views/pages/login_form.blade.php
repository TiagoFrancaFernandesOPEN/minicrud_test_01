@extends('layout/site')
@section('title','Login | '. env('APP_NAME'))

@section('content')
<div class="container">

    <div class="row">

        {{-- @if ($message_tgo = Session::get('message_tgo'))
        <div class="row alert_box">
          <div class="col s12 m12 white-text red darken-1">
                <p style="cursor:pointer;">{{ $message_tgo }}<strong class="close_alert"><i class="material-icons">close</i></strong></p>           
          </div>
        </div>
        @endif --}}

        <div class="col s12 m12">
        <form action="{{ route('login.post') }}" method="post">
            {{ csrf_field() }}
            <div class="input-field">
                <input type="text" name="user_email" required>
                <label>E-mail</label>
            </div>
            <div class="input-field">
                <input type="password" name="user_password" required>
                <label>Password</label>
            </div>
            <button class="btn deep-orange" type="submit">Login</button>
        </form>
        </div>
    </div>
          
</div>
@endsection