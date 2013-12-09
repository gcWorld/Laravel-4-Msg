@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('msg::general.show_title') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
	<h2 class="title"><i class="icon-chevron-right green"></i> {{{ $msg->subject }}}</h2>
	<small class=""><i class="icon-user"></i> <span class="muted">{{{ $msg->author->username }}}</span>
					| <i class="icon-calendar"></i> <!--Sept 16th, 2012-->{{{ $msg->date() }}}
	</small>
	<p>{{ $msg->content() }}</p>
	<div class="clearfix">
		<a href="{{ action('MsgsController@delete', $msg->id) }}" class="btn btn-danger pull-right">{{ Lang::get('msg::general.delete') }}</a>&nbsp;
		<a href="{{ action('MsgsController@reply', $msg->id) }}" class="btn btn-primary pull-right">{{ Lang::get('msg::general.reply') }}</a>
	</div>
@stop