<?php

/**
 * Created by PhpStorm.
 * User: n_ikeda
 * Date: 2015/02/04
 * Time: 18:28
 * @version 1.0
 */
class Controller_Management_User extends Controller_Base_Template
{
	/**
	 * 一覧表示/検索
	 *
	 * @return void
	 */
	public function get_index()
	{
		$data['users'] = Model_User::find('all');
		$this->template->content = View::forge('management/user/index', $data);
	}

	/**
	 * 新規入力
	 *
	 * @return void
	 */
	public function get_create()
	{
		$form = Controller_Form_User::forge('management/user');
		$form->for_create();
		$this->template->content = View::forge('management/user/create');
	}

	/**
	 * 新規登録
	 *
	 * @return void
	 */
	public function post_create()
	{
		// CSRF対策
		if ( ! Security::check_token())
		{
			throw new HttpNotFoundException;
		}

		// Form生成
		$form = Controller_Form_User::forge('management/user');
		$form->for_create();

		// バリデーションチェック
		if ($form->validation()->run())
		{
			// フォームデータ取得
			$form_data = $form->to_model();

			// ユーザ登録
			// TODO : グループを変更する場合はフォームに定義すること
			$id = Auth::create_user($form_data['email'], $form_data['password'], $form_data['email'], Model_Group::ADMIN);

			// ユーザ登録失敗時はエラー
			if ( ! $id)
			{
				Session::set_flash('error_message', 'アカウント情報の登録に失敗しました。');
				return Response::redirect('management/user');
			}

			// SimpleAuthで登録できないデータの登録(更新)
			$user = Model_User::find($id);
			$user->corp_id = $form_data['corp_id'];
			$user->person = $form_data['person'];
			$user->save();

			Session::set_flash('info_message', 'アカウント情報を登録しました。 #'.$user->id);
			return Response::redirect('management/user');
		}
		else
		{
			$form->repopulate();
			Session::set_flash('error_message', $form->show_errors());
			$this->template->content = View::forge('management/user/create');
			return;
		}

	}

	/**
	 * 編集入力
	 *
	 * @return void
	 */
	public function get_update($id)
	{
		$form = Controller_Form_User::forge('management/user');
		$form->for_update();

		$user = Model_User::find($id);

		// ユーザが存在しない場合はエラー
		if ( ! $user)
		{
			Session::set_flash('error_message', '対象のデータが見つかりませんでした。');

			return Response::redirect('management/user');
		}

		$form->from_model($user);

		$this->template->content = View::forge('management/user/update');
	}

	/**
	 * 編集登録
	 *
	 * @return void
	 */
	public function post_update()
	{
		// CSRF対策
		if ( ! Security::check_token())
		{
			throw new HttpNotFoundException;
		}

		// コンテンツセット
		$this->template->content = View::forge('management/user/update');

		// Form生成
		$form = Controller_Form_User::forge('management/user');
		$form->for_update();

		if ('1' != Input::post('change_password')[0])
		{
			$form->delete_change_password_rules();
		}

		// バリデーションチェック
		if ($form->validation()->run())
		{
			// フォームデータ取得
			$form_data = $form->to_model();

			// パスワード変更がある場合は旧パスワードと新パスワードを取得
			if ($form_data['change_password'])
			{
				if ( ! Auth::change_password($form_data['old_password'],$form_data['new_password'], $form_data['username']))
				{
					Session::set_flash('error_message', '現在のパスワードが一致しません。');
					$form->repopulate();
					return;
				}
			}

			// ユーザ更新
			Auth::update_user(['email' => $form_data['email']], $form_data['username']);
			$user = Model_User::find($form_data['id']);

			// SimpleAuthで登録できないデータの登録(更新)
			$user->username = $form_data['email'];
			$user->corp_id = $form_data['corp_id'];
			$user->person = $form_data['person'];
			$user->save();

			Session::set_flash('info_message', 'アカウント情報を更新しました。 #'.$user->id);
			return Response::redirect('management/user');
		}
		else
		{
			$form->repopulate();
			Session::set_flash('error_message', $form->show_errors());
			// コンテンツセット
			$this->template->content = View::forge('management/user/update');
			return;
		}
	}

	/**
	 * 削除登録
	 *
	 * @return void
	 */
	public function get_delete($id)
	{
		$user = Model_User::find($id);

		// ユーザが存在しない場合はエラー
		if ( ! $user)
		{
			Session::set_flash('error_message', '対象のデータが見つかりませんでした。');
			return Response::redirect('management/user');
		}

		$random = $this->_make_rand_mail();
		$user->username = $random;
		$user->email = $random;
		$user->delete();

		return Response::redirect('management/user');
	}

	/**
	 * ランダム文字列生成 (英数字)
	 * $length: 生成する文字数
	 */
	private function _make_rand_mail($length = 30)
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
		$user = '';
		for ($i = 0; $i < $length; ++$i)
		{
			$user .= $chars[mt_rand(0, 61)];
		}

		return $user.'@deleted.user';
	}
}
