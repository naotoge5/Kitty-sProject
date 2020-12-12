$(function () {
    $("input[name='search']").on("keydown",function(ev){
        if ((ev.which && ev.which === 13) ||(ev.keyCode && ev.keyCode === 13)){
          return false;
        } else {
          return true;
        }
      });
    $("#search").change(function (e) {
        let target = $(e.target)
        if (target.attr("name") === 'prefectures') {
            changePrefecture();
        } else if (target.attr("name") === 'cities') {
            changeCity();
        }
    });
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
});

let url = "http://geoapi.heartrails.com/api/json?jsonp=?";

function changePrefecture() {
    let prefecture = $("select[name='prefectures'] option:selected").val();
    resetCities();
    resetTowns();
    if (prefecture !== '都道府県を選択してください') {
        $.getJSON(url, {"method": "getCities", "prefecture": prefecture}, setCities);
    }
}

function setCities(json) {
    let cities = json.response['location'];
    for (let index = 0; index < cities.length; index++) {
        let option = $(document.createElement('option'));
        option.text(cities[index].city);
        option.val(cities[index].city);
        $('select[name="cities"]').append(option);
    }
}

function changeCity() {
    let city = $('select[name="cities"] option:selected').val();
    resetTowns();
    if (city !== '市区町村を選択してください') {
        $.getJSON(url, {'method': 'getTowns', 'city': city}, setTowns);
    }
}

function setTowns(json) {
    let towns = sortTowns(json.response['location']);
    for (let index = 0; index < towns.length; index++) {
        let option = $(document.createElement('option'));
        option.text(towns[index]);
        option.val(towns[index]);
        $('select[name="towns"]').append(option);
    }
}

function sortTowns(towns_default) {
    let towns = [];
    let tmp = null;
    for (let index = 0; index < towns_default.length; index++) {
        if (!towns_default[index].town.match(tmp) && towns_default[index].town !== '（その他）') {
            tmp = towns_default[index].town.replace('地階', '');
            if (tmp.match('丁目')) {
                tmp = towns_default[index].town.slice(0, -3)
            }
            tmp = tmp.replace('一丁', '');//大阪府堺市
            towns.push(tmp);
        }
    }
    let set = new Set(towns);
    towns = Array.from(set);
    return towns;
}

function resetCities() {
    $('select[name="cities"]').html('<option value="市区町村を選択してください">市区町村を選択してください</option>');
}

function resetTowns() {
    $('select[name="towns"]').html('<option value="町域を選択してください">町域を選択してください</option>');
}