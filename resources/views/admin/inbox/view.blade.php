@extends('layouts.admin-master')



@section('title')

Inbox

@endsection



@section('content')

<section class="section">

  <div class="section-header">

    <h1>Inbox Details</h1>

  </div>

  <div class="section-body">

    <div class="row">

      <div class="col-12 col-md-12 col-lg-12">

          <div class="progress"></div>

        <div class="card">

            <div class="card-header">

                <a href="{{ route('admin.inbox') }}" class="btn btn-sm btn-success mr-2">All Inbox</a>

              </div>

              <div class="card-body p-0 ml-2 mr-2">
                <div class="table-responsive">

                  <table class="table table-striped">

                    <tr>
                      <th>Nomor</th>
                      <td>:</td>
                      <td>{{$data->in_sender}}</td>
                    </tr>

                    <tr>
                      <th>Message</th>
                      <td>:</td>
                      <td>{{$data->in_msg}} <a href="{{url('pesan/inbox/printPDF/'.$data->in_msg)}}"> Download</a>   </td>
                    </tr>

                    <tr>
                      <th>Tanggal</th>
                      <td>:</td>
                      <td>{{Carbon\Carbon::parse($data->in_datetime)->addHour('7')}}</td>
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