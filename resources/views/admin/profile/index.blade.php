@extends('layouts.admin-master')



@section('title')

Profile

@endsection



@section('content')

<section class="section">

  <div class="section-header">

    <h1>Profile</h1>

  </div>

  <div class="section-body">

    <div class="row">

      <div class="col-12 col-md-12 col-lg-12">

          <div class="progress"></div>

        <div class="card">

            <div class="card-header">

                <a href="{{route('admin.edit-profile')}}" class="btn btn-sm btn-success mr-2">Edit Profile</a>
                <a href="{{route('admin.password')}}" class="btn btn-sm btn-success mr-2">Ubah Password</a>

              </div>

              <div class="card-body p-0 ml-2 mr-2">
                <div class="table-responsive">

                  <table class="table table-striped">

                    <tr>
                      <th>Nama</th>
                      <td>:</td>
                      <td>{{$data->name}}</td>
                    </tr>

                    <tr>
                      <th>Username</th>
                      <td>:</td>
                      <td>{{$data->username}}</td>
                    </tr>

                    <tr>
                      <th>Footer</th>
                      <td>:</td>
                      <td>{{$data->footer}}</td>
                    </tr>

                    <tr>
                      <th>Email</th>
                      <td>:</td>
                      <td>{{$data->email}}</td>
                    </tr>

                    <tr>
                      <th>No. Telepon</th>
                      <td>:</td>
                      <td>{{$data->mobile}}</td>
                    </tr>

                    <tr>
                      <th>Alamat</th>
                      <td>:</td>
                      <td>{{$data->address}}</td>
                    </tr>

                    <tr>
                      <th>Kota</th>
                      <td>:</td>
                      <td>{{$data->city}}</td>
                    </tr>

                    <tr>
                      <th>Provinsi</th>
                      <td>:</td>
                      <td>{{$data->state}}</td>
                    </tr>

                  </table>

                </div>

              </div>

            </div>

        </div>

      </div>

    </div>

  </div>

</section>

@endsection