@extends('layouts.admin-master')

@section('title')
'Waiting Confirmation'
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1 class="text text-warning">Waiting for Admin Confirmation</h1>    
  </div>
		<?php                      
	        if(isset($_POST['noBill']))
	        {                     
	         $noBill = $_POST['noBill'];   
	         // echo  $noBill . '<br>';
	        }

	        if(isset($_POST['isiPaket']))
	        {                     
	         $isiPaket = $_POST['isiPaket'];   
	         // echo  $isiPaket . '<br>';
	        }

	        if(isset($_POST['credUser']))
	        {                     
	        $credUser= $_POST['credUser'];   
	        $credUser= str_replace('.', '', $credUser);
	        $credUser= round($credUser, 2);
	    	}

	        if(isset($_POST['isiHrg']))
	        {                     
	         $isiHrg = $_POST['isiHrg'];   
	         // echo  $isiHrg . '<br>';
	         $isiHrgDb = str_replace('.', '', $isiHrg);
			 $isiHrgDb = round($isiHrgDb, 2);
			 $credUser = $credUser + $isiHrgDb;
	        }

	        if(isset($_POST['isi_Tlp']))
	        {                     
	         $isi_Tlp = $_POST['isi_Tlp'];   
	         // echo  $isi_Tlp . '<br>';
	        }

	        if(isset($_POST['rVal']))
	        {
				$rVal = $_POST['rVal'];  					        	
	        }
        ?>
<div class="section-body">    
 	<form method="POST" action="{{ url('/topup')}}">
 	@csrf
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="progress"></div>
            <div class="card">
              <div class="mt-2">
                <h2 align="center" class=" text text-info" style="font-family: verdana"><b>INVOICE</b></h2><hr>
              </div>

              <div class="container-fluid">                 

	                <div class="row"> 
	                	<h1 class="text-danger ml-4"><b>BELUM DIBAYAR</b></h1>
	                </div>
				
					<div class="row">                      
	                      <label for="nmPaket" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">Paket</label>
	                      <label for="t_1" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">:</label>	                      
	                      <label for="isiPaket" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">{{ $isiPaket}}</label>   
	                       <input type="hidden" name="noBill" id="noBill" value="{{ $noBill}}">	                      
	                </div>

	                <div class="row"> 
	                    <label for="lblHrg" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">Harga</label>	                    
	                    <label for="t_2" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">:</label>
	                    <label for="isiHrg" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">{{ $isiHrg}}</label>	 
	                    <input type="hidden" name="isiHrgDb" id="isiHrgDb" value="{{ $isiHrgDb}}">
	                    <input type="hidden" name="credUser" id="credUser" value="{{ $credUser}}">
                	</div>

                	<div class="row"> 
	                    <label for="lbl_Tlp" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">No. Telp : </label>	                    
	                    <label for="isi_Tlp" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">{{ $isi_Tlp}}</label>
	                    <input type="hidden" name="isi_Tlp" id="isi_Tlp" value="{{ $isi_Tlp}}">  
                	</div>

                	<div class="row"> 
	                    <label for="lbl_Trek" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">Transfer Via : </label>	                    
	                    <label for="lbl_TATM" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">ATM {{ $rVal}}</label>	                    
                	</div>

                	<div class="row"> 
                			<B><label for=lblTrans class="text text-danger ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">Silahkan Transfer ke nomer Rekening dibawah ini !:</label></B>
                	</div>

                	<div class="row"> 
                		<div class="form-inline">
	                		<B><label for=lblTrans class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">No. Rekening : </label></B>
		                    <input class="form-control ml-4 mb-1" type="text" id="noRekv" name="noRekv" value="1729.372843.80000" size="20" style="text-indent: 5px" readonly>
		                </div>
                	</div>

                 	<div class="row"> 
                		<div class="form-inline">
	                		<B><label for=lblNama class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">Atas Nama</label></B>
	                		 <label for="t_3" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">:</label>
		                    <input class="form-control ml-4 mb-1" type="text" id="namaRek" name="namaRek" value="PT. Graha Mitra Teguh" size="20" style="text-indent: 5px" readonly>
		                </div>
                	</div>
                	<br>
                	<div class="row ml-3 mt-2 mb-2">  
                		<div class="ml-5">                 		          		
                			<div class="ml-5">                 		          		
		                		<!-- <button type="submit" class="btn btn-danger btn-lg ml-5 mr-2" name="btnBack" id="btnBack" >  BACK  </button>
 -->
 								<a href="{{ url('/topup')}}" class="btn btn-danger btn-lg ml-5 mr-2"> CANCEL</a> 
		                		<button type="submit" class="btn btn-primary btn-lg" name="btnProcess" id="btnProcess">  PROCESS  </button>
		                	</div>
                		</div>
                	</div>
	             

              </div>            	

           	</div>
        </div> 
    </div> 
	</form>
  </div>       

  </section>
  @endsection