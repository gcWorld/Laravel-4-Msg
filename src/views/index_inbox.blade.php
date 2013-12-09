@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('msg::general.inbox_title') }}} ::
@parent
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
				<td>@if(!$msg->read) <span class="text-danger"><i class="icon-envelope"></i> {{ $msg->subject }}</span>@else {{ $msg->subject }} @endif</td>
				<td>{{ $msg->author->username }}</td>
				<td>{{ $msg->date() }}</td>
				<td><a href="{{ action('MsgsController@delete', $msg->id) }}" class="btn btn-xs btn-danger">{{ Lang::get('msg::general.delete') }}</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endif
@stop