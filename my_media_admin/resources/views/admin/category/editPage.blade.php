
@extends('admin.layouts.app')
@section('content')
<div class="col-4 mt-2">
    <div class="card">
        @if (Session::has('categoryUpdated'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
            <strong>{{Session::get('categoryUpdated')}}</strong>
            <button type="button" class="bg-success rounded shadow-sm" data-bs-dismiss="alert" >X</button>
          </div>
        @endif
        <div class="card-body">
            <form action="{{ route('admin#updateCategory', $updateData->category_id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="categoryName" class="form-label">Category Name :</label>
                    <input type="text" name="categoryName" value="{{$updateData->title}}" id="categoryName" class="form-control" placeholder="Enter Category Name...">
                    @error('categoryName')
                      <small class="text-danger fw-bold">{{$message}}</small>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="categoryDesc" class="form-label">Description</label>
                    <textarea name="categoryDesc" id="" cols="30" rows="10" class="form-control" placeholder="Enter Description...">{{$updateData->description}}</textarea>
                    @error('categoryDesc')
                      <small class="text-danger fw-bold">{{$message}}</small>
                  @enderror
                </div>
                <button type="submit" class="btn btn-success my-2 w-100">Update</button>
                <a href="{{ route('admin#category')}}" class="">
                    <button type="button" class="btn btn-primary w-100">Create</button>
                </a>
            </form>
        </div>
    </div>
</div>
<div class="col-8 mt-2">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Category List Page</h3>

        <div class="card-tools">
         <form action="{{route("admin#searchCategory")}}" method="POST">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="searchKey" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
         </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Category Name</th>

              <th>Description</th>

              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $cate)
            <tr>
                <td>{{$cate->category_id}}</td>
                <td>{{$cate->title}}</td>



                <td>{{$cate->description}}</td>
                <td>
                 <a href="{{ route('admin#editPage', $cate->category_id)}}">
                    <button class="btn btn-sm bg-dark text-white" ><i class="fas fa-edit"></i></button>
                 </a>
                 <a href="{{route("admin#deleteCategory", $cate->category_id)}}">
                    <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                 </a>
                </td>
              </tr>
            @endforeach


          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
