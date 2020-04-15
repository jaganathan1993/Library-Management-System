@extends('layouts.app')
@include('sweet::alert')

@section('title','Admin')

@section('content')


<br>
<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Dashboard</h5>
      </div>
      <div class="card-body">
        <div class="row">
        <div class="card text-center" style="width:30%;margin-left:2%;background-color:LightSeaGreen"><br>
          <p style="font-size:12px;">Total Books</p>
            <h2>{{count($booklist)}}</h2>

        </div>
        <div class="card text-center" style="width:30%;margin-left:2%;background-color:LightCoral"><br>
          <p style="font-size:12px;">Total Users</p>
          <h2>{{count($userlist)}}</h2>
        </div>
        <div class="card text-center" style="width:30%;margin-left:2%;background-color:#aec4ec"><br>
          <p style="font-size:12px;">Total Subscribe Books</p>
          <h2 id="SubsBookView"></h2>
        </div>
      </div>
      <br>
      <div class="row" style="background-color:rgba(122, 183, 249, 0.25);max-height:100%;border-radius:5%;">
        <div id="chartdiv"></div>
      </div>
    </div>
  </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title" style="float:left">Books Details</h5>
        <span><button type="button" class="btn fas fa-plus" style="float:right;background-color:SlateGrey;color:white;font-size:13px" data-toggle="modal" data-target="#exampleModal">
            Add
        </button></span>
        <span><button type="button" class="btn fas fa-upload" data-toggle="modal" data-target="#importBulkupload" style="padding-right:10px;float:right;background-color:#17a2b8;color:white;font-size:13px" >
            Upload
        </button></span>
      </div>
      <div class="card-body">
        @if(count($errors)>0)
          @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{$error}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endforeach
          @endif
        @if(@session('response'))
          @if(@session('response') == 'Inserted Successfully' || @session('response') == 'Deleted Successfully' || @session('response') == 'Updated Successfully' || @session('response') =='Successfully Uploaded')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
          @else
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
          @endif
          <strong>{{session('response')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <table id="dt" class="table table-striped table-bordered" style="font-size:12px;" >
          <thead>
            <tr>
          		<td>S.no</td>
              <td>Book ID</td>
          		<td>Book Name</td>
              <td>Category</td>
          		<td>Author</td>
          		<td>Price</td>
          		<td>Publisher</td>
              <td>Status</td>
              <td>Action</td>
          	</tr>
          </thead>
          <tbody>
            @foreach ($booklist as $indexVal => $a)
        	  <tr>
          		<td>{{ $indexVal+1 }}</td>
              <td data-toggle="modal" style="cursor:pointer;color:green;font-weight:bold" data-target="#viewBookdetails" data-cid="{{$a->id}}" >{{ $a->bookID }}</td>
          		<td data-toggle="modal" style="cursor:pointer;color:green" data-target="#viewBookdetails" data-cid="{{$a->id}}" >{{ $a->bname }}</td>
              <td>{{ $a->bCategory }}</td>
          		<td>{{ $a->author }}</td>
          		<td>{{ $a->price }}</td>
          		<td>{{ $a->publisher }}</td>
              <td>{{ $a->status }}</td>
               <td><i class="fas fa-pencil-alt"  style="font-size:15px;color:LightSeaGreen" data-toggle="modal" data-target="#updateBookdetails" data-cid="{{$a->id}}"  ></i>
                 <i class="fas fa-trash deleterow" style="font-size:15px;color:LightCoral;padding-left:15px"  data-toggle="modal" data-target="#deletecnfirmation" data-cid="{{$a->id}}" ></i>
               </td>
          	</tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="font-size:12px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="/BookStore"  enctype="multipart/form-data">

          <div class="row">
            {{ csrf_field() }}
            <div class="form-group" style="padding-left:10%">
              <label>Book ID<span style="color:red"> *</span><span style="color:#dc3545;display:none;padding-left:20px" id="bidview1">Book ID Already Exists</span></label>
              <input type="text" class="form-control" name="bookid" id="bid" style="max-width:90%;">
            </div>
            <div class="form-group">
              <label>Book Name<span style="color:red"> *</span></label>
              <input type="text" class="form-control" name="bname" style="max-width:90%;">
            </div>
            <div class="form-group">
              <label>Author Name<span style="color:red"> *</span></label>
              <input type="text" class="form-control" name="author" style="max-width:80%;">
            </div>

            <div class="col-md-7">

              <div style="color:#17a2b8;padding-left: 20%;"> <img style="font-size:230px;color:#17a2b8;min-width:300px;min-height:300px;" class="img-thumbnail" id="previewImage" src="Images/noimage.png" onclick="$('#bookImagefile').trigger('click');"></div>

            </div>

            <div class="col-md-5">
                <input type="file" id="bookImagefile" name="bookimg" style="display:none">

              <div class="form-group">
                  <label>Price<span style="color:red"> *</span></label>
                  <input type="text" class="form-control" name="price" style="max-width:70%;">
                </div>
                <div class="form-group">
                  <label>Publisher<span style="color:red"> *</span></label>
                  <input type="text" class="form-control" name="publisher" style="max-width:70%;">
                </div>
                <div class="form-group">
                  <label>Book Category<span style="color:red"> *</span></label>
                  <input type="text" class="form-control" name="category" style="max-width:70%;">
                </div>
                <div class="form-group">
                  <label>Description<span style="color:red"> *</span></label>
                  <textarea class="form-control" name="description"  style="max-width:70%;"></textarea>
                </div>
                <div class="form-group">
                  <label>Book Count<span style="color:red"> *</span></label>
                  <input type="number" id="bcount" class="form-control"  min='0' value="0" name="totalbooks" style="max-width:70%;">
                </div>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"  style="max-width:70%;">Close</button>
            <button type="submit"  class="btn btn-info"  style="max-width:70%;" id="booksubmit">Save</button>
          </div>
        </form>

        </div>
      </div>
    </div>
  </div>

  <div id="deletecnfirmation" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
      <form action="{{ route('admin.bookremove')}}" method="GET">
			<div class="modal-header">
				<div class="icon-box">
					<i class="fas fa-trash"  style="font-size:35px;color:LightCoral;"></i>
				</div>
			<span style="padding-left:5%;">	<h4 class="modal-title">Are you sure?</h4></span>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete these records? </p>
            {{ csrf_field() }}
          <input type="text" id="valuofid" name="removeid" style="display:none;">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
				<input type="submit" class="btn btn-danger"  value="Delete">
			</div>
      </form>
		</div>
	</div>
</div>

<div class="modal fade" id="updateBookdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="font-size:12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/BookChange"  enctype="multipart/form-data">

        <div class="row">
          {{ csrf_field() }}
          <div class="form-group" style="padding-left:10%">
            <label>Book ID<span style="color:red"> *</span></label>
            <input type="text" class="form-control" name="Updatebookid"  id="Updatebookid" style="max-width:90%;" readonly>
          </div>
          <div class="form-group">
            <label>Book Name<span style="color:red"> *</span></label>
            <input type="text" class="form-control" name="Updatebname"  id="Updatebname" style="max-width:90%;">
          </div>
          <div class="form-group">
            <label>Author Name<span style="color:red"> *</span></label>
            <input type="text" class="form-control" name="Updateauthor"  id="Updateauthor"style="max-width:80%;">
          </div>

          <div class="col-md-7">
            <!-- <i class="fas fa-book" id="bookimage" style="padding-top:10%;font-size:230px;color:#17a2b8;padding-left:30%;cursor: pointer;" onclick="$('#bookImagefile').trigger('click');" data-toggle="tooltip" data-placement="left" title="Click Here To Upload Your Photo"></i></b> -->
            <div style="color:#17a2b8;padding-left: 20%;"> <img style="font-size:230px;color:#17a2b8;min-width:300px;min-height:300px;" class="img-thumbnail" id="previewImageUpdate" onerror="this.src='Images/noimage.png'" onclick="$('#bookImagefileUpload').trigger('click');"></div>
          </div>

          <div class="col-md-5">
              <input type="file" id="bookImagefileUpload" name="bookImagefileUpload" style="display:none">

            <div class="form-group">
                <label>Price<span style="color:red"> *</span></label>
                <input type="text" class="form-control" name="Updateprice"  id="Updateprice" style="max-width:70%;">
              </div>
              <div class="form-group">
                <label>Publisher<span style="color:red"> *</span></label>
                <input type="text" class="form-control" name="Updatepublisher"  id="Updatepublisher" style="max-width:70%;">
              </div>
              <div class="form-group">
                <label>Book Category<span style="color:red"> *</span></label>
                <input type="text" class="form-control" name="Updatecategory"  id="Updatecategory" style="max-width:70%;">
              </div>
              <div class="form-group">
                <label>Description<span style="color:red"> *</span></label>
                <textarea class="form-control" name="Updatedescription"  id="Updatedescription" style="max-width:70%;"></textarea>
              </div>
              <div class="form-group">
                <label>Book Count<span style="color:red"> *</span></label>
                <input type="number"  class="form-control"  min='0' value="0" name="Updatebcount" id="Updatebcount" style="max-width:70%;">
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"  style="max-width:70%;">Close</button>
          <button type="submit"  class="btn btn-info"  style="max-width:70%;">Update</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="viewBookdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="font-size:12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 id="Viewbookid" style="text-align:center;color:#17a2b8"></h5><br>
        <div class="row">

          <div class="col-md-6">

             <div style="color:#17a2b8;padding-left: 20%;"><img class="card-img smallimg"
              id="previewImageView" onerror="this.src='/Images/noimage.png'" alt="Card image cap" style="font-size:230px;color:#17a2b8;min-width:300px;min-height:300px;" class="img-thumbnail">
            </div>
         </div>
         <div class="col-md-6">
           <div class="card">
          <ul class="list-group list-group-flush" style="font-size:12px;">
            <b style="background-color:#17a2b8;color:white;padding-left:5%;">Author:</b><li class="list-group-item" id="Viewauthor"></li>
          </ul><br>
          <ul class="list-group list-group-flush" style="font-size:12px;">
            <b style="background-color:#17a2b8;color:white;padding-left:5%;">Publisher:</b><li class="list-group-item" id="Viewpublisher"></li>
          </ul><br>
          <ul class="list-group list-group-flush" style="font-size:12px;">
             <b style="background-color:#17a2b8;color:white;padding-left:5%;">Category:</b><li class="list-group-item" id="Viewcategory"></li>
           </ul><br>
           <ul class="list-group list-group-flush" style="font-size:12px;">
              <b style="background-color:#17a2b8;color:white;padding-left:5%;">Description:</b><li class="list-group-item" id="Viewdescription"></li>
            </ul>

        </div>
        </div>
      </div><br>
     <h4 style="color:green;"><b>Subscribers</b><span style="font-size:25px;color:black;padding-left:2%;font-weight:bold" id="totalsub"></span></h4><br>
      <div id="userdetails"></div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal"  style="max-width:70%;">Close</button>
    </div>

      </div>
    </div>
  </div>




<div id="importBulkupload" class="modal fade">
<div class="modal-dialog modal-confirm">
  <div class="modal-content">
    <form action="{{ route('import')}}" method="POST" enctype="multipart/form-data">
    <div class="modal-header">
      <div class="icon-box">
        <i class="fas fa-upload"  style="font-size:35px;color:LightCoral;"></i>
      </div>
    <span style="padding-left:5%;">	<h4 class="modal-title">Upload Books Details</h4></span>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
    <a href="Bookcsv.csv">Sample CSV File</a>
          {{ csrf_field() }}
         <input type="file" name="file" class="form-control">

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
      <input type="submit" class="btn btn-danger"  value="Update">
    </div>
    </form>
  </div>
</div>
</div>


@endsection
