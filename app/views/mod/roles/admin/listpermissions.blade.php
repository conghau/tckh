@extends( 'layout/default-layout' )

@section('main_content')
<div class="list list-contacts">
    @foreach ( $list_perms as $perm )
    <a class="list-item" href="#">
        <div class="list-text">{{ $perm->p_name }}</div>
    </a>
    @endforeach
</div>
@stop
