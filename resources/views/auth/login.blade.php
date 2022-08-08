@extends('layout')

@section('content')
    <div class="flex flex-col flex-grow items-center justify-center">
        <div class="w-full md:w-72 md:border">
            <div class="relative flex p-2 border-b justify-center">
                <a href="/"><span class="absolute left-0 font-semibold text-lg px-2">&laquo;</span></a>
                <p class="font-bold text-lg">Login</p>
            </div>
            <div class="p-2">
                @if (Route::has('register_process'))
                    <form action="{{ route('login_process') }}" class="" method="POST">
                        @csrf
                        <div class="flex flex-col mb-2">
                            <label for="email" class="font-semibold">Email</label>
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <input id="email" type="email" name="email" class="border px-2 py-1"
                                value="{{ old('email') }}">
                        </div>
                        <div class="flex flex-col mb-2">
                            <label for="password" class="font-semibold">Password</label>
                            <input id="password" type="password" name="password" class="border px-2 py-1">
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <button class="px-2 py-1 border font-bold">Login</button>
                            <a href="{{ route('register') }}" class="text-sm font-semibold px-2">Register</a>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
