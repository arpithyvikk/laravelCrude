@extends("layouts.master")

@section("title")
Arpit | Categories
@endsection

@section("content")
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if (Session::has('success_message'))
                        <div class="alert alert-success"> 
                            <strong>Success</strong> {{Session::get('success_message')}}
                        </div>
                    @endif
                    <h4 class="card-title">Categories</h4>
                    <p class="card-description"> add new category </p>
                    <form class="forms-sample" method="POST" action="{{ url('category')}}">
                        @csrf
                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                        <div class="form-group">
                            <label for="exampleInputName1">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="type category name here..">
                            @error('category_name') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                       
                        <div class="form-group">
                            <label for="exampleSelectGender">Category Status</label>
                            <select class="form-control" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                      
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-dark">Reset</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Available Categories</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Status</th>
                            <th>User ID</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>
                                   <?php  $status = $category->status ?>

                                    @if ($status == 'active')

                                    <span class="text-success">Active</span>

                                    @else

                                    <span class="text-danger">Inative</span>
                                    @endif
                                </td>
                                <td>{{$category->user_id}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning"><i class="mdi mdi-delete-sweep"></i></button> &nbsp;
                                    <button class="btn btn-sm btn-primary"><i class="mdi mdi-pencil"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <div class="table-links">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection