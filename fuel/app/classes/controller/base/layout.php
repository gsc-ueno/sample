<?php

trait Controller_Base_Layout
{
	public function layout(View $template)
	{
		// テンプレートに割り当て
		if ($template)
		{
			$template->head = View::forge('common/head');
			$template->header = View::forge('common/header');
			$template->footer = View::forge('common/footer');
		}
	}
}

