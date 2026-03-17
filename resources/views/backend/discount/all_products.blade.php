@extends('layouts.admin')
@section('title', 'Set Product Discount')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Set Discount For All Products</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.allproducts.updateDiscount') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="discount"><b>Discount Percentage</b></label>
                <select name="discount" id="discount" class="form-control">
                    <option value="0">No Discount</option>
                    @foreach([10,15,20,25,30,35,40,45,50,55,60,65,70,75] as $value)
                        <option value="{{ $value }}">
                            {{ $value }}%
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Save Discount</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
