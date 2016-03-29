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
                <li><a href="{{ url('tckh/user/dangtckh') }}" class="tip" title="Đăng tạp chí khoa học"><span class="icon-plus"></span></a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <table class="table table-bordered responsive-table">
            <thead>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Nhóm bài viết</th>
                <th>Tên bài viết</th>
                <th>Giới thiệu bài viết</th>
                <th>Tác giả</th>
                <th>Hành động</th>
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
                    <td align="center">
                        <a href="{{url('tckh/user/suatckh/'.$baiviet->id)}}"><span class="icon-pencil tip" title="Sửa bài viết"></span></a>&nbsp;&nbsp;
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
    </div>
</div>

@stop
