$(function () {
    $('.edit').css("cursor", "pointer");
    //form#signにEnterKey無効&submitの制御
    $("#login").keypress(function (e) {
        if (e.which === 13) {
            return false;
        }
    }).submit(function () {
        let password = $('input[name="password"]').val();
        if (password.length == 0) {
            let result = confirm('新規登録でよろしいですか');
            if (result) {
                $(this).attr('action', 'mail.php');
            } else {
                return false;
            }
        }
    });
    $("#signup").submit(function () {
        let password = $('input[name="password"]').val();
        let password_check = $('input[name="password_check"]').val();
        if (password !== password_check) {
            alert('パスワードが一致しません');
            return false;
        }
        let name = $('input[name="name_first"]').val() + ' ' + $('input[name="name_second"]').val();
        let tel = $('input[name="tel"]').val();
        let postal = $('input[name="postal"]').val();
        let address = $('input[name="prefecture"]').val() + $('input[name="city"]').val() + $('input[name="town"]').val();
        let mail = $('input[name="mail"]').val();
        let result = confirm('企業名\n' + name + '\n電話番号\n' + tel + '\n郵便番号\n' + postal + '\n住所\n' + address + '\nメールアドレス\n' + mail + '\nパスワード\n' + '*****');
        if (!result) {
            return false;
        }
    });
    //住所自動入力
    $('#auto').click(function () {
        let postal = $('input[name="postal"]').val();
        $.ajax({
            type: "GET", url: "ajax.php", data: {postal: postal}
        }).done(function (response) {//ajax通信に成功したかどうかresponseに値があるかどうかでは無い
            setAddress(response)
        }).fail(function () {
            alert('自動入力に失敗しました。');
        });
    });
});

function setAddress(response) {
    let data = JSON.parse(response);
    if (data["results"] != null) {
        if (data["results"].length == 1) {
            $('input[name="prefecture"]').val(data["results"][0]["address1"]);
            $('input[name="city"]').val(data["results"][0]["address2"]);
            $('input[name="town"]').val(data["results"][0]["address3"]);
        } else {
            alert("複数の市区町村があるため補完できません。");
        }
    } else {
        alert("郵便番号を見直してください。");
    }
}
