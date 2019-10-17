
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
                      <label for="kdBooking" class="col-sm-3 ml-4 col-form-label" >Nomor. Tagihan</label> 
                      <div class="col-sm-8">    
                      <form method="POST" action="/pay_verify" name="frm_verify">
                          @csrf
                          @method('patch')      

                          <input type="text" name="kdBooking" id="kdBooking" class="form-control" value="{{ $CCredits->nomor_tagihan}}" placeholder="Ketikan nomor tagihan anda..." > 
                           <input type="submit" class="btn btn-danger mt-3" name="chkBooking" id="chkBooking" value="Check" >                    
                          </form>                                               
                      </div>                          
                  </div>
                  <form method="POST" action="/pay_verify" name="post_Verify">
                  @csrf      
                  <div class="form-group row">
                      <label for="trans_bank" class="col-sm-3 ml-4 col-form-label" >Transfer Bank</label> 
                      <div class="col-sm-8">
                          <input type="text" name="trans_bank" id="trans_bank" class="form-control" placeholder="Jenis Rekening" value="{{ $CCredits->nm_ATM}}" readonly >
                          <input type="hidden" name="Hid_kdBooking" id="Hid_kdBooking" value="{{ $CCredits->nomor_tagihan}}" > 
                      </div>                     
                  </div>

                  <div class="form-group row">
                     <input type="bts_Rpem" name="bts_Rpem" id="bts_Rpem" class="form-control bg-primary text-white " value="Rekening Pembeli" readonly >
                  </div>

                  <div class="form-group row">
                      <label for="rek_Buyer" class="col-sm-3 ml-4 col-form-label" >Nomor Rekening</label> 
                      <div class="col-sm-8">
                          <input type="text" name="rek_Buyer" id="rek_Buyer" class="form-control" placeholder="Nomor Rekening anda" >
                      </div>                     
                  </div>

                  <div class="form-group row">
                      <label for="rNm_Buyer" class="col-sm-3 ml-4 col-form-label" >Pemilik Rekening</label> 
                      <div class="col-sm-8">
                          <input type="text" name="rNm_Buyer" id="rNm_Buyer" class="form-control" placeholder="Nama Pemilik Rekening" >
                      </div>                     
                  </div>

                  <div class="form-group row">
                     <input type="bts_Rpen" name="bts_Rpen" id="bts_Rpen" class="form-control bg-danger text-white " value="Rekening Penjual" readonly >
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

                  <button type="submit" class="btn btn-info form-control" name="btn_post_Verify">Process</button>
               </form>                
              </div>
              

           </div> 
  			                                      
        </div>
  		
  	</div>
  </div>
</section>




@endsection
