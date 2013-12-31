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
		<a href="{{ action('MsgsController@delete', $msg->id) }}" class="btn btn-danger pull-right">{{ Lang::get('msg::general.delete') }}</a>&nbsp;
		<a href="{{ action('MsgsController@reply', $msg->id) }}" class="btn btn-primary pull-right mag-right">{{ Lang::get('msg::general.reply') }}</a>
	</div>
@stop