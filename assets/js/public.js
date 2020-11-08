$(function () {
    $('select[name="prefectures"]').on('change', function () {
        let prefecture = $('select[name="prefectures"]').val();
        $.ajax({
            type: "POST", url: "search.php", data: {prefecture: prefecture}
        }).done(function (response) {//ajax通信に成功したかどうかresponseに値があるかどうかでは無い
            let cities = JSON.parse(response);
            console.log(cities.length);
            $('select[name="cities"] > option').remove();
            if (cities.length != 0) {
                for (var i = 0; i < cities.length; i++) {
                    $('select[name="cities"]').append($('<option>').html(cities[i]["address_second"]).val(cities[i]["address_second"]));
                }
            } else {
                $('select[name="cities"]').append($('<option>').html('地域が存在しません'));
            }
        }).fail(function () {
            // 取得エラー
            console.log('miss');
            alert('取得エラー');
        }).always(function () {
            // 後処理(処理することが在れば)
            console.log('always');
        });
        return false;
    });
});