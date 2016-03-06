@extends( 'layout/default-layout' )

@section('view_content')
<div class="block block-drop-shadow">
    <div class="head bg-default bg-light-ltr">
        <h2>
            Hệ thống / Thiết lập hệ thống
        </h2>
    </div>

    <div class="content">
    <div class="alert alert-danger">
        <p>Thiết lập sẽ tự động lưu khi nhấn Enter sau khi hiệu chỉnh giá trị thiết lập</p>
    </div>

    @foreach ( $settings as $setting )
	<div class="panel-group" id="accordion{{ $setting->name }}">
      <div class="panel panel-default" style="overflow:visible">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion{{ $setting->name }}" href="#collapse{{ $setting->name }}">
              <i class="icon-angle-down"></i> {{ $setting->text }}
            </a>
          </h4>
        </div>
        <div id="collapse{{ $setting->name }}" class="panel-collapse collapse">
          <div class="panel-body">
            <table class="mform">
            @foreach ( $setting->settings as $item )
            <?php $md5_configname = md5($item->cfgname); ?>
                <tr>
                    <td>{{ $item->descr }}:</td>
                    <td>
                        <div class="input-group">
                          <input type="text" class="form-control" name="{{ $item->cfgname }}" id="{{ $md5_configname }}" value="{{ $item->cfgvalue }}" onkeypress="if(event.keyCode==13) { do_save_settings(this.name,this.value,'{{ $md5_configname }}'); }" />
                          <span class="input-group-addon" id="status{{ $md5_configname }}">&nbsp;</span>
                        </div

                    </td>
                </tr>
            @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
    <div>&nbsp;</div>
    @endforeach
	<script type="text/javascript">
    var sesstoken = '{{ $sesstoken }}';
	do_save_settings = function(config_name, config_value, md5_configname) {
	    $('#status'+md5_configname).show();

	    var data = {};
	    data.name = config_name;
	    data.value = config_value;

        $.ajax({
            type: 'POST',
            url: "{{ Config::get('app.url') .'/system/settings' }}?sesstoken="+sesstoken,
            data: 'data='+base64_encode_safe(JSON.stringify(data)),
            beforeSend: function() {
                $('#'+md5_configname).attr('disabled', 'disabled');
                $('#status'+md5_configname).html('<img src="'+wwwroot+'/asset/img/loading.png" />');
            },
            error : function() {
                $('#'+md5_configname).removeAttr('disabled');
                $('#status'+md5_configname).html('&nbsp;');
                bootbox.alert('Lỗi khi lưu thiết lập hệ thống !!!');
            },//
            success: function(response) {
                $('#'+md5_configname).removeAttr('disabled');
                $('#status'+md5_configname).html('&nbsp;');
                if ( response ) {
                    if ( response.status == 0 ) {
                        $('#status'+md5_configname).html('<img src="'+wwwroot+'/asset/img/Check-icon.png" />');
                    }
                    else {
                        bootbox.alert(response.message);
                    }
                }
                else {
                    bootbox.alert('Response is null !!!');
                }
            },
            dataType: 'json'
        });
    }
	</script>
	</div>
	<div class="footer"></div>
</div>
@stop
