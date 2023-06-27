@extends('admin.layouts.app')
@section('content')
<div class="col-5 offset-4">
    <div class="card mt-5 p-4">
        <i class="fas fa-arrow-left" onclick="history.back()"></i>
      <div class="card-body">
        @if ($detailedPost->image == null)
                    <img src="{{asset('defaultImg/default-image.jpg')}}"  class="rounded w-100" alt="">
                @else
                <img src="{{asset('postImage/'. $detailedPost->image)}}" alt="" class="w-100 rounded">
                @endif
          <h3 class="text-center"> {{$detailedPost->title}}</h3>
        <p class="text-start">
            {{$detailedPost->description}}
        </p>
      </div>

    </div>
    <!-- /.card -->
</div>
@endsection
