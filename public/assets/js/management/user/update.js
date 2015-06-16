$(function(){

    change_password_check();

    // パスワード変更チェック時にパスワード項目の表示/非表示を制御する
    $('input[name="change_password[0]"]').change(function() {
        change_password_check();
    });

});

function change_password_check() {
    if($('input[name="change_password[0]"]').prop('checked')) {
        $('input[name="change_password[0]"]').prop('value', '1');
        $('div.form-group.pw_change').show();
        $('input[name="old_password"]').prop('required', true);
        $('input[name="new_password"]').prop('required', true);
        $('input[name="new_password_confirm"]').prop('required', true);
    } else {
        $('input[name="change_password"]').prop('value', '0');
        $('input[name="old_password"]').prop('required', false);
        $('input[name="new_password"]').prop('required', false);
        $('input[name="new_password_confirm"]').prop('required', false);
        $('div.form-group.pw_change').hide();
    }
}