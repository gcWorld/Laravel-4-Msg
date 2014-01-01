@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('msg::general.show_title') }}} ::
@parent
@stop

@section('title_content')
{{{ $msg->subject }}}
@stop

{{-- Content --}}
@section('content')
	<small class=""><i class="icon-user"></i> <span class="muted">{{ is_null($msg->author) ? Lang::get('msg::general.deleted_user') : $msg->author->username }}</span>
					| <i class="icon-calendar"></i> <!--Sept 16th, 2012-->{{{ $msg->date() }}}
	</small>
	<p>{{ $msg->content() }}</p>
	<div class="clearfix">
		<br>
		<small><a href="{{ action('MsgsController@index') }}" class="btn btn-primary btn-xs">{{ Lang::get('msg::general.back') }}</a></small>
		<a href="#" data-toggle='modal' data-target='#deletepm' data-id='{{ $msg->id }}' class="btn btn-danger pull-right pmdelete-link">{{ Lang::get('msg::general.delete') }}</a>&nbsp;
		<a href="{{ action('MsgsController@reply', $msg->id) }}" class="btn btn-primary pull-right mag-right">{{ Lang::get('msg::general.reply') }}</a>
	</div>

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