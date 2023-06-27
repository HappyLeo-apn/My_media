@extends('admin.layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend posts page</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Post Title</th>
              <th>Image</th>
              <th>View Count</th>
              <th></th>

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
                    <img src="{{asset('defaultImg/default-image.jpg')}}" width="200" height="120"  class="rounded" alt="">
                @else
                <img src="{{asset('postImage/'. $post->image)}}" alt="" class="w-25 rounded">
                @endif
                </td>
                <td><i class="fas fa-eye"></i> {{$post->post_count}}</td>
                <td>
                  <a href="{{route('admin#trendPostDetails', $post->post_id)}}" class="btn btn-sm bg-dark text-white"><i class="fas fa-info"></i></a>

                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
      {{-- <div class="d-flex justify-content-end mr-5">{{$posts->links()}}</div> --}}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
