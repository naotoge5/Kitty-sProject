jQuery(
    function ($) {
        $('tbody tr').css("cursor", "pointer");
        //form#signにEnterKey無効&submitの制御
        $("#sign").keypress(function (e) {
            if (e.which === 13) {
                return false;
            }
        }).submit(function () {
            let password = $('input[name="password"]').val();
            ;
            if (password.length == 0) {
                let result = confirm('新規登録でよろしいですか');
                if (result) {
                    $(this).attr('action', 'signup.php');
                } else {
                    return false;
                }
            } else {
                $(this).attr('action', 'check.php');
            }
        });
    }
)
