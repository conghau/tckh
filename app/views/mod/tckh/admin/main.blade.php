@extends( '.........layout.default-layout' )

@section('main_content')
{{
    SystemController::breadcrumb(array(
        array(
            'url' => 'news',
            'title' => 'Quản lý Tạp chí khoa học',
            'active' => true
        ),

    ))
}}

<div class="col-md-12">
    <div class="block block-drop-shadow">

        <div class="head bg-default bg-light-rtl">
            <h2>Danh sách số tạp chí</h2>
            <div class="side pull-right">
                <ul class="buttons">
                    <li><a href="{{ url('tckh/themsotapchi') }}" class="tip" title="Thêm số tạp chí"><span class="icon-plus"></span></a></li>
                </ul>
            </div>
        </div>

        <div class="content">

            <table class="table table-bordered responsive-table table-hover">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Số</th>
                      <th>Năm</th>
                      <th>Tên</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $list_tapchi as $tapchi )
                    <tr>
                        <td>{{$tapchi->id}}</td>
                        <td>{{$tapchi->sotapchi}}</td>
                        <td>{{$tapchi->namtapchi}}</td>
                        <td>{{$tapchi->tentapchi}}</td>
                        <td align="center">
                            <a href="{{ url('tckh/suasotapchi') }}?idsotapchi={{$tapchi->id}}"><span class="icon-pencil tip" title="Sửa"></span></a>&nbsp;&nbsp;&nbsp;
                            <a href="javascript:;" onclick="del_sotapchi({{ $tapchi->id }})"><span class="icon-remove tip" class="Xóa"></span></a>
                        </td>
                        <td align="center">
                            <a href="{{ url('tckh/dsbaiviet') }}?idsotapchi={{$tapchi->id}}"><span class="icon-list tip" title="Danh sách bài viết của số tạp chí"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <script type="text/javascript">
            del_sotapchi = function(idsotapchi) {
                bootbox.confirm('Bạn có chắc là muốn xóa không?', function(ok) {
                    self.location.href = '{{url('tckh/xoasotapchi')}}?idsotapchi='+idsotapchi;
                });
            };
            </script>
        </div>
    </div>
</div>

@stop
