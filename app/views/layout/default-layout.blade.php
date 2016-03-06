@extends( Input::has('popup') ? '../../master-index-popup' : (Input::has('blank') ? '../../master-index-blank' : '../../master-index') )

@section('main_content')
    @yield('view_content')
@stop