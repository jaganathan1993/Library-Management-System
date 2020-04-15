@extends('layouts.loginlayout')

@section('title','Login')

@section('content')

<div class="card w-50" style="margin-top:10%">
  <div class="card-header">
      <h5 class="card-title">Library Management System</h5>
  </div>

  <div class="card-body">
    <div class="row">
      <div id="myTabContent" class="col-md-8" >

      <form  method="POST" action="/login" style="box-shadow: 2px 2px 2px 2px #888888;padding-left:15%" >
         {{ csrf_field() }}
        <br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Admin"  name="category" onclick="selectOnlyThis(this.id,'s1')" checked>
          <label class="form-check-label" for="inlineCheckbox1" >Admin</label>
        </div>
        <div class="form-check form-check-inline" style="padding-left:20px">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="User"  name="category" onclick="selectOnlyThis(this.id,'s2')">
          <label class="form-check-label" for="inlineCheckbox2">User</label>
        </div>
        <br>  <br><br>
        <div class="form-group">
          <label for="adminuserid">User ID<span style="color:red"> *</span></label>
          <input type="text" class="form-control inputfield" id="adminuserid" placeholder="" name="userid">
        </div>
        <div class="form-group">
          <label for="adminuserpw">Password<span style="color:red"> *</span></label>
          <input type="password" class="form-control inputfield" id="adminuserpw" placeholder=""  name="pw">
        </div><br>
        <div class="form-group">
          <input type="submit" class="btn btn-info  form-control">
        </div>

        <br>
        <p id="userRegist">New User? <a href="/userRegistration">Register here</a><p>
      </form>

  </div>
  <div class="col-md-4" style="margin-left: 2px solid gray" >
    <p id="s1"><i class="fas fa-user" style="padding-top:50%;font-size:130px;color:#17a2b8" ></i><b> &nbsp;Admin Login</b></p>
      <p id="s2"><i class="fas fa-users" style="padding-top:50%;font-size:130px;color:#17a2b8" ></i><b> &nbsp; &nbsp;  &nbsp;User Login</b></p>
  </div>
  <br>
  @if(isset($response))
        <div class="alert alert-danger"  role="alert">{{ $response }}</div>
  @endif

  @if(count($errors)>0)
    @foreach($errors->all() as $error)
      <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
  @endif
  @if(@session('response'))
         <p class="alert alert-danger">{{session('response')}}</p>
 @endif

</div>
  </div>
</div>

@endsection
