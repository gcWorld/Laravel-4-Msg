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
	<div class="form-group {{ $errors->first('to','has-error') }}">
		<label class="control-label" for="to">{{{ Lang::get('msg::general.to') }}}</label><br>
		<input type="text" class="typeahead form-control " name="to" id="to" value="{{{ Input::old('to', isset($msg) ? is_null($msg->recipient) ? "" : $msg->recipient->username : null) }}}" />
	</div>
	<div class="form-group {{ $errors->first('subject','has-error') }}">
		<label class="control-label" for="subject">{{{ Lang::get('msg::general.subject') }}}</label>
		<input type="text" class="form-control" name="subject" id="subject" value="{{{ Input::old('subject', isset($msg) ? substr($msg->subject, 0, 3) != "Re:" ? "Re: ".$msg->subject : $msg->subject : null) }}}"/>
	</div>
	<div class="form-group {{ $errors->first('message','has-error') }}">
		<label class="control-label" for="message">{{{ Lang::get('msg::general.message') }}}</label>
		<textarea type="text" class="form-control" name="message" id="message" rows="7">{{{ Input::old('message') }}}</textarea>
	</div>
	<input type="submit" value="Create" class="btn btn-primary" />
	<a href="{{ action('MsgsController@index') }}" class="btn btn-link">Cancel</a>
</form>
<br>
@if(isset($msg))
<div class="panel panel-success">
	<div class="panel-heading">
		<small class="pull-right">{{{ $msg->date_normal() }}}</small>
    	<h3 class="panel-title">'{{{ $msg->subject }}}' {{{ Lang::get('msg::general.from2') }}} {{{isset($msg->author) ? $msg->author->username : Lang::get('msg::general.deleted_user')}}}</h3>
  	</div>
  	<div class="panel-body">
		{{ $msg->message }}
	</div>
</div>
@endif
@stop

@section('bottom_line')
<script>
$('.typeahead').typeahead({                                
  name: 'usernames',                                                          
  prefetch: "{{ action('MsgsController@data') }}",                                         
  limit: 10                                                                   
});
$('#message').wysihtml5();
</script>
@stop