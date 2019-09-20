@extends('layouts.admin-master')



@section('title')

Edit Profile

@endsection



@section('content')

<section class="section">

  <div class="section-header">

    <h1>Edit Profile</h1>

  </div>

  <div class="section-body">

    <div class="row">

      <div class="col-12 col-md-12 col-lg-12">

        <div class="card">

              <div class="card-body m-3">

                <form method="POST" action="{{url('profile/edit-profile')}}">
                    @csrf
                    @if(session()->has('info'))

		            <div class="alert alert-danger">

		                {{ session()->get('info') }}

		            </div>

		            @endif
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nama</label>
                            <input type="text" maxlength="100" class="form-control" required="" name="name" value="{{$detail->name}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Username</label>
                            <input type="text" maxlength="100" class="form-control" required="" name="username" value="{{$detail->username}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Footer</label>
                            <input type="text" maxlength="30" class="form-control" name="footer" value="{{$detail->footer}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" maxlength="250" required="" class="form-control" name="email" value="{{$detail->email}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">No. Telepon</label>
                            <input type="number" required="" class="form-control" name="mobile" value="{{$detail->mobile}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Alamat</label>
                            <input type="text" required="" class="form-control" name="address" maxlength="250" value="{{$detail->address}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Kota</label>
                            <input type="text" maxlength="100" class="form-control" name="city" value="{{$detail->city}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Provinsi</label>
                            <input type="text" maxlength="100" class="form-control" name="state" value="{{$detail->state}}">
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