@extends('layouts.admin-master')



@section('title')

Template

@endsection



@section('content')

<section class="section">

  <div class="section-header">

    <h1>Manage Template</h1>

  </div>

  <div class="section-body">

    <div class="row">

      <div class="col-12 col-md-12 col-lg-12">

        <div class="card">

            <div class="card-header">

                   <h4> <i class ="fa fa-pencil-alt"></i> Edit Template</h4>

              </div>

              <div class="card-body m-3">

                <form method="POST" action="{{ route('admin.update-template') }}">

                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    	<div class="form-group">

                            <input type="text" name="judul" maxlength="100" required="" class="form-control" value="{{$detail->t_title}}" placeholder="Tulis Judul">

                        </div>

                        <div class="form-group">

                            <textarea style="height: 150px;" required="" name="pesan" class="form-control" placeholder="Tulis Pesan">{{$detail->t_text}}</textarea>

                        </div>
                        	
                    	<div class="col-md-4">

                            <button type="submit" class="form-control btn btn-info mb-1">Simpan</button>

                            <a href="{{route('admin.template')}}" class="form-control btn btn-success">Kembali</a>

                        </div>

	            </form>

            </div>

        </div>

      </div>

    </div>

  </div>

</section>

@endsection