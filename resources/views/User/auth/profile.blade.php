@extends('Layouts.user.main2')
@section('class-body','user-acount')
@section('isi')
<div class="main-content">
    <div class="wrap-banner">

        <!-- breadcrumb -->
        <nav class="breadcrumb-bg">
            <div class="container no-index">
                <div class="breadcrumb">
                    <ol>
                        <li>
                            <a href="#">
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span>My Account</span>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </nav>
        <br>
        <br>
        <div class="acount head-acount">
            <div class="container">
                <div id="main">
                    <h1 class="title-page">My Account</h1>
                    <div class="content" id="block-history">
                        <table class="std table">
                            <tbody>
                                @if (member_auth()->check())
                                <tr>
                                    <th class="first_item">Nama </th>
                                    <td>: {{ member_auth()->user()->get('nama') }}</td>
                                </tr>
                                <tr>
                                    <th class="first_item">Email </th>
                                    <td>: {{ member_auth()->user()->get('email') }}</td>
                                </tr>
                                <tr>
                                    <th class="first_item">Alamat </th>
                                    <td>: {{ member_auth()->user()->get('alamat1') }}, {{ member_auth()->user()->get('alamat2') }}, {{ member_auth()->user()->get('kota') }}, {{ member_auth()->user()->get('propinsi') }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                    <button class="btn btn-primary" data-link-action="sign-in" type="submit">
                        view Address
                    </button>
                    <div class="order">
                        <h4>Order
                            <span class="detail">History</span>
                        </h4>
                        <p>You haven't placed any orders yet.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
