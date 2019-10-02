<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
 <style>
      /*green button*/
    /* .button
     {
      background-color: rgb(50,205,50); 
      border: none;
      border-radius: 4px;
     }
     .button:hover {background-color: #3e8e41}    */

      /*orange button*/
     /*.button2
     {
      background-color: rgb(255,128,0); 
      border: none;
      border-radius: 4px;
     }
     .button2:hover {background-color: rgb(128,128,0);}   */
      
      /*maroon button*/
     /*.button3
     {
      background-color: maroon; 
      border: none;
      border-radius: 4px;
     }
     .button3:hover {background-color: rgb(165,42,42);}   */

</style>
</head>
<body>


@extends('layouts.admin-master')

@section('title')
'Top Up'
@endsection

@section('content')
<section class="section">
  <div class="section-header">
      <div class="col-sm-8">           
          <h1>Top UP Kredit</h1><img class="img-fluid ml-3" src="{{ asset('assets/img/money/money.svg') }}" alt="logo" width="40" height="30">	        
      </div>
    
      <div class="ml-3 col-sm-4">
          <h1 class="text text-success">Saldo Kredit Anda :
              <label for="saldo" >
                {{number_format($user_get->credit,2,",",".") }}                
                <!-- {{ $user_get->credit }}-->                
              </label>
          </h1>
      </div>

  </div>     
   
  <div class="section-body">
    <div class="row">
  		  <div class="col-12 col-md-12 col-lg-12">
  			   <div class="progress"></div>
        		<div class="card">
        		  <div class="mt-2">
  						    <h2 align="center" class="text-info" style="font-family: verdana"><b>PAKET SESUAI KEBUTUHAN ANDA</b>                          
                  </h2><hr>   

                  @if (session('status'))
                      <div class="alert alert-warning">
                          {{ session('status') }}
                      </div>
                  @endif  
  					  </div>
  					<br>

  					<div class="container">                 
                <div class="row">       

                    <div class="col-sm-4">
                    	<div class="card ml-4">
                      		<div class="card-header bg-info text-white">
                      			<!-- <h3 class="ml-5" style="text-indent: 12px"> REGULAR</h3>                 -->
                            <h3 > REGULAR</h3>                
                      		</div>

                          <form method="POST" action="{{ url('/topup/payment')}}">
                                @csrf
                                <input type="hidden" name="credUser" id="credUser" value="{{ $user_get->credit}}">
                                <input type="hidden" name="mobileUser" id="mobileUser" value="{{ $user_get->mobile}}">

                            	<!-- 	<button type="submit" style="width: 302px;  height: 340px; color:#3c8dbc; " class="button"  name="btnReg" value="Regular"> -->                                
                                <div class="card card-body border border-info">
                                  			<!-- <h3 class="card-title text text-info">250Rb /Month<hr></h3> -->
                                        <h3 class="card-title text text-info">Rp 250.000 /bulan<hr></h3>
                                        <input type="hidden" name="P_reg" id="P_reg" value="250000">
                            
                                  			<div class="card-text text-info" style="font-size: 20px; font-variant-caps: titling-case;">
                                          
                                      			  Dashboard akses<br><br>
                                    	        500 SMS<br><br>
                                    	        Nomor GSM Acak<br><br>
                                    	        SMS satu arah<br><br>
                                              <br><br>
                                          
                                			  </div>

                                          <button type="submit" class="btn btn-danger btn-md"  name="btnReg" value="Regular">
                                              Beli Paket
                                          </button>
                            		<!-- </button>                  -->                  
                              </div>                              
                            </form>                            
  	                   </div>
  	                 </div>

                    <div class="col-sm-4">
                        <div class="card ml-4">
                          <div class="card-header bg-warning text-white">
                              <h3 > PREMIUM </h3>
                          </div>

                          <form method="POST" action="{{ url('/topup/payment')}}">
                                @csrf
                                <input type="hidden" name="credUser" id="credUser" value="{{ $user_get->credit}}">
                                <input type="hidden" name="mobileUser" id="mobileUser" value="{{ $user_get->mobile}}">

                               <!-- <button type="submit" style="width: 302px; height: 340px; color:white; font-size:25px; " href="http://localhost/smsgateway/topup/payment" class="button2" name="btnPrem" value="Premium"> -->
                                <div class="card card-body border border-warning">
                              			<h3 class="card-title text text-warning">Rp 500.000 /bulan<hr></h3>
                                    <input type="hidden" name="P_prem" id="P_prem" value="500000">

                              			<div class="card-text text-warning" style="font-size: 20px; font-variant-caps: titling-case;">
                                        Dashboard akses<br><br>
                                        1200 SMS<br><br>
                                        Nomor GSM Acak<br><br>
                                        SMS semi 2 arah<br><br>
                                        SMS akses API Client<br><br>
                            			  </div> 			
                                    
                                      <button type="submit" class="btn btn-danger btn-md"  name="btnPrem" value="Premium">
                                          Beli Paket
                                      </button>
                                </div>                                   
                          		  <!-- </button>                      -->           
                           </form>
                        </div> 
                    </div>

                    <div class="col-sm-4">
                        <div class="card ml-4">
                            <div class="card-header bg-danger text-white">
                                <h3> PLATINUM</h3>
                            </div>
            
                            <form method="POST" action="{{ url('/topup/payment')}}">
                                  @csrf
                                  <input type="hidden" name="credUser" id="credUser" value="{{ $user_get->credit}}">
                                  <input type="hidden" name="mobileUser" id="mobileUser" value="{{ $user_get->mobile}}">

                                  <!-- <button type="submit" style="width: 302px; height: 340px; color:#3c8dbc; font-size:25px;" href="http://localhost/smsgateway/topup/payment" class="button3" name="btnPlat" value="Platinum"> -->

                                    <div class="card card-body border border-danger">

                                			<h3 class="card-title text-danger">Rp 1.000.000 /Bulan<hr></h3>
                                      <input type="hidden" name="P_plat" id="P_plat" value="1000000">

                                			<div class="card-text text-danger" style="font-size: 20px; font-variant-caps: titling-case;">
                              			      Dashboard akses<br><br>
                                          2500 SMS<br><br>
                                          Nomor GSM Fixed<br><br>
                                          SMS 2 arah<br><br>
                                          Akses API Client<br><br>
                              			  </div> 	
                                        
                                        <button type="submit" class="btn btn-danger btn-md"  name="btnPlat" value="Platinum">
                                            Beli Paket
                                        </button>
                                    </div>		
                                 <!-- </button> -->
                            </form>  
                        </div> 
                    </div>

               </div>                                                
            </div>
          </div>                                   
        </div>    
  		
  	</div>
  </div>
</section>

@endsection
</body>
</html>