@extends( 'layout/default-layout' )

@section('main_content')
{{
    SystemController::breadcrumb(array(
        array(
            'url' => 'news',
            'title' => 'Thông báo/Tin tức',
            'active' => false
        ),
        array(
            'url' => '',
            'title' => 'Danh sách chuyên mục',
            'active' => true
        ),
    ))
}}

<div class="block block-drop-shadow">

    <div class="head bg-default bg-light-rtl">
        <h2>Danh sách chuyên mục</h2>
        <div class="side pull-right">
            <ul class="buttons">
                <li><a href="{{ url('news/cat/createcat') }}" class="tip" title="Thêm chuyên mục"><span class="icon-plus"></span></a></li>
                <li><a class="tip" href="{{ url('news/article/createarticle') }}" title="Đăng Thông báo/Tin tức"><span class="icon-plus-sign"></span></a></li>
                <li><a class="tip" href="{{ url('news') }}" title="Danh sách Thông báo/Tin tức"><span class="icon-list"></span></a></li>
            </ul>
        </div>
    </div>

    <div class="content">

        <table class="table table-bordered responsive-table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Tên chuyên mục</th>
              <th>Mô tả</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach ( $cats as $cat ) {
            ?>
            <tr>
                <td id="cat_{{ $cat->id }}">{{ $cat->id }}</td>
                <td><a href="javascript:;" onclick="get_news_subcat({{ $cat->id }})">
                    <?php
                        if ( $cat->childcount > 0 ) print '<img id="expand_cat_'.$cat->id.'" src="'.Config::get('app.url') . '/' . ('asset/images/icon_plus.gif').'" align="absmiddle" /> ';
                    ?>
                    {{ $cat->catname }}</a>
                </td>
                <td>{{ $cat->catdesc }}</td>
                <td align="center">
                    <a href="{{ url('news/article/listarticle/'.$cat->id) }}"><span class="icon-list tip" title="Danh sách bài viết của chuyên mục"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('news/cat/editcat/'.$cat->id) }}"><span class="icon-pencil tip" title="Sửa"></span></a>&nbsp;
                    <a href="javascript:;" onclick="del_cat({{ $cat->id }})"><span class="icon-remove tip" class="Xóa"></span></a>
                </td>
            </tr>
            <tr style="display:none;">
            <td colspan="4" id="subcat_{{ $cat->id }}"></td>
        </tr>
            <?php } ?>
          </tbody>
        </table>
        <script type="text/javascript">
        del_cat = function(catid) {
            bootbox.confirm('Bạn có chắc là muốn xóa không ?', function(result) {
                if ( result ) {
                    self.location.href = '{{ url("news/cat/deletecat/") }}/'+catid;
                }
            });
        };

        get_news_subcat = function(catid) {
            if ( $('#subcat_'+catid).parent().is(':visible') ) {
                $('#subcat_'+catid).slideUp();
                $('#subcat_'+catid).parent().css('display','none');
                $('#expand_cat_'+catid).attr('src','{{ Config::get('app.url') . '/' . ("asset/images/icon_plus.gif") }}');
                return;
            }


            $.ajax({
                type: "GET",
                url: '{{ url("news/cat/listcat/") }}/'+catid,
                beforeSend: function() {
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    bootbox.alert('Không lấy chuyên mục con !!!\n\n'+xhr.responseText);
                },
                success: function( response ) {
                    var tds = $('#subcat_'+catid).parent().children();
                    for (i=0; i<tds.length; i++) {
                        $(tds[i]).css('background-color', '#FFF9DB');
                        $(tds[i]).css('border-top', '1px solid #F3D97F');
                        $(tds[i]).css('border-bottom', '1px solid #F3D97F');
                    }

                    if ( response.code == 0 ) {
                        html = '<table class="table table-bordered responsive-table">'+
                            '<thead> '+
                                '<tr> '+
                                    '<th>#</th> '+
                                    '<th>Tên chuyên mục</th> '+
                                    '<th>Mô tả</th> '+
                                    '<th>&nbsp;</th> '+
                                '</tr> '+
                            '</thead> 	'+
                            '<tbody> ';
                        for ( i=0;i<response.data.length; i++ ) {
                            html += '<tr> '+
                                    '<td id="cat_'+response.data[i].id+'">'+response.data[i].id+'</td> '+
                                    '<td><a href="javascript:;" onclick="get_news_subcat('+response.data[i].id+')">'+
                                        (response.data[i].childcount > 0 ? '<img id="expand_cat_'+response.data[i].id+'" src="{{ Config::get('app.url') . '/' . ("asset/images/icon_plus.gif") }}" align="absmiddle" />' : '') + ' ' +
                                        response.data[i].catname +
                                    '</td> '+
                                    '<td>'+response.data[i].catdesc+'</td> '+
                                    '<td align="center">'+
                                        '<a href="{{ url("news/cat/editcat/") }}/'+response.data[i].id+'"><img src="{{ Config::get('app.url') . '/' . ("asset/images/file_edit.png") }}" title="Sửa" /></a>&nbsp;'+
                                        '<a href="#" onclick="del_cat('+response.data[i].id+')"><img src="{{ Config::get('app.url') . '/' . ("asset/images/file_delete.png") }}" title="Xóa" /></a></td> '+
                                '</tr> ';
                            html += '<tr style="display:none;"> '+
                                '<td colspan="4" id="subcat_'+response.data[i].id+'"></td>'+
                                '</tr>';
                        }
                        html += '</tbody></table>';
                        $('#subcat_'+catid).parent().css('display','');
                        $('#subcat_'+catid).html(html);
                        $('#subcat_'+catid).slideDown();

                        $('#expand_cat_'+catid).attr('src','{{ Config::get('app.url') . '/' . ("asset/images/minus_icon.gif") }}');
                        //$('#href'+catid).remove();
                    }
                    else {
                        bootbox.alert(response.msg);
                    }
                },
                dataType: 'json'
            });
        };
        </script>
    </div>
</div>

@stop
