@extends('layouts.master')
@section('title', 'Register')
@section('content')
<div class="container">
  <div align="center" class="row">
        <div class="mui-panel width_400 padding_40">
          <div class="red_message">
            @if (! empty(session('message')))
              {{ session('message') }}
            @endif
          </div>
          <legend align="left">SIGN UP</legend>
          <form method="POST" action="/auth/register">
            {{ csrf_field() }}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{  $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mui-form-group">
              <input type="text" class="mui-form-control" name="username" id="username" placeholder="username" value="{{ old('username') }}" required>
            </div>
            <div class="mui-form-group">
              <input type="email" class="mui-form-control" name="email" id="email" placeholder="e-mail" value="{{ old('email') }}" required>
            </div>
            <div class="mui-form-group">
              <input type="password" class="mui-form-control" name="password" id="password" placeholder="password" required>
            </div>
            <div class="mui-form-group">
              <input type="password" class="mui-form-control" name="password_confirmation" id="password_confirmation" placeholder="confirm password" required>
            </div>
            <div align="left" class="mui-form-group">
              <input type="submit" class="mui-btn" value="submit">
            </div>
             <div align="left" class="mui-form-group">
                <p><span class="valign">Or sign up with:</span>
                    <a href="/auth/github" name="github"><span class="footer-icons icon fa fa-github"></span></a>
                    <a href="/auth/twitter" name="twitter"><span class="footer-icons icon fa fa-twitter"></span></a>
                </p>
            </div>
          </form>
        </div>
  </div>
</div>
@endsection
