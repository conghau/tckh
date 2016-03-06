@extends( Input::has('popup') ? '../../master-index-popup' : (Input::has('blank') ? '../../master-index-blank' : '../../master-index') )

@section('main_content')
    <section id="error" class="container" style="padding:30px">
        <h1>404, Không tìm thấy trang yêu cầu</h1>
        <p>Trang bạn yêu cầu có thể bị xóa khỏi hệ thống hoặc bạn không có quyền truy cập trang này.</p>
        <?php
        if ( isset($message) && $message != '' ) {
            print '<div class="alert alert-danger">'.$message.'</div>';
        }
        ?>
    </section><!--/#error-->
@stop