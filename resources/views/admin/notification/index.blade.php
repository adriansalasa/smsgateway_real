@extends('layouts.admin-master')



@section('title')

'notification'

@endsection


@section('content')


<section class="section">
 
  <div class="section-header">

    <h1>Notification</h1>  
             
  </div>

  @if (session('success'))
        <div id="disappear" class="alert alert-success alert-dismissible mt-2">
          <button type="button" class="close">&times;</button>
          <strong>Selamat...! </strong>{{ session('success') }}
        </div>
    @endif   

     @if (session('reject'))
        <div id="disappear" class="alert alert-danger alert-dismissible mt-2">
          <button type="button" class="close">&times;</button>
          <strong>Maaf...! </strong> {{ session('reject') }}
        </div>
    @endif 

  <div class="section-body">

    <div class="row">
   
      <div class="col-12 col-md-12 col-lg-12">

          <div class="progress"></div>

        <div class="card">

            <form name="search" action="{{ url()->current() }}">

            <div class="card-header">

               <!--  <a href="{{ route('admin.compose') }}" class="btn btn-sm btn-info mr-2"><i class="fa fa-check-circle"></i> Confirm </a> -->

               <button type="button" class="btn btn-sm btn-info mr-2" id="multiConfirm"><i class="fa fa-check-circle"></i> Confirm</button>

                <button type="button" class="btn btn-sm btn-danger mr-2" id="bulk_delete_contact"><i class="fa fa-trash"></i> Reject</button>

                

                <h4></h4>

                <div class="card-header-form">

                    <div class="input-group">

                      <div class="float-left ml-2">

                      </div>

                      <input type="text" class="form-control" placeholder="Search" id="keyword" name="keyword">

                      <div class="input-group-btn">

                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>

                        

                        <div class="float-right ml-2">

                            <select class="form-control-sm" style=" width:80px" name="total" id="total" onchange="getval(this);"> 

                                <option value="20">20</option>

                                <option value="50">50</option>

                                <option value="100">100</option>

                                <option value="250">250</option>

                                <option value="500">500</option>

                              </select>

                          </div>

                      </div>

                    </div>

                  </form>

                </div>

              </div>

               <div class="card-body p-0 ml-2 mr-2">

                <div class="table-responsive">

                  <table class="table table-striped">

                    <tr>

                      <th class="p-0 text-center" style="width:5%">

                        <div class="custom-checkbox custom-control">

                          <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">

                          <label for="checkbox-all" class="custom-control-label">&nbsp;</label>

                        </div>

                      </th>

                      <th style="width:10%">Nomor</th>

                      <th>Pesan</th>

                      <th  style="width:20%">Tanggal</th>

                      <th colspan="2" style="width:10%" class="text-center">Action</th>

                    </tr>

                    @foreach ($notifdb as $notif)                    
                    <tr>

                      <td class="p-0 text-center">

                        <div class="custom-checkbox custom-control">

                          <input type="hidden" value='{{ $notif->idTagihan }}'>
                          
                          {{-- <input type="checkbox" data-checkboxes="mygroup" class="data-check custom-control-input" name='uid[]' value='{{$notif->idTagihan}}' id="checkbox-1"> --}}

                          <input type="checkbox" data-checkboxes="mygroup" class="data-check custom-control-input" id="checkbox-{{ $loop->iteration }}" value='{{$notif->idTagihan}}'>

                        <label for="checkbox-{{ $loop->iteration }}" class="custom-control-label">&nbsp;</label>

                          {{-- <input type='checkbox' class='data-check' name='uid[]' value='{{$notif->idTagihan}}'> --}}

                        </div>

                      </td>
                      
                      <td> {{$notif->noTelp}} </td> 
                      <input type="hidden" name="noTelp" value="{{$notif->noTelp}}">                     

                      <td class="align-middle">
                          <a class="text-danger" href="{{url('notification/view/'.$notif->idTagihan)}}">Request Pengisian Paket {{$notif->nominal}}...</a>
                      </td>

                      <td>

                          <!-- {{Carbon\Carbon::parse($notif->createDt)->addHour('7')}} -->
                          {{($notif->createDt)}}

                      </td>
                      
                       <td >                           
                          <form action="{{url('notification/'.$notif->idTagihan)}}" method="POST">
                            @csrf                             
                            <button type="submit" class="btn btn-link text-success" title="Confirm"><i class="fa fa-thumbs-up fa-2x"></i></button>
                          </form>                        
                       </td>
                      

                       <td >                         
                          <form class="delete" action="{{url('notification/'.$notif->idTagihan)}}" method="POST">
                            @method('put')
                            @csrf

                       <!--  <a href="{{url('notification/update/'.$notif->idTagihan)}}" class="text-success" title="Confirm"><i class="fa fa-check-circle mr-2" ></i></a>  
                        -->                      
                            <button type="submit" class="btn btn-link text-danger" title="Reject" onclick="return confirm('Apakah Anda yakin akan Reject paket ini...?')"><i class="fa fa-ban fa-2x"></i></button>
                          </form>                        
                       </td>                                                                  
                     
                    </tr>                  
                    @endforeach

                  </table>

              	</div>

               </div>

                </div>

</section>

@endsection



@section('scripts')  
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

        //Ketika Enter 

        var input = document.getElementById("keyword");

        input.addEventListener("keyup", function(event) {

            if (event.keyCode === 13) {

                event.preventDefault();

                document.search.submit();

            }

        });


          function getval(sel)

        {

            document.search.submit();

        }
         

      // Fungsi Check all checkbox 

        $("#checkbox-all").click(function(){            
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

        });


      // Fungsi Delete 1 atau lebih notifikasi

          $("#bulk_delete_contact").click(function() {

          var list_id = [];

    

          $(".data-check:checked").each(function() {

            list_id.push(this.value);

          });

    

          if(list_id.length > 0)

          {

              if(confirm('Are you sure delete this '+list_id.length+' data?'))

              {
                
                var csrf = $('meta[name="csrf-token"]').attr('content');

                $.ajax({

                  xhr: function () {

                  var xhr = new window.XMLHttpRequest();

                  xhr.upload.addEventListener("progress", function (evt) {

                      if (evt.lengthComputable) {

                          var percentComplete = evt.loaded / evt.total;

                          console.log(percentComplete);

                          $('.progress').css({

                              width: percentComplete * 100 + '%'

                          });

                          if (percentComplete === 1) {

                              $('.progress').addClass('hide');

                          }

                      }

                  }, false);

                  xhr.addEventListener("progress", function (evt) {

                      if (evt.lengthComputable) {

                          var percentComplete = evt.loaded / evt.total;                          
                          console.log(percentComplete);

                          $('.progress').css({

                              width: percentComplete * 100 + '%'

                          });

                      }

                  }, false);

                  return xhr;

                  },

                url:"{{ route('admin.notifdeletes') }}",
                // url:"{{ '/admin/notifdeletes' }}",

                method:'POST',

                data:{id:list_id, _token:csrf},                

                success:function(data) 

                {
                   
                  // alert(data);               
                  // swal(data);
                  swal ( "Oops" ,(data),  "error" );
                  window.location = "{{ route('admin.notification') }}";                  

                }
                

                });


              }

          }

          else

          {

              alert('no data selected ');

          }


        });           


      // Fungsi Confirm 1 atau lebih notifikasi

          $("#multiConfirm").click(function() {

          var list_id = [];                    


          $(".data-check:checked").each(function() {

            list_id.push(this.value);                                   

          });

    

          if(list_id.length > 0)

          {

              if(confirm('Are you sure want to confirm this '+list_id.length+' data?'))

              {                
                var csrf = $('meta[name="csrf-token"]').attr('content');
               
                $.ajax({

                  xhr: function () {

                  var xhr = new window.XMLHttpRequest();               

                  xhr.upload.addEventListener("progress", function (evt) {                    

                      if (evt.lengthComputable) {                        

                          var percentComplete = evt.loaded / evt.total;                                                    
                          console.log(percentComplete);

                          $('.progress').css({

                              width: percentComplete * 100 + '%'

                          });

                          if (percentComplete === 1) {                            

                              $('.progress').addClass('hide');

                          }

                      }

                  }, false);

                  xhr.addEventListener("progress", function (evt) {
                        
                      if (evt.lengthComputable) {

                          var percentComplete = evt.loaded / evt.total;

                          console.log(percentComplete);

                          $('.progress').css({

                              width: percentComplete * 100 + '%'

                          });

                      }

                  }, false);

                  return xhr;

                  },

                url:"{{ route('admin.multiconfirms') }}",

                method:'POST',

                data:{id:list_id, _token:csrf},

                success:function(data)

                {                  

                  // swal(data);
                  swal({
                  title: "Paket Confirm",
                  text: (data),
                  icon: "success" });
                  window.location = "{{ route('admin.notification') }}";

                }

         
                });


              }

          }

          else

          {

              alert('no data selected ');

          }

        });
            
           
</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript"> 
  $(document).ready( function() {
    $('#disappear').delay(3000).fadeOut();
  });

  //Refresh jumlah saldo yang tersisa dlm 5 detik
  var auto_refresh = setInterval(
  function ()
  {
    $('.sNotifD').load(location.href + " #divNotifD");
  }, 5000); // refresh every 15000 milliseconds

</script>
 

@endsection         
