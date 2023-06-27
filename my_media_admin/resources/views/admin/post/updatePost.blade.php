@extends('admin.layouts.app')
@section('content')
    <div class="col-4 mt-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin#updatePost', $updatePostData->post_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Post title:</label>
                        <input type="text" name="postTitle" value="{{$updatePostData->title}}" id="" class="form-control"
                            placeholder="Enter post title..">
                        @error('postTitle')
                            <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Description</label>
                        <textarea name="postDesc" id="" cols="30" rows="10" class="form-control"
                            placeholder="Enter Description...">{{ $updatePostData->description }}</textarea>
                        @error('postDesc')
                            <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label d-block">Image</label>

                        @if ($updatePostData->image == null)
                                        <img src="{{asset('defaultImg/default-image.jpg')}}" width="190" height="110"  class="rounded" alt="">
                                    @else
                                    <img src="{{asset('postImage/'. $updatePostData->image)}}" alt="" class="w-50 rounded">
                                    @endif
                                     <input type="file" class="form-control" name="postImage">
                        @error('postImage')
                            <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Description</label>
                        <select name="postCategory" class="form-control" id="">
                            <option value="">Choose..</option>
                            @foreach ($category as $cate)
                                <option value="{{ $cate->category_id }}"
                                 @if ($cate->category_id == $updatePostData->category_id)
                                    selected
                                @endif>{{ $cate->title }}</option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark w-100">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8 mt-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">NewsFeed</h3>

                <div class="card-tools">
                    <form action="{{ route('admin#searchCategory') }}" method="POST">
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
                            <th>Post ID</th>
                            <th>Post Title</th>
                            <th>Image</th>
                            <th>Description</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->post_id}}</td>
                                <td>{{$post->title}}</td>
                                <td>
                                    @if ($post->image == null)
                                        <img src="{{asset('defaultImg/default-image.jpg')}}" width="190" height="110"  class="rounded" alt="">
                                    @else
                                    <img src="{{asset('postImage/'. $post->image)}}" alt="" class="w-50 rounded">
                                    @endif
                                </td>


                                <td>{{$post->description}}</td>
                                <td>
                                    <a href="{{ route('admin#postUpdatePage', $post->post_id)}}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#deletePost', $post->post_id)}}">
                                        <button class="btn btn-sm bg-danger text-white"><i
                                                class="fas fa-trash-alt"></i></button>
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
