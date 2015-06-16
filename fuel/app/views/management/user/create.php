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
					<?= explode("\n", $form->field('password'))[0] ?>
				</div>
				<div class="col-md-4">
					<?= explode("\n", $form->field('password'))[1] ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2 control-label">
					<?= explode("\n", $form->field('password_confirm'))[0] ?>
				</div>
				<div class="col-md-4">
					<?= explode("\n", $form->field('password_confirm'))[1] ?>
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
		</div>
	</div>

	<!-- Action panel -->
	<div class="panel panel-default">
		<div class="panel-body">
			<button type="submit" class="btn btn-primary create" onclick="return confirm('登録してよろしいでしょうか？')"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 登録</button>
		</div>
	</div>
</form>