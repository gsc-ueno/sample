<!-- for update -->
<?= Asset::js('management/user/update.js') ?>

<div class="page-header">
	<h3>アカウント情報作成
		<div class="pull-right"><a class="btn btn-link cancel" role="button" href="/management/user" onclick="return confirm('キャンセルしてよろしいですか？')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> キャンセル</a></div>
	</h3>
</div>

<!-- message area -->
<?= View::forge('common/message')->render() ?>

<?php $form = Controller_Form_User::instance('management/user') ?>
<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

	<?= Form::csrf(); ?>
	<?= $form->field('username') ?>
	<?= $form->field('id') ?>
	<!-- Data detail -->
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<?php $tags = explode("\n", $form->field('corp_id')); ?>
				<div class="col-md-2 control-label">
					<?= array_shift($tags) ?>
				</div>
				<div class="col-md-4">
					<?= implode("\n", $tags) ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2 control-label">
					<?= explode("\n", $form->field('email'))[0] ?>
				</div>
				<div class="col-md-4">
					<?= explode("\n", $form->field('email'))[1] ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2 control-label">
					<?= explode("\n", $form->field('person'))[0] ?>
				</div>
				<div class="col-md-4">
					<?= explode("\n", $form->field('person'))[1] ?>
				</div>
			</div>
			<hr>
			<div class="form-group">
				<label class="col-md-2 control-label">
					<?= $form->field('change_password')->__get('label') ?>
				</label>
				<div class="col-md-2">
					<div class="checkbox">
						<label>
							<?= explode("\n", $form->field('change_password'))[3] ?>
						</label>
					</div>
				</div>
			</div>
			<div class="form-group pw_change">
				<div class="col-md-2 control-label">
					<?= explode("\n", $form->field('old_password'))[0] ?>
				</div>
				<div class="col-md-4">
					<?= explode("\n", $form->field('old_password'))[1] ?>
				</div>
			</div>
			<div class="form-group pw_change">
				<div class="col-md-2 control-label">
					<?= explode("\n", $form->field('new_password'))[0] ?>
				</div>
				<div class="col-md-4">
					<?= explode("\n", $form->field('new_password'))[1] ?>
				</div>
			</div>
			<div class="form-group pw_change">
				<div class="col-md-2 control-label">
					<?= explode("\n", $form->field('new_password_confirm'))[0] ?>
				</div>
				<div class="col-md-4">
					<?= explode("\n", $form->field('new_password_confirm'))[1] ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Action panel -->
	<div class="panel panel-default">
		<div class="panel-body">
			<button type="submit" class="btn btn-primary create" onclick="return confirm('更新してよろしいでしょうか？')"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 更新</button>
			<a class="btn btn-danger" style="margin-left: 10px;" role="button" href="/management/user/delete/<?= $form->field('id')->value ?>" onclick="return confirm('削除してよろしいですか？')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 削除</a>
		</div>
	</div>
</form>