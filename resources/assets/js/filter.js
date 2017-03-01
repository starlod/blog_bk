Vue.filter('number_format', function (num, decimals = 0) {
    return number_format(num, decimals);
});

Vue.filter('date_format', function (date, format = DATE_FORMAT, lang = 'ja') {
    return date_format(date, format, lang);
});
