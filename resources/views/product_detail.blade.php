@extends("layouts.master")

@section("title")
Arpit | Edit Category 
@endsection

@section("content")
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Products</h4>
                    <p class="card-description"> add new product</p>
                    <form class="forms-sample" method="POST" action="{{ url('product/add')}}">
                        @csrf

                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                        <input type="hidden" value="{{$product->category_id}}" name="category_id">
                        
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="img[]" class="file-upload-default">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                            </div>
                          </div>

                        <div class="form-group">
                            <label for="exampleInputName1">Product Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="type product name here..">
                            @error('category_name') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                       
                        <div class="form-group">
                            <label for="exampleSelectGender">Category Status</label>
                            <select class="form-control" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                      
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        <button type="reset" class="btn btn-dark">Reset</button>
                    </form>
                </div>
            </div>
        </div>     
    </div>
</div>
@endsection