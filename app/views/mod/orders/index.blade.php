@extends('front-page') @section('main_content')

<div class="news_viewarticle_box">
	<div class="form-data-input">
		{{ Form::open(array('url' => 'orders/store', 'method'
		=> 'post')) }}
		<div class="margin-bottom-20 head bg-default bg-light-ltr">
			<h2>Đặt hàng</h2>
		</div>

		<!-- will be used to show any messages -->
		<div style="clear: both"></div>
		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li> @endforeach
			</ul>
		</div>
		@endif

		<div class="form-group">
			<label for="inputDisplayName">Tên tài khoản:</label> {{$user_info->display_name}}
		</div>
		<div class="form-group">
			<label for="inputPhone">Số điện thoại:</label> {{$user_info->phone_numer}}
		</div>
		<div class="form-group">
			<label for="inputEmail">Số điện thoại:</label> {{$user_info->email}}
		</div>

		<button type="submit" class="btn btn-primary">Đăng kí</button>

		<div style="clear: both"></div>
		{{ Form::close() }}

	</div>
</div>

@stop
