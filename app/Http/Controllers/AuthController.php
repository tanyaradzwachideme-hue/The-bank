<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'name'          => 'required|string|max:255',
            'surname'       => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:8|confirmed', // password + password_confirmation
            'id_number'     => 'required|string|max:20',
            'phone_number'  => 'required|string|max:20',
            'address'       => 'required|string|max:500',
            'account_type'  => 'required|string',
        ]);
    
        // Create user
        $user = User::create([
            'name'         => $request->name,
            'surname'      => $request->surname,
            'email'        => $request->email,
            'id_number'    => $request->id_number,
            'phone_number' => $request->phone_number,
            'address'      => $request->address,
            'password'     => Hash::make($request->password),
        ]);
    
        // Generate a unique account number (6-digit)
        do {
            $account_number = random_int(100000, 999999);
        } while (Account::where('account_number', $account_number)->exists());
    
        // Create account
        $account = Account::create([
            'user_id'       => $user->id,
            'balance'       => 0.00,
            'account_type'  => $request->account_type,
            'account_number'=> $account_number,
        ]);
    
        // Optional: create an initial transaction record
        Transaction::create([
            'user_id'      => $user->id,
            'account_id'   => $account->id,
            'amount'       => 0.00,
            'prev_balance' => 0.00,
            'account_number'=> "0000",
            'description'=>'account setup',
        ]);
    
        // Log in user
        Auth::login($user);
    
        // Regenerate session for security
        $request->session()->regenerate();
    
        // Redirect to dashboard route
        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome to your dashboard.');
    }
    public function login(Request $request)
    {
         // validate input
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // attempt login
    if (!Auth::attempt($credentials)) {
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }

    // regenerate session (security best practice)
    $request->session()->regenerate();

    // redirect to dashboard route
    return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Redirect to login page (or wherever you want)
        return redirect()->route('login')->with('status', 'You have been logged out.');
    }

    public function show_register(){
        return view('register');
    }

    public function show_login(){
        return view('welcome');
    }

    public function show_dashboard(){
    $user = Auth::user();
    $account = $user->account;
    $transactions = $account->transactions()->latest()->get();

    return view('dashboard', compact('user','account','transactions'));
    }
}
