@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <h4>Welcome, {{ auth()->user()->name }}</h4>
                <p>Your current balance: ${{ auth()->user()->balance }}</p>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('transactions.deposit') }}" class="btn btn-primary">Deposit</a>
                <a href="{{ route('transactions.withdraw') }}" class="btn btn-danger">Withdraw</a>
            </div>
        </div>
        <table id="transactions-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                    <th>Fee</th>
                    <th>Date</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#transactions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('transactions.get', ['user_id' => Auth::id()]) }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'transaction_type',
                        name: 'transaction_type'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'fee',
                        name: 'fee'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    }
                ]
            });
        });
    </script>
@endpush
