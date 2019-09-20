@extends('layouts.admin-master')



@section('title')

Ubah Password

@endsection



@section('content')

<section class="section">

  <div class="section-header">

    <h1>Ubah Password</h1>

  </div>

  <div class="section-body">

    <div class="row">

      <div class="col-12 col-md-12 col-lg-12">

        <div class="card">

              <div class="card-body m-3">

                <form method="POST" action="{{url('profile/password')}}">
                    @csrf
                    @if(session()->has('info'))

		            <div class="alert alert-danger">

		                {{ session()->get('info') }}

		            </div>

		            @endif
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Password Lama</label>
                            <input type="password" maxlength="100" class="form-control" required="" name="old">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Password Baru</label>
                            <input type="password" maxlength="100" class="form-control" required="" name="new">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Konfirmasikan Password Baru</label>
                            <input type="password" maxlength="100" class="form-control" required="" name="again">
                        </div>

                    </div>
                    <div class="form-row">
	                    <div class="form-group col-md-3">
	                        <button type="submit" class="form-control btn btn-info">Simpan</button>
	                    </div>
	                    <div class="form-group col-md-3">
	                        <a href="{{route('admin.profile')}}" class="form-control btn btn-success">Kembali</a>
	                    </div>
	                </div>
                </form>

            </div>

        </div>

      </div>

    </div>

  </div>

</section>

@endsection