@extends( Input::has('popup') ? '../../front-page-popup' : (Input::has('blank') ? '../../front-page-blank' : '../../front-page') )

@section('main_content')
<section id="error" class="container" style="padding:30px">
    <h1>Lỗi</h1>
    <div class="alert alert-danger" role="alert"><?php echo $message ?></div>
</section>
@stop
