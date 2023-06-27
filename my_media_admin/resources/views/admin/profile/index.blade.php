@extends('admin.layouts.app')
@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">

        {{-- alert start --}}
        @if (Session::has('updateSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{Session::get('updateSuccess')}}</strong> You should check in on some of those fields below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
          </div>
        @endif


              <form class="form-horizontal" method="post" action="{{route('admin#update')}}">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="adminName" id="inputName" placeholder="Name" value="{{old('adminName'),$user->name}}">
                    @error('adminName')
                      <small class="text-danger fw-bold">{{$message}}</small>
                  @enderror
                  </div>

                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" name="adminEmail" placeholder="Email" value="{{old('adminEmail'),$user->email}}">
                    @error('adminEmail')
                      <small class="text-danger fw-bold">{{$message}}</small>
                  @enderror
                  </div>
                </div>


                <div class="form-group row">
                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputPhone" placeholder="Phone" name="adminPhone" value="{{$user->phone}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      {{-- <input type="text" class="form-control" id="inputAddress" placeholder="Address"> --}}
                      <textarea  id="" cols="30" rows="10" placeholder="Address" name="adminAddress" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputGender"  class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                      <select name="adminGender" id="" class="form-control">
                        @if ($user->gender == "male")
                        <option value="empty">Choose..</option>
                        <option value="male" selected>Male</option>
                        <option value="female">Female</option>
                        @elseif ($user->gender == "female")
                        <option value="empty">Choose..</option>
                        <option value="male">Male</option>
                        <option value="female" selected>Female</option>
                        @else
                        <option value="empty" selected>Choose..</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        @endif
                      </select>
                    </div>
                  </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
                  </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <a href="{{route('admin#changePasswordPage')}}">Change Password</a>
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
