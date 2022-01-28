@extends("layouts.master")

@section("title")
Arpit | Edit Category 
@endsection

@section("content")
<style>
    .pro-detail{
        padding: 10px 0px;
    }
    .pro-detail img{
        width: 100%;
        /* margin-left: -10%; */
    }
    .probtn{
        margin: 10px 10px!important;
    }
</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title">Product details</h4> --}}
                    <p class="card-description"> </p>
                    <div class="row">
                        <div class="col-md-4 col-sm-10 offset-sm-1">
                            <div class="pro-detail">
                                <img src="{{asset('images')}}/{{$product->image}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-10 offset-md-1 offset-sm-1">
                            <h3>{{$product->name}}</h3>
                            <h5>Quantity : {{$product->quantity}}</h5>
                            <h5>Status : {{$product->status}}</h5>
                            <h5>Category : {{implode(', ', $product->categories->pluck('category_name')->toArray()) }}</h5>
                            <h2>₹ {{$product->price}}</h2>
                            <hr>
                            <h5>User ID : {{$product->user_id}}</h5>
                            <h5>User Name : {{Auth::user()->name}}</h5> 
                            <h6>Add Date & Time: {{$product->created_at}}</h6>
                            <h6>Update Date & Time: {{$product->updated_at}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <a href="{{route('product.index')}}">
                                <button class="btn btn-outline-info btn-icon-text probtn">
                                    <i class="mdi mdi-view-list btn-icon-prepend mdi-36px"></i>
                                    <span class="d-inline-block text-left">
                                      <small class="font-weight-light d-block">Show product list</small> PRODUCTS </span>
                                  </button>
                                </a>
                            <a href="{{route('product.create')}}">
                            <button class="btn btn-outline-success btn-icon-text probtn">
                                <i class="mdi mdi-basket-fill btn-icon-prepend mdi-36px"></i>
                                <span class="d-inline-block text-left">
                                  <small class="font-weight-light d-block">Add new product</small> INSERT </span>
                              </button>
                            </a>
                            <a href="{{ route('product.edit',$product->id) }}">
                                <button class="btn btn-outline-warning btn-icon-text probtn">
                                    <i class="mdi mdi-pencil btn-icon-prepend mdi-36px"></i>
                                    <span class="d-inline-block text-left">
                                      <small class="font-weight-light d-block">Edit product detail</small> UPDATE </span>
                                </button>
                            </a>
                            <a href="{{ route('product.delete',$product->id) }}">
                                <button class="btn btn-outline-primary btn-icon-text probtn">
                                    <i class="mdi mdi-delete-sweep btn-icon-prepend mdi-36px"></i>
                                    <span class="d-inline-block text-left">
                                      <small class="font-weight-light d-block">Move to trash</small> TRASH </span>
                                </button>
                            </a>
                            <a href="{{ route('product.force_delete',$product->id) }}" onclick="return confirm('Are you Sure You Want to Remove `{{$product->name}}` Product Perminant?')">
                                <button class="btn btn-outline-danger btn-icon-text probtn">
                                    <i class="mdi mdi-delete btn-icon-prepend mdi-36px"></i>
                                    <span class="d-inline-block text-left">
                                      <small class="font-weight-light d-block">Remove perminant</small> DELETE </span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>     
    </div>
</div>
@endsection