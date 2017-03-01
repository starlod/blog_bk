/**
 * 型判定
 * @param  type
 * @param  obj
 * @return Boolean
 */
window.is = function (type, obj) {
    var clas = Object.prototype.toString.call(obj).slice(8, -1);
    return obj !== undefined && obj !== null && clas === type;
}

/**
 * 全角から半角への変革関数
 * 入力値の英数記号を半角変換して返却
 * @param   str: 入力値
 * @return String(): 半角変換された文字列
 */
window.to_hankaku = function (str) {
    // 半角変換
    var halfVal = str.replace(/[！-～]/g,
        function( tmpStr ) {
        // 文字コードをシフト
        return String.fromCharCode( tmpStr.charCodeAt(0) - 0xFEE0 );
    });

    // 文字コードシフトで対応できない文字の変換
    return halfVal.replace(/”/g, "\"")
        .replace(/’/g, "'")
        .replace(/‘/g, "`")
        .replace(/￥/g, "\\")
        .replace(/　/g, " ")
        .replace(/〜/g, "~");
}

/**
 * 数値フォーマット
 * @param  num 数値
 * @param  decimals 数値
 * @return string
 */
window.number_format = function (num, decimals = 0) {
    if (decimals > 0) {
        num = parseFloat(num).toFixed(decimals);
    } else {
        num = parseInt(num);
    }

    var parts = num.toString().split('.');
    parts[0] = parts[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
    return parts.join('.');
}

/**
 * 日付フォーマット
 *
 * @param  date 数値
 * @param  format 文字列
   * YYYY年MM月DD日 HH => 2017年01月01日
   * YY年M月D日 => 17年1月1日
 * @param  lang ロケール
 * @return string
 */
window.date_format = function (date, format = DATE_FORMAT, lang = 'ja') {
    return moment(date).format(format);
}

/**
 * URLパラメーターを取得し配列に格納しておく
 *
 * @return array
 */
window.params = function () {
    var arg = new Object;
    var pair = location.search.substring(1).split('&');
    for(var i = 0; pair[i]; i++) {
        var kv = pair[i].split('=');
        arg[kv[0]] = kv[1];
    }

    return arg;
}
