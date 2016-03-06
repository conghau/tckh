@extends( Input::has('popup') ? '../../front-page-popup' : (Input::has('blank') ? '../../front-page-blank' : '../../front-page') )

@section('main_content')
    <section id="error" class="container" style="padding:30px;">
        <h1 style="color:#990000">403, Không có quyền truy cập !</h1>
        <p>Bạn không có quyền truy cập vào trang bạn yêu cầu. Nếu bạn muốn truy cập, vui lòng liên hệ với quản trị Website</p>
    </section><!--/#error-->
@stop