<!--@extends( 'layout/default-layout' )-->

@section('main_content')
<?php
//    $is_popup = '';
//    if ( Input::has('popup') ) $is_popup = '?popup=true';
//        $form_action = 'permission/create'.$is_popup;
//    if ( isset($permission_info) && $permission_info ) {
//        $form_action = 'permission/edit/'.$permission_info->id.$is_popup;
//    }
//?>
<script type="text/javascript" src="{{ Config::get('app.url') . '/' . ('asset/js/bootstrap-datetimepicker.js') }}"></script>

<div class="block block-drop-shadow">
    <div class="head bg-default bg-light-ltr">
        <h2>Phân công chấm bài</h2>
    </div>

    <div style="clear:both"></div>

    <div class="form-phancong">
        {{ Form::open(array('url' => '#', 'id' => 'popup-validation')) }}

        <?php if ( Session::has('message') ) { ?>
            <div class="alert alert-danger" role="alert"><?php echo Session::get('message') ?></div>
            <?php Session::forget('message'); ?>
        <?php } ?>

        <!-- will be used to show any messages -->
        <div style="clear:both"></div>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div class="form-group">
            <label for="inputPermissionName"><h3>Tên bài báo</h3></label>
            {{ @$baivietinfo->tenbaiviet }}
        </div>

        <div class="form-group">
            <label for="txtDSPhanBien"><h3>Danh sách người chấm bài:</h3></label>
            <br>
            <div class="input-group input-nguoichambai">
                <?php
                $count = 0;
                foreach ($dspb as $nguoiphanbien) { ?>
                    <input type="checkbox" class="form-control" id="txtDSPhanBien-{{@$count}}" name="txtDSPhanBien[]" value="{{ @$nguoiphanbien->id }}"> {{ $nguoiphanbien->username }}
                <?php } ?>
            </div>

        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="txtNgayBatDau">Ngày bắt đầu chấm bài:</label>
                <input type="text" class="form-control" id="inputModName" name="inputModName" placeholder="Khu vực quản lý" value="{{ @$permission_info->mod_name }}">
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group date" id="datetimepicker1">
                        <input type="text" class="form-control">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    dateFormat: 'dd-mm-yy',
                    minDate: getFormattedDate(new Date())
                });
            })
        </script>
        </div>
        <input type="hidden" name="do_save" id="do_save" value="1" />
        <button type="submit" class="btn btn-primary">Submit</button>

        <div style="clear:both"></div>
        {{ Form::close() }}
    </div>
</div>

@stop
