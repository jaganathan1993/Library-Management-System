@extends('layouts.loginlayout')

@section('title','User Registraion')

@section('content')

@if(@session('response'))
<div class="card w-50" style="margin-top:10%">
  <div class="card-header">
      <h5 class="card-title">Library Management System</h5>
  </div>

  <div class="card-body">
  <div class="alert alert-success">{{session('response')}}</div><br>
  <h4 style="text-align:center;"> **** User ID is your registered Email ID ****</h4><br><br>

  <h4  style="text-align:center;"><a href="/">click Here To Login</a></h4>
</div>
</div>
@else
<div class="card w-80" style="margin-top:2%">
  <div class="card-header">
      <h5 class="card-title">Library Management System</h5>
  </div>

  <div class="card-body">
    <div class="row">
      <div class="col-md-4"  >
        <i class="fas fa-user" id="imageup" style="padding-top:50%;font-size:230px;color:#17a2b8;padding-left:30%;cursor: pointer;" onclick="$('#userImage').trigger('click');" data-toggle="tooltip" data-placement="left" title="Click Here To Upload Your Photo"></i></b>
        <div style="padding-top:30%;color:#17a2b8;padding-left:30%;"> <img  style="font-size:230px;color:#17a2b8;min-width:300px;min-height:300px;display:none;" class="img-thumbnail" id="previewImage"></div>
      </div>

  <div id="myTabContent" class="col-md-8" >

      <form  method="POST" action="/userRegStore" style="box-shadow: 2px 2px 2px 2px #888888;padding-left:15%"  enctype="multipart/form-data">
         {{ csrf_field() }}
        <br>
        <input type="file" id="userImage" name="userimg" style="display:none">

        <div class="form-group">
          <label for="adminusername">Name:<span style="color:red"> *</span></label>
          <input type="text" class="form-control inputfield" id="adminusername" placeholder="" name="username">
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Male"  name="gender" onclick="genderselect(this.id)" checked>
          <label class="form-check-label" for="inlineCheckbox1" >Male</label>
        </div>
        <div class="form-check form-check-inline" style="padding-left:20px">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Female"  name="gender" onclick="genderselect(this.id)">
          <label class="form-check-label" for="inlineCheckbox2">Female</label>
        </div>
        <br>
        <br>
        <div class="form-group">
          <label for="dobuser">DOB:<span style="color:red"> *</span></label>
          <input type="date" class="form-control inputfield" id="dobuser" placeholder=""  name="dob">
        </div>
        <div class="form-group">
           <label for="phno">Phone Number:<span style="color:red"> *</span></label>
           <input type="text" class="form-control inputfield" id="phno" placeholder="" maxlength="10" name="phone"></td>
        </div>
        <div class="form-group">
          <label for="address">Address:<span style="color:red"> *</span></label>
          <textarea class="form-control inputfield" id="address" placeholder=""  name="address"></textarea>
        </div>
        <div class="form-group">
          <table>
            <tr><td>  <label for="proffuser" >ID Proff:<span style="color:red" > *</span></label> </td>
                <td>  <label for="proffuser1">ID Proff Attachment:<span style="color:red"> *</span></label> </td>
            </tr>
            <tr>
              <td>   <input type="text" class="form-control inputfield" id="proffuser" placeholder=""  name="proffid" style="max-width:250px;"> </td>
              <td>   <input type="file" class="form-control inputfield" id="proffuser1" placeholder=""  name="attachment" style="max-width:250px;"> </td>
            </tr>
          </table>
        </div>
        <div class="form-group">
          <table>
            <tr>
                <td>  <label for="emailview">Email ID:<span style="color:red"> *</span><span style="color:#dc3545;display:none;padding-left:80px" id="emailview1">Email Already Exists</span></label> </td>
                <td>  <label for="userpassword">Password:<span style="color:red"> *</span></label> </td>
            </tr>
            <tr>

              <td>
                   <input type="email" class="form-control inputfield" id="emailview" placeholder=""  name="emailvalue" style="min-width:250px">

              </td>
                <td>   <input type="password" class="form-control inputfield" id="userpassword" placeholder="" name="userpassword"></td>
            </tr>
          </table>
        </div>
        <br>
        <div class="form-group">
          <input type="submit" value='Register' id="useraddSubmit" class="btn btn-info  form-control" style="width:50%;float:right">
            <input type="reset" class="btn btn-danger  form-control" style="width:50%;">
        </div>
        <br>
        <br>

      </form>

  </div>

  <br>
</div>
  </div>
</div>
@endif
@endsection
