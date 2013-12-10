@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('msg::general.inbox_title') }}} ::
@parent
@stop

@section('title_content')
{{{ Lang::get('msg::general.inbox_title') }}}
@stop

{{-- Content --}}
@section('content')
@if($msgs->isEmpty())
	<p>{{{ Lang::get('msg::general.no_messages') }}}</p>
@else
	<table id="blogs" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-4">{{{ Lang::get('msg::general.subject') }}}</th>
				<th class="col-md-2">{{{ Lang::get('msg::general.from') }}}</th>
				<th class="col-md-2">{{{ Lang::get('msg::general.date') }}}</th>
				<th class="col-md-2">{{{ Lang::get('msg::general.actions') }}}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($msgs as $msg)
			<tr>
				<td><a href="{{{ URL::to('msg/show/'.$msg->id) }}}">@if(!$msg->read) <span class="text-danger"><i class="icon-envelope"></i> {{ $msg->subject }}</span>@else {{ $msg->subject }} @endif</a></td>
				<td>{{ $msg->author->username }}</td>
				<td>{{ $msg->date() }}</td>
				<td><a href="#" data-toggle='modal' data-target='#deletepm' data-id='{{ $msg->id }}' class="btn btn-xs btn-danger pmdelete-link">{{ Lang::get('msg::general.delete') }}</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<div class='modal fade' id='deletepm'>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
				    <h3 id='modal-title'>Löschen</h3>
				</div>
				<div class='modal-body'>
					Wirklich Löschen?
					<form id='delete-pm-form' method='post' action="{{ action('MsgsController@handleDelete') }}">
						<input type="hidden" name="_token" value="{{{ Session::getToken() }}}" />
						<input type="hidden" id="delete-pm-id" name="msg" value="" />
					</form>
				</div>
				<div class='modal-footer'>
				    <button class='btn' data-dismiss='modal' aria-hidden='true'>{{{ Lang::get('msg::general.cancel') }}}</button>
				    <button class='btn btn-danger' type='submit' id='pm-delete'>{{{ Lang::get('msg::general.delete') }}}</button>
				</div>
			</div>
		</div>
	</div>
@endif
@stop

@section('bottom_line')
<script type='text/javascript'>
		$('.pmdelete-link').click(function() {
			var pmid = $(this).data('id');
			$('#delete-pm-id').val(pmid);
		});
		$('#pm-delete').click(function() {
			$('#delete-pm-form').submit();
		});
	</script>
@stop