@extends("layouts.master")

@section("title")
Arpit | Products
@endsection

@section("content")
<style>
    .table td img{
        width:50px!important;
        height:50px!important;
    }
</style>
<div class="content-wrapper">
   
    @if (Session::has('success_message'))
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" style="padding: 15px 15px 0px 15px!important;">
                        <div class="alert alert-success"> 
                            <strong>Success </strong> {{Session::get('success_message')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
          
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Available Products</h4>
                    <div class="row">
                        {{-- <div class="col-"> &nbsp; </div> --}}
                        <div class="col-12">
                            <form class="forms-sample">
                                <div class="input-group">
                                <?php $search = (isset($_REQUEST['search'])) ? htmlentities($_REQUEST['search']) : ''; ?>
                                    <input type="text" class="form-control form-control-sm" name="search" placeholder="Search here.." value="{{ $search }}" >
                                    <div class="input-group-append">
                                    <button class="btn btn-sm btn-success" type="submit"><i class="mdi mdi-search-web"></i></button>
                                    </div>
                                </div>
                                <div><br></div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>User ID</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>
                                        <img src="{{asset('images')}}/{{$product->image}}" alt="" />
                                </td>
                                <td>{{$product->name}}</td>
                                <td>
                                                                      
                                    @if ($product->status == 'instock')
                                        <span class="text-success">Instock</span>
                                    @else
                                        <span class="text-danger">Outstock</span>
                                    @endif
                                </td>
                                <td>
                                    {{implode(', ', $product->categories->pluck('category_name')->toArray()) }}
                                </td>
                                <td>{{$product->user_id}}</td>
                                <td>
                                    <a href="{{ route('product.edit',$product->id) }}" title="Edit" class="btn btn-sm btn-warning"><i class="mdi mdi-pencil"></i></a> &nbsp;
                                    <a href="{{ route('product.delete',$product->id) }}" title="Move to trash" class="btn btn-sm btn-primary"><i class="mdi mdi-delete-sweep"></i></a>
                                    {{-- <a href="{{ url('deleted_category/'.$product->id) }}"  onclick="return confirm('Are you sure want to remove this product perminant?')" title="Perminant Remove" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i></a> --}} &nbsp;
                                    <a href="{{ route('product.detail',$product->id) }}"  title="Details" class="btn btn-sm btn-info"><i class="mdi mdi-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <div class="table-links">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
