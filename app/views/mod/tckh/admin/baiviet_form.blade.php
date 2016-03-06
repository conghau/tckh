@extends('layout/default-layout')
<?php
    $page_title = 'Thêm bài viết cho số tạp chí';
    $form_action = 'tckh/thembaiviet?idsotapchi='.Input::get('idsotapchi');
    if ( isset($baivietinfo) && $baivietinfo ) {
        $page_title = 'Sửa thông tin bài viết trên số tạp chí';
        $form_action = 'tckh/suabaiviet?idsotapchi='.Input::get('idsotapchi').'&idbaiviet='.$baivietinfo->id;
    }
?>
@section('view_content')
{{
    SystemController::breadcrumb(array(
        array(
            'url' => 'tckh',
            'title' => 'Quản lý tạp chí khoa học',
            'active' => false
        ),
        array(
            'url' => '',
            'title' => $page_title,
            'active' => true
        ),
    ))
}}
<link rel="stylesheet" href="{{ Config::get('app.url') . '/' . ('asset/css/autocomplete.css') }}" type="text/css" media="screen" />
<script type="text/javascript" src="{{ Config::get('app.url') . '/' . ('asset/js/jquery.autocomplete.min.js') }}"></script>

<div class="col-md-9">
    <div class="block block-drop-shadow">

        <div class="head bg-default bg-light-ltr">
            <h2>{{ $page_title }}</h2>
        </div>

        <div class="content">
            {{ Form::open(array('url' => $form_action, 'id' => 'form_baiviet_tapchi', 'onsubmit' => 'return check_baiviet_tapchi_form();')) }}
            <table class="mform">
                <tr>
                    <td width="120" >Nhóm bài viết:</td>
                    <td>
                        <input type="text" class="form-control" maxlength="200" name="txtNhomBaiViet" id="txtNhomBaiViet" value="{{ @$baivietinfo->nhombaiviet }}" />
                        <script type="text/javascript">
                        var lst_nhombaiviet = [
                            @foreach ( $list_nhombaiviet as $nhom )
                            { value: '{{ $nhom->tennhombaiviet }}', data: '{{ $nhom->tennhombaiviet }}' },
                            @endforeach
                        ];
                        $('#txtNhomBaiViet').autocomplete({
                            lookup: lst_nhombaiviet
                        });
                        </script>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Tên bài viết:</td>
                    <td>
                        <textarea rows="2" class="form-control" name="txtTenBaiViet" id="txtTenBaiViet" maxlength="1000">{{ @$baivietinfo->tenbaiviet }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Giới thiệu bài viết:</td>
                    <td>
                        <textarea rows="3" class="form-control" name="txtGioiThieu" id="txtGioiThieu" maxlength="1000">{{ @$baivietinfo->gioithieubaiviet }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Tác giả:</td>
                    <td id="tacgia_panel">
                        <div style="padding-bottom:10px"><a href="javascript:;" class="btn btn-default" onclick="doTCKH_add_more_tacgia()">Thêm tác giả</a></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <button type="submit" class="btn btn-primary">Lưu thông tin bài viết</button>
                        <input type="hidden" name="do_save" id="do_save" value="1" />
                    </td>
                </tr>
            </table>
            {{ Form::close() }}
            <script type="text/javascript">
            check_baiviet_tapchi_form = function() {
                if ( $('#txtTenBaiViet').val() == '' ) {
                    bootbox.alert('Chưa nhập tên bài viết !!!');
                    $('#txtTenBaiViet').focus();
                    return false;
                }
                return true;
            };
            doTCKH_add_more_tacgia = function(tentacgia) {
                if ( typeof tentacgia == 'undefined' ) tentacgia = '';

                var control = '<div style="padding-bottom:5px;"><input type="text" class="form-control" id="txtTacGia[]" name="txtTacGia[]" maxlength="50" size="50" value="'+tentacgia+'" /></div>';
                $('#tacgia_panel').append($(control));
            };

            <?php
            if ( isset($baivietinfo) && $baivietinfo ) {
                if ( $baivietinfo->tacgia != '' ) {
                    $tacgia = json_decode($baivietinfo->tacgia);
                    if ( $tacgia && count($tacgia) > 0 ) {
                        foreach ( $tacgia as $tg ) {
                            if ( $tg != '' ) {
                                print 'doTCKH_add_more_tacgia("'.$tg.'");';
                            }
                        }
                    }
                }
            }
            ?>
            doTCKH_add_more_tacgia();
            </script>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="block block-drop-shadow">

        <div class="head bg-default bg-light">
            <h2>Thông tin số tạp chí</h2>
        </div>

        <div class="content content-transparent np">
            <div class="list list-contacts">
                <a class="list-item" href="#">
                    <div class="list-text">Số: {{$sotapchiinfo->sotapchi}}</div>
                </a>
                <a class="list-item" href="#">
                    <div class="list-text">Năm: {{$sotapchiinfo->namtapchi}}</div>
                </a>
                <a class="list-item" href="#">
                    <div class="list-text">Tên: {{$sotapchiinfo->tentapchi}}</div>
                </a>
            </div>
        </div>
    </div>
</div>

@stop
