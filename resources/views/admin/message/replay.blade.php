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
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                   <h4> <i class ="fa fa-phone"></i> Tambah Phonebook</h4>
              </div>
              <div class="card-body m-3">
                <form method="POST" action="{{ route('admin.send_sms') }}">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-9">
                            <label for="inputEmail4">Tujuan</label>
                                <input type="text" name="p_num_text" class="form-control" style="width: 100%" value="{{ $message->in_sender }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                    <label for="inputEmail4">Schedule</label>
                                          <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <div class="input-group-text">
                                                    <input type="checkbox" id="schedule_check" class="check_box" aria-label="Checkbox for following text input" name="schedule_check">
                                                  </div>
                                                </div>
                                                <input type="text" class="form-control datetimepicker" id="datetimepicker1" name="schedule_date" value="" disabled>
                                              </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputAddress">Isi Pesan</label>
                                <select id="inputTemplate" class="form-control" onchange="getvaltemplate(this);">
                                    <option value="Replay Sms :{{ $message->in_msg }}&#13;&#10;">Pilih Template</option>
                                    @foreach ($template as $item)
                                        <option value="Replay Sms :{{ $message->in_msg }}&#13;&#10;{{ $item->t_text }}">{{ $item->t_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            {{-- <textarea ></textarea> --}}
                            <textarea style="height: 150px;"  name="message" id="message_draft" rows="10" cols="45" class="form-control @error('message') is-invalid @enderror" placeholder="Tulis Pesan">Replay Sms : {{ $message->in_msg }}&#13;&#10;</textarea>
                            <div class="invalid-feedback">
                                @error('message') {{ $message}} @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="inputCity">Options</label>
                            <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck" name="checkFlashsms">
                                    <label class="form-check-label" for="gridCheck">
                                        Flash message
                                    </label>
                                </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck" name="checkUnicodesms">
                                <label class="form-check-label" for="gridCheck">
                                    Unicode message
                                </label>
                            </div>
                            </div>
                            <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="sms_footer" id="footer_draft" placeholder="Footer" value="{{Auth::user()->footer}}">
                            </div>
                            <div class="form-group col-md-4">
                                <button type="submit" class="form-control btn btn-success mb-1">Kirim</button>
                                <button type="submit" class="form-control btn btn-info">Simpan</button>
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

@section('scripts')  
<script type="text/javascript" src="http://192.168.5.31/plugin/themes/common/jscss/combobox/select2.min.js"></script>
<script type="text/javascript" src="http://192.168.5.31/plugin/themes/common/jscss/combobox/select2_locale_id.js"></script>
<script type="text/javascript" src="{{ URL::to('/') }}/assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="{{ URL::to('/') }}/assets/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
	$(document).ready(function() {
        var csrf = $('meta[name="csrf-token"]').attr('content');

		$("#msg_combo_sendto").select2({
			multiple: true,
			/* placeholder: "Send to", */
			allowClear: true,
			selectOnBlur: true,
			minimumInputLength: 2,
			separator: ",",
			tokenSeparators: [","],
			initSelection : function (element, callback) {
				var data = [];
				$(element.val().split(",")).each(function () {
					data.push({id: this, text: this});
				});
				callback(data);
			},
			createSearchChoice: function(term, data) {
				if ($(data).filter(function () {
					return this.text.localeCompare(term)===0;
				}).length===0) {
					return {id:term, text:term};
				}
			},
			ajax: {
				url: "{{ route('admin.api_getcontact') }}",
				dataType: 'json',
				quietMillis: 100,
                method: 'get',
				data: function (term, page) {
					return {
						_token:csrf,
						kwd: term
					};
				},
				results: function (data, page) {
					return {results: data};
				}
			}
		});
        
		$("#message").focus();

	});

    function getvaltemplate(sel)
        {
            $("textarea#message_draft").val(sel.value);
        }
</script>

<script type="text/javascript">
   $(function () {
                $('#datetimepicker1').datetimepicker();
            });

    $("#schedule_check").click(function(){
        if ($('input.check_box').is(':checked')) {
            $("input.datetimepicker").prop('disabled', false);
        }else{
            $("input.datetimepicker").prop('disabled', true);
        }

    });
</script>

@endsection