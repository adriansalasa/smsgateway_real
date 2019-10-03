@extends('layouts.admin-master')

@section('title')
'Payment'
@endsection

@section('content')
<script type="text/javascript">

  //function ValidateForm(form){
    var radios = document.getElementsByName('tnbk');         
    var ErrorText="";
    
    //   if ( ( form.gender[0].checked == false ) && ( form.gender[1].checked == false ) )
    // if (radios[i].checked == false)
    // {
    //     alert ( "Please choose your Bank account..." );
    //     return false;
    //     ErrorText="1";
    // }          
    //}
function getRadioVal(){
    for (var i = 0, length = radios.length; i < length; i++)
    {
       if (radios[i].checked)
       {  
          radioval = radios[i].value;                    
          break;
       }
    }        
         document.frmPayment.rVal.value = radioval;         
  }

</script>

<section class="section">
  <div class="section-header">
    <h1>Payment</h1>    

 
<!--  @if($sisaKredit=="")
    kosong om
 @else
  isi om
  {{ $sisaKredit }}
 @endif -->
 <!-- {{ $sisaKredit}} -->
  </div>
      

                <?php                      
                    $credUser = 0;                                              
                
                    if(isset($_POST['credUser']))
                    {                     
                     $credUser = $_POST['credUser'];   
                     // echo  $credUser . '<br>';
                    }

                    if(isset($_POST['mobileUser']))
                    {
                      $mobileUser= $_POST['mobileUser'];   
                     // echo  $mobileUser . '<br>';
                    }

                    if(isset($_POST['P_reg']))
                    {
                      $harga= $_POST['P_reg'];   
                      $harga= number_format($harga,2,",",".");
                      // echo  $harga . '<br>';
                      $Nama= $_POST['btnReg'];
                      // echo $Nama . '<br>';
                    }    

                    if(isset($_POST['P_prem']))
                    {
                      $harga= $_POST['P_prem'];
                      $harga= number_format($harga,2,",",".");  
                      // echo  $harga . '<br>';
                      $Nama= $_POST['btnPrem'];
                      // echo $Nama . '<br>';
                    }

                    if(isset($_POST['P_plat']))
                    {
                      $harga= $_POST['P_plat'];
                      $harga= number_format($harga,2,",",".");  
                      // echo  $harga . '<br>';
                      $Nama= $_POST['btnPlat'];
                      // echo $Nama . '<br>';
                    }    
                                    
                ?>
 
  <div class="section-body">
    <form name="frmPayment" id="frmPayment" method="post" action="{{ url('/topup/confirm')}}">      
      @csrf
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="progress"></div>
            <div class="card">
              <div class="mt-2">
                <h2 align="center" class="text-primary" style="font-family: verdana"><b>Pembelian Paket</b></h2><hr>
              </div>
            <br>

            <div class="container-fluid">                 
                <div class="row">                      
                      <label for="nmPaket" class="ml-3" style="font-family: lucida console; text-align: left; padding: 5px;">Paket</label>
                      <label for="t_1" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">:</label>                      
                      <label for="isiPaket" class="ml-3" style="font-family: lucida console; text-align: left; padding: 5px;">{{ $Nama}}</label> 
                      <input type="hidden" name="isiPaket" id="isiPaket" value="{{ $Nama}}">                        
                      <input type="hidden" name="noBill" id="noBill" value="{{$sisaKredit}}">
                      <input type="hidden" name="credUser" id="credUser" value="{{$credUser}}">                   
                </div>

                <div class="row"> 
                    <label for="lblHrg" class="ml-3" style="font-family: lucida console; text-align: left; padding: 5px;">Harga</label>                    
                    <label for="t_2" class="ml-4" style="font-family: lucida console; text-align: left; padding: 5px;">:</label>
                    <label for="isiHrg" class="ml-3" style="font-family: lucida console; text-align: left; padding: 5px;">{{ $harga}}</label>
                    <input type="hidden" name="isiHrg" id="isiHrg" value="{{ $harga}}">  
                </div>

                 <div class="row"> 
                    <label for="lbl_Tlp" class="ml-3" style="font-family: lucida console; text-align: left; padding: 5px;">No. Telp : </label>                    
                    <label for="isi_Tlp" class="ml-3" style="font-family: lucida console; text-align: left; padding: 5px;">{{ $mobileUser}}</label>
                    <input type="hidden" name="isi_Tlp" id="isi_Tlp" value="{{ $mobileUser}}">  
                </div>
                <br>                
                <div class="row">
                  <h4 class="ml-5"><b>Pilih Rekening Pembayaran</b></h4>   
                </div>

                 <div class="row mt-2">
                      <div class="custom-control custom-radio custom-control-inline ml-5">
                            <input type="radio" class="custom-control-input" name="tnbk" id="bnk1" value="MANDIRI" checked="true">
                            <label class="custom-control-label" for="bnk1" >
                              ATM Mandiri
                            </label>      

                          <p class="ml-5" style="display: inline-block;"><img src="{{ asset('assets/img/bank/logomandiri.svg') }}" height="30" alt="TOPUP" rel="icon" /></p>
                      </div>                          
                </div>

                <div class="row mt-2">
                      <div class="custom-control custom-radio custom-control-inline ml-5">
                            <input type="radio" class="custom-control-input" name="tnbk" id="bnk2" value="BCA">
                            <label class="custom-control-label" for="bnk2">
                              ATM BCA
                            </label>      
                          <p class="ml-5" style="display: inline-block;"><img src="{{ asset('assets/img/bank/logobca.png') }}" height="30" alt="TOPUP" rel="icon" /></p>
                      </div> 
                </div>

                <div class="row mt-2">
                      <div class="custom-control custom-radio custom-control-inline ml-5">
                            <input type="radio" class="custom-control-input" name="tnbk" id="bnk3" value="HSBC">
                            <label class="custom-control-label" for="bnk3">
                              ATM HSBC
                            </label>      
                          <p class="ml-5" style="display: inline-block;"><img src="{{ asset('assets/img/bank/logohsbc.png') }}" height="30" alt="TOPUP" rel="icon" /></p>
                      </div> 
                </div>
                <br>
                <input type="hidden" name="rVal" id="rVal" value="">
                <div class="ml-4">
                  <a href="{{ url('/topup')}}" class="btn btn-primary btn-lg ml-4 mb-2"> BACK</a>    
                  <!-- <button class="btn btn-danger btn-lg mb-2 ml-2" onclick="ValidateForm(this.form)">BELI</button> -->    
                  
                  <button type="submit"  class="btn btn-danger btn-lg mb-2 ml-2" onclick="getRadioVal()">BELI</button>
                </div>

            </div>
          </div>           
        </div>
    </div>
    </form>
  </div>

            
    </section>
@endsection