@extends('layout')
@section('content')
    <x-product.card>
        <div class="border p-2">
            <div class="flex items-center p-2 mb-2 border-b">
                <a href="{{ url('product') }}" class="">
                    <span class="border px-2 mr-2">&laquo</span>
                </a>
                <p class="font-bold text-xl">{{ isset($product) ? 'Update' : 'Create' }} Product</p>
            </div>
            <div class="p-2">
                <form action="{{ url('product' . (isset($product) ? '/' . $product->id : '')) }}" method="POST">
                    @csrf
                    @if (isset($product))
                        @method('PUT')
                    @endif
                    <div class="mb-2 flex flex-col">
                        <label for="sn" class="font-semibold">Name</label>
                        @error('sn')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <input type="text" id="sn" name="sn" maxlength="10"
                            class="border px-2 py-1 w-[12em] tracking-widest font-semibold"
                            value="{{ $product->sn ?? old('sn') }}">
                    </div>
                    <div class="mb-2 flex flex-col">
                        <label for="name" class="font-semibold">Name</label>
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <input type="text" id="name" name="name" maxlength="100" class="border px-2 py-1"
                            value="{{ $product->name ?? old('name') }}">
                    </div>
                    <div class="mb-2 flex flex-col">
                        <label for="desc" class="font-semibold">Description</label>
                        @error('desc')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <input type="text" id="desc" name="desc" maxlength="200" class="border px-2 py-1"
                            value="{{ $product->desc ?? old('desc') }}">
                    </div>
                    <div class="mb-2 flex flex-col">
                        <label for="price" class="font-semibold">Price</label>
                        @error('price')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <input type="number" id="price" name="price" class="border px-2 py-1 w-full md:w-1/2"
                            value="{{ $product->price ?? old('price') }}">
                    </div>
                    <div class="mb-2 flex flex-col">
                        <label for="stock" class="font-semibold">Stock</label>
                        @error('stock')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <input type="number" id="stock" name="stock" class="border px-2 py-1 w-full md:w-1/2"
                            value="{{ $product->stock ?? old('stock') }}">
                    </div>
                    <div class="mb-2 flex flex-col">
                        <button class="px-2 py-1 border w-fit font-bold">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </x-product.card>
@endsection
