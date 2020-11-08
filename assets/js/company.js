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
                $(this).attr('action', 'signup.php');
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
        let url = "https://zipcloud.ibsnet.co.jp/api/search?zipcode=" + postal;
        $.getJSON(url, (data) => {
            if (data["results"] != null && data["results"][0]["address3"]) {
                $('input[name="address_first"]').val(data["results"][0]["address1"]);
                $('input[name="address_second"]').val(data["results"][0]["address2"]);
                $('input[name="address_third"]').val(data["results"][0]["address3"]);
            } else {
                alert("郵便番号が間違っている可能性があります。");
            }
        })
    });
});

