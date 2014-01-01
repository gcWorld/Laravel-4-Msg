@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('msg::general.outbox_title') }}} ::
@parent
@stop

@section('title_content')
{{{ Lang::get('msg::general.outbox_title') }}}
@stop

{{-- Content --}}
@section('content')
@if($msgs->isEmpty())
	<p>{{{ Lang::get('msg::general.no_messages') }}}</p>
@else
	<table id="blogs" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-6">{{{ Lang::get('msg::general.subject') }}}</th>
				<th class="col-md-2">{{{ Lang::get('msg::general.to') }}}</th>
				<th class="col-md-2">{{{ Lang::get('msg::general.date') }}}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($msgs as $msg)
			<tr>
				<td><a href="{{{ URL::to('msg/show/sent/'.$msg->id) }}}">@if(!$msg->read) <span class="text-danger"><i class="icon-envelope"></i> {{{ $msg->subject }}}</span>@else {{ $msg->subject }} @endif</a></td>
				<td>{{ is_null($msg->recipient) ? Lang::get('msg::general.deleted_user') : $msg->recipient->username }}</td>
				<td>{{ $msg->date() }}</td
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $msgs->links(); }}
@endif
@stop