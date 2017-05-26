/*
 js自身没有trim()函数取消字符串中的空白字符
 自定义函数：用正则替换掉空白字符
 */
function trim(s) {
    return s.replace(/^\s+|\s+$/g, "");
};

//根据身份证号码来自动填充出生日期
$("#idcard").blur(function () {
    var iIdNo = $("#idcard").val();
    var tmpStr = "";
    var idDate = "";
    var tmpInt = 0;
    var strReturn = "";

    iIdNo = trim(iIdNo);

    if ((iIdNo.length != 15) && (iIdNo.length != 18)) {
        strReturn = "输入的身份证号位数错误";
        layer.msg(strReturn);
        $("#idcard").val("").focus();
        $("#birthday").val("");
//            alert(strReturn);
    }

    if (iIdNo.length == 15) {
        tmpStr = iIdNo.substring(6, 12);
        tmpStr = "19" + tmpStr;
        tmpStr = tmpStr.substring(0, 4) + "-" + tmpStr.substring(4, 6) + "-" + tmpStr.substring(6)

        $("#birthday").val(tmpStr);
//                return tmpStr;
    }
    else {
        tmpStr = iIdNo.substring(6, 14);
        tmpStr = tmpStr.substring(0, 4) + "-" + tmpStr.substring(4, 6) + "-" + tmpStr.substring(6)

        $("#birthday").val(tmpStr);
//                return tmpStr;
    }
});