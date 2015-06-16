<?php

class Controller_Admin_Top extends Controller_Base_Template
{
	public function before()
	{
		parent::before();
	}

	/**
	 * 一覧表示処理
	 */
	public function get_index()
	{
		// TODO
		$this->template->content = View::forge('admin/top/index');
	}
}
