@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('transactions.withdraw') }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <div class="form-group">
        <label for="amount">Withdrawal Amount</label>
        <input type="number" class="form-control" id="amount" name="amount" required>
    </div>
    <button type="submit" class="btn btn-primary">Withdraw</button>
</form>

@endsection
