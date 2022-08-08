@extends('layout')

@section('content')
    <x-product.card>
        <div class="flex items-center mb-4">
            <h2 class="font-bold text-xl mr-2">Products</h2>
            <form action="" class="m-2">
                <input type="search" name="search" class="px-2 py-1 border" placeholder="s/n or name"
                    value="{{ request()->search }}">
                <input type="submit" class="px-2 py-1 border ml-1" value="Search">
            </form>
        </div>

        <div class="w-full overflow-y-auto">
            <table class="w-full">
                <thead class="">
                    <tr class="border-b">
                        <th class="w-[5%] border-r">#</th>
                        <th class="w-[15%] border-r">S/N</th>
                        <th class=" border-r">Name</th>
                        <th class="w-[15%] border-r">Price</th>
                        <th class="w-[10%] border-r">Stock</th>
                        <th class="w-[15%] border-r"></th>
                    </tr>
                </thead>
                <tbody class="">
                    @php $no=1 @endphp
                    @foreach ($products as $product)
                        <tr class="border-b">
                            <td class="p-2 text-center font-semibold">{{ $no++ }}</td>
                            <td class="p-2 text-center font-semibold">{{ $product->sn }}</td>
                            <td class="p-2">{{ $product->name }}</td>
                            <td class="p-2 text-right">{{ $product->price }}z</td>
                            <td class="p-2 text-right">{{ $product->stock }}</td>
                            <td class="p-2 text-center flex">
                                <a href="{{ url('product/' . $product->id . '/edit') }}" class="">✏️</a>
                                <form action="{{ url('product/' . $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>❌</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="w-full mt-4 flex items-center justify-between">
            <span class="m-2 px-2 py-1">Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</span>
            <div class="">
                @if ($products->currentPage() > 1)
                    <a href="{{ $product->path }}?page={{ $products->currentPage() - 1 }}" class="">
                        <span class="m-1 px-2 py-1 border">&laquo; Prev</span>
                    </a>
                @endif
                @if ($products->currentPage() < $products->lastPage())
                    <a href="{{ $product->path }}?page={{ $products->currentPage() + 1 }}" class="">
                        <span class="m-1 px-2 py-1 border">Next &raquo;</span>
                    </a>
                @endif
            </div>
        </div>
    </x-product.card>
@endsection
