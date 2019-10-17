
@extends('layouts.admin-master')

@section('title')
'Confirmation'
@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<section class="section">
  <div class="section-header">
      <div class="col-sm-8">           
          <h1>Credit Confirmation</h1>
      </div>          
  </div>   

  @if (session('status'))
      <div id="disappear" class="alert alert-success alert-dismissible">
        <button type="button" class="close">&times;</button>
         <strong>Pembayaran Berhasil di Verifikasi...!</strong> {{ session('status') }}
      </div>
  @endif    
   
  <div class="section-body">
    <div class="row">
  		  <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header">
                <h4 align="left" class="text-info" style="font-family: verdana"><b>Transaction Form</b></h4>
              <!--   <img class="img-fluid ml-3" src="{{ asset('assets/img/money/money_ico.png') }}" alt="logo" width="80" height="50"> -->
                <hr>
             </div>

         <!--    <div class="container">                 
              <div class="row">   --> 
             
              <div class="card-body">
               <!--  <form method="POST" action="/pay_verify">
                  @csrf  -->
                  
                  <div class="form-group row">
                      <label for="kdBooking" class="col-sm-3 ml-4 col-form-label" >Nomor Tagihan</label> 
                      <div class="col-sm-8">                                 
                        <form method="POST" action="/pay_verify">
                          @csrf
                          @method('patch')
                          <input type="text" name="kdBooking" id="kdBooking" class="form-control @error('kdBooking') is-invalid @enderror" placeholder="Ketikan nomor tagihan anda...">
                          @error('kdBooking')<div class="invalid-feedback">{{ 'Kode Booking tidak boleh kosong..!'}}</div>@enderror

                          <input type="submit" class="btn btn-danger mt-3" name="chkBooking" id="chkBooking" value="Check" >                    
                        </form>    
                      </div>                          
                  </div>

                  <div class="form-group row">
                      <label for="trans_bank" class="col-sm-3 ml-4 col-form-label" >Transfer Bank</label> 
                      <div class="col-sm-8">
                          <input type="text" name="trans_bank" id="trans_bank" class="form-control" placeholder="Jenis Rekening" disabled>
                      </div>                     
                  </div>

                  <div class="form-group row">
                     <input type="bts_Rpem" name="bts_Rpem" id="bts_Rpem" class="form-control bg-primary text-white " value="Rekening Pembeli" disabled >
                  </div>
                  
                  <div class="form-group row">
                      <label for="rek_Buyer" class="col-sm-3 ml-4 col-form-label" >Nomor Rekening</label> 
                      <div class="col-sm-8">
                          <input type="text" name="rek_Buyer" id="rek_Buyer" class="form-control" placeholder="Nomor Rekening anda" disabled>
                      </div>                     
                  </div>

                  <div class="form-group row">
                      <label for="rNm_Buyer" class="col-sm-3 ml-4 col-form-label" >Pemilik Rekening</label> 
                      <div class="col-sm-8">
                          <input type="text" name="rNm_Buyer" id="rNm_Buyer" class="form-control" placeholder="Nama Pemilik Rekening" disabled>
                      </div>                     
                  </div>

                  <div class="form-group row">
                     <input type="bts_Rpen" name="bts_Rpen" id="bts_Rpen" class="form-control bg-danger text-white " value="Rekening Penjual" disabled >
                  </div>

                  <div class="form-group row">
                      <label for="rek_No" class="col-sm-3 ml-4 col-form-label" >Nomor Rekening</label> 
                      <div class="col-sm-8">
                          <input type="number" name="rek_No" id="rek_No" class="form-control" placeholder="Nomor Rekening anda" disabled>
                      </div>                     
                  </div>

                  <div class="form-group row">
                      <label for="rek_Name" class="col-sm-3 ml-4 col-form-label" >Pemilik Rekening</label> 
                      <div class="col-sm-8">
                          <input type="text" name="rek_Name" id="rek_Name" class="form-control" placeholder="Nama Pemilik Rekening" disabled>
                      </div>                     
                  </div>

                

                <!--   <div class="form-inline">
                      <label for="trans_bank" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">Transfer Bank</label>                     
                      <input type="text" name="trans_bank" id="trans_bank" class="form-control form-control-sm mb-2 mt-2 ml-4">
                  </div>

                  <div class="form-inline">
                      <label for="rek_No" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">Nomor Rekening</label>                   
                      <input type="text" name="rek_No" id="rek_No" class="form-control form-control-sm mb-2 mt-2 ml-3">
                  </div>

                  <div class="form-inline">
                      <label for="rek_Name" class="ml-4 mr-2" style="font-family: lucida console; text-align: left; padding: 5px;">Nama Pemilik</label>
                      <input type="text" name="rek_Name" id="rek_Name" class="form-control form-control-sm mb-2 mt-2 ml-4">
                  </div> -->
            <!--     <button type="submit" class="form-control btn btn-info">Process</button>
                </form> -->
               
              </div>
              
          <!--     </div>
            </div> -->



           </div> 
  			                                      
        </div>
  		
  	</div>
  </div>
</section>

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript"> 
  $(document).ready( function() {
    $('#disappear').delay(3000).fadeOut();
  });
</script>

@endsection
