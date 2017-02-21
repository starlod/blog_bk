/**
 * 全角から半角への変革関数
 * 入力値の英数記号を半角変換して返却
 * @param   str: 入力値
 * @return String(): 半角変換された文字列
 */
window.toHankaku = function (str) {
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
window.numberFormat = function (num, decimals = 0) {
    if (decimals > 0) {
        num = parseFloat(num).toFixed(decimals);
    } else {
        num = parseInt(num);
    }

    var parts = num.toString().split('.');
    parts[0] = parts[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
    return parts.join('.');
}

