@extends('layout/default-layout')

@section('view_content')
<script type="text/javascript" src="{{ Config::get('app.url') . '/' . ('asset/js/js_plupload/plupload.full.min.js') }}"></script>

<link rel="stylesheet" type="text/css" href="{{ Config::get('app.url') . '/' . ('asset/js/js_plupload/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" media="screen" />
<script type="text/javascript" src="{{ Config::get('app.url') . '/' . ('asset/js/js_plupload/jquery.plupload.queue/jquery.plupload.queue.js') }}"></script>

{{
    SystemController::breadcrumb(array(
        array(
            'url' => 'tckh',
            'title' => 'Danh sách số tạp chí',
            'active' => false
        ),
        array(
            'url' => 'tckh/dsbaiviet?idsotapchi='.$baivietinfo->id_sotapchi,
            'title' => 'Danh sách bài viết',
            'active' => false
        ),
        array(
            'url' => '',
            'title' => 'Upload file bài viết',
            'active' => true
        ),
    ))
}}

<div class="col-md-8">
    <div class="block block-drop-shadow">

        <div class="head bg-default bg-light-ltr">
            <h2>Upload File bài viết tạp chí (PDF files)</h2>
        </div>

        <div class="content">
            <div id="flash_uploader" style="height: 230px;">You browser doesn't have Flash installed.</div>
            <script type="text/javascript">
            	var plupload_list_exists_files = new Array();
                <?php
                /* plupload_list_exists_files: global variable su dung cho plupload */
                if ( $bvfiles && count($bvfiles) > 0 ) {
                    print 'var plupload_list_exists_files = new Array();';
                    foreach ( $bvfiles as $file ) {
                        if ( $file->tmp == 1 ) continue;
                        if ( $file->deleted == 1 ) continue;

                        $fi = cUtils::split_filepath($file->file_path);

                        print 'plupload_list_exists_files.push({id : "o_'.md5($file->id).'",server_file_id: "'.
                            $file->id.'",name: "'.$fi['base_filename'].'",size: '.$file->file_size.'});';
                    }
                }
                else {
                    print 'var plupload_list_exists_files = new Array();';
                }
                ?>

            	doDeleteVBFile = function(file_id, file_panel_id) {
            	    bootbox.confirm('Bạn có chắc là muốn xoá file văn bản này không?', function(result) {
            	        if ( result ) {
            	            $.ajax({
                                url: '{{ url("tckh/dodelbaivietfile") }}?idfile='+file_id,
                                type: 'GET',
                                beforeSend: function() {
                                },
                                error: function() {
                                    bootbox.alert('Lỗi khi xóa file !!!');
                                },
                                success: function(response) {
                                    if ( response.status == 'SUCCESS' ) {
                                        $('#'+file_panel_id).remove();

                                        var tmp = new Array();
                                        for ( i=0; i<plupload_list_exists_files.length; i++ ) {
                                            if ( plupload_list_exists_files[i].server_file_id == file_id ) {
                                            }
                                            else {
                                                tmp.push(plupload_list_exists_files[i]);
                                            }
                                        }
                                        plupload_list_exists_files = tmp;
                                    }
                                    else {
                                        bootbox.alert(response.message);
                                    }
                                },
                                dataType: 'json'
                            });
            	        }
            	    });
            	};

                var vb_uploader = $("#flash_uploader").pluploadQueue({
                    // General settings
                    runtimes : 'html5,flash,silverlight,html4',
                    url : '{{ url("tckh/douploadbaiviet?idbaiviet=".$baivietinfo->id) }}',
                    // my custom
                    fnDeleteFileFromServer: 'doDeleteVBFile',
                    // Maximum file size
                    max_file_size : '50mb',
                    chunk_size: '1mb',

                    unique_names : false,
                    // Resize images on clientside if we can
                    /*resize : {
                        width : 200,
                        height : 200,
                        quality : 90,
                        crop: true // crop to exact dimensions
                    },*/

                    // Specify what files to browse for
                    filters : [
                        {title : "Image files", extensions : "jpg,gif,png"},
                        {title : "PDF files", extensions : "pdf"},
                        {title : "Word files", extensions : "doc,docx"},
                    ],

                    // Rename files by clicking on their titles
                    rename: false,
                    // Sort files
                    sortable: true,
                    // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
                    dragdrop: true,

                    // Flash settings
                    flash_swf_url : '{{ Config::get('app.url') . '/' . ('js/js_plupload/Moxie.swf') }}',

                    // Silverlight settings
                    silverlight_xap_url : '{{ Config::get('app.url') . '/' . ('js/js_plupload/Moxie.xap') }}',
                    // Post init events, bound after the internal events
                    init : {
                        FileUploaded: function(up, file, info) {
                            var f = $.parseJSON(info.response);
                            var fileItem = $('#' + file.id);
                            if ( f.error.code != 0 )
                            {
                                file.status = plupload.FAILED;
                            }
                            else {
                                file.server_file_id = f.result.file_id;
                            }
                        },
                        UploadComplete: function(up, files) {
                            // Called when all files are either uploaded or failed
                            up.refresh();
                            $('.plupload_buttons').show();
                            $('.plupload_upload_status').hide();
                        }
                    }
                });

            </script>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="block block-drop-shadow">

        <div class="head bg-default bg-light">
            <h2>Thông tin bài viết</h2>
        </div>

        <div class="content">
            <div class="list list-contacts">
                <a class="list-item" href="#">
                    <div class="list-text">Số tạp chí: {{$baivietinfo->sotapchi}}</div>
                </a>
                <a class="list-item" href="#">
                    <div class="list-text">Năm tạp chí: {{$baivietinfo->namtapchi}}</div>
                </a>
                <a class="list-item" href="#">
                    <div class="list-text">Tên tạp chí: {{$baivietinfo->tentapchi}}</div>
                </a>
                <a class="list-item" href="#">
                    <div class="list-text">Tên bài viết: {{$baivietinfo->tenbaiviet}}</div>
                </a>
                <a class="list-item" href="#">
                    <div class="list-text">Giới thiệu bài viết: {{$baivietinfo->gioithieubaiviet}}</div>
                </a>
                <a class="list-item" href="#">

                    <?php
                    $tg_html = '';
                    if ( $baivietinfo->tacgia != "" )
                    {
                        $list_tacgia = json_decode($baivietinfo->tacgia);
                        if ( $list_tacgia && count($list_tacgia) > 0 ) {
                            foreach ( $list_tacgia as $tg ) {
                                if ( $tg_html == '' ) $tg_html = $tg;
                                else $tg_html .= ', ' . $tg;
                            }
                        }
                    }
                    ?>
                    <div class="list-text">Tác giả: {{$tg_html}}</div>
                </a>
            </div>
        </div>
    </div>
</div>

@stop
