<!DOCTYPE html>
<html>
<head>
 <title>{{ $title }}</title>
</head>
<body>    
   
    <div class="container">
      <div class="col-sm-6">
          <h1>SMS Bersama</h1>
            <p style="font-size: 10px; font-family: sans-serif;"><b>PT. GRAHA MITRA TEGUH</b></p>      
            <p style="font-size: 10px; font-family: sans-serif;"><b>Jl. KH. Zainul Arifin. Ruko Ketapang Business Centre. Blok. A29-30</b></p>
          <hr>
      </div>
    </div>

  <div>    
  	<h1>INVOICE</h1>  
  	<h1 class="mt-3">Status : Belum Dibayar</h1>  	  	  	
  	 <h3 class="mt-5">No. Tagihan : {{$NoBill}}  </h3> 
     <p class="mt-3 ml-2">Pembelian : Pulsa {{ $Nominal}}</p> 
     <p class="mt-2 ml-2">No Telp   : {{ $NoTelp}}</p> 
     <p class="mt-2 ml-2">Transfer via   : {{ $NoATM}}</p>      
  </div>

  <div class="mt-8">
     <h3>Silahkan Transfer ke Rekening</h3>
     <p class="mt-2">Nomor Rekening : {{ $NoRek}}</p> 
     <p class="mt-2">Nama Pemilik   : {{ $NmRek}}</p> 
     <br>
     <br>  
     <p>*Note: Setelah Transfer segera verifikasi dari menu -> pay_verify </p>
  </div>

  <div class="mt-3">
  	<p>=======================================================</p>
  	<h3 class="ml-5">Thanks for your attention</h3>
  	<p>=======================================================</p>
  </div>
</body>
</body>
</html>