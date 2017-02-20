Vue.filter('number_format', function (num, decimals = 0) {
    return number_format(num, decimals);
});
