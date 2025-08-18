@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div x-data="{ sidebarOpen: false, active: 'home' }" class="h-screen">
	{{-- Top Navigation --}}
	<header class="sticky top-0 z-30 bg-white border-b">
		<div class="flex items-center justify-between px-4 sm:px-6 py-3">
			<div class="flex items-center gap-3">
				<button @click="sidebarOpen = !sidebarOpen" class="inline-flex items-center justify-center w-10 h-10 rounded-lg border hover:bg-gray-50 lg:hidden" aria-label="Toggle menu">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
					</svg>
				</button>
				<span class="hidden lg:inline text-xl font-bold text-blue-600 tracking-tight">MyApp</span>
			</div>
			<div class="flex-1 max-w-xl mx-4 hidden md:block">
				<div class="relative">
					<input type="text" placeholder="Search..." class="w-full rounded-xl border-gray-300 pl-10 pr-4 py-2 focus:ring-blue-500 focus:border-blue-500" />
					<svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 104.473 8.69l3.168 3.168a.75.75 0 101.06-1.06l-3.168-3.168A5.5 5.5 0 009 3.5zm-4 5.5a4 4 0 118 0 4 4 0 01-8 0z" clip-rule="evenodd"/></svg>
				</div>
			</div>
			<div class="flex items-center gap-3">
				<span class="hidden sm:inline text-gray-700">👋 {{ Auth::user()->name ?? 'Guest' }}</span>
				<div class="w-9 h-9 rounded-full bg-blue-600 text-white grid place-items-center">{{ strtoupper(substr(Auth::user()->name ?? 'G',0,1)) }}</div>
			</div>
		</div>
	</header>

	<div class="flex h-[calc(100vh-56px)]">
		{{-- Sidebar --}}
		<aside class="fixed inset-y-0 left-0 z-40 w-72 transform bg-white border-r shadow-sm transition-transform duration-200 lg:translate-x-0" :class="{ '-translate-x-full': !sidebarOpen }" @click.outside="sidebarOpen = false">
			<div class="h-14 px-4 lg:hidden flex items-center justify-between border-b">
				<span class="text-lg font-semibold text-blue-600">MyApp</span>
				<button @click="sidebarOpen = false" class="p-2 rounded-lg hover:bg-gray-50" aria-label="Close menu">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M6.72 6.72a.75.75 0 011.06 0L12 10.94l4.22-4.22a.75.75 0 111.06 1.06L13.06 12l4.22 4.22a.75.75 0 11-1.06 1.06L12 13.06l-4.22 4.22a.75.75 0 11-1.06-1.06L10.94 12 6.72 7.78a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg>
				</button>
			</div>
			<nav class="px-3 py-4 space-y-1 overflow-y-auto h-[calc(100%-56px)]">
				<a href="#" @click.prevent="active = 'home'; sidebarOpen = false" :class="active === 'home' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'text-gray-700 hover:bg-gray-50'" class="flex items-center gap-3 px-3 py-2.5 rounded-lg border">
					<span>🏠</span><span class="font-medium">Home</span>
				</a>
				<a href="#" @click.prevent="active = 'contact'; sidebarOpen = false" :class="active === 'contact' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'text-gray-700 hover:bg-gray-50'" class="flex items-center gap-3 px-3 py-2.5 rounded-lg border">
					<span>📞</span><span class="font-medium">Contact</span>
				</a>
				<a href="#" @click.prevent="active = 'about'; sidebarOpen = false" :class="active === 'about' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'text-gray-700 hover:bg-gray-50'" class="flex items-center gap-3 px-3 py-2.5 rounded-lg border">
					<span>ℹ️</span><span class="font-medium">About</span>
				</a>
				<a href="#" @click.prevent="active = 'account'; sidebarOpen = false" :class="active === 'account' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'text-gray-700 hover:bg-gray-50'" class="flex items-center gap-3 px-3 py-2.5 rounded-lg border">
					<span>👤</span><span class="font-medium">Account</span>
				</a>
				<a href="#" @click.prevent="active = 'transactions'; sidebarOpen = false" :class="active === 'transactions' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'text-gray-700 hover:bg-gray-50'" class="flex items-center gap-3 px-3 py-2.5 rounded-lg border">
					<span>💳</span><span class="font-medium">Transactions</span>
				</a>
				<a href="#" @click.prevent="active = 'history'; sidebarOpen = false" :class="active === 'history' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'text-gray-700 hover:bg-gray-50'" class="flex items-center gap-3 px-3 py-2.5 rounded-lg border">
					<span>📜</span><span class="font-medium">History</span>
				</a>
				<div class="pt-2">
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button class="btn btn-danger w-full">
							<span>Logout</span>
						</button>
					</form>
				</div>
			</nav>
		</aside>

		{{-- Backdrop for mobile --}}
		<div class="fixed inset-0 bg-black/40 z-30 lg:hidden" x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"></div>

		{{-- Main content area --}}
		<main class="flex-1 ml-0 lg:ml-72 overflow-y-auto bg-gray-50">
			<div class="p-6 space-y-6">
				{{-- Home --}}
				<section x-show="active === 'home'" x-transition>
					<h2 class="text-2xl font-bold tracking-tight">Welcome back, {{ $user->name }}</h2>
				
					<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mt-4">
				
						{{-- Account Overview --}}
						<div class="bg-white rounded-xl shadow p-5">
							<h3 class="font-semibold text-gray-800">Account Overview</h3>
							<p class="text-gray-600 mt-1">
								Balance: <span class="font-bold text-green-600">${{ number_format($account->balance, 2) }}</span>
							</p>
							<p class="text-gray-600 mt-1">
								Account Number: <span class="font-mono">{{ $account->account_number }}</span>
							</p>
						</div>
				
						{{-- Latest Transactions --}}
						<div class="bg-white rounded-xl shadow p-5">
							<h3 class="font-semibold text-gray-800">Recent Transactions</h3>
							@if($transactions->isEmpty())
								<p class="text-gray-600 mt-1">No transactions yet.</p>
							@else
								<ul class="mt-2 space-y-1 text-sm text-gray-600">
									@foreach($transactions->take(5) as $txn)
										<li class="flex justify-between">
											<span>{{ $txn->description }}</span>
											<span class="{{ $txn->amount < 0 ? 'text-red-600' : 'text-green-600' }}">
												{{ $txn->amount < 0 ? '-' : '+' }}${{ number_format(abs($txn->amount), 2) }}
											</span>
										</li>
									@endforeach
								</ul>
							@endif
						</div>
				
						{{-- History Summary --}}
						<div class="bg-white rounded-xl shadow p-5">
							<h3 class="font-semibold text-gray-800">History</h3>
							<p class="text-gray-600 mt-1">
								Total Transactions: {{ $transactions->count() }}
							</p>
							<p class="text-gray-600 mt-1">
								Last Activity: {{ $transactions->first()->created_at->diffForHumans() ?? 'N/A' }}
							</p>
						</div>
				
					</div>
				</section>
				

				{{-- Contact --}}
				<section x-show="active === 'contact'" x-transition>
					<h2 class="text-2xl font-bold">Contact</h2>
					<div class="bg-white rounded-xl shadow p-6 mt-4">
						<p class="text-gray-700">You can reach us at <a href="mailto:thebank@comapny.com" class="text-blue-600 underline">support@example.com</a>.</p>
					</div>
				</section>

				{{-- About --}}
				<section x-show="active === 'about'" x-transition>
					<h2 class="text-2xl font-bold">About</h2>
					<div class="bg-white rounded-xl shadow p-6 mt-4">
						<p class="text-gray-700">This is a simple banking dashboard built with Laravel and Tailwind CSS.</p>
					</div>
				</section>

				{{-- Account --}}
				<section x-show="active === 'account'" x-transition>
					<h2 class="text-2xl font-bold">Account</h2>
					<div class="bg-white rounded-xl shadow p-6 mt-4 space-y-4">
						<p class="text-gray-700">Name: <span class="font-medium">{{ Auth::user()->name ?? 'Guest' }}</span></p>
						<p class="text-gray-700">Email: <span class="font-medium">{{ Auth::user()->email ?? '-' }}</span></p>
						<p class="text-gray-700">Acc #: <span class="font-medium">{{ Auth::user()->account->account_number ?? '-' }}</span></p>
						<p class="text-gray-700">Acc Balance: <span class="font-medium">{{ Auth::user()->account->balance ?? '-' }}</span></p>
					</div>
				</section>

				{{-- Transactions --}}
<section x-show="active === 'transactions'" x-transition>
    <h2 class="text-2xl font-bold mb-4">Transactions</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Add Funds Form --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Add Funds</h3>
            <form action="{{ route('transactions.addFunds') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Amount --}}
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" name="amount" id="amount" min="1" step="0.01"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit" class="btn btn-success w-full">
                        Add Funds
                    </button>
                </div>
            </form>
        </div>

        {{-- Make Transaction Form --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Make a Transaction</h3>
            <form action="{{ route('transactions.make') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Recipient --}}
                <div>
                    <label for="recipient" class="block text-sm font-medium text-gray-700">Recipient</label>
                    <input type="text" name="recipient" id="recipient"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                {{-- Amount --}}
                <div>
                    <label for="txn_amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" name="amount" id="txn_amount" min="1" step="0.01"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text" name="description" id="description"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit" class="btn btn-primary w-full">
                        Make Transaction
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>


				{{-- History --}}
				<section x-show="active === 'history'" x-transition>
					<h2 class="text-2xl font-bold mb-4">History</h2>
					@if($transactions->isEmpty())
						<div class="bg-white rounded-xl shadow p-6">
							<p class="text-gray-600">No transactions yet.</p>
						</div>
					@else
						<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
							@foreach($transactions as $txn)
								<div class="bg-white rounded-xl shadow p-5 border">
									<div class="flex items-start justify-between">
										<div>
											<p class="text-xs text-gray-500">{{ $txn->created_at->format('M d, Y H:i') }}</p>
											<p class="mt-1 text-sm text-gray-600">To account</p>
											<p class="font-mono text-sm text-gray-800">{{ $txn->account_number ?? 'N/A' }}</p>
										</div>
										<span class="text-lg font-semibold {{ $txn->amount < 0 ? 'text-red-600' : 'text-green-600' }}">
											{{ $txn->amount < 0 ? '-' : '+' }}${{ number_format(abs($txn->amount), 2) }}
										</span>
									</div>
									@if(!empty($txn->description))
										<p class="mt-3 text-sm text-gray-700">{{ $txn->description }}</p>
									@endif
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
