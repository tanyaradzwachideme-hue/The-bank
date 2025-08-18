<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function add_funds(Request $request){
        $data = $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);
    
        $user = Auth::user();
    
        // Fetch the user's account
        $account = Account::where('user_id', $user->id)->firstOrFail();
    
        $wallet_balance = $account->balance;
        $new_balance = $wallet_balance + $data['amount'];
    
        // Update balance
        $account->update([
            'balance' => $new_balance,
        ]);
    
        // Save transaction history
        Transaction::create([
            'user_id'        => $user->id,
            'account_id'     => $account->id,
            'amount'         => $data['amount'],
            'prev_balance'   => $wallet_balance,
            'account_number' => $account->account_number,
            'description'    => 'Funds added',
        ]);
    
        // Redirect back with success message
        return redirect()->route('dashboard')->with('success', 'Funds successfully added!');  
    }

    public function account_details()
{
    $user = Auth::user();

    // One account per user -> safe with firstOrFail
    $account = Account::where('user_id', $user->id)->firstOrFail();

    // Get many transactions (latest first)
    $transactions = Transaction::where('account_id', $account->id)
        ->orderBy('created_at', 'desc')
        ->get();
    // Pass to dashboard blade instead of account
    return view('dashboard', [
        'user'         => $user,
        'account'      => $account,
        'transactions' => $transactions,
    ]);
}

public function make_transaction(Request $request)
{
    $validated = $request->validate([
        'recipient'   => 'required|string',
        'amount'      => 'required|numeric|min:1',
        'description' => 'nullable|string',
    ]);

    $user = Auth::user();
    $account = Account::where('user_id', $user->id)->firstOrFail();

    // Basic balance check
    if ($account->balance < $validated['amount']) {
        return back()->withErrors(['amount' => 'Insufficient balance.']);
    }

    $previousBalance = $account->balance;
    $newBalance = $previousBalance - $validated['amount'];

    // Deduct from sender
    $account->update(['balance' => $newBalance]);

    // Record sender transaction
    Transaction::create([
        'user_id'        => $user->id,
        'account_id'     => $account->id,
        'amount'         => -1 * $validated['amount'],
        'prev_balance'   => $previousBalance,
        'account_number' => $validated['recipient'],
        'description'    => $validated['description'] ?? 'Transfer sent',
    ]);

    return redirect()->route('dashboard')->with('success', 'Transaction completed.');
}
}


