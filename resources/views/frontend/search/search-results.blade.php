@extends('layouts.app')
@section('title', 'Search Results')
@section('content')
<div class="container">
    <h3><strong>Search results for: "{{ $query }}"</strong></h3>
<br>
    @if($results->count() > 0)
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Subcategory</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $product)
                    <tr>
                        <td>
                            <a href="{{ route('frontend.product', $product->id) }}">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td>
                            {{ $product->subcategory ? $product->subcategory->name : 'N/A' }}
                        </td>
                        <td>{{ Str::limit($product->description, 100) }}</td>
                        <td>{{ $product->price }} EGP</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No results found</p>
    @endif
</div>
@endsection
