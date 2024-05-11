@extends('layouts.app')
@push('css')
<style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }
    .container {
        margin-top: 50px;
    }
    .jumbotron {
        background-color: #007bff;
        color: #ffffff;
        padding: 100px 0;
        margin-bottom: 0;
    }
    .jumbotron h1 {
        font-size: 4.5em;
    }
    .btn-primary {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    .btn-outline-primary {
        color: #0056b3;
        border-color: #0056b3;
    }
    .btn-outline-primary:hover {
        background-color: #0056b3;
        color: #ffffff;
    }
    .feature {
        margin-bottom: 50px;
    }
    .feature-icon {
        font-size: 3em;
        color: #007bff;
    }
</style>

@endpush
@section('content')
<div class="jumbotron text-center">
    <h1>Welcome to Our Banking App</h1>
    <p class="lead">A modern banking experience for all your financial needs</p>
    @guest
    <a href="{{ route('login') }}" class="btn btn-warning btn-lg mr-2">Sign In</a>
    <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">Sign Up</a>
    @else
    <a href="{{ route('transactions.index') }}" class="btn btn-warning btn-lg mr-2">View Transactions</a>
    <a href="{{ route('transactions.withdraw') }}" class="btn btn-danger btn-lg m-2">Withdraw</a>
    @endguest

    
</div>

<div class="container">
    <div class="row feature">
        <div class="col-md-4 text-center">
            <span class="feature-icon">&#128176;</span>
            <h3>Easy Transactions</h3>
            <p>Transfer money easily and securely to anyone, anytime.</p>
        </div>
        <div class="col-md-4 text-center">
            <span class="feature-icon">&#128176;</span>
            <h3>Online Banking</h3>
            <p>Manage your accounts, pay bills, and more online.</p>
        </div>
        <div class="col-md-4 text-center">
            <span class="feature-icon">&#128176;</span>
            <h3>Mobile App</h3>
            <p>Access your accounts on the go with our mobile app.</p>
        </div>
    </div>
</div>
@endsection

