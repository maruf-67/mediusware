@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Withdraw</div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Name:</strong> {{ Auth::user()->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Balance:</strong> ${{ Auth::user()->balance }}
                    </div>
                    {{-- <hr>
                    <div class="mb-3">
                        <strong>Deposit:</strong>
                        <form method="POST" action="{{ route('transactions.deposit.store') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" id="amount" name="amount" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Deposit</button>
                        </form>
                    </div> --}}
                    <hr>
                    <div>
                        <strong>Withdraw:</strong>
                        <form method="POST" action="{{ route('transactions.withdraw.store') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <div class="form-group">
                                <label for="withdraw_amount">Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" id="withdraw_amount" name="withdraw_amount" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger">Withdraw</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
