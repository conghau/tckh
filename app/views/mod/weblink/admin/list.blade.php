@extends( '.........layout.default-layout' )

@section('main_content')
{{
    SystemController::breadcrumb(array(
        array(
            'url' => 'weblink',
            'title' => 'Liên kết Website',
            'active' => true
        ),
    ))
}}

<div class="block block-drop-shadow">

    <div class="head bg-default bg-light-rtl">
        <h2>Danh sách Web link</h2>
        <div class="side pull-right">
            <ul class="buttons">
                <li><a href="{{ url('weblink/add') }}" class="tip" title="Thêm liên kết web"><span class="icon-plus"></span></a></li>
            </ul>
        </div>
    </div>

    <div class="content">

        <table class="table table-bordered responsive-table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Tiêu đề</th>
              <th>Link</th>
              <th>Logo</th>
              <th>Thứ tự</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            @foreach ( $list_weblink as $weblink )
            <tr>
                <td>{{$weblink->id}}</td>
                <td>{{$weblink->link_title}}</td>
                <td>{{$weblink->link_url}}</td>
                <td>
                <?php
                $logo = '';
                if ( $weblink->link_image != '' ) {
                    $logo = '<img src="'.Config::get('app.url') . '/weblink/' . $weblink->link_image.'" />';
                }
                ?>
                {{$logo}}
                </td>
                <td>{{$weblink->link_order}}</td>
                <td align="center">
                    <a href="{{url('weblink/edit?id='.$weblink->id)}}"><span class="icon-pencil tip" title="Sửa"></span></a>&nbsp;&nbsp;&nbsp;
                    <a href="javascript:;" onclick="weblink_delete({{$weblink->id}})"><span class="icon-remove tip" title="Xóa"></span></a>&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <script type="text/javascript">
        weblink_delete = function(id) {
            bootbox.confirm('Bạn có chắc là muốn xóa không ?', function(ok) {
                if ( ok ) {
                    self.location.href = '{{ url("weblink/delete?id=") }}'+id;
                }
            });
        };
        </script>
    </div>
</div>

@stop
