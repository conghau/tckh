<div class="col-md-12" style="padding: 0px;">
    <ol class="breadcrumb">
        <li><a href="{{ url('user/dashboard') }}">Dashboard</a></li>
        @foreach ( $paths as $path )
            @if ( $path['active'] )
                <li class="active">{{ $path['title'] }}</li>
            @else
                <li><a href="{{ url($path['url']) }}">{{ $path['title'] }}</a></li>
            @endif
        @endforeach
    </ol>
</div>