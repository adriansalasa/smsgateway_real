@extends('layouts.admin-master')



@section('title')

Manage Group

@endsection



@section('content')

<section class="section">

  <div class="section-header">

    <h1>Manage Group</h1>

  </div>

  <div class="section-body">

    <div class="row">

      <div class="col-12 col-md-6 col-lg-6">

        <div class="card">

            <div class="card-header">

                   <h4> <i class ="fa fa-pencil-alt"></i> Tambah Group</h4>

              </div>

              <div class="card-body m-3">

                    <form method="POST" action="{{url('kontak/group')}}">

                        @csrf



                        <div class="form-group row">

                            <label for="inputPassword" class="col-sm-3 col-form-label">Nama</label>

                            <div class="col-sm-9">

                                <input type="text" class="form-control" name="name" placeholder="Input Nama Group" value="" required="">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="inputPassword" class="col-sm-3 col-form-label">Kode</label>

                            <div class="col-sm-9">

                                <input type="text" class="form-control" name="code" placeholder="Input Kode" value="" required="">

                            </div>

                        </div>

        

                        <button type="submit" class="form-control btn btn-info">Simpan</button>

                        </form>

            </div>

        </div>

      </div>

    </div>

  </div>

</section>

@endsection

