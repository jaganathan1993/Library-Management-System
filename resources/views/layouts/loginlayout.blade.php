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
    <title>@yield('title')</title>
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
      body, html {
  height: 100%;
}
body {
 background-image: url("Images/bg1.jpg");
 background-color: #cccccc;
 height: 100%;

 /* Center and scale the image nicely */
 background-position: center;
 background-repeat: no-repeat;
 background-size: cover;
}

#myTabContent{
  padding-left:10%;
  font-size:12px;
}
.form-group{
  max-width:80%;
}
.inputfield {
  font-size: 12px;
}
.alert{
  margin-top:5%;
  margin-left:50px;
  width:80%;
  font-size:12px;
  font-weight: bold;
}
    </style>
  </head>
  <body>

    <div class="bd-example">
    <div class="container">
      @yield('content')
    </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">

        </script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
        document.getElementById('s1').style.display = 'block';
        document.getElementById('s2').style.display = 'none';
        document.getElementById('userRegist').style.display = 'none';
        function selectOnlyThis(id,ion) {
        for (var i = 1;i <= 2; i++)
        {
            document.getElementById("inlineCheckbox" + i).checked = false;
            document.getElementById("s" + i).style.display = 'none';
        }
        document.getElementById(id).checked = true;
        document.getElementById(ion).style.display = 'block';
        if(ion == 's1'){
          document.getElementById('userRegist').style.display = 'none';
        }else{
          document.getElementById('userRegist').style.display = 'block';
        }
        }

        function genderselect(id){
          for (var i = 1;i <= 2; i++)
          {
              document.getElementById("inlineCheckbox" + i).checked = false;
          }
          document.getElementById(id).checked = true;
        }
    </script>
    <script>
    $("#userImage").change(function() {
        $('#previewImage').show();
            readURL(this);
            $('#imageup').hide();
          });
          function readURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
            }
          }

      $(document).ready(function(){
        $('#emailview').blur(function(){
          var emailid=$('#emailview').val();
          $.ajax({
            url : "/checkAvailable",
            method : "POST",
            data:{emailID:emailid,"_token": "{{ csrf_token() }}"},
            success:function(result){
              if(result == 'Already Exists'){
                $('#emailview1').show();
                $('#emailview').css("border", "2px solid #dc3545");
                $('#useraddSubmit').prop('disabled', true);
              }else{
                $('#emailview1').hide();
                $('#emailview').css("border", "2px solid green");
                $('#useraddSubmit').prop('disabled', false);
              }

            }
          });
        });
      });
    </script>
      </body>
    </html>
