@extends('layouts.admin')
@section('title', 'Products')
@section('heading', 'Products')

@section('content')

<div class="flex flex-wrap items-center justify-between gap-3 mb-5">
    {{-- Category filter --}}
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('admin.products.index') }}"
           class="px-3 py-1.5 rounded-lg text-xs font-body border {{ !request('category') ? 'bg-cb-black text-white border-cb-black' : 'border-cb-gray-300 text-cb-gray-600 hover:border-cb-gray-400' }} transition-colors">
            All
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('admin.products.index', ['category' => $cat->slug]) }}"
               class="px-3 py-1.5 rounded-lg text-xs font-body border {{ request('category') === $cat->slug ? 'bg-cb-black text-white border-cb-black' : 'border-cb-gray-300 text-cb-gray-600 hover:border-cb-gray-400' }} transition-colors">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>
    <a href="{{ route('admin.products.create') }}" class="admin-btn-primary rounded-lg">+ Add Product</a>
</div>

<div class="admin-card">
    @if($products->isEmpty())
        <p class="px-5 py-12 text-center font-body text-sm text-cb-gray-400">No products found. <a href="{{ route('admin.products.create') }}" class="underline">Add one</a>.</p>
    @else
        <div class="overflow-x-auto">
        <table class="admin-table" data-sortable="{{ route('admin.products.reorder') }}">
            <thead>
                <tr>
                    <th class="w-8"></th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr data-id="{{ $product->id }}">
                        <td><span class="drag-handle">⠿</span></td>
                        <td>
                            <div class="flex items-center gap-3">
                                @if($product->primaryImageUrl())
                                    <img src="{{ $product->primaryImageUrl() }}" alt=""
                                         class="w-10 h-10 rounded-lg object-cover shrink-0 border border-cb-gray-200">
                                @endif
                                <p class="font-medium text-cb-black">{{ $product->name }}</p>
                            </div>
                        </td>
                        <td>{{ $product->category?->name ?? '—' }}</td>
                        <td class="whitespace-nowrap">{{ $product->formattedPrice() }}</td>
                        <td>
                            @if($product->is_featured)
                                <span class="badge-green">Yes</span>
                            @else
                                <span class="badge-gray">No</span>
                            @endif
                        </td>
                        <td>
                            @if($product->active)
                                <span class="badge-green">Active</span>
                            @else
                                <span class="badge-red">Inactive</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="admin-btn-outline text-xs rounded-lg px-3 py-1.5">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="admin-btn-danger text-xs rounded-lg px-3 py-1.5"
                                            data-confirm="Delete '{{ $product->name }}'?">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->hasPages())
            <div class="px-5 py-4 border-t border-cb-gray-100">
                {{ $products->withQueryString()->links() }}
            </div>
        @endif
    @endif
</div>

@endsection
