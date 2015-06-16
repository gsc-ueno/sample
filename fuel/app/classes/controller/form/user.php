<?php

class Controller_Form_User extends Fieldset
{
	public function to_model()
	{
		return $this->validated();
	}

	public function for_create()
	{
		$this->_add_common_fields();

		// パスワード
		$this->add('password', 'パスワード')
			->set_type('password')
			->set_attribute('class', 'form-control')
			->add_rule('required')
			->add_rule('min_length', 6)
			->add_rule('max_length', 20);

		// パスワード確認
		$this->add('password_confirm', 'パスワード確認')
			->set_type('password')
			->set_attribute('class', 'form-control')
			->add_rule('required')
			->add_rule('min_length', 6)
			->add_rule('max_length', 20)
			->add_rule('match_field', 'password');

		return $this;
	}

	public function for_update()
	{
		$this->_add_common_fields();

		// username
		$this->add('username', 'username')
			->set_type('hidden');

		// id
		$this->add('id')
			->set_type('hidden');

		$this->add('updated_at')
			->set_type('hidden');

		// パスワード変更
		$this->add('change_password', 'パスワード変更')
			->set_type('checkbox')
			->set_options(['1' => '']);

		// 現在のパスワード
		$this->add('old_password', '現在のパスワード')
			->set_type('password')
			->set_attribute('class', 'form-control')
			->add_rule('required')
			->add_rule('min_length', 6)
			->add_rule('max_length', 20);

		// 新パスワード
		$this->add('new_password', '新パスワード')
			->set_type('password')
			->set_attribute('class', 'form-control')
			->add_rule('required')
			->add_rule('min_length', 6)
			->add_rule('max_length', 20);

		// 新パスワード確認
		$this->add('new_password_confirm', '新パスワード確認')
			->set_type('password')
			->set_attribute('class', 'form-control')
			->add_rule('required')
			->add_rule('min_length', 6)
			->add_rule('max_length', 20)
			->add_rule('match_field', 'new_password');

		return $this;
	}

	private function _add_common_fields()
	{
		$this->validation()->add_callable(new Rules_User_Extension());

		// メールアドレス
		$this->add('email', 'メールアドレス')
			->set_type('text')
			->set_attribute('class', 'form-control')
			->add_rule('trim')
			->add_rule('required')
			->add_rule('max_length', 50)
			->add_rule('valid_email')
			->add_rule('email_already_exists');


		// 会社名
		$this->add('corp_id', '会社名')
			->set_type('select')
			->set_attribute('class', 'form-control')
			->set_options(Model_Corp::create_options());

		// 担当者名
		$this->add('person', '担当者名')
			->set_type('text')
			->set_attribute('class', 'form-control')
			->add_rule('trim')
			->add_rule('required')
			->add_rule('max_length', 255);

		return $this;
	}

	public function delete_change_password_rules()
	{
		if ($this->field('old_password'))
		{
			$this->field('old_password')->delete_rule('required', false)
				->delete_rule('min_length', 6)
				->delete_rule('max_length', 20);
		}

		if ($this->field('new_password'))
		{
			$this->field('new_password')->delete_rule('required', false)
				->delete_rule('min_length', 6)
				->delete_rule('max_length', 20);
		}

		if ($this->field('new_password_confirm'))
		{
			$this->field('new_password_confirm')->delete_rule('required', false)
				->delete_rule('min_length', 6)
				->delete_rule('max_length', 20)
				->delete_rule('match_field', 'new_password');
		}
	}

	public function from_model(Model_User $user)
	{
		$this->populate($user);
	}
}

class Rules_User_Extension
{

	public function _validation_email_already_exists($value)
	{
		if ($value === '')
		{
			return true;
		}

		// 検索条件作成
		$where = ['email' => $value];

		// 編集時は自分自身を除外する
		if (Input::post('id') != null)
		{
			$where += [['id', '!=', Input::post('id')]];
		}

		// 入力されたEmailが既に存在していればエラー
		return ! Model_User::count(['where' => $where]) > 0;
	}
}