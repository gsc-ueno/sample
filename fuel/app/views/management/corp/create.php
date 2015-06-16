<div class="page-header">
	<h3>会社情報作成
		<div class="pull-right"><a class="btn btn-link cancel" role="button" href="/management/corp" onclick="return confirm('キャンセルしてよろしいですか？')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> キャンセル</a></div>
	</h3>
</div>

<!-- message area -->
<?= View::forge('common/message')->render() ?>

<?php $form = Fieldset::instance('management/corp/create'); ?>
<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

	<?= Form::csrf(); ?>

	<!-- Data detail -->
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<div class="col-md-2 control-label">
				<?php $tags = explode("\n", $form->field('name')); ?>
					<?= array_shift($tags) ?>
				</div>
				<div class="col-md-3">
					<?= implode("\n", $tags) ?>
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