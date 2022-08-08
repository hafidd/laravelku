@extends('layout')

@section('content')
    <div class="flex flex-col flex-grow items-center justify-center">
        <div class="w-full md:w-72 md:border">
            <div class="relative flex p-2 border-b justify-center">
                <a href="/"><span class="absolute left-0 font-semibold text-lg px-2">&laquo;</span></a>
                <p class="font-bold text-lg">Register</p>
            </div>
            <div class="p-2">
                @if (Route::has('register_process'))
                    <form id="form" action="{{ route('register_process') }}" class="" method="POST">
                        @csrf
                        <div class="flex flex-col mb-2">
                            <label for="text" class="font-semibold">Name</label>
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <input id="text" type="text" name="name" class="border px-2 py-1"
                                value="{{ old('name') }}" autofocus>
                        </div>
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
                            @error('password')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <input id="password" type="password" name="password" class="border px-2 py-1">
                        </div>
                        <div class="flex flex-col mb-2">
                            <label for="password_confirmation" class="font-semibold">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="border px-2 py-1">
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <button class="px-2 py-1 border font-bold">Register</button>
                            <a href="{{ route('login') }}" class="text-sm font-semibold px-2">Login</a>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
