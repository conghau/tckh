@extends( Input::has('popup') ? '../../front-page-popup' : (Input::has('blank') ? '../../front-page-blank' : '../../front-page') )

@section('main_content')
    <section id="error" class="container" style="padding: 30px;">
        <?php
        if ( isset($message) && $message != '' ) {
            print '<h1>Thông báo</h1>';
            print '<div class="alert alert-success">'.$message.'</div>';
        }
        ?>
    </section><!--/#error-->
@stop