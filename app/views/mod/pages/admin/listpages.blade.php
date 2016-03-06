@extends( Input::has('popup') ? '../../master-index-popup' : '../../master-index')

@section('main_content')

{{
    SystemController::breadcrumb(array(
        array(
            'url' => '',
            'title' => 'Quản lý Trang',
            'active' => true
        ),
    ))
}}

<div class="block block-drop-shadow">

    <div class="head bg-default bg-light-ltr">
        <h2>Trang / Danh sách trang</h2>
        <div class="side pull-right">
            <ul class="buttons">
                <li><a href="{{ url('pages/createpage') }}" class="tip" title="Thêm Trang"><span class="icon-plus"></span></a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <table class="table table-bordered responsive-table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Tên trang</th>
              <th>Tiêu đề trang</th>
              <th>Link đến trang</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach ( $list_pages as $page ) {
            ?>
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->pagename }}</td>
                <td>{{ $page->pagetitle }}</td>
                <td><a target="_blank" href="{{ url('pages/view') }}/{{ $page->pagetitle_seo }}">{{ url('pages/view') }}/{{ $page->pagetitle_seo }}</a></td>
                <td align="center">
                    <a href="{{ url('pages/editpage/'.$page->id) }}"><span class="icon-pencil tip" title="Sửa"></span></a>&nbsp;&nbsp;&nbsp;
                    <a href="javascript:;" onclick="del_page({{ $page->id }})"><span class="icon-remove tip" title="Xóa"></span></a>
                </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <script type="text/javascript">
        del_page = function(pageid) {
            bootbox.confirm('Bạn có chắc là muốn xóa không ?', function(result) {
                if ( result ) {
                    self.location.href = '{{ url("pages/deletepage/") }}/'+pageid;
                }
            });
        };
        </script>
    </div>
</div>

@stop
