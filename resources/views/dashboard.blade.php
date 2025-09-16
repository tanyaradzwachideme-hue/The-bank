@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div x-data="{ sidebarOpen: false, active: 'home' }" class="min-vh-100">
    {{-- Top Navigation --}}
    <nav class="navbar navbar-expand-lg navbar-light dashboard-navbar sticky-top">
        <div class="container-fluid">
            <button @click="sidebarOpen = !sidebarOpen" class="btn btn-outline-secondary d-lg-none me-3" type="button">
                <i class="bi bi-list fs-5"></i>
            </button>
            <span class="navbar-brand d-none d-lg-block fw-bold text-primary fs-4">
                <i class="bi bi-bank2 me-2"></i>MyApp
            </span>
            
            <div class="d-none d-md-block flex-grow-1 mx-4">
                <div class="position-relative">
                    <input type="text" placeholder="Search transactions, accounts..." class="form-control" />
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <span class="d-none d-sm-inline text-muted fw-medium">👋 {{ Auth::user()->name ?? 'Guest' }}</span>
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                    {{ strtoupper(substr(Auth::user()->name ?? 'G',0,1)) }}
                </div>
            </div>
        </div>
    </nav>

    <div class="d-flex">
        {{-- Sidebar --}}
        <aside class="position-fixed top-0 start-0 h-100 dashboard-sidebar shadow-sm" 
               style="width: 280px; z-index: 1040; transform: translateX(-100%); transition: transform 0.3s ease;"
               :class="{ 'translateX(0)': sidebarOpen || window.innerWidth >= 992 }"
               @click.outside="sidebarOpen = false">
            <div class="d-flex d-lg-none align-items-center justify-content-between p-3 border-bottom">
                <span class="h5 mb-0 fw-bold text-primary">
                    <i class="bi bi-bank2 me-2"></i>MyApp
                </span>
                <button @click="sidebarOpen = false" class="btn-close" type="button"></button>
            </div>
            <nav class="p-3">
                <div class="list-group list-group-flush">
                    <a href="#" @click.prevent="active = 'home'; sidebarOpen = false" 
                       :class="active === 'home' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'">
                        <i class="bi bi-house-door me-3"></i>🏠 Home
                    </a>
                    <a href="#" @click.prevent="active = 'contact'; sidebarOpen = false" 
                       :class="active === 'contact' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'">
                        <i class="bi bi-telephone me-3"></i>📞 Contact
                    </a>
                    <a href="#" @click.prevent="active = 'about'; sidebarOpen = false" 
                       :class="active === 'about' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'">
                        <i class="bi bi-info-circle me-3"></i>ℹ️ About
                    </a>
                    <a href="#" @click.prevent="active = 'account'; sidebarOpen = false" 
                       :class="active === 'account' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'">
                        <i class="bi bi-person-circle me-3"></i>👤 Account
                    </a>
                    <a href="#" @click.prevent="active = 'transactions'; sidebarOpen = false" 
                       :class="active === 'transactions' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'">
                        <i class="bi bi-credit-card me-3"></i>💳 Transactions
                    </a>
                    <a href="#" @click.prevent="active = 'history'; sidebarOpen = false" 
                       :class="active === 'history' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'">
                        <i class="bi bi-clock-history me-3"></i>📜 History
                    </a>
                </div>
                <div class="mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-custom-danger w-100">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        {{-- Backdrop for mobile --}}
        <div class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50" 
             style="z-index: 1030;"
             x-show="sidebarOpen" 
             x-transition.opacity 
             @click="sidebarOpen = false"></div>

        {{-- Main content area --}}
        <main class="flex-grow-1 ms-0 ms-lg-auto main-content" style="min-height: calc(100vh - 56px);">
            <div class="p-4">
                {{-- Home --}}
                <section x-show="active === 'home'" x-transition class="fade-in">
                    <div class="d-flex align-items-center mb-4">
                        <h2 class="h3 mb-0">Welcome back, {{ $user->name }}</h2>
                        <div class="ms-auto">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                <i class="bi bi-check-circle me-1"></i>Online
                            </span>
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        {{-- Account Overview --}}
                        <div class="col-md-6 col-xl-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                            <i class="bi bi-wallet2 text-primary fs-4"></i>
                                        </div>
                                        <h5 class="card-title mb-0">Account Overview</h5>
                                    </div>
                                    <p class="card-text">
                                        Balance: <span class="fw-bold text-success fs-5">${{ number_format($account->balance, 2) }}</span>
                                    </p>
                                    <p class="card-text">
                                        Account Number: <span class="font-monospace text-muted">{{ $account->account_number }}</span>
                                    </p>
                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <i class="bi bi-shield-check me-1"></i>Account Status: Active
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Latest Transactions --}}
                        <div class="col-md-6 col-xl-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                            <i class="bi bi-arrow-left-right text-info fs-4"></i>
                                        </div>
                                        <h5 class="card-title mb-0">Recent Transactions</h5>
                                    </div>
                                    @if($transactions->isEmpty())
                                        <p class="card-text text-muted">No transactions yet.</p>
                                    @else
                                        <ul class="list-unstyled mb-0">
                                            @foreach($transactions->take(5) as $txn)
                                                <li class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                                                    <div>
                                                        <span class="small fw-medium">{{ $txn->description }}</span>
                                                        <br>
                                                        <small class="text-muted">{{ $txn->created_at->format('M d, H:i') }}</small>
                                                    </div>
                                                    <span class="small fw-bold {{ $txn->amount < 0 ? 'text-danger' : 'text-success' }}">
                                                        {{ $txn->amount < 0 ? '-' : '+' }}${{ number_format(abs($txn->amount), 2) }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- History Summary --}}
                        <div class="col-md-6 col-xl-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                                            <i class="bi bi-graph-up text-warning fs-4"></i>
                                        </div>
                                        <h5 class="card-title mb-0">Activity Summary</h5>
                                    </div>
                                    <p class="card-text">
                                        Total Transactions: <span class="fw-bold">{{ $transactions->count() }}</span>
                                    </p>
                                    <p class="card-text">
                                        Last Activity: <span class="text-muted">{{ $transactions->first()->created_at->diffForHumans() ?? 'N/A' }}</span>
                                    </p>
                                    <div class="mt-3">
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-success" style="width: 75%"></div>
                                        </div>
                                        <small class="text-muted">Account Health: Excellent</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Contact --}}
                <section x-show="active === 'contact'" x-transition class="fade-in">
                    <h2 class="h3 mb-4">
                        <i class="bi bi-telephone me-2"></i>Contact
                    </h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Get in Touch</h5>
                                    <p class="card-text">We're here to help with any questions about your account.</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-envelope text-primary me-3"></i>
                                        <span>support@example.com</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-telephone text-primary me-3"></i>
                                        <span>+1 (555) 123-4567</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-clock text-primary me-3"></i>
                                        <span>24/7 Support Available</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light rounded p-3">
                                        <h6>Quick Response</h6>
                                        <p class="small text-muted mb-0">Our support team typically responds within 2 hours during business hours.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- About --}}
                <section x-show="active === 'about'" x-transition class="fade-in">
                    <h2 class="h3 mb-4">
                        <i class="bi bi-info-circle me-2"></i>About
                    </h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="card-title">The Other Bank</h5>
                                    <p class="card-text">This is a modern banking dashboard built with Laravel and Bootstrap, designed to provide a seamless banking experience with real-time transaction monitoring and secure account management.</p>
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <div class="text-center p-3">
                                                <i class="bi bi-shield-check text-success fs-1"></i>
                                                <h6 class="mt-2">Secure</h6>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center p-3">
                                                <i class="bi bi-lightning text-warning fs-1"></i>
                                                <h6 class="mt-2">Fast</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="bg-primary bg-opacity-10 rounded p-3">
                                        <h6 class="text-primary">Version</h6>
                                        <p class="mb-0">1.0.0</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Account --}}
                <section x-show="active === 'account'" x-transition class="fade-in">
                    <h2 class="h3 mb-4">
                        <i class="bi bi-person-circle me-2"></i>Account
                    </h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Personal Information</h5>
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Full Name</label>
                                        <p class="fw-medium">{{ Auth::user()->name ?? 'Guest' }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Email Address</label>
                                        <p class="fw-medium">{{ Auth::user()->email ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="card-title">Account Details</h5>
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Account Number</label>
                                        <p class="fw-medium font-monospace">{{ Auth::user()->account->account_number ?? '-' }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Current Balance</label>
                                        <p class="fw-bold text-success fs-5">${{ Auth::user()->account->balance ?? '0.00' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Transactions --}}
                <section x-show="active === 'transactions'" x-transition class="fade-in">
                    <h2 class="h3 mb-4">
                        <i class="bi bi-credit-card me-2"></i>Transactions
                    </h2>
                    <div class="row g-4">
                        {{-- Add Funds Form --}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                            <i class="bi bi-plus-circle text-success fs-4"></i>
                                        </div>
                                        <h5 class="card-title mb-0">Add Funds</h5>
                                    </div>
                                    <form action="{{ route('transactions.addFunds') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" name="amount" id="amount" min="1" step="0.01"
                                                       class="form-control" placeholder="0.00" required>
                                            </div>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-custom-success">
                                                <i class="bi bi-plus-circle me-2"></i>Add Funds
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Make Transaction Form --}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                            <i class="bi bi-arrow-right-circle text-primary fs-4"></i>
                                        </div>
                                        <h5 class="card-title mb-0">Make a Transaction</h5>
                                    </div>
                                    <form action="{{ route('transactions.make') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="recipient" class="form-label">Recipient Account</label>
                                            <input type="text" name="recipient" id="recipient"
                                                   class="form-control" placeholder="Enter account number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="txn_amount" class="form-label">Amount</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" name="amount" id="txn_amount" min="1" step="0.01"
                                                       class="form-control" placeholder="0.00" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <input type="text" name="description" id="description"
                                                   class="form-control" placeholder="Payment for...">
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-custom-primary">
                                                <i class="bi bi-send me-2"></i>Make Transaction
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- History --}}
                <section x-show="active === 'history'" x-transition class="fade-in">
                    <h2 class="h3 mb-4">
                        <i class="bi bi-clock-history me-2"></i>Transaction History
                    </h2>
                    @if($transactions->isEmpty())
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="bi bi-inbox text-muted fs-1"></i>
                                <p class="card-text text-muted mt-3">No transactions yet.</p>
                            </div>
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach($transactions as $txn)
                                <div class="col-md-6 col-xl-4">
                                    <div class="card h-100 transaction-card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded-circle p-2 me-3">
                                                        <i class="bi {{ $txn->amount < 0 ? 'bi-arrow-down text-danger' : 'bi-arrow-up text-success' }}"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">{{ $txn->description ?: 'Transaction' }}</h6>
                                                        <small class="text-muted">{{ $txn->created_at->format('M d, Y H:i') }}</small>
                                                    </div>
                                                </div>
                                                <span class="h6 fw-bold {{ $txn->amount < 0 ? 'text-danger' : 'text-success' }}">
                                                    {{ $txn->amount < 0 ? '-' : '+' }}${{ number_format(abs($txn->amount), 2) }}
                                                </span>
                                            </div>
                                            <div class="border-top pt-3">
                                                <small class="text-muted">
                                                    <i class="bi bi-credit-card me-1"></i>
                                                    To: {{ $txn->account_number ?? 'N/A' }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>
        </main>
    </div>
</div>
@endsection
