@extends('front-page')

@section('main_content')

<div class="news_viewarticle_box">
    <div class="fp-boxtitle" style="text-align: left;border-radius: 4px 4px 0px 0px;">Xem bài viết</div>
    <div>
        <div style="padding-right:30px;">
            <table class="mform">
                <tr>
                    <td class="tckh_tacgia tckh_row" width="200px;" style="padding-right:20px">
                    <?php
                        $tg_html = '';
                        if ( $baivietinfo->tacgia != '' ) {
                            $tacgia = json_decode($baivietinfo->tacgia);
                            if ( $tacgia && count($tacgia) > 0 ) {
                                foreach ( $tacgia as $tg ) {
                                    if ( $tg_html == '' ) $tg_html = $tg;
                                    else $tg_html .= '<br />' . $tg;
                                }
                            }
                        }
                    ?>
                    {{$tg_html}}
                    </td>
                    <td class="tckh_row" valign="top">
                        {{$baivietinfo->tenbaiviet}}
                    </td>
                    <td class="tckh_row" width="70" align="center">
                        <a href="{{url('tckh/downloadfile?idbaiviet='.$baivietinfo->id.'&idfile='.$vb_files[0]->id)}}" class="btn btn-primary">Tải file</a>
                    </td>
                </tr>
            </table>
        </div>
        <div id="file_content"></div>
        <script type="text/javascript">
        var vbpages = new Array();
        do_viewvbfile = function(idbaiviet, idfile) {
            $.ajax({
                type: 'GET',
                url: '{{ url("tckh/xembaivietfile") }}?idbaiviet='+idbaiviet+'&idfile='+idfile,
                beforeSend: function() {
                    $('#file_content').html('<img src="{{ Config::get('app.url') . '/' . ('asset/img/loading.png') }}" /> Đang lấy nội dung...');
                },
                error : function() {
                    $('#file_content').html('');
                    bootbox.alert('Lỗi khi thực thi thao tác !!!');
                },
                success: function(response) {
                    $('#file_content').html('');
                    if ( response ) {
                        if ( response.status == 'OK' ) {
                            //var html = '<div class="caption"><h4>Nội dung file: '+response.file+'</h4></div>';
                            var html = '';
                            html += '<div style="border:1px solid #ccc;">';
                            html += '<div style="background-color: #f2f2f2;padding:10px;border-bottom:1px solid #ccc">'+
                                '<span id="viewer_filename">File: '+response.file+' <b>('+response.data.length+' trang)</b></span>&nbsp;&nbsp;|&nbsp;&nbsp;'+
                                '<a style="color:#000066" href="javascript:;" onclick="do_zoom_image(\'+\')"><img src="'+wwwroot+'/asset/img/zoom-in.png" align="absmiddle" /> Phóng to</a>'+
                                '&nbsp;&nbsp;<a style="color:#000066" href="javascript:;" onclick="do_zoom_image(\'-\')"><img src="'+wwwroot+'/asset/img/zoom-out.png" align="absmiddle" /> Thu nhỏ</a>'+
                                '</div>';
                            html += '<div style="width:100%;height:600px;overflow: auto;background-color: #f9f9f9;position:relative;" id="vbimagefile-container">';
                            for ( i=0; i<response.data.length; i++ ) {
                                var img = '<img id="page-'+(i+1)+'" rel="vbimagefile" class="col-md-14 vbimagefile" src="{{ url('tckh/getfilecontent') }}?idfile='+
                                      idfile+'&filename='+response.data[i].filename+'" />';
                                if ( i == 0 ) {
                                    /* trang dau tien */
                                    html += img;
                                }
                                else {
                                    // cac trang tiep theo ko can load -> ghi nhan lai de load sau
                                    vbpages.push(img);
                                }
                            }
                            html += '</div></div>';
                            $('#file_content').html(html);
                            do_fit_images();

                            /* add handle to show when visible */
                            $('#vbimagefile-container').scroll(function() {
                                if($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight - 100) {
                                    // load trang ke tiep
                                    if ( vbpages && vbpages.length > 0 ) {
                                        $(this).append(vbpages[0]);

        								// chinh cho = kich thuoc voi page-1
        								var page1 = $('#page-1');
        								do_adjust_page_size(page1.width(), page1.height());

                                        vbpages.splice(0,1);
                                    }
                                }
                            });
                        }
                        else {
                            bootbox.alert(response.message);
                        }
                    }
                    else {
                        bootbox.alert('Không có thông tin phản hồi từ máy chủ !!!');
                    }
                },
                dataType : 'json'
            });
        };
        do_adjust_page_size = function(w,h) {
        	var imgs = $('img[rel="vbimagefile"]');
        	for ( i=0; i<imgs.length; i++ ) {
        		var img = $(imgs[i]);
        		img.animate({
                        'width':w+'px',
                        'height':h+'px'
                        },
                        {
                            duration:300
                        }
                    );
        	}
        };
        do_zoom_image = function(type) {
            var scale_fx = 50;
            var imgs = $('img[rel="vbimagefile"]');
            var p_width = $('#vbimagefile-container').width();

            for ( i=0; i<imgs.length; i++ ) {
                var img = $(imgs[i]);

                width =  img.css('width').replace('px','');
                height =  img.css('height').replace('px','');
                left = 0;
                top = 0;

                if ( type == '+') {
                    new_width = (parseFloat(width) + scale_fx)+'px';
                    new_height = (parseFloat(height) + scale_fx)+'px';
                }
                else if ( type == '-' ) {
                    new_width = (parseFloat(width) - scale_fx)+'px';
                    new_height = (parseFloat(height) - scale_fx)+'px';
                }
                else if ( type == '*' ) {
                    do_fit_images();
                }

                if ( type != '*' ) {
                    img.animate({
                        'width':new_width,
                        'height':new_height
                        },
                        {
                            duration:300
                        }
                    );
                }
            }
        };
        do_fit_images = function() {
            var imgs = $('img[rel="vbimagefile"]');
            var p_width = $('#vbimagefile-container').width()-20;

            for ( i=0; i<imgs.length; i++ ) {
                var img = $(imgs[i]);

                img.css('width', p_width+'px');
            }
        };

        do_viewvbfile({{$baivietinfo->id}}, {{$vb_files[0]->id}});

        </script>
    </div>

    <div>&nbsp;</div>
		@if ( count($list_baiviet_khac) > 0 )
    <div style="padding:10px">
        <div class="tckh_nhombaiviet">Các bài viết khác trong tạp chí số {{$sotapchiinfo->sotapchi}} năm {{$sotapchiinfo->namtapchi}}</div>
        <div>
            @foreach ( $list_baiviet_khac as $baiviet )
            <div class="tckh_row" style="padding: 5px"><a href="{{url('tckh/xembaiviet?id='.$baiviet->id)}}">{{$baiviet->tenbaiviet}}</a></div>
            @endforeach
        </div>
    </div>
		@endif
</div>

@stop