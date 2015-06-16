<header>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<!-- PR Logo / Small Menu -->
			<div class="navbar-header">
				<a class="navbar-brand" href="<?= strstr(Uri::main(), '/login') ? '#' : '/' ?>"><?= Asset::img('logo.png', array('style' => 'margin-top: -6px')) ?></a>
			</div>
			<!-- NavBar -->
			<div id="navbar" class="collapse navbar-collapse">
				<?php if (Auth::get_user_id()): ?>
					<?php if (Auth::member(Model_Group::ADMIN)): ?>
						<!-- Admin Menu -->
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">アカウント管理<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><?= Html::anchor('management/user', '一覧') ?></li>
									<li><?= Html::anchor('management/user/create', '新規登録') ?></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">会社管理<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><?= Html::anchor('management/corp', '一覧') ?></li>
									<li><?= Html::anchor('management/corp/create', '新規登録') ?></li>
								</ul>
							</li>
						</ul>
					<?php endif; ?>
					<!-- Auth -->
					<ul class="nav navbar-nav navbar-right">
						<li class="navbar-text"><small><?= e($this->current_user->corp->name) ?>&nbsp;<?= e($this->current_user->person) ?>さま</small></li>
						<li><?= Html::anchor('/login/logout', 'ログアウト') ?></li>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</nav>
</header>
