@extends('layout/default-layout')

@section('view_content')
<link rel="stylesheet" href="{{ Config::get('app.url') . '/' . ('asset/js/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" type="text/css" media="screen" />
<script type="text/javascript" src="{{ Config::get('app.url') . '/' . ('asset/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

	<div class="headline">
	    <h3 class="clr-o">Hệ thống / Xem Logs hoạt động (Guest - chưa đăng nhập)</h3>
	</div>

    <div>&nbsp;</div>
    <div class="form-group">

        <div class="input-group">
            <div class="input-group-addon">Từ ngày:</div>
            <input type="text" class="form-control" data-date-format="DD/MM/YYYY" name="txtTuNgay" id="txtTuNgay" value="{{ Input::get('tungay') }}" placeholder="dd/MM/yyyy" size="50" />
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
            </span>

            <div class="input-group-addon">Đến ngày:</div>
            <input type="text" class="form-control" data-date-format="DD/MM/YYYY" name="txtDenNgay" id="txtDenNgay" value="{{ Input::get('denngay') }}" placeholder="dd/MM/yyyy" size="50" />
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <div>&nbsp;</div>
        <div class="input-group">
            <div class="input-group-addon">Nội dung tìm:</div>
            <input type="text" class="form-control" name="txtKW" id="txtKW" value="{{ Input::get('kw') }}" placeholder="Tìm theo 'Request username'" size="50" />
        </div>
        <div>&nbsp;</div>
        <a class="btn btn-primary" href="javascript:;" onclick="do_search_guestrequestlogs()">Xem logs &raquo;</a>
        <script type="text/javascript">
            $(function() {
                $('#txtTuNgay').datetimepicker({
                    pickTime: false
                });
                $('#txtDenNgay').datetimepicker({
                    pickTime: false
                });
            });
            do_search_guestrequestlogs = function() {
                self.location.href = '{{ url("system/guestrequestlog") }}?kw='+$('#txtKW').val()+'&tungay='+$('#txtTuNgay').val()+'&denngay='+$('#txtDenNgay').val();
            };
            $('#txtKW').keypress(function( event ) {
                if ( event.which == 13 ) {
                    do_search_guestrequestlogs();
                    event.preventDefault();
                }
            });
        </script>
    </div>

    <div align="right">
        <a class="btn btn-danger" href="javascript:;" onclick="do_delete_all_logs()">Xóa tất cả logs</a>
    </div>
    <div>&nbsp;</div>
	<table class="table table-bordered responsive-table">
	  <thead>
		<tr>
		  <th>STT</th>
		  <th>UserID</th>
		  <th><span class="caret"><sup>(2)</sup></span>&nbsp;&nbsp;&nbsp;Username</th>
		  <th>Client info</th>
		  <th>Http referer</th>
		  <th>Http request</th>
		  <th><span class="caret"><sup>(1)</sup></span>&nbsp;&nbsp;&nbsp;Ngày</th>
		</tr>
	  </thead>
	  <tbody>		
		<?php
		    $pageno = Input::get('page');
            if ( !$pageno || intval($pageno) == 0 ) $pageno = 1;

            $stt = ($pageno-1) * $list_logs->getPerPage() + 1;
			foreach ( $list_logs as $log ) {
			    $referer = strlen($log->http_referer) > 70 ?
                    '<a href="#" data-toggle="tooltip" data-placement="top" data-original-title="'.$log->http_referer.'">' . substr($log->http_referer,0,70) . '...</a>' :
                    $log->http_referer;
                $request = strlen($log->http_request) > 70 ?
                    '<a href="#" data-toggle="tooltip" data-placement="top" data-original-title="'.$log->http_request.'">' . substr($log->http_request,0,70) . '...</a>' :
                    $log->http_request;
		?>
		<tr>
            <td>{{ $stt++ }}</td>
            <td>{{ $log->user_id }}</td>
            <td>{{ $log->username }}</td>
            <td>{{ $log->client_ip }}</td>
            <td>{{ $referer }}</td>
            <td>{{ $request }}</td>
            <td>{{ date('d/m/Y H:i:s', $log->created_at_unix) }}</td>
		</tr>
		<?php } ?>		
	  </tbody>
	</table>
	<div>
        <?php
            $pager = $list_logs->appends(Input::except(array('page')))->links();
            if ( $pager != '' ) {
                print '<label class="pager_desc"><span>Có: '.$list_logs->getTotal().' mẫu tin ('.
                    $list_logs->getLastPage().' trang)</span> | Trang: </label>' . $pager;
            }
        ?>
    </div>
	<script type="text/javascript">
    do_delete_all_logs = function() {
        bootbox.confirm('Bạn có chắc là muốn xóa tất cả Guest Logs không ?', function(result) {
            if ( result ) {
                self.location.href = "{{ url('system/deleteallguestrequestlog') }}";
            }
        });
    };
	</script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
@stop
