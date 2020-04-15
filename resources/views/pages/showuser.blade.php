@extends('layouts.userLayout')
@include('sweet::alert')

@section('title','User')

@section('content')

<br>
<!-- {{$userlist->id}} -->
@if(@session('response'))
  @if(@session('response') == 'Subscribed Successfully' || @session('response') == 'Rejected Successfully')
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

@php($j=0)
  @foreach($bookscroll as $val)
    @if($loop->index % 2 == 0)

    <div class="row" style="background-color:#e6e6e6">
      <div id="multi-item-example{{$loop->index}}" class="carousel slide carousel-multi-item " data-ride="carousel" data-pause="hover" style="background-color:#e6e6e6">
    @else
      <div class="row" style="background-color:#cfe2e2">
      <div id="multi-item-example{{$loop->index}}" class="carousel slide carousel-multi-item " data-ride="carousel" data-pause="hover" style="background-color:#cfe2e2">
    @endif


  <div class="controls-top">

    <a class="btn-floating" href="#multi-item-example{{$loop->index}}" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
    <span style="font-weight:bold;padding-left:40%;font-size:20px;position:absolute;">{{ $val['category'] }}</span>
    <a class="btn-floating" href="#multi-item-example{{$loop->index}}" data-slide="next"><i class="fas fa-chevron-right" style="padding-left: 98%;position:absolute"></i></a>
  </div><br>
  <div class="carousel-inner" role="listbox">

      @php($count=0)
      @foreach(array_chunk($val['dataset'],4) as  $fourRecord)

        @if($count == 0)
          <div class="carousel-item active">
            @foreach($fourRecord as $b)

                <div class="col-md-3" style="float:left;font-size:12px;">
                 <div class="card" style="min-height:200px;">
                   <div  data-toggle="modal" data-target="#getBookDetails" style="cursor:pointer" data-cid="{{ $b->id }}">
                   <div class="row">
                   <div class="col-md-6" >
                    <img class="card-img smallimg"
                      src="/Images/Book/{{ $b->bImage }}" class="rounded mx-auto d-block" onerror="this.src='/Images/noimage.png'" alt="Card image cap" style="padding-top:10%">
                    </div>
                     <div class="col-md-6">
                       <h6 class="card-title">{{ $b->bname }}</h6>
                       <p class="card-text"><span class="fas fa-pencil-alt" style="padding-right:2%;color:#18a7bd"></span>{{ Str::limit($b->author, 50) }}</p>
                        <p class="card-text"><span class="fas fa-money-bill-alt" style="padding-right:2%;color:#18a7bd"></span>{{ number_format($b->price,2) }}</p>
                        <p class="card-text"><span class="fas fa-book-open"style="padding-right:2%;color:#18a7bd"></span>{{ Str::limit($b->publisher, 50) }}</p>
                    </div>
                  </div>
                </div>
                @if($b->subt == 0)
                  <a href="{{route('subscribeReq',['userid'=>$userlist['id'],'Bookid'=>$b->id])}}" class="btn btn-info form-control" style="position: absolute;bottom:   0;">Subscribe</a>
                  @else
                    <a href="{{route('subscribeReqDelete',['userid'=>$userlist['id'],'Bookid'=>$b->id])}}" class="btn btn-danger form-control" style="position: absolute;bottom:0;">Reject</a>
                @endif
                </div>
                </div>

            @endforeach
          </div>
        @else
          <div class="carousel-item">
            @foreach($fourRecord as $b)

            <div class="col-md-3" style="float:left;font-size:12px;">
             <div class="card" style="min-height:200px;">
               <div  data-toggle="modal" data-target="#getBookDetails" style="cursor:pointer" data-cid="{{ $b->id }}">
               <div class="row">
               <div class="col-md-6" >
                <img class="card-img smallimg"
                  src="/Images/Book/{{ $b->bImage }}" class="rounded mx-auto d-block" onerror="this.src='/Images/noimage.png'" alt="Card image cap" style="padding-top:10%">
                </div>
                 <div class="col-md-6">
                   <h6 class="card-title">{{ $b->bname }}</h6>
                   <p class="card-text"><span class="fas fa-pencil-alt" style="padding-right:2%;color:#18a7bd"></span>{{ Str::limit($b->author, 50) }}</p>
                    <p class="card-text"><span class="fas fa-money-bill-alt" style="padding-right:2%;color:#18a7bd"></span>{{ number_format($b->price,2) }}</p>
                    <p class="card-text"><span class="fas fa-book-open"style="padding-right:2%;color:#18a7bd"></span>{{ Str::limit($b->publisher, 50) }}</p>
                </div>
              </div>
            </div>
            @if($b->subt == 0)
              <a href="{{route('subscribeReq',['userid'=>$userlist['id'],'Bookid'=>$b->id])}}" class="btn btn-info form-control" style="position: absolute;bottom:   0;">Subscribe</a>
              @else
                <a href="{{route('subscribeReqDelete',['userid'=>$userlist['id'],'Bookid'=>$b->id])}}" class="btn btn-danger form-control" style="position: absolute;bottom:0;">Reject</a>
            @endif
            </div>
            </div>
            @endforeach
          </div>
        @endif

        @php($count++)
      @endforeach
  </div>
</div>
<br>
</div>
<br>
    @php($j++)
 @endforeach
 <div class="modal fade" id="getBookDetails">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">

         <!-- Modal Header -->
         <div class="modal-header">
           <h5 class="modal-title">Book Details</h5>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>

         <!-- Modal body -->
         <div class="modal-body">
           <h5 id="id" style="text-align:center;color:#17a2b8"></h5><br>
           <div class="row">

             <div class="col-md-6">

               <img class="card-img smallimg"
                 id="previewimage" onerror="this.src='/Images/noimage.png'" alt="Card image cap" style="padding-top:10%">
            </div>
            <div class="col-md-6">
              <div class="card">
             <ul class="list-group list-group-flush" style="font-size:12px;">
               <b style="background-color:#17a2b8;color:white;padding-left:5%;">Author:</b><li class="list-group-item" id="author"></li>
             </ul><br>
             <ul class="list-group list-group-flush" style="font-size:12px;">
               <b style="background-color:#17a2b8;color:white;padding-left:5%;">Publisher:</b><li class="list-group-item" id="publisher"></li>
             </ul><br>
             <ul class="list-group list-group-flush" style="font-size:12px;">
                <b style="background-color:#17a2b8;color:white;padding-left:5%;">Category:</b><li class="list-group-item" id="category"></li>
              </ul><br>
              <ul class="list-group list-group-flush" style="font-size:12px;">
                 <b style="background-color:#17a2b8;color:white;padding-left:5%;">Description:</b><li class="list-group-item" id="description"></li>
               </ul>

           </div>
           </div>
         </div>
         </div>

         <!-- Modal footer -->
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>

       </div>
     </div>
   </div>

<!--/.Carousel Wrapper-->

@endsection
