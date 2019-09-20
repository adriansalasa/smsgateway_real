@extends('layouts.admin-master')

@section('title')
Outbox
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Inbox</h1>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
          <div class="progress"></div>
        <div class="card">
            <form name="search" action="{{ url()->current() }}">
            <div class="card-header">
                <a href="{{ route('admin.compose') }}" class="btn btn-sm btn-info mr-2"><i class="fa fa-pencil-alt"></i> Tulis Pesan</a>
                <button type="button" class="btn btn-sm btn-danger mr-2" id="bulk_delete_contact"><i class="fa fa-trash"></i> Delete</button>
                
                <h4></h4>
                <div class="card-header-form">
                    <div class="input-group">
                      <div class="float-left ml-2">
                      </div>
                      <input type="text" class="form-control" placeholder="Search" id="keyword" name="keyword">
                      <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        
                        <div class="float-right ml-2">
                            <select class="form-control-sm" style=" width:80px" name="total" id="total" onchange="getval(this);"> 
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                              </select>
                          </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="card-body p-0 ml-2 mr-2">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th class="p-0 text-center" style="width:5%">
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                        </div>
                      </th>
                      <th style="width:10%">Nomor</th>
                      <th>Pesan</th>
                      <th  style="width:20%">Tanggal</th>
                      <th  style="width:15%">Status</th>
                      <th style="width:10%">Action</th>
                    </tr>
                    @foreach ($Outboxs as $item)
                    <tr>
                      <td class="p-0 text-center">
                        <div class="custom-checkbox custom-control">
                          {{-- <input type="checkbox" data-checkboxes="mygroup" class="data-check custom-control-input" name='uid[]' value='{{$item->id}}' id="checkbox-1"> --}}
                          <input type="checkbox" data-checkboxes="mygroup" class="data-check custom-control-input" id="checkbox-{{ $loop->iteration }}" value='{{$item->id}}'>
                        <label for="checkbox-{{ $loop->iteration }}" class="custom-control-label">&nbsp;</label>
                          {{-- <input type='checkbox' class='data-check' name='uid[]' value='{{$item->id}}'> --}}
                        </div>
                      </td>
                      <td><a href="#">{{$item->p_dst}}</a></td>
                      <td class="align-middle">
                          {{$item->p_msg}}
                      </td>
                      <td>
                          {{Carbon\Carbon::parse($item->p_datetime)->addHour('7')}}
                      </td>
                      <td>
                          @if($item->p_status == 0)
                            <div class="badge badge-info">Mengirim</div>
                          @elseif($item->p_status == 1)
                            <div class="badge badge-warning">Pending <i class="fa fa-check"></i></div>
                          @elseif($item->p_status == 2)
                            <a href="/pesan/outbox/{{ $item->id }}/resend" class="badge badge-danger" title="Resend">Gagal <i class="fa fa-retweet" ></i></a>
                          @else
				<div class="badge badge-success">Terkirim <i class="fa fa-check"></i></div>
			@endif
                      </td>
                      <td>
                        <form class="delete" action="/pesan/outbox/{{ $item->id }}" method="POST" class="d-inline">
                          @method('delete')
                          @csrf
                          <button type="submit" class="btn btn-link text-danger" title="Hapus" onclick="return confirm('Apakah Anda akan menghapus?')"><i class="fa fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </table>
                  <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        {{ $Outboxs->links() }}
                    </nav>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
      @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
      @endif
    </div>
  </div>
</section>
@endsection


@section('scripts')  
<script>
        //Ketika Enter 
        var input = document.getElementById("keyword");
        input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.search.submit();
            }
        });
    
        function getval(sel)
        {
            document.search.submit();
        }
        $("#keyword").val("{{$request->keyword}}");
    
        $("#total option[value={{$request->total}}]").attr('selected', 'selected');
  
        $("#checkbox-all").click(function(){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        });
    
        $("#bulk_delete_contact").click(function() {
          var list_id = [];
    
          $(".data-check:checked").each(function() {
            list_id.push(this.value);
          });
    
          if(list_id.length > 0)
          {
              if(confirm('Are you sure delete this '+list_id.length+' data?'+list_id[0]))
              {
                var csrf = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                  xhr: function () {
                  var xhr = new window.XMLHttpRequest();
                  xhr.upload.addEventListener("progress", function (evt) {
                      if (evt.lengthComputable) {
                          var percentComplete = evt.loaded / evt.total;
                          console.log(percentComplete);
                          $('.progress').css({
                              width: percentComplete * 100 + '%'
                          });
                          if (percentComplete === 1) {
                              $('.progress').addClass('hide');
                          }
                      }
                  }, false);
                  xhr.addEventListener("progress", function (evt) {
                      if (evt.lengthComputable) {
                          var percentComplete = evt.loaded / evt.total;
                          console.log(percentComplete);
                          $('.progress').css({
                              width: percentComplete * 100 + '%'
                          });
                      }
                  }, false);
                  return xhr;
                  },
                url:"{{ route('admin.outbox_deletes') }}",
                method:'POST',
                data:{id:list_id, _token:csrf},
                success:function(data)
                {
                  alert(data);
                  window.location = "{{ route('admin.outbox') }}";
                }
                
                });
              }
          }
          else
          {
              alert('no data selected ');
          }
        });    
        
    </script>
    @endsection