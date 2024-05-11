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

        try {user = User::find($request->user_id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $amount = $request->amount;
        $today = now();
        $fee = 0;

        // Check if it's Friday
        $isFreeDay = $today->isFriday();
        // Calculate the total withdrawal this month for free threshold
        $monthlyWithdrawals = Transaction::where('user_id', $user->id)
                                          ->where('transaction_type', 'withdrawal')
                                          ->whereMonth('date', $today->month)
                                          ->whereYear('date', $today->year)
                                          ->sum('amount');

        // Check account type and apply fees
        if ($user->account_type == 'Individual') {
            if (!$isFreeDay) {
                if ($monthlyWithdrawals < 5000) {
                    $freeAmount = min(5000 - $monthlyWithdrawals, $amount);
                    $chargeableAmount = $amount - $freeAmount;
                    $fee = ($chargeableAmount > 1000) ? 0.015 * ($chargeableAmount - 1000) : 0;
                } else {
                    $fee = 0.015 * max($amount - 1000, 0);
                }
            }
        } elseif ($user->account_type == 'Business') {
            $totalWithdrawal = Transaction::where('user_id', $user->id)
                                          ->where('transaction_type', 'withdrawal')
                                          ->sum('amount');
            $feePercentage = ($totalWithdrawal >= 50000) ? 0.015 : 0.025;
            $fee = $feePercentage * $amount;
        }

        // Update user balance and create transaction record
        $user->balance -= ($amount + $fee);
        $user->save();

        $transaction = new Transaction([
            'user_id' => $user->id,
            'transaction_type' => 'withdrawal',
            'amount' => $amount,
            'fee' => $fee,
            'date' => $today,
        ]);
        $transaction->save();

        return response()->json([
            'message' => 'Withdrawal successful',
            'data' => $transaction
        ]);
    }
}
