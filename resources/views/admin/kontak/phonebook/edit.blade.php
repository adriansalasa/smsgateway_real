@extends('layouts.admin-master')

@section('title')
Manage Users
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Manage Phonebook</h1>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                   <h4> <i class ="fa fa-phone"></i> Tambah Phonebook</h4>
              </div>
              <div class="card-body m-3">
                    <form method="POST" action="/kontak/phonebook/{{ $phonebook->id }}">
                        @method('put')
                        @csrf

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Nomor Selular</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Input Nomor" value="{{ $phonebook->mobile }}">
                                <div class="invalid-feedback">
                                    @error('mobile') {{ $message}} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Nama Kontak</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Input Nama" value="{{ $phonebook->name }}">
                                <div class="invalid-feedback">
                                    @error('name') {{ $message}} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Input email" value="{{ $phonebook->email }}">
                                <div class="invalid-feedback">
                                    @error('email') {{ $message}} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Tags</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" placeholder="Input Tags" value="{{ $phonebook->tags }}">
                                <div class="invalid-feedback">
                                    @error('tags') {{ $message}} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Groups</label>
                                <div class="col-sm-9">
                                    <select class="form-control selectpicker" data-live-search="true" name="gpid">
                                        <option value="0">Pilih Group</option> 
                                        @foreach ($group as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option> 
                                        @endforeach
                                      </select>
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
