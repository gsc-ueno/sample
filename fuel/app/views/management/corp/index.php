<!-- Page title -->
<div class="page-header">
    <h3>
        会社情報一覧
        <div class="pull-right"><a class="btn btn-link" href="/management/corp/create" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>新規作成</a></div>
    </h3>
</div>
<!-- message area -->
<?= View::forge('common/message')->render() ?>

<!-- Data list -->
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th>#</th>
            <th>会社名</th>
        </tr>
    </thead>
    <tbody>
    <?php if ((count($corps)) > 0): ?>
        <?php foreach ($corps as $corp): ?>
            <tr>
                <td><?= e($corp->id) ?></td>
                <td><?= Html::anchor('/management/corp/update/' . e($corp->id), e($corp->name)) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td style="text-align:center; vertical-align:middle;" colspan="3">会社情報はありません。</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
