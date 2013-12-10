Laravel-4-Msg
=============

Requires
--------

* Twitter typeahead.js

Installation
------------

Add to models/User.php:

    //gcWorld/Msg
    public function messages()
    {
        return $this->hasMany('Msg', 'to');
    }

     //gcWorld/Msg
    public function sentmessages()
    {
        return $this->hasMany('Msg','from');
    }

Usage
-----

Display number of unread messages

    {{ Msg::getNewMsg() }}
    
    
