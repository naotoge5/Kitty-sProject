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

let url = 'http://geoapi.heartrails.com/api/json?jsonp=?';

function changePrefecture() {
    let prefecture = $('select[name="prefectures"] option:selected').val();
    resetCities();
    resetTowns();
    if (prefecture !== '都道府県を選択してください') {
        $.getJSON(url, {'method': 'getCities', 'prefecture': prefecture}, setCities);
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