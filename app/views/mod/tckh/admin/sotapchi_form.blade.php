@extends( 'layout/default-layout' )
<?php
    $form_action = 'tckh/themsotapchi';
    $form_title = '';
    if ( isset($sotapchiinfo) && $sotapchiinfo ) {
        $form_title = 'Sửa thông tin số tạp chí';
        $form_action = 'tckh/suasotapchi?idsotapchi='.$sotapchiinfo->id;
    }
    else $form_title = 'Thêm số tạp chí';
?>
@section('main_content')
{{
    SystemController::breadcrumb(array(
        array(
            'url' => 'tckh',
            'title' => 'Danh sách số tạp chí',
            'active' => false
        ),
        array(
            'url' => '',
            'title' => $form_title,
            'active' => true
        ),
    ))
}}

<link rel="stylesheet" href="{{ Config::get('app.url') . '/' . ('asset/css/chosen.css') }}" type="text/css" media="screen" />
<script type="text/javascript" src="{{ Config::get('app.url') . '/' . ('asset/js/chosen.jquery.js') }}"></script>
<div class="block block-drop-shadow">

    <div class="head bg-default bg-light-ltr">
        <h2>{{ $form_title }}</h2>
    </div>

    <div class="content">
        <?php if ( !empty($message) ) { ?>
          <div class="alert alert-danger" role="alert"><?php echo $message ?></div>
        <?php } ?>

        {{ Form::open(array('url' => $form_action, 'files'=>true, 'onsubmit' => 'return check_sotapchi_form();')) }}
        <table class="mform">
            <tr>
                <td>Số tạp chí:</td>
                <td>
									<select class="form-control chosen-select" id="txtSo" name="txtSo">
									@for ( $i=1; $i<15; $i++ )
									<option value="{{ $i }}">{{ $i }}</option>
									@endfor
									</select>
									<script type="text/javascript">
									$(function() {
										var _so = parseInt('{{ @$sotapchiinfo->sotapchi }}');
										if ( _so > 0 ) 
										$('#txtSo').val(_so);
									});
									
									</script>
                </td>
            </tr>
            <tr>
                <td>Năm:</td>
                <td>
										<select class="form-control chosen-select" id="txtNam" name="txtNam">
										@for ( $i=2001; $i<2050; $i++ )
										<option value="{{ $i }}">{{ $i }}</option>
										@endfor
										</select>
										<script type="text/javascript">
										$(function() {
											var _nam = parseInt('{{ @$sotapchiinfo->namtapchi }}');
											if ( _nam > 0 ) 
											$('#txtNam').val(_nam);
										});
										
										</script>
                </td>
            </tr>
            <tr>
                <td>Tên tạp chí:</td>
                <td>
                    <input type="text" class="form-control" id="txtTen" name="txtTen" maxlength="255" size="50" value="{{ @$sotapchiinfo->tentapchi }}" />
                </td>
            </tr>
            <tr>
                <td valign="top">Ảnh bìa:</td>
                <td>
                    <input type="file" name="fileAnhBia" id="fileAnhBia" />
                    @if ( isset($sotapchiinfo) && $sotapchiinfo && $sotapchiinfo->anhbia != '' )
                    <div style="width:200px;height:300px;border:1px solid #f2f2f2;">
                        <div style="text-align: right;background-color: #333;padding:4px;"><a href="javascript:;" onclick="tckh_checkxoa_anhbia(this)"><span class="icon-remove"></span></a></div>
                        <img src="{{Config::get('app.url')}}/tckhbia/{{$sotapchiinfo->anhbia}}" style="width:199px;height:300px" />
                    </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <button class="btn btn-primary" type="submit">Lưu thông tin</button>
                    <input type="hidden" name="do_save" id="do_save" value="1" />
                    <input type="hidden" name="xoaanhbia" id="xoaanhbia" value="0" />
                </td>
            </tr>
        </table>
        {{ Form::close() }}
        <script type="text/javascript">
				$(document).ready(function()
				{
						$('.chosen-select').chosen({
								allow_single_deselect: true,
								search_contains: true,
								width: '100%'
						});
				});
        check_sotapchi_form = function() {
            if ( $('#txtSo').val() == '' ) {
                bootbox.alert('Chưa nhập số tạp chí !!!');
                $('#txtSo').focus();
                return false;
            }
            if ( $('#txtNam').val() == '' ) {
                bootbox.alert('Chưa nhập năm tạp chí !!!');
                $('#txtNam').focus();
                return false;
            }
            return true;
        };
        tckh_checkxoa_anhbia = function(from_el) {
            $(from_el).parent().parent().remove();
            $('#xoaanhbia').val(1);
        };
        </script>
    </div>
</div>


@stop
