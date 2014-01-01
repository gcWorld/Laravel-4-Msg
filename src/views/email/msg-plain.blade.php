Du hast eine neue Nachricht von {{ $author }}:
----------------------------------------------
{{{ $sub }}}

{{{ strip_tags($mess) }}}


{{ URL::to('msg/show/'.$id) }}
