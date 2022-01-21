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
                   
                    <h4 class="card-title">Categories</h4>
                    <p class="card-description"> edit category details</p>
                    <form class="forms-sample" method="POST" action="{{ url('edit_category')}}">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                        <input type="hidden" value="{{$category->id}}" name="id">

                        <div class="form-group">
                            <label for="exampleInputName1">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="type category name here.." value="{{$category->category_name}}">
                            @error('category_name') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                       
                        <div class="form-group">
                            <label for="exampleSelectGender">Category Status</label>
                            <select class="form-control" name="status">
                                <option value="active" {{$category->status == 'active' ? 'selected' : ''}}>Active</option>
                                <option value="inactive" {{$category->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
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