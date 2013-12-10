@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('msg::general.inbox_title') }}} ::
@parent
@stop

@section('title_content')
{{{ Lang::get('msg::general.delete') }}}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
<h1>Delete {{ $msg->subject }} <small>Are you sure?</small></h1>
</div>
<form action="{{ action('MsgsController@handleDelete') }}" method="post" role="form">
<input type="hidden" name="msg" value="{{ $msg->id }}" />
<input type="submit" class="btn btn-danger" value="Yes" />
<a href="{{ action('MsgsController@index') }}" class="btn btn-default">Noway!</a> </form>
@stop