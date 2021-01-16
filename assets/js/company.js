let userAgent = window.navigator.userAgent.toLowerCase();
var defaultpicker = true;
if (userAgent.indexOf("windows") !== -1 || userAgent.indexOf("macintosh") !== -1) defaultpicker = false;

//signup.php
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

$(function () {
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

    $('#auto').click(function () {
        let postal = $('input[name="postal"]').val().replace('-', '');
        $.ajax({
            type: "GET",
            url: "../../assets/ajax.php",
            data: { request_url: "https://zipcloud.ibsnet.co.jp/api/search?zipcode=" + postal }
        }).done(function (response) {//ajax通信に成功したかどうかresponseに値があるかどうかでは無い
            setAddress(response)
        }).fail(function () {
            setAddress(response)
        }).fail(function () {
            alert('自動入力に失敗しました。');
        });
    });

    //reset.php
    $("#reset").submit(function () {
        let password = $('input[name="password"]').val();
        let password_check = $('input[name="password_check"]').val();
        if (password !== password_check) {
            alert('パスワードが一致しません');
            return false;
        }
        let result = confirm('変更しますか');
        if (!result) {
            return false;
        }
    });

    //management.php register.php
    $("#menu a:last").click(function () {
        $.ajax({
            type: "POST",
            url: "../assets/ajax.php",
            data: { logout: '' }
        }).done(function (response) {
            console.log('ログアウト');
        }).fail(function () {
            console.log('error');
        });
    });

    //management.php
    $(".edit").css("cursor", "pointer").click(function () {
        location.href = $(this).data("href");
    });

    if ($("#objects_table").length) {
        $("#objects_table").DataTable({
            "paging": false,
            "info": false,
            columnDefs: [
                { targets: 0, width: "50%" }
            ],
            oLanguage: {
                /* 日本語化設定 */
                sLengthMenu: "表示　_MENU_　件", // 表示行数欄(例 = 表示 10 件)
                oPaginate: { // ページネーション欄
                    sNext: "次へ",
                    sPrevious: "前へ"
                },
                sInfo: "_TOTAL_ 件中 _START_件から_END_件 を表示しています", // 現在の表示欄(例 = 100 件中 20件から30件 を表示しています)
                sSearch: "検索 ", // 検索欄(例 = 検索 --)
                sZeroRecords: "表示するデータがありません", // 表示する行がない場合
                sInfoEmpty: "0 件中 0件 を表示しています", // 行が表示されていない場合
                sInfoFiltered: "全 _MAX_ 件から絞り込み" // 検索後に総件数を表示する場合
            }
        });
    }

    $('#delete').click(function () {
        if (confirm('削除してもよろしいですか？')) {
            $("form[name='delete']").submit();
        }
    });

    $("#update").click(function () {
        let details = $("textarea[name='details']").val();
        if (details === '') {
            details = 'none';
        }
        $.ajax({
            type: "POST",
            url: "../assets/ajax.php",
            data: { details: details }
        }).done(function (response) {
            //これはよくない
            window.location.reload();
        }).fail(function () {
            alert('更新に失敗しました。');
        });
    });

    //register.php
    if (defaultpicker) {
        $(".date .input-group-append").remove();
        $('input[name="date"]').get(0).type = 'date';
        $('input[name="time"]').get(0).type = 'time';
        $("select").toggleClass('form-control d-block w-100');
    } else {
        if ($(".date").length) {
            $('#date').datetimepicker({
                dayViewHeaderFormat: 'YYYY年 MMMM',
                format: 'YYYY-MM-DD',
                locale: 'ja',
                showClose: true
            });
            $('#time').datetimepicker({
                format: 'HH:mm',
                locale: 'ja',
                showClose: true
            });
        }
    }
});