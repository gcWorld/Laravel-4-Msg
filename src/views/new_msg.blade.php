@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('msg::general.inbox_title') }}} ::
@parent
@stop

@section('title_content')
{{{ Lang::get('msg::general.new_title') }}}
@stop

{{-- Content --}}
@section('content')
<form action="{{ action('MsgsController@handleCreate') }}" method="post" role="form">
	<input type="hidden" name="_token" value="{{{ Session::getToken() }}}" />
	<div class="form-group">
		<label for="to">{{{ Lang::get('msg::general.to') }}}</label>
		<input type="text" class="form-control" name="to" id="to" />
	</div>
	<div class="form-group">
		<label for="subject">{{{ Lang::get('msg::general.subject') }}}</label>
		<input type="text" class="form-control" name="subject" id="subject"/> 
	</div>
	<div class="form-group">
		<label for="message">{{{ Lang::get('msg::general.message') }}}</label>
		<textarea type="text" class="form-control wysihtml5" name="message" id="message" rows="7"></textarea>
	</div>
	<input type="submit" value="Create" class="btn btn-primary" />
	<a href="{{ action('MsgsController@index') }}" class="btn btn-link">Cancel</a>
</form>
@stop

@section('bottom_line')

@stop