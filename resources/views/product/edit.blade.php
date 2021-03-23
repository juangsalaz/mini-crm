@extends('layout_cms._layouts')
@section('product')
    active
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit product</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form method="post" action="{{route('update-product', $product[0]->id)}}">
                    @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$product[0]->name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Model</label>
                                        <input type="text" class="form-control" id="website" name="model" value="{{$product[0]->model}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <select class="form-control" name="id_brand">
                                            <option value="">Choose Brand</option>
                                            @foreach ($brands as $brand)
                                                @if ($brand->id == $product[0]->id_brand)
                                                    <option value="{{$brand->id}}" selected>{{$brand->name}}</option> 
                                                @else
                                                    <option value="{{$brand->id}}">{{$brand->name}}</option> 
                                                @endif
                                            @endforeach    
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit product</button>
                            <a href="{{route('product')}}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    
@endsection