<?php

class Controller_Management_Corp extends Controller_Base_Template
{
	/**
	 * 一覧表示/検索
	 *
	 * @return void
	 */
	public function get_index()
	{
		$data['corps'] = Model_Corp::find('all');
		$this->template->content = View::forge('management/corp/index', $data);
	}

	/**
	 * 新規入力
	 *
	 * @return void
	 */
	public function get_create()
	{
		$form = Fieldset::forge('management/corp/create');
		$form->add_model('Model_Corp');
		$this->template->content = View::forge('management/corp/create');
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
		$form = Fieldset::forge('management/corp/create');
		$form->add_model('Model_Corp');

		// バリデーションチェック
		if ($form->validation()->run())
		{
			$corp = Model_Corp::forge($form->validated());
			$corp->save();
			Session::set_flash('info_message', '会社情報を登録しました。 #'.$corp->id);
			return Response::redirect('management/corp');
		}
		else
		{
			$form->repopulate();
			Session::set_flash('error_message', $form->show_errors());
			// コンテンツセット
			$this->template->content = View::forge('management/corp/create');
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
		$corp = Model_Corp::find($id);

		if ( ! $corp)
		{
			Session::set_flash('error_message', '対象のデータが見つかりませんでした。');
			return Response::redirect('management/corp');
		}

		$form = Fieldset::forge('management/corp/update');
		$form->add_model('Model_Corp');
		$form->add('id')->set_type('hidden');
		$form->populate($corp);
		$this->template->content = View::forge('management/corp/update');
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

		// Form生成
		$form = Fieldset::forge('management/corp/update');
		$form->add_model('Model_Corp');
		$form->add('id')->set_type('hidden');
		// バリデーションチェック
		if ($form->validation()->run())
		{
			$corp = Model_Corp::find($form->validated()['id']);
			$corp->name = $form->validated()['name'];
			$corp->save();
			Session::set_flash('info_message', '会社情報を更新しました。 #'.$corp->id);
			return Response::redirect('management/corp');
		}
		else
		{
			$form->repopulate();
			Session::set_flash('error_message', $form->show_errors());
			// コンテンツセット
			$this->template->content = View::forge('management/corp/update');
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
		$corp = Model_Corp::find($id);

		if ( ! $corp)
		{
			Session::set_flash('error_message', '対象のデータが見つかりませんでした。');
			return Response::redirect('management/corp');
		}
		$corp->delete();

		Session::set_flash('info_message', '会社情報を削除しました。 #'.$id);
		return Response::redirect('management/corp');
	}
}
