@extends( 'layout/default-layout' )

@section('view_content')
<table class="table table-bordered responsive-table">
	<thead>
		<tr>
			<th>#</th>
			<th>Tên trang</th>
			<th>Tiêu đề trang</th>
			<th>&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach ( $pages as $page ) {
		?>
		<tr>
			<td>{{ $page->id }}</td>
			<td><a target="_blank" href="{{ url('pages/view/'.$page->pagetitle_seo) }}">{{ $page->pagename }}</a></td>
			<td>{{ $page->pagetitle }}</td>
			<td>
				<input class="btn btn-primary btn-flat btn-rect" type="button" value="Chọn" data-dismiss="modal" onclick="menu_do_choice_page('{{ cUtils::base64_encode_safe("pages/view/".$page->pagetitle_seo) }}')" />
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>
<script type="text/javascript">
$(function() {
	menu_do_choice_page = function(url) {
		$('#txtLink').val(base64_decode_safe(url));
	};
});
</script>
@stop