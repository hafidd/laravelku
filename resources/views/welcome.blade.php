@extends('layout')

@section('content')
    <div class="flex flex-col flex-grow items-center justify-center">
        <h1 class="font-bold text-4xl mb-2">Welcome to laravel</h1>
        @auth
            @if (Route::has('product'))
                <a href="{{ route('product') }}"><span class="px-2 py-1 border border-indigo-600">Products</span></a>
            @endif
        @endauth
    </div>
@endsection
