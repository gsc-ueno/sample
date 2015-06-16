<?php if (Session::get_flash('info_message')) { ?>
	<div class="alert alert-info alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
				aria-hidden="true">&times;</span></button>
		<?= Session::get_flash('info_message') ?>
	</div>
<?php } ?>
<?php if (Session::get_flash('error_message')) { ?>
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
				aria-hidden="true">&times;</span></button>
		<?= Session::get_flash('error_message') ?>
	</div>
<?php } ?>