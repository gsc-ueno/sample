<?php

use AspectMock\Test as test;

class Test_Controller_Management_User extends \TestCase
{
	public static function setUpBeforeClass()
	{
		// DB初期化
		\Fuel\Core\DBUtil::truncate_table('users');
		\Fuel\Core\DBUtil::truncate_table('corps');
	}

	protected function setUp()
	{
		$input = (new ReflectionClass('Input'))->getProperty('input');
		$input->setAccessible(1);
		$input->setValue(null);

		$_POST = [];
		$_GET = [];
		$_FILES = [];

		$input = (new ReflectionClass('Fieldset'))->getProperty('_instance');
		$input->setAccessible(1);
		$input->setValue(null);

		$input = (new ReflectionClass('Fieldset'))->getProperty('_instances');
		$input->setAccessible(1);
		$input->setValue([]);
	}

	protected function tearDown()
	{
		test::clean(); // 登録したテストダブルをすべて削除
		Auth::logout();
	}

	public static function tearDownAfterClass()
	{
		// DB初期化
		\Fuel\Core\DBUtil::truncate_table('users');
		\Fuel\Core\DBUtil::truncate_table('corps');
	}

	public function test_未ログイン状態で一覧ページにアクセスを行うとログイン画面にリダイレクトされること()
	{
		$method = test::double('Fuel\Core\Response', ['redirect' => true]);

		$request = \Fuel\Core\Request::forge('management/user')->set_method('GET');
		$request->execute()->response();

		$method->verifyInvoked('redirect', ['/login', 'location', 302]);
	}

	public function test_ログイン状態で一覧ページにアクセスを行うと正常に画面遷移ができること()
	{
		// ユーザー作成
		$mail = 'TCMU_T_01@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$user = Model_User::find($id);
		$user->corp_id = 1;
		$user->person = 'TEST_USER';
		$user->save();
		\Auth\Auth::force_login($id);

		$request = \Fuel\Core\Request::forge('management/user')->set_method('GET');
		$response = $request->execute()->response();

		$this->assertEquals(200, $response->status);

		Auth::logout();
	}

	public function test_未ログイン状態で新規登録ページにアクセスを行うとログイン画面にリダイレクトされること()
	{
		$method = test::double('Fuel\Core\Response', ['redirect' => true]);

		$request = \Fuel\Core\Request::forge('management/user/create')->set_method('GET');
		$request->execute()->response();

		$method->verifyInvoked('redirect', ['/login', 'location', 302]);
	}

	public function test_ログイン状態で新規登録ページにアクセスを行うと正常に画面遷移ができること()
	{
		// ユーザー作成
		$mail = 'TCMU_T_02@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$user = Model_User::find($id);
		$user->corp_id = 1;
		$user->person = 'TEST_USER';
		$user->save();
		\Auth\Auth::force_login($id);

		$request = \Fuel\Core\Request::forge('management/user/create')->set_method('GET');
		$response = $request->execute()->response();

		$this->assertEquals(200, $response->status);

		Auth::logout();
	}

	/**
	 * @expectedException HttpNotFoundException
	 */
	public function test_新規登録ページでCRRFチェックが正常に行われ「HttpNotFoundException」がスローされること()
	{
		// ユーザー作成
		$mail = 'TCMU_T_03@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$user = Model_User::find($id);
		$user->corp_id = 1;
		$user->person = 'TEST_USER';
		$user->save();
		\Auth\Auth::force_login($id);

		$request = \Fuel\Core\Request::forge('management/user/create')->set_method('POST');
		$response = $request->execute()->response();

		Auth::logout();
	}

	public function test_新規登録ページで正常にデータの登録を行うと一覧画面に画面遷移ができること()
	{
		$security = test::double('Fuel\Core\Security', ['check_token' => true]);
		$redirect = test::double('Fuel\Core\Response', ['redirect' => true]);

		// ユーザー作成
		$mail = 'TCMU_T_04@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$user = Model_User::find($id);
		$user->corp_id = 1;
		$user->person = 'TEST_USER';
		$user->save();
		\Auth\Auth::force_login($id);

		// POSTデータ生成
		$post_objects = [
			'group'             => Model_Group::ADMIN,
			'email'             => 'create_for_success_for_test@gmo-sc.com',
			'password'          => 'password',
			'password_confirm'  => 'password',
			'corp_id'           => 1,
			'person'            => 'TEST_USER2',
		];

		// POSTセット
		foreach ($post_objects as $key => $value)
		{
			$_POST[$key] = $value;
		}

		$request = \Fuel\Core\Request::forge('management/user/create')->set_method('POST');
		$response = $request->execute()->response();

		// エラーメッセージが出力されていないこと
		$this->assertNull(Session::get_flash('error_message'));

		// インフォメッセージが出力されていること
		$this->assertNotNull(Session::get_flash('info_message'));

		$security->verifyInvoked('check_token');
		$redirect->verifyInvoked('redirect', ['management/user', 'location', 302]);

		Auth::logout();
	}

	public function test_未ログイン状態で編集ページにアクセスを行うとログイン画面にリダイレクトされること()
	{
		// データ作成
		$mail = 'update_for_test2@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$user = Model_User::find($id);
		$user->corp_id = 1;
		$user->person = 'TEST_USER';
		$user->save();

		$method = test::double('Fuel\Core\Response', ['redirect' => true]);

		$request = \Fuel\Core\Request::forge('management/user/update')->set_method('GET');
		$request->execute(['id' => $user->id])->response();

		$method->verifyInvoked('redirect', ['/login', 'location', 302]);
	}

	public function test_ログイン状態で編集ページにアクセスを行うと正常に画面遷移ができること()
	{
		// ユーザー作成
		$mail = 'TCMU_T_05@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$user = Model_User::find($id);
		$user->corp_id = 1;
		$user->person = 'TEST_USER';
		$user->save();
		\Auth\Auth::force_login($id);

		// データ作成
		$mail = 'update_for_test3@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$user = Model_User::find($id);
		$user->corp_id = 1;
		$user->person = 'TEST_USER';
		$user->save();

		$request = \Fuel\Core\Request::forge('management/user/update')->set_method('GET');
		$response = $request->execute(['id' => $user->id])->response();

		$this->assertEquals(200, $response->status);
		Auth::logout();
	}

	/**
	 * @expectedException HttpNotFoundException
	 */
	public function test_編集ページでCRRFチェックが正常に行われ「HttpNotFoundException」がスローされること()
	{
		// ユーザー作成
		$mail = 'TCMU_T_06@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$user = Model_User::find($id);
		$user->corp_id = 1;
		$user->person = 'TEST_USER';
		$user->save();
		\Auth\Auth::force_login($id);

		$request = \Fuel\Core\Request::forge('management/user/update')->set_method('POST');
		$response = $request->execute()->response();

		Auth::logout();
	}

	public function test_編集ページで正常にデータの登録を行うと一覧画面に画面遷移ができること()
	{
		$security = test::double('Fuel\Core\Security', ['check_token' => true]);
		$redirect = test::double('Fuel\Core\Response', ['redirect' => true]);

		// データ作成
		$mail = 'update_for_test4@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$target = Model_User::find($id);
		$target->corp_id = 1;
		$target->person = 'TEST_USER222';
		$target->save();

		// ユーザー作成
		$mail = 'TCMU_T_07@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$user = Model_User::find($id);
		$user->corp_id = 1;
		$user->person = 'TEST_USER';
		$user->save();
		\Auth\Auth::force_login($id);

		// POSTデータ生成
		$expect = [
			'id' => $target->id,
			'person' => 'forUnitTest-edit'.time(),
		];

		// POSTセット
		foreach ($expect as $key => $value)
		{
			$_POST[$key] = $value;
		}

		$request = \Fuel\Core\Request::forge('management/user/update')->set_method('POST');
		$response = $request->execute()->response();

		$actual = Model_User::find('all', ['from_cache' => false, 'where' => [['id', $expect['id']]]]);
		$this->assertEquals($expect['person'], $actual[$target->id]->person);

		// エラーメッセージが出力されていないこと
		$this->assertNull(Session::get_flash('error_message'));

		// インフォメッセージが出力されていること
		$this->assertNotNull(Session::get_flash('info_message'));

		$security->verifyInvoked('check_token');
		$redirect->verifyInvoked('redirect', ['management/user', 'location', 302]);

		Auth::logout();
	}

	public function test_未ログイン状態で削除処理を行うとログイン画面にリダイレクトされること()
	{
		// データ作成
		$mail = 'delete_for_test1@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$user = Model_User::find($id);
		$user->corp_id = 1;
		$user->person = 'TEST_USER';
		$user->save();

		$method = test::double('Fuel\Core\Response', ['redirect' => true]);

		$request = \Fuel\Core\Request::forge('management/user/delete')->set_method('GET');
		$request->execute(['id' => $user->id])->response();

		$method->verifyInvoked('redirect', ['/login', 'location', 302]);
	}

	public function test_ログイン状態で正常に削除処理を行うと一覧画面にリダイレクトされること()
	{
		$redirect = test::double('Fuel\Core\Response', ['redirect' => true]);

		// データ作成
		$mail = 'delete_for_test2@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$expect = Model_User::find($id);
		$expect->corp_id = 1;
		$expect->person = 'TEST_USER';
		$expect->save();

		// ユーザー作成
		$mail = 'TCMU_T_08@gmo-sc.com';
		$id = Auth::create_user($mail, 'password', $mail, Model_Group::ADMIN);
		$user = Model_User::find($id);
		$user->corp_id = 1;
		$user->person = 'TEST_USER';
		$user->save();
		\Auth\Auth::force_login($id);

		$method = test::double('Fuel\Core\Response', ['redirect' => true]);

		$request = \Fuel\Core\Request::forge('management/user/delete')->set_method('GET');
		$request->execute(['id' => $expect->id])->response();

		$redirect->verifyInvoked('redirect', ['management/user', 'location', 302]);

		Auth::logout();
	}
}
