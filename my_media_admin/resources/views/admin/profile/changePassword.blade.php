@extends('admin.layouts.app')
@section('content')
<div class="col-12 offset-2 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body ">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">

        {{-- alert start --}}
        @if (Session::has('lengthError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{Session::get('lengthError')}}</strong>
            <button type="button" class="bg-danger " data-bs-dismiss="alert" > X</button>
          </div>
        @endif
        @if (Session::has('fail'))
        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
            <strong>{{Session::get('fail')}}</strong>
            <button type="button" class="bg-danger rounded shadow-sm" data-bs-dismiss="alert" >X</button>
          </div>
        @endif

              <form class="form-horizontal" method="post" action="{{route('admin#passwordChange')}}">
                @csrf
                <div class="form-group row">
                  <label for="inputOldPassword" class="col-sm-2 col-form-label">Old Password:</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control w-50" name="oldPassword" id="inputOldPassword" placeholder="Enter your old password" >
                    @error('oldPassword')
                      <small class="text-danger fw-bold">{{$message}}</small>
                  @enderror
                  </div>

                </div>
                <div class="form-group row">
                  <label for="inputNewPassword" class="col-sm-2 col-form-label">New Password:</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control w-50" id="inputEmail" name="newPassword" placeholder="New Password">
                    @error('newPassword')
                      <small class="text-danger fw-bold">{{$message}}</small>
                  @enderror
                  </div>
                </div>

                <div class="form-group row">
                    <label for="inputConfirmPassword" class="col-sm-2 col-form-label">Confirm Password:</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control w-50" id="inputEmail" name="confirmPassword" placeholder="Confirm Password">
                      @error('confirmPassword')
                        <small class="text-danger fw-bold">{{$message}}</small>
                    @enderror
                    </div>
                  </div>




                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
                  </div>
                </div>

              </form>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
