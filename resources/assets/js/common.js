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
 * セパレート
 * @param  num 数値
 * @return string
 */
window.separate = function (num) {
    num = String(num);
    var len = num.length;

    // 再帰的に呼び出すよ
    if (len > 3) {
        // 前半を引数に再帰呼び出し + 後半3桁
        return separate(num.substring(0, len - 3)) + ',' + num.substring(len - 3);
    } else {
        return num;
    }
}
