@extends( 'layout/default-layout' )

@section('main_content')
{{
SystemController::breadcrumb(array(
array(
'url' => 'user/list',
'title' => 'Quản lý User',
'active' => false
),
array(
'url' => '',
'title' => 'Quản lý vai trò',
'active' => false
),
array(
'url' => '',
'title' => 'Quản lý phân quyền',
'active' => true
),
))
}}

@section('main_content')
<div class="col-md-12">
    <div class="block block-drop-shadow">
        <div class="head bg-default bg-light-ltr">
            <h2>Quản lý Tạp Chí Khoa Học</h2>
        </div>
        <?php if ( Session::has('message') ) { ?>
            <div class="alert alert-danger" role="alert"><?php echo Session::get('message') ?></div>
            <?php Session::forget('message'); ?>
        <?php } ?>

        <div class="content">
            <table class="table table-bordered responsive-table">
                <thead>
                    <tr>
                        <th>ID số tạp chí</th>
                        <th>Tên Bài viết</th>
                        <th>Trạng thái</th>
                        <th>Ngày nhập</th>
                        <th>Ngày bắt đầu chấm bài</th>
                        <th>Ngày kết thúc chấm bài</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ( $dshdpb as $chitietbaiviet ) {
                    ?>
                    <tr>
                        <td>{{ $chitietbaiviet->id_sotapchi }}</td>
                        <td>{{ $chitietbaiviet->tenbaiviet }}</td>
                        <td><?php echo getStatusById($chitietbaiviet->trangthai) ?></td>
                        <td><?php echo date("Y-m-d",$chitietbaiviet->ngaynhap) ?></td>
                        <td>{{ $chitietbaiviet->ngaybatdaucham }}</td>
                        <td>{{ $chitietbaiviet->ngayketthucchambai }}</td>
                        <td align="center">
                            <a href="#"><span class="icon-pencil tip" title="Phân công chấm bài"></span></a>
                            <a href="#"><span class="icon-eye-open tip" title="Xem chi tiết"></span></a>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div>
                <?php
                $pager = $dshdpb->appends(Input::except(array('page')))->links();
                if ( $pager != '' ) {
                    print '<label class="pager_desc"><span>Có: '.$dshdpb->getTotal().' văn bản ('.
                        $dshdpb->getLastPage().' trang)</span> | Trang: </label>' . $pager;
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
    function getStatusById($statusId) {
        switch($statusId) {
            case 1:
                return "Bài viết mới";
            break;
            case 2:
                return "Đang chấm";
                break;
            case 3:
                return "Được xác nhận";
                break;
            case 4:
                return "Bị từ chối";
                break;
            case 5:
                return "Đang được sửa";
                break;
            case 6:
                return "Đã đăng tạp chí";
                break;
    }
}?>
@stop
