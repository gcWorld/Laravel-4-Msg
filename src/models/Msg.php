<?php

// app/models/Msg.php

class Msg extends Eloquent
{

	public function date()
	{
		$date = $this->created_at;
		$date = date_timestamp_get($date);
        $lang = Config::get('application.language'); 
        $formatted = DateFmt::Format('AGO[t]IF-FAR[d##my H#:s#]', $date, 'de');

        return $formatted;
	}

	public function author()
	{
		return $this->belongsTo('User', 'from');
	}

	public function from()
    {
        return $this->belongsTo('User', 'from');
    }

    public function to()
    {
        return $this->belongsTo('User', 'to');
    }

    public function recipient()
    {
        return $this->belongsTo('User', 'to');
    }

    public function getNewMsg()
    {
    	$count = User::find(Auth::user()->id)->messages()->where('read', '=', 1)->count();
    	return $count;
    }

}