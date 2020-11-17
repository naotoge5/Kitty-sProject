$(function () {
    $('tbody tr').css("cursor", "pointer");
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
                $(this).attr('action', 'mail_check.php');
            } else {
                return false;
            }
        }
    });
    $("#signup").submit(function () {
        let name = $('input[name="name_first"]').val() + ' ' + $('input[name="name_second"]').val();
        let tel = $('input[name="tel"]').val();
        let postal = $('input[name="postal"]').val();
        let address = $('input[name="address_first"]').val() + $('input[name="address_second"]').val() + $('input[name="address_third"]').val();
        let mail = $('input[name="mail"]').val();
        let result = confirm('企業名\n' + name + '\n電話番号\n' + tel + '\n郵便番号\n' + postal + '\n住所\n' + address + '\nメールアドレス\n' + mail + '\nパスワード\n' + '*****');
        if (!result) {
            return false;
        }
    });
    //住所自動入力
    $('#auto').on('click', function () {
        let postal = $('input[name="postal"]').val();
        $.ajax({
            type: "POST", url: "../../assets/ajax.php", data: {postal: postal}
        }).done(function (response) {//ajax通信に成功したかどうかresponseに値があるかどうかでは無い
            let data = JSON.parse(response);
            console.log(data);
            if (data["results"] != null) {
                if(data["results"].length == 1) {
                    $('input[name="address_first"]').val(data["results"][0]["address1"]);
                    $('input[name="address_second"]').val(data["results"][0]["address2"]);
                    $('input[name="address_third"]').val(data["results"][0]["address3"]);
                } else {
                    alert("複数の市区町村があるため補完できません。");
                }
            } else {
                alert("郵便番号を見直してください。");
            }
        }).fail(function () {
            // 取得エラー
            console.log('miss');
        }).always(function () {
            // 後処理(処理することが在れば)
            console.log('always');
        });


    });
});

