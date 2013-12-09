<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\Confide;
use Zizaco\Confide\ConfideEloquentRepository;
use Zizaco\Entrust\HasRole;
use Robbo\Presenter\PresentableInterface;
use Carbon\Carbon;

class User extends ConfideUser {
	use HasRole;
	protected $table = 'users';

	public function messages()
    {
        return $this->hasMany('Msg', 'to');
    }

    public function sentmessages()
    {
        return $this->hasMany('Msg','from');
    }
}