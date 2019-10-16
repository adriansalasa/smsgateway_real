
@extends('layouts.admin-master')

@section('title')
'Check Confirm'
@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<section class="section">
  <div class="section-header">
      <div class="col-sm-8">           
          <h1>Credit Confirmation</h1>
      </div>          
  </div>   

<!--   @if (session('status'))
      <div id="disappear" class="alert alert-success alert-dismissible">
        <button type="button" class="close">&times;</button>
         <strong>Harap Menunggu...!</strong> {{ session('status') }}
      </div>
  @endif   -->  
   
  <div class="section-body">
    <div class="row">
  		  <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header">
                <h4 align="left" class="text-info" style="font-family: verdana"><b>Transaction Form</b></h4>
                <hr>
             </div>
              
              
              <div class="card-body">                                  
                  <div class="form-group row">
                      <label for="kdBooking" class="col-sm-3 ml-4 col-form-label" >Kode Booking</label> 
                      <div class="col-sm-8">    
                      <form method="POST" action="/pay_verify">
                          @csrf
                          @method('patch')                             
                          <input type="text" name="kdBooking" id="kdBooking" class="form-control" value="{{ $CCredits->nomor_tagihan}}" > 
                           <input type="submit" class="btn btn-danger mt-3" name="chkBooking" id="chkBooking" value="Check" >                    
                          </form>                                               
                      </div>                          
                  </div>

                  <div class="form-group row">
                      <label for="trans_bank" class="col-sm-3 ml-4 col-form-label" >Transfer Bank</label> 
                      <div class="col-sm-8">
                          <input type="text" name="trans_bank" id="trans_bank" class="form-control" placeholder="Jenis Rekening" value="{{ $CCredits->nm_ATM}}" readonly >
                      </div>                     
                  </div>

                  <div class="form-group row">
                      <label for="rek_No" class="col-sm-3 ml-4 col-form-label" >Nomor Rekening</label> 
                      <div class="col-sm-8">
                          <input type="text" name="rek_No" id="rek_No" class="form-control" placeholder="Nomor Rekening anda" value="{{ $CCredits->noRek}}" readonly>
                      </div>                     
                  </div>

                  <div class="form-group row">
                      <label for="rek_Name" class="col-sm-3 ml-4 col-form-label" >Pemilik Rekening</label> 
                      <div class="col-sm-8">
                          <input type="text" name="rek_Name" id="rek_Name" class="form-control" placeholder="Nama Pemilik Rekening" value="{{ $CCredits->nmRek}}" readonly>
                      </div>                     
                  </div>
                               
              </div>
              

           </div> 
  			                                      
        </div>
  		
  	</div>
  </div>
</section>

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript"> 

  //Hilangkan tampilan message with status dlm 2 detik
  $(document).ready( function() {
    $('#disappear').delay(2000).fadeOut();
  });

  //Refresh jumlah saldo yang tersisa dlm 5 detik
  var auto_refresh = setInterval(
  function ()
  {
  $('.sCredit').load(location.href + " #divSaldo").fadeIn("slow");
  }, 3000); // refresh every 15000 milliseconds


</script>


@endsection
