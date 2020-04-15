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


#chartdiv {
  width: 100%;
  height: 500px;
}
Style Attribute {
    user-select: none;
    font-size: 13px;
}
body {
    margin: 0;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: 11px;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    background-color: #fff;
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

    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

    <script>

    $(document).ready(function(){
      $('#deletecnfirmation').on('show.bs.modal',function(event){
        var button=$(event.relatedTarget);
        var id=button.data('cid');
        var modal=$(this);
        modal.find('.modal-body #valuofid').val(id);
      });
    });



    $(document).ready(function() {
      $('#dt').DataTable({
      "pageLength": 5
      });
    } );

</script>
<script>
$("#bookImagefile").change(function() {
  readURLim(this);
});
function readURLim(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#previewImage').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#bookImagefileUpload").change(function() {
  readURL(this);
});
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#previewImageUpdate').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
<script>
$(document).ready(function(){
  $('#updateBookdetails').on('show.bs.modal',function(event){
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
          modal.find('.modal-body #Updatebookid').val(res[0].bookID);
          modal.find('.modal-body #Updatebname').val(res[0].bname);
          modal.find('.modal-body #Updateauthor').val(res[0].author);
          modal.find('.modal-body #Updateprice').val(res[0].price);
          modal.find('.modal-body #Updatedescription').val(res[0].description);
          modal.find('.modal-body #Updatepublisher').val(res[0].publisher);
          modal.find('.modal-body #Updatecategory').val(res[0].bCategory);
          modal.find('.modal-body #previewImageUpdate').attr('src',"Images/Book/"+res[0].bImage);
          modal.find('.modal-body #Updatebcount').val(res[0].bcount);
        }
      });
  });
});

</script>

<script>
$(document).ready(function(){
  $('#bid').blur(function(){
    var bid=$('#bid').val();
    $.ajax({
      url : "/checkAvailableBook",
      method : "POST",
      data:{bookid:bid,"_token": "{{ csrf_token() }}"},
      success:function(result){
        if(result == 'Already Exists'){
          $('#bidview1').show();
          $('#bid').css("border", "2px solid #dc3545");
           $('#booksubmit').prop('disabled', true);
        }else{
          $('#bidview1').hide();
          $('#bid').css("border", "2px solid green");
           $('#booksubmit').prop('disabled', false);
        }

      }
    });
  });
});

</script>
<script>
$(document).ready(function(){
    $('#SubsBookView').html('0');
    $.ajax({
        url : "{{ route('admin.SubscribeChart') }}",
        method : "GET",
        dataType: 'JSON',
        success:function(res){

          var catdata1=JSON.stringify(res.catList);
          var sum=0;
          for(var i=0;i< res.catList.length;i++){
            sum += parseInt(res.catList[i].y);
          }
          $('#SubsBookView').html(sum);
          am4core.ready(function() {
          // Themes begin
          am4core.useTheme(am4themes_animated);
          // Themes end
          var chart = am4core.create("chartdiv", am4charts.PieChart);
          chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

          chart.data = res.catList;
          chart.radius = am4core.percent(80);
          chart.innerRadius = am4core.percent(50);
          var title = chart.titles.create();
          title.text = "Subscribe Details";
          title.fontSize = 15;
          title.marginBottom = 30;

          chart.startAngle = 180;
          chart.endAngle = 360;

          var series = chart.series.push(new am4charts.PieSeries());
          series.dataFields.value = "y";
          series.dataFields.category = "name";
          series.slices.template.cornerRadius = 10;
          series.slices.template.innerCornerRadius = 7;
          series.slices.template.draggable = true;
          series.slices.template.fontSize = 10;
          series.slices.template.inert = true;
          series.alignLabels = false;


          series.hiddenState.properties.startAngle = 90;
          series.hiddenState.properties.endAngle = 90;

          chart.legend = new am4charts.Legend();

          });
        }
      });

});

</script>
<script>
$(document).ready(function(){
  $('#viewBookdetails').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget);
    var id=button.data('cid');
    var modal=$(this);
    var data= {
      "_token": "{{ csrf_token() }}",
      "idBook": id
    };

    $.ajax({
        url : "{{ route('admin.viewbook') }}",
        method : "GET",
        data:data,
        dataType: 'JSON',
        success:function(res){
          modal.find('.modal-body #Viewbookid').html(res[0].bookID+' - '+res[0].bname);
          modal.find('.modal-body #Viewauthor').html(res[0].author);
          modal.find('.modal-body #Viewprice').html(res[0].price);
          modal.find('.modal-body #Viewdescription').html(res[0].description);
          modal.find('.modal-body #Viewpublisher').html(res[0].publisher);
          modal.find('.modal-body #Viewcategory').html(res[0].bCategory);
          modal.find('.modal-body #previewImageView').attr('src',"Images/Book/"+res[0].bImage);
          modal.find('.modal-body #Viewbcount').html(res[0].bcount);

        }
      });
      $.ajax({
          url : "{{ route('admin.getsublist') }}",
          method : "GET",
          data:data,
          dataType: 'JSON',
          success:function(res){

            console.log(res);
            var out='';
            modal.find('.modal-body  #totalsub').html('('+res.length+')');
           for(var i=0;i<res.length;i++){

                out+= '<div class="col-md-3" style="background-color:white;float:left"><div class="card"  style="width: 10rem;"><div class="card-body"><div class="card-title"><b>'+res[i].name+'</b></div><div class="card-text">'+res[i].phone+'</div><div class="card-text">'+res[i].emailID+'</div></div></div></div>';
            }
            modal.find('.modal-body  #userdetails').html(out);

          }
        });

  //  modal.find('.modal-body #valuofid').val(id);
  });
});

</script>
  </body>
</html>
