@extends("layouts.master")

@section("title")
Arpit | Add Product 
@endsection


<style>
    #uploadPreview {
        max-height: 150px;
        margin-bottom:10px;
        margin-left: 5px;
        display: block;
        border:none!important;
    }

</style>
@section("content")

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
    @elseif(Session::has('errror_message'))
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" style="padding: 15px 15px 0px 15px!important;">
                        <div class="alert alert-danger"> 
                            <strong>Error </strong> {{Session::get('error_message')}}
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
                    <h4 class="card-title">Product Form</h4>
                    <p class="card-description"> add new product</p>
                    <form class="forms-sample" method="POST" action="{{ route('product.created')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">

                        <div class="form-group">
                            <label>Product Image</label>
                            <img id="uploadPreview">
                            <input type="file" name="img" class="file-upload-default" id="uploadImage" onchange="PreviewImage();" multiple>
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="upload product image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                              @error('img') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputName">Product Name</label>
                                <input type="text" class="form-control file-upload-info" id="name" name="name" placeholder="type product name here.." />
                                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="exampleInputName">Product Price</label>
                                <input type="text" class="form-control file-upload-info" id="price" name="price" placeholder="₹" />
                                @error('price') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputName">Product Status</label>
                                <select class="form-control file-upload-info" name="status" id="status" style="border:solid .1vmax #2a2c30;">
                                    <option value="instock" selected>Instock</option>
                                    <option value="outstock">OutStock</option>
                                  </select>
                                @error('status') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="exampleInputName">Product Quantity</label>
                                <input type="text" class="form-control file-upload-info" id="quantity" name="quantity" placeholder="number of product" value="">
                                @error('quantity') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Product Category</label>
                            <select class="js-example-basic-multiple select2-hidden-accessible file-upload-info" name="category[]" multiple="" style="width:100%" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category') <span class="text-danger error">{{ $message }}</span>@enderror

                        </div>      

                        <button type="submit" class="btn btn-info mr-2">Submit</button>
                        <button type="reset" class="btn btn-dark">Reset</button>
                    </form>
                </div>
            </div>
        </div>     
    </div>
</div>
<!-- JavaScript Bundle with Popper -->
<script type="text/javascript">

    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };

</script>
@endsection