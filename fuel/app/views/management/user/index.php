<!-- Page title -->
<div class="page-header">
    <h3>
        アカウント情報一覧
        <div class="pull-right"><a class="btn btn-link" href="/management/user/create" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>新規作成</a></div>
    </h3>
</div>
<!-- message area -->
<?= View::forge('common/message')->render() ?>
<!-- Data list -->
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
    <tr>
        <th>#</th>
        <th>メールアドレス</th>
        <th>会社名</th>
        <th>ユーザー名称</th>
    </tr>
    </thead>
    <tbody>
    <?php if ((count($users)) > 0): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= e($user->id) ?></td>
                <td style="vertical-align:middle;" nowrap><?= Html::anchor('/management/user/update/' . e($user->id), e($user->email)) ?></td>
                <td style="vertical-align:middle;"><?= e($user->corp->name) ?></td>
                <td style="vertical-align:middle;"><?= e($user->person) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td style="text-align:center; vertical-align:middle;" colspan="3">アカウント情報はありません。</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
