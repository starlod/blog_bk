Vue.filter('numberFormat', function (num, decimals = 0) {
    return numberFormat(num, decimals);
});
