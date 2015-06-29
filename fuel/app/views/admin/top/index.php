<!-- for datetimepicker-->
<?= Asset::js('common.js') ?>



<!-- Page title -->
<div class="page-header">
	<h3>スニペット</h3>
</div>

<!-- message area -->
<?= View::forge('common/message')->render() ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			アクションボタン
		</h3>
	</div>
	<div class="panel-body">
		<a class="btn btn-link"style="margin-right: 20px;"  href="#" role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 戻る</a>
		<a class="btn btn-default cancel" role="button" href="#" onclick="return confirm('キャンセルしてよろしいですか？')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> キャンセル</a>
		<a class="btn btn-link" href="#" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>新規作成</a>
		<button type="submit" class="btn btn-primary create" onclick="return confirm('登録してよろしいでしょうか？')"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 登録</button>
		<button type="submit" class="btn btn-primary create" onclick="return confirm('更新してよろしいでしょうか？')"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 更新</button>
		<a class="btn btn-danger" style="margin-left: 10px;" role="button" href="#" onclick="return confirm('削除してよろしいですか？')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 削除</a>
		<button type="submit" class="btn btn-default" name="search" value="検索"> 検索</button>
		<button type="submit" class="btn btn-info download"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> ダウンロード</button>
	</div>
</div>

<!-- Action panel -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			テーブル
		</h3>
	</div>
	<div class="panel-body">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead>
				<tr>
					<th><a class="disabled" style="cursor: hand; cursor:pointer;"># <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span></a></th>
					<th><a class="disabled" style="cursor: hand; cursor:pointer;">会社名 <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span></a></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>01</td>
					<td>GMOシステムコンサルティング株式会社</td>
				</tr>
				<tr>
					<td>02</td>
					<td>GMOシステムコンサルティング株式会社</td>
				</tr>
				<tr>
					<td>03</td>
					<td>GMOシステムコンサルティング株式会社</td>
				</tr>
				<tr>
					<td>04</td>
					<td>GMOシステムコンサルティング株式会社</td>
				</tr>
				<tr>
					<td>05</td>
					<td>GMOシステムコンサルティング株式会社</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				フォーム
			</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="col-md-2 control-label">
					<label>フォーム（小）</label>
				</div>
				<div class="col-md-1">
					<input class="form-control" type="text" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2 control-label">
					<label>フォーム（中）</label>
				</div>
				<div class="col-md-3">
					<input class="form-control" type="text" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2 control-label">
					<label>フォーム（大）</label>
				</div>
				<div class="col-md-5">
					<input class="form-control" type="text" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2 control-label">
					<label>日付入力</label>
				</div>
				<div class="col-md-2 input-group date" id="datepicker">
					<input class="form-control" type="text" /><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				</div>
			</div>
		</div>
	</div>
</form>