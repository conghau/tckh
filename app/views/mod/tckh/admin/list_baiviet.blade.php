@extends('layout/default-layout')

@section('view_content')
{{
    SystemController::breadcrumb(array(
        array(
            'url' => 'tckh',
            'title' => 'Quản lý tạp chí khoa học',
            'active' => false
        ),
        array(
            'url' => 'tckh',
            'title' => 'Danh sách bài viết',
            'active' => true
        ),
    ))
}}

<div class="block block-drop-shadow">

    <div class="head bg-default bg-light-ltr">
        <h2>Danh sách bài viết</h2>
        <div class="side pull-right">
            <ul class="buttons">
                <li><a href="{{ url('tckh/thembaiviet') }}?idsotapchi={{Input::get('idsotapchi')}}" class="tip" title="Thêm bài viết cho số tạp chí"><span class="icon-plus"></span></a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        {{--
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">Tìm nhanh văn bản</div>
                <input type="text" class="form-control" name="txtSearchVB" id="txtSearchVB" value="{{ Input::get('kw') }}" placeholder="Nhập từ khóa tìm kiếm (tìm kiếm trong các cột trên lưới)" size="50" />
            </div>
            <script type="text/javascript">
                $('#txtSearchVB').keypress(function( event ) {
                    if ( event.which == 13 ) {
                        self.location.href = '{{ url("qlvb/vanban?kw=") }}'+$('#txtSearchVB').val();
                        event.preventDefault();
                    }
                });
            </script>
        </div>
        --}}
        <table class="table table-bordered responsive-table">
          <thead>
            <tr>
              <th>STT</th>
              <th>ID</th>
              <th>Nhóm bài viết</th>
              <th>Tên bài viết</th>
              <th>Giới thiệu bài viết</th>
              <th>Tác giả</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $pageno = Input::get('page');
                if ( !$pageno || intval($pageno) == 0 ) $pageno = 1;

                $stt = ($pageno-1) * $list_baiviet->getPerPage() + 1;
                foreach ( $list_baiviet as $baiviet ) {
            ?>
            <tr>
                <td>{{ $stt++ }}</td>
                <td>{{ $baiviet->id }}</td>
                <td>{{ $baiviet->nhombaiviet }}</td>
                <td>{{ $baiviet->tenbaiviet }}</td>
                <td>{{ $baiviet->gioithieubaiviet }}</td>
                <td>
                <?php
                    $tg_html = '';
                    if ( $baiviet->tacgia != '' ) {
                        $tg = json_decode($baiviet->tacgia);
                        if ( $tg && count($tg) > 0 ) {
                            foreach ( $tg as $item ) {
                                if ( $tg_html == '' ) $tg_html = $item;
                                else $tg_html .= '<br />' . $item;
                            }
                        }
                    }
                ?>

                {{$tg_html}}
                </td>
                <td align="center"><a class="btn btn-primary" target="_blank" href="{{ url('qlvb/viewvb/'.$baiviet->id) }}">Xem VB</a></td>
                <td align="center">
                    <a href="{{url('tckh/uploadfilebaiviet?idbaiviet='.$baiviet->id)}}"><span class="icon-upload tip" title="Upload file bài viết"></span></a>&nbsp;&nbsp;
                    <a href="{{url('tckh/downloadfile?idbaiviet='.$baiviet->id)}}"><span class="icon-download tip" title="Tải file bài viết"></span></a>&nbsp;&nbsp;
                    <a href="{{url('tckh/suabaiviet?idsotapchi='.$baiviet->id_sotapchi.'&idbaiviet='.$baiviet->id)}}"><span class="icon-pencil tip" title="Sửa bài viết"></span></a>&nbsp;&nbsp;
                    <a href="javascript:;" onclick="tckh_del_baiviet({{ $baiviet->id }})"><span class="icon-remove tip" title="Xóa bài viết"></span></a>
                </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <div>
            <?php
                $pager = $list_baiviet->appends(Input::except(array('page')))->links();
                if ( $pager != '' ) {
                    print '<label class="pager_desc"><span>Có: '.$list_baiviet->getTotal().' văn bản ('.
                        $list_baiviet->getLastPage().' trang)</span> | Trang: </label>' . $pager;
                }
            ?>
        </div>
        <script type="text/javascript">
        tckh_del_baiviet = function(idbaiviet) {
            bootbox.confirm('Bạn có chắc là muốn xóa không ?', function(result) {
                if ( result ) {
                    self.location.href = '{{ url("tckh/xoabaiviet") }}?idbaiviet=' + idbaiviet;
                }
            });
        };
        </script>
    </div>
</div>

@stop
