<?php

use Zizaco\Confide\ConfideRepository;

class MsgsController extends BaseController
{
	/**
     * Post Model
     * @var Post
     */
    protected $msg;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Msg $msg, User $user)
    {
        parent::__construct();

        $this->msg = $msg;
        $this->user = $user;
    }

	public function index()
	{
		//show a listing of msgs
		$msgs = User::find(Auth::user()->id)->messages()->orderBy('created_at','DESC')->get();
		return View::make('msg::index_inbox', compact('msgs'));
	}

	public function index_outbox() 
	{
		//show a listing of outbox msgs
		$msgs = User::find(Auth::user()->id)->sentmessages()->orderBy('created_at','DESC')->get();
		return View::make('msg::index_outbox', compact('msgs'));
	}

	public function getMsg(Msg $msg) 
	{
   		if( (Auth::user()->id)==$msg->to) {
			$msg->read = true;
			$msg->save();
			return View::make('msg::show', compact('msg'));
		} else {
			return App::abort(404);
		}
	}

	public function getSentMsg(Msg $msg) 
	{
		if( (Auth::user()->id)==$msg->from) {
			return View::make('msg::show_sent', compact('msg'));
		} else {
			return App::abort(404);
		}
	}

	public function reply(Msg $msg) 
	{
		return View::make('msg::new_msg', compact('msg'));
	}

	public function create()
	{
		//show the new msg form
		return View::make('msg::new_msg');

	}

	public function handleCreate()
	{
		$rules = array(
            'to'   => 'required|exists:users,username',
            'subject' => 'required|min:3',
            'message' => 'required|min:2'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
			//handle new msg form submission
			$msg = new Msg;
			$msg->subject = Input::get('subject');

			//$user = ConfideRepository->getUserByIdentity( Input::get('to'), $identityColumns = array('username') );
			//$user = User::where('username', '=', Input::get('to'))->first()->get();
			$username = Input::get('to');
			$user = DB::select('select * from users where username = ?', array($username));
			//var_dump($user);die();
			$msg->to = $user[0]->id;

			$msg->from = Auth::user()->id;
			$msg->message = Purifier::clean(Input::get('message'));
			$msg->save();

			return Redirect::action('MsgsController@index')
					->with( 'success', Lang::get('msg::general.alert.msg_send') );
		} else {
			return Redirect::action('MsgsController@create')->withErrors($validator)->withInput();
		}

	}

	public function delete(Msg $msg)
	{
		//show delete confirmation page
		return View::make('msg::delete', compact('msg'));

	}

	public function handleDelete()
	{

		// handle delete confirmation
		$id = Input::get('msg');
		$msg = Msg::findOrFail($id);
		$msg->delete();

		return Redirect::action('MsgsController@index');
	}

	public function data()
	{
		$users = User::query()->lists('username');

		return Response::json($users);
	}
}