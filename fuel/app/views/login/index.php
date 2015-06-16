<!-- Page title -->
<div class="page-header">
	<h3>ログイン</h3>
</div>
<div class="panel panel-default" style="width: 450px; margin-left: auto; margin-right: auto; margin-top: 60px">
	<div class="panel-body">
		<!-- message area -->
		<?= View::forge('common/message')->render() ?>
		<?= Form::open(array('action' => '/login', 'class' => 'form-horizontal', 'id' => 'form')) ?>
		<div class="form-group" style="margin-top: 20px">
			<div class="col-md-12">
				<div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
					<?= Form::input('username', Input::post('username'), array('class' => 'form-control', 'placeholder' => 'e-mail')) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </span>
					<?= Form::password('password', Input::post('password'), array('class' => 'form-control', 'placeholder' => 'password')) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12 ">
				<div class="pull-right">
					<button type="submit" class="btn btn-primary">ログイン&nbsp;<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></button>
				</div>
			</div>
		</div>
		<?= Form::close() ?>
	</div>
</div>
