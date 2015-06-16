<?php

/**
 * Created by PhpStorm.
 * User: n_ikeda
 * Date: 2015/02/04
 * Time: 18:28
 */
class Controller_Login extends Controller_Base_Template
{
	/**
	 * 共通ログイン
	 *
	 * @return void
	 */
	public function get_index()
	{

		if (Auth::check())
		{
			// TODO:redirect top page
			if (Auth::member(Model_Group::ADMIN))
			{
				return Response::redirect('admin/top');
			}
			Auth::logout();
		}

		$this->template->content = View::forge('login/index');
	}

	/**
	 * 共通ログイン(認証)
	 *
	 * @return void
	 */
	public function post_index()
	{
		$val = Validation::forge();

		$val->add('username', 'メールアドレス')
			->add_rule('required')
			->add_rule('max_length', 50);
		$val->add('password', 'パスワード')
			->add_rule('required')
			->add_rule('max_length', 20);

		if ($val->run())
		{
			$auth = Auth::instance();

			// ログイン認証
			if (Auth::check() or $auth->login(Input::post('username'), Input::post('password')))
			{

				if (Auth::member(Model_Group::ADMIN))
				{
					return Response::redirect('admin/top');
				}
			}
			else
			{
				Session::set_flash('error_message', 'メールアドレスまたはパスワードが正しくありません。');
			}
		}
		else
		{
			Session::set_flash('error_message', $val->show_errors());
		}

		$this->template->content = View::forge('login/index');
	}

	public function get_logout()
	{
		Auth::logout();
		return Response::redirect('login');
	}

	public function action_403()
	{
		$this->template->content = View::forge('common/403');
	}

	public function action_404()
	{
		$this->template->content = View::forge('common/404');
	}

	public function action_503()
	{
		$this->template->content = View::forge('common/503');
	}
}