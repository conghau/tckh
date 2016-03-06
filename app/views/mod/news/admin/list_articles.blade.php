@extends( 'layout/default-layout' )

@section('main_content')
{{
    SystemController::breadcrumb(array(
        array(
            'url' => '',
            'title' => 'Thông báo/Tin tức',
            'active' => true
        ),
    ))
}}

<div class="block block-drop-shadow">

    <div class="head bg-default bg-light-rtl">
        <h2>Danh sách bài viết</h2>
        <div class="side pull-right">
            <ul class="buttons">
                <li><a href="{{ url('news/article/createarticle').((isset($catinfo) && $catinfo) ? '/'.$catinfo->id : '') }}" class="tip" title="Đăng bài viết"><span class="icon-plus"></span></a></li>
                <li><a class="tips" href="{{ url('news/cat/createcat') }}" title="Thêm chuyên mục"><span class="icon-plus-sign tip" title="Tạo chuyên mục"></span></a></li>
                <li><a class="tip" href="{{ url('news/cat') }}"><span class="icon-list tip" title="Danh sách chuyên mục"></span></a></li>
            </ul>
        </div>
        <?php
            if ( isset($catinfo) && $catinfo ) {
                print '<h5>Chuyên mục: '.$catinfo->catname.'</h5><div>&nbsp;</div>';
            }
        ?>
    </div>

    <div class="content">

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">Tìm bài viết</div>
                <input type="text" class="form-control" name="txtSearchArticleKW" id="txtSearchArticleKW" value="{{ Input::get('kw') }}" placeholder="Nhập từ khóa tìm kiếm trong bài viết" size="50" />
            </div>
        </div>
        <table class="table table-bordered responsive-table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Chuyên mục</th>
              <th>Tiêu đề bài viết</th>
              <th>Ngày tạo</th>
              <th>Ngày đăng</th>
              <th>Hot</th>
              <th>Sticky</th>
              <th>Đã duyệt</th>
              <th>Published</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach ( $list_articles as $article ) {
            ?>
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->catname }}</td>
                <td><a href="{{ url('news/view/') }}/{{ $article->title_seo }}" target="_blank">{{ $article->title }}</a></td>
                <td>{{ date('d/m/Y H:i',$article->create_at) }}</td>
                <td>{{ date('d/m/Y H:i',$article->post_date) }}</td>
                <td align="center">{{ $article->hot == 1 ? 'x' : '&nbsp;' }}</td>
                <td align="center">{{ $article->sticky == 1 ? 'x' : '&nbsp;' }}</td>
                <td align="center">{{ $article->daduyet == 1 ? 'x' : '&nbsp;' }}</td>
                <td align="center">{{ $article->published == 1 ? 'x' : '&nbsp;' }}</td>
                <td align="center">
                    <a href="javascript:;" onclick="news_sethot($articleinfo->id)"><span class="icon-check tip" title="Đánh dấu/bỏ đánh dấu tin nóng"></span></a>&nbsp;&nbsp;
                    <a href="{{ url('news/article/editarticle/'.$article->id) }}"><span class="icon-pencil tip" title="Sửa"></span></a>&nbsp;&nbsp;
                    <a href="javascript:;" onclick="del_article({{ $article->id }})"><span class="icon-remove tip" title="Xóa"></span></a>
                </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <div>
            <?php
                $pager = $list_articles->appends(Input::except(array('page')))->links();
                if ( $pager != '' ) {
                    print '<label class="pager_desc"><span>Có: '.$list_articles->getTotal().' bài viết. ('.
                        $list_articles->getLastPage().' trang)</span> | Trang: </label>' . $pager;
                }
            ?>
        </div>
        <script type="text/javascript">
        $('#txtSearchArticleKW').keypress(function( event ) {
            if ( event.which == 13 ) {
                self.location.href = '{{ url("news/article/listarticle?kw=") }}'+$('#txtSearchArticleKW').val();
                event.preventDefault();
            }
        });

        del_article = function(articleid) {
            bootbox.confirm('Bạn có chắc là muốn xóa không ?', function(result) {
                if ( result ) {
                    self.location.href = '{{ url("news/article/deletearticle/") }}/'+articleid;
                }
            });
        };

        news_sethot = function(articleid) {
            confirm('Bạn có chắc là muốn thiết lập tin này là tin nóng không ?', function(result) {
                if ( result ) {
                    self.location.href = "{{ url('news/article/sethot/') }}/"+articleid;
                }
            });
        };
        </script>
    </div>
</div>

@stop
