$(function () {
    $('#search').change(function (e) {
        let target = $(e.target)
        if (target.attr('name') === 'prefectures') {
            changePrefecture();

        } else if (target.attr('name') === 'cities') {
            changeCity();
        }
    });
});

var geoapi_url = "http://geoapi.heartrails.com/api/json?jsonp=?";
var geoapi_prefecture_selected;
var geoapi_city_selected;
var geoapi_towns = null;


function changePrefecture() {
    geoapi_prefecture_selected = $('select[name="prefectures"] option:selected');
    geoApiInitializeCities();
    geoApiInitializeTowns();
    if (geoapi_prefecture_selected.val() == '都道府県を選択してください') {
        return;
    }
    $.getJSON(geoapi_url, {"method": "getCities", "prefecture": geoapi_prefecture_selected.text()}, setCities);
}

function setCities(json) {
    var cities = json.response['location'];
    for (var index = 0; index < cities.length; index++) {
        var option = $(document.createElement('option'));
        option.text(cities[index].city);
        option.val(cities[index].city);
        $('select[name="cities"]').append(option);
    }
}

function changeCity() {
    geoapi_city_selected = $('select[name="cities"] option:selected');
    geoApiInitializeTowns();
    if (geoapi_city_selected.val() == '市区町村を選択してください') {
        return;
    }
    $.getJSON(geoapi_url, {"method": "getTowns", "city": geoapi_city_selected.text()}, setTowns);
}

function setTowns(json) {
    geoapi_towns = json.response['location'];
    var cities = json.response['location'];
    for (var index = 0; index < cities.length; index++) {
        var option = $(document.createElement('option'));
        option.text(cities[index].town);
        option.val(cities[index].town);
        $('select[name="towns"]').append(option);
    }
}

function geoApiInitializeCities() {
    $('select[name="cities"]').html('<option value="市区町村を選択してください">市区町村を選択してください</option>');
}

function geoApiInitializeTowns() {
    $('select[name="towns"]').html('<option value="町域を選択してください">町域を選択してください</option>');
}