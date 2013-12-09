<?php

class MsgsController extends BaseController
{


	public function index()
	{
		//show a listing of msgs
		$msgs = User::find(Auth::user()->id)->messages()->orderBy('created_at','DESC')->get();
		return View::make('msg::index_inbox', compact('msgs'));
	}

	public function index_outbox() 
	{
		//show a listing of outbox msgs
		$msgs = User::find(Auth::user()->id)->sentmessages;
		return View::make('msg::index_outbox', compact('msgs'));
	}

	public function create()
	{
		//show the new msg form
		return View::make('msg::new_msg');

	}

	public function handleCreate()
	{
		//handle new msg form submission
	}

	public function delete(Msg $msg)
	{
		//show delete confirmation page
		return View::make('msg::delete');

	}

	public function handleDelete()
	{
		// handle delete confirmation
	}
}