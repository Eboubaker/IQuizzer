@extends('layout')

@section('title') Register @endsection

@section('content')
<div class="text-center mt-12">
    <div class="flex items-center justify-center">
        <svg fill="none" viewBox="0 0 24 24" class="w-12 h-12 text-blue-500" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
    </div>
    <h2 class="text-4xl tracking-tight">
        Register new account
    </h2>
</div>
<div class="flex justify-center my-2 mx-4 md:mx-0">
    <form action="{{ route('register') }}" method="POST" class="w-full max-w-xl bg-white rounded-lg shadow-md p-6">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-full px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for='name'>
                    Name
                </label>
                <input value="{{ old('name') }}" name="name"
                    class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none"
                    type='text' required>
                @error('name')
                    <small class="text-sm text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div class="w-full md:w-full px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for='email'>
                    Email address
                </label>
                <input value="{{ old('email') }}" name="email"
                    class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none"
                    type='email' required>
                @error('email')
                    <small class="text-sm text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div class="w-full md:w-full px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for='Password'>
                    Password
                </label>
                <input value="{{ old('password') }}" name="password"
                    class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none"
                    type='password' required>
                @error('password')
                    <small class="text-sm text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div class="w-full flex items-center justify-between px-3 mb-3 ">
                <label for="remember" class="flex items-center w-1/2">
                </label>
                <div class="w-1/2 text-right">
                    <a href="{{ route('login') }}" class="text-blue-500 text-sm tracking-tight">
                        Already have an account?
                    </a>
                </div>
            </div>
            <div class="w-full md:w-full px-3 mb-6">
                <button
                    class="appearance-none block w-full bg-blue-600 text-gray-100 font-bold border border-gray-200 rounded-lg py-3 px-3 leading-tight hover:bg-blue-500 focus:outline-none focus:bg-white focus:border-gray-500">
                    Sign Up
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
