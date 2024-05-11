<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::with('user')->latest()->get();
            return Datatables::of($data)->make(true);
        }
        return view('transactions');
    }

    public function index()
    {
        // dd(Auth()->id());
        $transactions = Transaction::with('user')->where('user_id',Auth()->id())->get();
        return view('transactions.index',compact('transactions'));
    }


    public function deposit()
    {
        return view('transactions.deposit');
    }

    public function depositStore(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
        ]);

        try {
            DB::beginTransaction();

            $user = $request->user();
            $user->transactions()->create([
                'transaction_type' => 'deposit',
                'amount' => $request->amount,
                'fee' => 0,
                'date' => now(),
            ]);

            $user->update(['balance' => $user->balance + $request->amount]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('transactions.deposit');
    }

    public function withdraw()
    {
        return view('transactions.withdraw');
    }

    public function withdrawStore(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
        ]);

        $user = $request->user();
        $user->transactions()->create([
            'transaction_type' => 'withdrawal',
            'amount' => $request->amount,
            'fee' => 0,
            'date' => now(),
        ]);

        return redirect()->route('transactions.withdraw');
    }
}
