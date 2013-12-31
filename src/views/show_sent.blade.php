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
	<small class=""><i class="icon-user"></i> <span class="muted">{{ is_null($msg->recipient) ? Lang::get('msg::general.deleted_user') : $msg->recipient->username }}</span>
					| <i class="icon-calendar"></i> <!--Sept 16th, 2012-->{{{ $msg->date() }}}
	</small>
	<p>{{ $msg->content() }}</p>
	<div class="clearfix">
		<br>
		<small><a href="{{ action('MsgsController@index_outbox') }}" class="btn btn-primary btn-xs">{{ Lang::get('msg::general.back') }}</a></small>
	</div>
@stop