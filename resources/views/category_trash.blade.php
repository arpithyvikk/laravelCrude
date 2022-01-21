@extends("layouts.master")

@section("title")
Arpit | Trash Categories
@endsection

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
    @endif
          
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Trashed Categories</h4>
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
                            <th>Category Name</th>
                            <th>Status</th>
                            <th>User ID</th>
                            <th>Date & Time</th>
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
                                        <span class="text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{$category->user_id}}</td>
                                <td>{{$category->deleted_at}}</td>
                                <td>
                                    <a href="{{ url('restore_category/'.$category->id) }}" title="Restore" class="btn btn-sm btn-info"><i class="mdi mdi-pencil"></i></a> &nbsp;
                                    <a href="{{ url('deleted_category/'.$category->id) }}"  onclick="return confirm('Remove Category Perminant?')" title="Perminant Remove" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i></a>
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