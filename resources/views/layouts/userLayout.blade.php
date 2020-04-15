<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
    <link rel=”stylesheet” href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel = "stylesheet" type = "text/css" href = "../../css/Carousel.css" />
    <title>Jagan - @yield('title')</title>
    <style>
      #cardicon{
        margin-right: auto;
        margin-left: auto;
        margin-top:20%;
        font-size: 2.73em;
        color:#FFD700;
      }
      #cardicon1{
        float:right;
        font-size: 1.73em;
        color:#FFD700;
      }
      .page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #17a2b8;
    border: 2px solid #17a2b8f;
    }
  .dt-bootstrap4{
      font-size: 12px;
  }
  .form-group{
    max-width:80%;
  }
  .inputfield {
    font-size: 12px;
  }


  .highcharts-figure, .highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

.highcharts-figure, .highcharts-data-table table {
    min-width: 415px;
    max-width: 1200px;
    margin: 1em auto;
    padding-top: 9px;
    position: absolute;
}

    </style>
  </head>
  <body>


    <nav class="navbar navbar-light" style="background-color:#17a2b8">
      <a class="navbar-brand" style="color:white">Library Management System </a>
      <span style="font-size:12px;color:white">{{Session::get('user')['mailid']}}
        <a href="{{ route('full.logout') }}" class="fas fa-power-off" style="font-size:25px;padding-left:30%;text-decoration:none;color:white"></a>
      </span>
  </nav>
  <div class="container-fluid">
      @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
    </script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script src="../../js/Carousel.js"></script>
<script>
$(document).ready(function(){
  $('#getBookDetails').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget);
    var id=button.data('cid');
    var modal=$(this);
    var data= {
      "_token": "{{ csrf_token() }}",
      "idBook": id
    };
    console.log(data);
    $.ajax({
        url : "{{ route('admin.viewbook') }}",
        method : "GET",
        data:data,
        dataType: 'JSON',
        success:function(res){
          console.log(res);
          modal.find('.modal-body #id').html(res[0].bookID+' - '+res[0].bname);
           modal.find('.modal-body #bookname').html(res[0].bname);
           modal.find('.modal-body #author').html(res[0].author);
           modal.find('.modal-body #price').html(res[0].price);
           modal.find('.modal-body #description').html(res[0].description);
           modal.find('.modal-body #publisher').html(res[0].publisher);
           modal.find('.modal-body #category').html(res[0].bCategory);
           modal.find('.modal-body #previewimage').attr('src',"Images/Book/"+res[0].bImage);
          // modal.find('.modal-body #Updatebcount').val(res[0].bcount);

        }
      });

  //  modal.find('.modal-body #valuofid').val(id);
  });
});

</script>
  </body>
</html>
