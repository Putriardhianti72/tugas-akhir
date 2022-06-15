@extends('Layouts.main')
@section('isi')
<div class="main-content">
    <div id="wrapper-site">
        <div id="content-wrapper" class="full-width">
            <div id="main">
                <div class="container">
                    <h1 class="text-center title-page">Log In</h1>
                    <div class="login-form">
{{--                        <form method="POST" action="{{ route('login.custom') }}">--}}
                        <form id="customer-form" action="{{ route('login.submit') }}" method="post">
{{--                        <form id="customer-form" action="#" method="post">--}}
                            @csrf
                            <div>
                                <input type="hidden" name="back" value="my-account">
                                <div class="form-group no-gutters">
                                    <input class="form-control" name="uid" type="text" placeholder="Username">
                                </div>
                                <div class="form-group no-gutters">
                                    <div class="input-group js-parent-focus">
                                        <input class="form-control js-child-focus js-visible-password" name="passwd" type="password" value="" placeholder="Password">
                                    </div>
                                </div>
                                <div class="no-gutters text-center">
                                    <div class="forgot-password">
                                        <a href="user-reset-password.html" rel="nofollow">
                                            Forgot your password?
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="text-center no-gutters">
                                    <input type="hidden" name="submitLogin" value="1">
                                    <button class="btn btn-primary" data-link-action="sign-in" type="submit">
                                        Sign in
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
