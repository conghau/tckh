@extends( Input::has('popup') ? '../../master-index-popup' : (Input::has('blank') ? '../../master-index-blank' : '../../master-index') )

@section('main_content')
<section id="error" class="container" style="padding:30px">
    <div class="alert alert-{{ !isset($message_type) ? 'info' : $message_type }}" role="alert"><?php echo $message ?></div>
</section>
@stop
