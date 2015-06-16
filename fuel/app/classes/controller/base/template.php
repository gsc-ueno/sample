<?php

/**
 * Created by PhpStorm.
 * User: n_ikeda
 * Date: 2015/02/04
 * Time: 18:26
 */
class Controller_Base_Template extends Controller_Template
{
	use Controller_Base_Layout;

	public function before()
	{
		parent::before();

		// current_userセット
		$this->current_user = null;
		if (Auth::check())
		{
			$this->current_user = Model_User::find_by_username(Auth::get_screen_name());
		}

		View::set_global('current_user', $this->current_user);
	}

	public function after($response)
	{
		if ($this->template)
		{
			$this->layout($this->template);
		}

		return parent::after($response);
	}
}