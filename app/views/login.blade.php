@extends( Input::has('popup') ? '../../front-page-popup' : '../../front-page')

@section('main_content')
<?php
$is_popup = '';
if ( Input::has('popup') ) $is_popup = '?popup=true';

if ( !isset($login_success) ) {
?>

	<div>&nbsp;</div>
	<div>&nbsp;</div>
	{{ Form::open(array('url' => 'login'.$is_popup, 'class' => 'center', 'role' => 'form', 'onsubmit' => 'return loginpage_checkLoginForm()')) }}
    <fieldset class="registration-form" style="width: 250px;margin: auto;">
    		<?php if ( !Input::has('popup') ) { ?>
			<div class="form-group">
				<h4>Đăng nhập hệ thống</h4>
			</div>
			<?php } ?>
			<?php if ( !empty($message) ) { ?>
			  <div class="alert alert-danger" role="alert"><?php echo $message ?></div>
			<?php } ?>
      <div class="form-group">
        <input type="text" style="background-color: #fff;border-color:#ccc;color:#000066" id="txtUsername" name="txtUsername" placeholder="Tài khoản" maxlength="50" class="form-control" />
      </div>
      <div class="form-group">
        <input type="password" style="background-color: #fff;border-color:#ccc;color:#000066" id="txtPassword" name="txtPassword" placeholder="Mật khẩu" maxlength="50" class="form-control" />
      </div>
      <div class="form-group">
        <button class="btn btn-primary">Đăng nhập</button>
      </div>
    </fieldset>
  {{ Form::close() }}
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<script type="text/javascript">
	$(function() {
		$('#txtUsername').focus();
	
		loginpage_checkLoginForm = function() {
			if ( $('#txtUsername').val() == '' ) {
				$('#txtUsername').focus();
				bootbox.alert('Chưa nhập tài khoản !');
				return false;
			}
			if ( $('#txtPassword').val() == '' ) {
				$('#txtPassword').focus();
				bootbox.alert('Chưa nhập mật khẩu !');
				return false;
			}
			return true;
		};
	});
	</script>
<?php } ?>
@stop