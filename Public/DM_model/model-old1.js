/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var LODOP; //声明为全局变量   
function Preview1(id, x) {
    if (x == 1) {
        CreateFullBill2(id);
    } else {
        CreateFullBill22(id);
    }

    LODOP.PREVIEW();
}
function Design1() {
    CreateFullBill2();
//	    LODOP.SET_SHOW_MODE("HIDE_ITEM_LIST",true);//设置对象列表默认处于关闭状态
//	    LODOP.SET_SHOW_MODE("TEXT_SHOW_BORDER",1); //设置字符编辑框默认为single	
    LODOP.PRINT_DESIGN();
}
function RealPrint() {
    CreateFullBill2();
    LODOP.PRINTA();
    CreateFullBill22();
    LODOP.PRINTA();

}
function Preview2() {
    CreateFullBill4();
    LODOP.PREVIEW();
}
function Design2() {
    CreateFullBill4();
//	    LODOP.SET_SHOW_MODE("HIDE_ITEM_LIST",true);//设置对象列表默认处于关闭状态
//	    LODOP.SET_SHOW_MODE("TEXT_SHOW_BORDER",1); //设置字符编辑框默认为single	
    LODOP.PRINT_DESIGN();
}
function RealPrint2() {
    CreateFullBill4();
    LODOP.PRINT();
    openmoneybox();
}

function RealPrint5(id) {
    CreateFullBill5(id);
    LODOP.PRINT();
}

function Design5(id) {
    CreateFullBill5(id);
//	    LODOP.SET_SHOW_MODE("HIDE_ITEM_LIST",true);//设置对象列表默认处于关闭状态
//	    LODOP.SET_SHOW_MODE("TEXT_SHOW_BORDER",1); //设置字符编辑框默认为single	
    LODOP.PRINT_DESIGN();
}
function CreateFullBill() {
    var num = 3;
    var top = 0;
    var top2 = (num - 1) * 33;

    LODOP = getLodop();
    LODOP.PRINT_INITA(10, 10, 762, 533, "打印控件功能演示_Lodop功能_移动公司发票全样");
    LODOP.SET_PRINT_STYLE("FontColor", "#0000FF");
    //外矩形边框
    LODOP.ADD_PRINT_SHAPE(2, 40, 3, 723, 450, 0, 1, "#000000");//1是斜线2是矩形3是椭圆形4是矩形实心5是椭圆形实心，最后两值为边框线的样式（1-3为不同程度虚线）与粗细
    //内表格，增加33
    LODOP.ADD_PRINT_SHAPE(2, 200 + top, 16, 698, 100 + top2, 0, 1, "#000000");//1
    LODOP.ADD_PRINT_SHAPE(1, 233 + top, 16, 698, 1, 0, 1, "#000000");//2不变
    LODOP.ADD_PRINT_SHAPE(1, 266 + top, 16, 698, 1, 0, 1, "#000000");//3,不变
    LODOP.ADD_PRINT_SHAPE(1, 200 + top, 95, 1, 100 + top2, 0, 1, "#000000");//4
    LODOP.ADD_PRINT_SHAPE(1, 200 + top, 165, 1, 66 + top2, 0, 1, "#000000");//5
    LODOP.ADD_PRINT_SHAPE(1, 200 + top, 250, 1, 66 + top2, 0, 1, "#000000");//6
    LODOP.ADD_PRINT_SHAPE(1, 200 + top, 335, 1, 100 + top2, 0, 1, "#000000");//7
    LODOP.ADD_PRINT_SHAPE(1, 200 + top, 415, 1, 100 + top2, 0, 1, "#000000");//8
    LODOP.ADD_PRINT_SHAPE(1, 200 + top, 500, 1, 66 + top2, 0, 1, "#000000");//9
    LODOP.ADD_PRINT_SHAPE(1, 200 + top, 620, 1, 66 + top2, 0, 1, "#000000");//10
    //下划线
    LODOP.ADD_PRINT_SHAPE(1, 180 + top, 100, 180, 1, 0, 1, "#C0C0C0");//12
    LODOP.ADD_PRINT_SHAPE(1, 180 + top, 480, 180, 1, 0, 1, "#C0C0C0");//13
    //增加33
    LODOP.ADD_PRINT_SHAPE(1, 335 + top + top2, 85, 625, 1, 0, 1, "#C0C0C0");//14
    LODOP.ADD_PRINT_SHAPE(1, 360 + top + top2, 85, 245, 1, 0, 1, "#C0C0C0");//15
    LODOP.ADD_PRINT_SHAPE(1, 360 + top + top2, 465, 245, 1, 0, 1, "#C0C0C0");//16
    LODOP.ADD_PRINT_SHAPE(1, 385 + top + top2, 465, 245, 1, 0, 1, "#C0C0C0");//17
    //文字
    LODOP.ADD_PRINT_TEXT(95 + top, 310, 125, 45, "收款收据");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 15);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(170 + top, 12, 95, 30, "客户名称:");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(170 + top, 395, 95, 30, "收款单号:");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(323 + top + top2, 15, 95, 30, "说明:");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(347 + top + top2, 378, 95, 30, "收款日期:");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(347 + top + top2, 6, 95, 30, "收款人:");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(373 + top + top2, 378, 95, 30, "收款公司:");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(208 + top, 8, 95, 30, "费项名称");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(208 + top, 83, 95, 30, "单元名称");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(208 + top, 158, 95, 30, "起始日期");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(208 + top, 244, 95, 30, "终止日期");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(208 + top, 328, 95, 30, "单价");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(208 + top, 411, 95, 30, "实收金额");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(208 + top, 500, 120, 30, "上次/本次读数");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(208 + top, 620, 95, 30, "备注");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    //内容
    for (var i = 0; i < num; i++) {
        var t = i * 33;
        LODOP.ADD_PRINT_TEXT(240 + top + t, 8, 95, 30, "物业费");
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
        LODOP.ADD_PRINT_TEXT(240 + top + t, 83, 95, 30, "101");
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
        LODOP.ADD_PRINT_TEXT(240 + top + t, 162, 95, 30, "2010-10-10");
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
        LODOP.ADD_PRINT_TEXT(240 + top + t, 246, 95, 30, "2011-11-11");
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
        LODOP.ADD_PRINT_TEXT(240 + top + t, 328, 95, 30, "30");
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
        LODOP.ADD_PRINT_TEXT(240 + top + t, 411, 95, 30, "7200");
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
        LODOP.ADD_PRINT_TEXT(240 + top + t, 500, 120, 30, "130/250");
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
        LODOP.ADD_PRINT_TEXT(240 + top + t, 620, 95, 30, "没有");
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
        if (i >= 1) {
            LODOP.ADD_PRINT_SHAPE(1, 266 + top + t, 16, 698, 1, 0, 1, "#000000");//3,数据多一条，改线多一条并高度加33
        }
    }
    //结果，增加33
    LODOP.ADD_PRINT_TEXT(275 + top + top2, 13, 95, 30, "合计(大写):");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(275 + top + top2, 116, 165, 30, change(7200));
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(275 + top + top2, 317, 120, 30, "小写:");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(275 + top + top2, 573, 95, 30, "￥7200.00");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);

}
//收银
function CreateFullBill4() {
    var code = shopcode();
    LODOP = getLodop();
    LODOP.PRINT_INITA(10, 10, 780, 533, "");
    LODOP.SET_PRINT_STYLE("FontColor", "#0000FF");
    LODOP.ADD_PRINT_TEXT(55, -7, 170, 20, "欢迎光临星湖国际广场！");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 10);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(83, -8, 120, 20, "票号:" + code);
    $("#code_sn").val(code);
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(83, 110, 53, 20, "收银员:");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(83, 150, 42, 20, $("#account").val());
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(110, -8, 53, 20, "商品编码");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(110, 62, 49, 20, "零售价");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(110, 104, 43, 20, "会员价");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(110, 144, 36, 20, "数量");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    var i = 0;
    var h;
    //原价总价
    var ago_price = 0;
    //商品总数量
    var cm_num = 0;
    $("#addCsMsg tbody").find("tr").each(function () {
        i++;
        if (i > 1) {
            i++;
        }
        h = (i - 1) * 23;
        var tdArr = $(this).children();
        var code = tdArr.eq(1).html(); //条码
        var name = tdArr.eq(2).html(); //名称
        var ago_cost = tdArr.eq(3); //原价
        //var discount = tdArr.eq(4).html(); //折扣
        var num = tdArr.eq(5)[0]["children"][0]["value"]; //数量
        cm_num = cm_num + num * 1;
        var now_price = tdArr.eq(6).html(); //现价
        var total_price = tdArr.eq(7).html(); //小计
        LODOP.ADD_PRINT_TEXT(132 + h, -4, 70, 20, i + "." + code);
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.ADD_PRINT_TEXT(132 + h, 65, 42, 20, ago_cost[0]["children"][0]["value"]);
        ago_price = ago_price + ago_cost[0]["children"][0]["value"] * num;
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.ADD_PRINT_TEXT(132 + h, 107, 42, 20, now_price);
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.ADD_PRINT_TEXT(132 + h, 149, 21, 20, num);
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.ADD_PRINT_TEXT(155 + h, 7, 85, 20, name);
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        LODOP.ADD_PRINT_TEXT(155 + h, 113, 65, 20, total_price);
        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    });
    h = h - 3 * 23;
    //会员打折扣后总价
    var price = $("#price").html();
    //会员优惠总差价
    var discount_mm_price = ago_price - price;
    //活动优惠金额
    var pay_mode = $("#pay_mode").html();
    //最终优惠总价
    var discount_price = discount_mm_price * 1 + pay_mode * 1;
    //最终应收款
    var cl_pay = $("#cl_pay").html();
    //付款金额
    var count_pay = $("#count_pay").val();
    //找零金额
    var cl_change = $("#cl_change").html();
    LODOP.ADD_PRINT_SHAPE(2, 47, -11, 185, 380 + h, 0, 1, "#000000"); //1是斜线2是矩形3是椭圆形4是矩形实心5是椭圆形实心，最后两值为边框线的样式（1-3为不同程度虚线）与粗细
    LODOP.ADD_PRINT_TEXT(262 + h, -6, 180, 20, "合计:" + price + "  优惠金额:" + discount_price);
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(280 + h, -6, 130, 20, "实付金额:" + cl_pay);
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(296 + h, -5, 180, 20, "付款:");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(312 + h, -6, 130, 20, "现金:人民币  " + count_pay);
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(328 + h, -6, 130, 20, "找零:人民币  " + cl_change);
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(345 + h, -6, 178, 20, "机器号:" + $("#mac").val() + "|商品数:" + cm_num + "件");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(363 + h, -6, 180, 20, "销售时间:" + getDate01());
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(380 + h, -7, 150, 20, "谢谢光临，欢迎下次再来！");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(397 + h, 110, 70, 20, "第1次打印");
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
}

function CreateFullBill3() {
    var num = 3;
    var top = 0;
    var top2 = (num - 1) * 33;
    LODOP = getLodop();
    LODOP.PRINT_INITA(10, 10, 762, 533, "");
    LODOP.SET_PRINT_STYLE("FontColor", "#0000FF");
    //标题
    LODOP.ADD_PRINT_TEXT(27, 295, 190, 30, "缴费通知单"); //2
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 13);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    //外矩形边框66 85 650 420
    LODOP.ADD_PRINT_SHAPE(2, 66, 65, 670, 357, 0, 1, "#000000"); //1是斜线2是矩形3是椭圆形4是矩形实心5是椭圆形实心，最后两值为边框线的样式（1-3为不同程度虚线）与粗细
    LODOP.ADD_PRINT_SHAPE(1, 83, 66, 670, 1, 0, 1, "#000000"); //3
    LODOP.ADD_PRINT_SHAPE(1, 100, 66, 670, 1, 0, 1, "#000000"); //4
    LODOP.ADD_PRINT_SHAPE(1, 117, 66, 670, 1, 0, 1, "#000000"); //5
    LODOP.ADD_PRINT_SHAPE(1, 134, 66, 575, 1, 0, 1, "#000000"); //6
    LODOP.ADD_PRINT_SHAPE(1, 151, 66, 575, 1, 0, 1, "#000000"); //7
    LODOP.ADD_PRINT_SHAPE(1, 168, 66, 575, 1, 0, 1, "#000000"); //8
    LODOP.ADD_PRINT_SHAPE(1, 185, 66, 575, 1, 0, 1, "#000000"); //9
    LODOP.ADD_PRINT_SHAPE(1, 202, 66, 575, 1, 0, 1, "#000000"); //10
    LODOP.ADD_PRINT_SHAPE(1, 219, 66, 575, 1, 0, 1, "#000000"); //11
    LODOP.ADD_PRINT_SHAPE(1, 236, 66, 575, 1, 0, 1, "#000000"); //12
    LODOP.ADD_PRINT_SHAPE(1, 253, 66, 670, 1, 0, 1, "#000000"); //13
    LODOP.ADD_PRINT_SHAPE(1, 270, 66, 670, 1, 0, 1, "#000000"); //14
    LODOP.ADD_PRINT_SHAPE(1, 287, 66, 575, 1, 0, 1, "#000000"); //15
    LODOP.ADD_PRINT_SHAPE(1, 304, 66, 575, 1, 0, 1, "#000000"); //16
    LODOP.ADD_PRINT_SHAPE(1, 321, 66, 575, 1, 0, 1, "#000000"); //17
    LODOP.ADD_PRINT_SHAPE(1, 338, 66, 670, 1, 0, 1, "#000000"); //18
    LODOP.ADD_PRINT_SHAPE(1, 355, 66, 670, 1, 0, 1, "#000000"); //19
    LODOP.ADD_PRINT_SHAPE(1, 372, 66, 670, 1, 0, 1, "#000000"); //20
    LODOP.ADD_PRINT_SHAPE(1, 389, 66, 670, 1, 0, 1, "#000000"); //21
    LODOP.ADD_PRINT_SHAPE(1, 406, 66, 670, 1, 0, 1, "#000000"); //22
    LODOP.ADD_PRINT_SHAPE(1, 66, 148, 1, 272, 0, 1, "#000000"); //23
    LODOP.ADD_PRINT_SHAPE(1, 66, 230, 1, 272, 0, 1, "#000000"); //24
    LODOP.ADD_PRINT_SHAPE(1, 66, 312, 1, 272, 0, 1, "#000000"); //25
    LODOP.ADD_PRINT_SHAPE(1, 66, 394, 1, 272, 0, 1, "#000000"); //26
    LODOP.ADD_PRINT_SHAPE(1, 66, 476, 1, 272, 0, 1, "#000000"); //27
    LODOP.ADD_PRINT_SHAPE(1, 66, 558, 1, 272, 0, 1, "#000000"); //28
    LODOP.ADD_PRINT_SHAPE(1, 66, 640, 1, 289, 0, 1, "#000000"); //29
    LODOP.ADD_PRINT_TEXT(42, 85, 70, 25, "客户:"); //30
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 13);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(42, 160, 70, 25, "摩斯雷"); //31
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 13);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(70, 188, 70, 25, "管理费"); //32
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(70, 249, 70, 25, "其他"); //33
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(70, 323, 70, 25, "维护费"); //34
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(70, 386, 94, 25, "户外广告租金"); //35
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(70, 678, 70, 25, "小计"); //36
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 74, 88, 25, "电表上月行度"); //37
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 156, 88, 25, "电表本月行度"); //38
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 252, 88, 25, "实用量"); //39
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 342, 88, 25, "单价"); //40
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 412, 88, 25, "应缴电费"); //41
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 483, 100, 25, "户外广告电费"); //42
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 580, 70, 25, "垃圾费"); //43
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(70, 95, 70, 25, "租金"); //44
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 72, 90, 25, "水表上月行度"); //45
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 155, 90, 25, "水表本月行度"); //46
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 252, 70, 25, "实用量"); //47
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 341, 70, 25, "单价"); //48
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 412, 70, 25, "应缴水费"); //49
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(258, 678, 70, 25, "小计"); //50
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(343, 584, 90, 25, "费用合计"); //51
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(92, 99, 90, 25, "4,621.00"); //52
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(92, 184, 90, 25, "3075.00"); //53
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(92, 666, 90, 25, "7696.00"); //54
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(132, 106, 90, 25, "12628"); //55
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(132, 186, 90, 25, "12745"); //56
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(132, 274, 90, 25, "117"); //57
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(132, 339, 90, 25, "1.020000"); //58
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(132, 421, 90, 25, "119.34"); //59
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_SHAPE(1, 372, 230, 1, 51, 0, 1, "#000000"); //60
    LODOP.ADD_PRINT_SHAPE(1, 372, 476, 1, 51, 0, 1, "#000000"); //61
    LODOP.ADD_PRINT_SHAPE(1, 372, 640, 1, 51, 0, 1, "#000000"); //62
    LODOP.ADD_PRINT_TEXT(359, 68, 220, 25, "请贵客户将费用存入一下账户:"); //63
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 135, 70, 25, "名称"); //64
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 341, 70, 25, "开户行"); //65
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 548, 70, 25, "账号"); //66
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 676, 70, 25, "金额"); //67
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(394, 68, 175, 16, "肇庆市星湖国际广场商业管理有限公司"); //68
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(411, 68, 175, 16, "肇庆市宝星发招有限公司"); //69
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(393, 233, 250, 16, "肇庆市端州农村商业银行股份有限公司星湖支行"); //71
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(410, 233, 240, 16, "肇庆市端州农村商业银行股份有限公司星湖支行"); //72
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(393, 480, 165, 16, "80020000001724592"); //73
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(410, 480, 165, 16, "80020000001724592"); //74
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(393, 644, 100, 16, "7696.00"); //73
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(410, 644, 100, 16, "1232.00"); //73
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
}


function CreateFullBill22(id) {
    var num = 3;
    var top = 0;
    var top2 = (num - 1) * 33;
    LODOP = getLodop();
    LODOP.PRINT_INITA(10, 10, 762, 533, "");
    LODOP.SET_PRINT_STYLE("FontColor", "#0000FF");
    //标题
    LODOP.ADD_PRINT_TEXT(27, 295, 190, 30, "缴费通知单"); //2
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 13);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    //外矩形边框66 85 650 420
    LODOP.ADD_PRINT_SHAPE(2, 66, 65, 670, 357, 0, 1, "#000000"); //1是斜线2是矩形3是椭圆形4是矩形实心5是椭圆形实心，最后两值为边框线的样式（1-3为不同程度虚线）与粗细
    LODOP.ADD_PRINT_SHAPE(1, 83, 66, 670, 1, 0, 1, "#000000"); //3
    LODOP.ADD_PRINT_SHAPE(1, 100, 66, 670, 1, 0, 1, "#000000"); //4
    LODOP.ADD_PRINT_SHAPE(1, 117, 66, 670, 1, 0, 1, "#000000"); //5
    LODOP.ADD_PRINT_SHAPE(1, 134, 66, 575, 1, 0, 1, "#000000"); //6
    LODOP.ADD_PRINT_SHAPE(1, 151, 66, 575, 1, 0, 1, "#000000"); //7
    LODOP.ADD_PRINT_SHAPE(1, 168, 66, 575, 1, 0, 1, "#000000"); //8
    LODOP.ADD_PRINT_SHAPE(1, 185, 66, 575, 1, 0, 1, "#000000"); //9
    LODOP.ADD_PRINT_SHAPE(1, 202, 66, 575, 1, 0, 1, "#000000"); //10
    LODOP.ADD_PRINT_SHAPE(1, 219, 66, 575, 1, 0, 1, "#000000"); //11
    LODOP.ADD_PRINT_SHAPE(1, 236, 66, 575, 1, 0, 1, "#000000"); //12
    LODOP.ADD_PRINT_SHAPE(1, 253, 66, 670, 1, 0, 1, "#000000"); //13
    LODOP.ADD_PRINT_SHAPE(1, 270, 66, 670, 1, 0, 1, "#000000"); //14
    LODOP.ADD_PRINT_SHAPE(1, 287, 66, 575, 1, 0, 1, "#000000"); //15
    LODOP.ADD_PRINT_SHAPE(1, 304, 66, 575, 1, 0, 1, "#000000"); //16
    LODOP.ADD_PRINT_SHAPE(1, 321, 66, 575, 1, 0, 1, "#000000"); //17
    LODOP.ADD_PRINT_SHAPE(1, 338, 66, 670, 1, 0, 1, "#000000"); //18
    LODOP.ADD_PRINT_SHAPE(1, 355, 66, 670, 1, 0, 1, "#000000"); //19
    LODOP.ADD_PRINT_SHAPE(1, 372, 66, 670, 1, 0, 1, "#000000"); //20
    LODOP.ADD_PRINT_SHAPE(1, 389, 66, 670, 1, 0, 1, "#000000"); //21
    LODOP.ADD_PRINT_SHAPE(1, 406, 66, 670, 1, 0, 1, "#000000"); //22
    LODOP.ADD_PRINT_SHAPE(1, 66, 148, 1, 272, 0, 1, "#000000"); //23
    LODOP.ADD_PRINT_SHAPE(1, 66, 230, 1, 272, 0, 1, "#000000"); //24
    LODOP.ADD_PRINT_SHAPE(1, 66, 312, 1, 272, 0, 1, "#000000"); //25
    LODOP.ADD_PRINT_SHAPE(1, 66, 394, 1, 272, 0, 1, "#000000"); //26
    LODOP.ADD_PRINT_SHAPE(1, 66, 476, 1, 272, 0, 1, "#000000"); //27
    LODOP.ADD_PRINT_SHAPE(1, 66, 558, 1, 272, 0, 1, "#000000"); //28
    LODOP.ADD_PRINT_SHAPE(1, 66, 640, 1, 289, 0, 1, "#000000"); //29
    LODOP.ADD_PRINT_TEXT(42, 85, 70, 25, "客户:"); //30
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 13);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    //费类小计
    var price1 = 0;
    //电费小计
    var price2 = 0;
    //水费小计
    var price3 = 0;
//获取收款单数据
    $.ajax({
        type: "GET",
        url: "../../../Noticemng/ajax/action/ck_nm",
        data: {'id': id},
        dataType: "json",
        async: false,
        success: function (data) {
            var info = eval(data);
            LODOP.ADD_PRINT_TEXT(42, 160, 70, 25, info[0].nm_scsr_id); //31
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 13);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            var u = 0;
            var y = 0;
            var e = 0;
            for (var i = 0; i < info.length; i++) {
                if (i < 8) {
                    //费类
                    if (info[i].nmc_ci_id != 2 && info[i].nmc_ci_id != 3 && info[i].nmc_ci_id != 21 && info[i].nmc_ci_id != 22) {
                        var s = info[i].ci_name;
                        var s1 = info[i].nmc_amount2;
                        price1 = price1 + s1 * 1;
                        var font = ((7 - s.length) * 11.6 / 2) + 66 + 82 * e;
                        var num = ((13 - s1.length) * 6.3 / 2) + 66 + 82 * e;
                        LODOP.ADD_PRINT_TEXT(70, font, 70, 25, s); //44
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        LODOP.ADD_PRINT_TEXT(88, num, 90, 25, s1); //52
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        e++;
                    }
                }
            }
        }
    });
    //总计
    var price4 = price1 * 1 + price2 * 1 + price3 * 1;
    var price5 = price1 * 1;
    var price6 = price2 * 1 + price3 * 1;
    LODOP.ADD_PRINT_TEXT(70, 678, 70, 25, "小计"); //36
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(88, 676, 90, 25, price1.toFixed(2)); //54
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(104, 678, 70, 25, "小计"); //76
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(186, 678, 70, 25, price2.toFixed(2)); //36
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(258, 678, 70, 25, "小计"); //50
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(300, 678, 70, 25, price3.toFixed(2)); //50
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(343, 584, 90, 25, "费用合计"); //51
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(343, 666, 90, 25, price4.toFixed(2)); //51
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 74, 88, 25, "电表上月行度"); //37
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 156, 88, 25, "电表本月行度"); //38
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 252, 88, 25, "实用量"); //39
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 342, 88, 25, "单价"); //40
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 412, 88, 25, "应缴电费"); //41
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//    LODOP.ADD_PRINT_TEXT(105, 483, 100, 25, "户外广告电费");//42
//    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
//    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//    LODOP.ADD_PRINT_TEXT(105, 580, 70, 25, "垃圾费");//43
//    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
//    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 72, 90, 25, "水表上月行度"); //45
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 155, 90, 25, "水表本月行度"); //46
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 252, 70, 25, "实用量"); //47
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 341, 70, 25, "单价"); //48
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 412, 70, 25, "应缴水费"); //49
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_SHAPE(1, 372, 230, 1, 51, 0, 1, "#000000"); //60
    LODOP.ADD_PRINT_SHAPE(1, 372, 476, 1, 51, 0, 1, "#000000"); //61
    LODOP.ADD_PRINT_SHAPE(1, 372, 640, 1, 51, 0, 1, "#000000"); //62
    LODOP.ADD_PRINT_TEXT(359, 68, 220, 25, "请贵客户将费用存入一下账户:"); //63
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 135, 70, 25, "名称"); //64
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 341, 70, 25, "开户行"); //65
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 548, 70, 25, "账号"); //66
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 676, 70, 25, "金额"); //67
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(394, 68, 175, 16, "禤敏诗"); //68
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(411, 68, 175, 16, "王霞"); //69
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(393, 233, 250, 16, "肇庆市工商银行端州支行"); //71
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(410, 233, 240, 16, "中信银行肇庆分行"); //72
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(393, 480, 165, 16, "6222082017000784792"); //73
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(410, 480, 165, 16, "6217730901995421"); //74
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(393, 644, 100, 16, price5.toFixed(2)); //74
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(410, 644, 100, 16, price6.toFixed(2)); //75
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
}

function CreateFullBill2(id) {
    var num = 3;
    var top = 0;
    var top2 = (num - 1) * 33;
    LODOP = getLodop();
    LODOP.PRINT_INITA(10, 10, 762, 533, "");
    LODOP.SET_PRINT_STYLE("FontColor", "#0000FF");
    //标题
    LODOP.ADD_PRINT_TEXT(27, 295, 190, 30, "缴费通知单"); //2
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 13);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    //外矩形边框66 85 650 420
    LODOP.ADD_PRINT_SHAPE(2, 66, 65, 670, 357, 0, 1, "#000000"); //1是斜线2是矩形3是椭圆形4是矩形实心5是椭圆形实心，最后两值为边框线的样式（1-3为不同程度虚线）与粗细
    LODOP.ADD_PRINT_SHAPE(1, 83, 66, 670, 1, 0, 1, "#000000"); //3
    LODOP.ADD_PRINT_SHAPE(1, 100, 66, 670, 1, 0, 1, "#000000"); //4
    LODOP.ADD_PRINT_SHAPE(1, 117, 66, 670, 1, 0, 1, "#000000"); //5
    LODOP.ADD_PRINT_SHAPE(1, 134, 66, 575, 1, 0, 1, "#000000"); //6
    LODOP.ADD_PRINT_SHAPE(1, 151, 66, 575, 1, 0, 1, "#000000"); //7
    LODOP.ADD_PRINT_SHAPE(1, 168, 66, 575, 1, 0, 1, "#000000"); //8
    LODOP.ADD_PRINT_SHAPE(1, 185, 66, 575, 1, 0, 1, "#000000"); //9
    LODOP.ADD_PRINT_SHAPE(1, 202, 66, 575, 1, 0, 1, "#000000"); //10
    LODOP.ADD_PRINT_SHAPE(1, 219, 66, 575, 1, 0, 1, "#000000"); //11
    LODOP.ADD_PRINT_SHAPE(1, 236, 66, 575, 1, 0, 1, "#000000"); //12
    LODOP.ADD_PRINT_SHAPE(1, 253, 66, 670, 1, 0, 1, "#000000"); //13
    LODOP.ADD_PRINT_SHAPE(1, 270, 66, 670, 1, 0, 1, "#000000"); //14
    LODOP.ADD_PRINT_SHAPE(1, 287, 66, 575, 1, 0, 1, "#000000"); //15
    LODOP.ADD_PRINT_SHAPE(1, 304, 66, 575, 1, 0, 1, "#000000"); //16
    LODOP.ADD_PRINT_SHAPE(1, 321, 66, 575, 1, 0, 1, "#000000"); //17
    LODOP.ADD_PRINT_SHAPE(1, 338, 66, 670, 1, 0, 1, "#000000"); //18
    LODOP.ADD_PRINT_SHAPE(1, 355, 66, 670, 1, 0, 1, "#000000"); //19
    LODOP.ADD_PRINT_SHAPE(1, 372, 66, 670, 1, 0, 1, "#000000"); //20
    LODOP.ADD_PRINT_SHAPE(1, 389, 66, 670, 1, 0, 1, "#000000"); //21
    LODOP.ADD_PRINT_SHAPE(1, 406, 66, 670, 1, 0, 1, "#000000"); //22
    LODOP.ADD_PRINT_SHAPE(1, 66, 148, 1, 272, 0, 1, "#000000"); //23
    LODOP.ADD_PRINT_SHAPE(1, 66, 230, 1, 272, 0, 1, "#000000"); //24
    LODOP.ADD_PRINT_SHAPE(1, 66, 312, 1, 272, 0, 1, "#000000"); //25
    LODOP.ADD_PRINT_SHAPE(1, 66, 394, 1, 272, 0, 1, "#000000"); //26
    LODOP.ADD_PRINT_SHAPE(1, 66, 476, 1, 272, 0, 1, "#000000"); //27
    LODOP.ADD_PRINT_SHAPE(1, 66, 558, 1, 272, 0, 1, "#000000"); //28
    LODOP.ADD_PRINT_SHAPE(1, 66, 640, 1, 289, 0, 1, "#000000"); //29
    LODOP.ADD_PRINT_TEXT(42, 85, 70, 25, "客户:"); //30
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 13);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    //费类小计
    var price1 = 0;
    //电费小计
    var price2 = 0;
    //水费小计
    var price3 = 0;
//获取收款单数据
    $.ajax({
        type: "GET",
        url: "../../../Noticemng/ajax/action/ck_nm",
        data: {'id': id},
        dataType: "json",
        async: false,
        success: function (data) {
            var info = eval(data);
            LODOP.ADD_PRINT_TEXT(42, 160, 70, 25, info[0].nm_scsr_id); //31
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 13);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            var u = 0;
            var y = 0;
            var e = 0;
            for (var i = 0; i < info.length; i++) {
                if (i < 8) {
                    //费类
                    if (info[i].nmc_ci_id != 2 && info[i].nmc_ci_id != 3 && info[i].nmc_ci_id != 21 && info[i].nmc_ci_id != 22) {
                        var s = info[i].ci_name;
                        var s1 = info[i].nmc_amount1;
                        price1 = price1 + s1 * 1;
                        var font = ((7 - s.length) * 11.6 / 2) + 66 + 82 * e;
                        var num = ((13 - s1.length) * 6.3 / 2) + 66 + 82 * e;
                        LODOP.ADD_PRINT_TEXT(70, font, 70, 25, s); //44
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        LODOP.ADD_PRINT_TEXT(88, num, 90, 25, s1); //52
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        e++;
                    }
                    if (info[i].nmc_ci_id == 3 || info[i].nmc_ci_id == 22) {
                        price2 = price2 + info[i].nmc_amount * 1;
                        var h = u * 17;
                        var lt1 = price_1(info[i].nmc_prior_reading, 0);
                        LODOP.ADD_PRINT_TEXT(122 + h, lt1, 90, 25, info[i].nmc_prior_reading); //55
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        var lt2 = price_1(info[i].nmc_cur_dosage, 1);
                        LODOP.ADD_PRINT_TEXT(122 + h, lt2, 90, 25, info[i].nmc_cur_reading); //56
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        var ps = info[i].nmc_cur_reading * 1 - info[i].nmc_prior_reading * 1;
                        var lt3 = price_1(ps, 2);
                        LODOP.ADD_PRINT_TEXT(122 + h, lt3, 90, 25, ps.toFixed(2)); //57
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        var lt4 = price_1(info[i].nmc_unit_price, 3);
                        LODOP.ADD_PRINT_TEXT(122 + h, lt4, 90, 25, info[i].nmc_unit_price); //58
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        var lt5 = price_1(info[i].nmc_amount, 4);
                        LODOP.ADD_PRINT_TEXT(122 + h, lt5, 90, 25, info[i].nmc_amount); //59
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        u++;
                    }
                    if (info[i].nmc_ci_id == 2 || info[i].nmc_ci_id == 21) {
                        price3 = price3 + info[i].nmc_amount * 1;
                        var h = y * 17;
                        var lt1 = price_1(info[i].nmc_prior_reading, 0);
                        LODOP.ADD_PRINT_TEXT(275 + h, lt1, 90, 25, info[i].nmc_prior_reading); //55
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        var lt2 = price_1(info[i].nmc_cur_dosage, 1);
                        LODOP.ADD_PRINT_TEXT(275 + h, lt2, 90, 25, info[i].nmc_cur_reading); //56
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        var ps = info[i].nmc_cur_reading * 1 - info[i].nmc_prior_reading * 1;
                        var lt3 = price_1(ps, 2);
                        LODOP.ADD_PRINT_TEXT(275 + h, lt3, 90, 25, ps); //57
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        var lt4 = price_1(info[i].nmc_unit_price, 3);
                        LODOP.ADD_PRINT_TEXT(275 + h, lt4, 90, 25, info[i].nmc_unit_price); //58
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        var lt5 = price_1(info[i].nmc_amount, 4);
                        LODOP.ADD_PRINT_TEXT(275 + h, lt5, 90, 25, info[i].nmc_amount); //59
                        LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
                        LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
                        y++;
                    }
                }
            }
        }
    });
    //总计
    var price4 = price1 * 1 + price2 * 1 + price3 * 1;
    var price5 = price1 * 1;
    var price6 = price2 * 1 + price3 * 1;
    LODOP.ADD_PRINT_TEXT(70, 678, 70, 25, "小计"); //36
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(88, 676, 90, 25, price1.toFixed(2)); //54
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(104, 678, 70, 25, "小计"); //76
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(186, 678, 70, 25, price2.toFixed(2)); //36
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(258, 678, 70, 25, "小计"); //50
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(300, 678, 70, 25, price3.toFixed(2)); //50
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(343, 584, 90, 25, "费用合计"); //51
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(343, 666, 90, 25, price4.toFixed(2)); //51
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 74, 88, 25, "电表上月行度"); //37
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 156, 88, 25, "电表本月行度"); //38
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 252, 88, 25, "实用量"); //39
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 342, 88, 25, "单价"); //40
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(105, 412, 88, 25, "应缴电费"); //41
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//    LODOP.ADD_PRINT_TEXT(105, 483, 100, 25, "户外广告电费");//42
//    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
//    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//    LODOP.ADD_PRINT_TEXT(105, 580, 70, 25, "垃圾费");//43
//    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
//    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 72, 90, 25, "水表上月行度"); //45
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 155, 90, 25, "水表本月行度"); //46
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 252, 70, 25, "实用量"); //47
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 341, 70, 25, "单价"); //48
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(257, 412, 70, 25, "应缴水费"); //49
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_SHAPE(1, 372, 230, 1, 51, 0, 1, "#000000"); //60
    LODOP.ADD_PRINT_SHAPE(1, 372, 476, 1, 51, 0, 1, "#000000"); //61
    LODOP.ADD_PRINT_SHAPE(1, 372, 640, 1, 51, 0, 1, "#000000"); //62
    LODOP.ADD_PRINT_TEXT(359, 68, 220, 25, "请贵客户将费用存入一下账户:"); //63
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 135, 70, 25, "名称"); //64
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 341, 70, 25, "开户行"); //65
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 548, 70, 25, "账号"); //66
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 676, 70, 25, "金额"); //67
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(394, 68, 175, 16, "肇庆市星湖国际广场商业管理有限公司"); //68
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(411, 68, 175, 16, "肇庆市宝星发招有限公司"); //69
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(393, 233, 250, 16, "肇庆市端州农村商业银行股份有限公司星湖支行"); //71
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(410, 233, 240, 16, "肇庆市端州农村商业银行股份有限公司星湖支行"); //72
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(393, 480, 165, 16, "80020000001724592"); //73
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(410, 480, 165, 16, "80020000008068586"); //74
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(393, 644, 100, 16, price5.toFixed(2)); //74
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(410, 644, 100, 16, price6.toFixed(2)); //75
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
}

function price_1(val, i) {
    var num = ((13 - (val + "").length) * 6.3 / 2) + 66 + 82 * i;
    return num;
}

function change(str) {
    je = "零壹贰叁肆伍陆柒捌玖";
    cdw = "万仟佰拾亿仟佰拾万仟佰拾元角分";
    var newstring = (parseInt(str * 100)).toString();
    newstringlog = newstring.length;
    newdw = cdw.substr(cdw.length - newstringlog);
    num0 = 0; //记录零的个数
    wan = 0; //记录万位出现的次数
    dxje = ""; //记录大写金额
    for (m = 1; m < newstringlog + 1; m++) {
        xzf = newstring.substr(m - 1, 1); //取得该位数
        dzf = je.substr(xzf, 1); //结果（大写的零-玖）
        dw = newdw.substr(m - 1, 1); //位大写
        if (dzf == "零") {
            dzf = "";
            if (dw == "亿") {
            } else if (dw == "万") {
                dzf = "";
                wan = 1;
            } else if (dw == "元") {

            } else {
                dw = ""; //记录单位        
            }
            num0 = num0 + 1;
        } else {
            if (num0 - wan > 0) {
                if (dw != "角") {
                    dzf = "零" + dzf;
                }
            }
            num0 = 0;
        }
        dxje = dxje + dzf + dw;
    }
    if (newstring.length != 1) {
        if (newstring.substr(newstring.length - 2) == "00") {
            dxje = dxje + "整";
        } else {
            dxje = dxje;
        }
    }
    return dxje;
}
/**获得当前日期**/
function  getDate01() {
    var time = new Date();
    var myYear = time.getFullYear();
    var myMonth = time.getMonth() + 1;
    var myDay = time.getDate();
    var myHours = time.getHours();
    var myMinutes = time.getMinutes();
    var mySecondes = time.getSeconds();
    if (myMonth < 10) {
        myMonth = "0" + myMonth;
    }
    var times = myYear + "-" + myMonth + "-" + myDay + " " + myHours + ":" + myMinutes + ":" + mySecondes;
    return times;
}
/**获得当前日期**/
function  getDate02() {
    var time = new Date();
    var myYear = time.getFullYear();
    var myMonth = time.getMonth() + 1;
    var myDay = time.getDate();
    var myHours = time.getHours();
    var myMinutes = time.getMinutes();
    var mySecondes = time.getSeconds();
    if (myMonth < 10) {
        myMonth = "0" + myMonth;
    }
    var times = myYear + "-" + myMonth + "-" + myDay + " " + myHours + ":" + myMinutes;
    return times;
}
/**获得当前日期**/
function  getDate03() {
    var time = new Date();
    var myYear = time.getFullYear();
    var myMonth = time.getMonth() + 1;
    var myDay = time.getDate();
    var myHours = time.getHours();
    var myMinutes = time.getMinutes();
    var mySecondes = time.getSeconds();
    if (myMonth < 10) {
        myMonth = "0" + myMonth;
    }
    var times = myYear + "-" + myMonth + "-" + myDay;
    return times;
}
/**小票号**/
function  shopcode() {
    var time = new Date();
    var myYear = time.getFullYear();
    var myMonth = time.getMonth() + 1;
    var myDay = time.getDate();
    var myHours = time.getHours();
    var myMinutes = time.getMinutes();
    var mySecondes = time.getSeconds();
    if (myMonth < 10) {
        myMonth = "0" + myMonth;
    }
    var times = myYear + "" + myMonth + "" + myDay + "" + myHours + "" + myMinutes + "" + mySecondes;
    return times;
}
function Preview3(id) {
    CreateFullBill3(id);
    LODOP.PREVIEW();
}
function Design3(id) {
    CreateFullBill3(id);
    LODOP.PRINT_DESIGN();
}
function RealPrint3(id) {
    CreateFullBill3(id);
    if (LODOP.PRINTA())
        alert("已发出实际打印命令！");
    else
        alert("放弃打印！");
}
function CreateFullBill3(id) {
    LODOP = getLodop();
    LODOP.PRINT_INITA(10, 10, 762, 533, "");
    LODOP.SET_PRINT_STYLE("FontColor", "#0000FF");
    //标题
    LODOP.ADD_PRINT_TEXT(27, 255, 200, 30, "星湖国际广场专柜结算单"); //2
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 13);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
    LODOP.ADD_PRINT_TEXT(17, 9, 100, 25, "第2次打印"); //30
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 13);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(40, 503, 220, 25, "打印时间:" + getDate02()); //31
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 11);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    //外矩形边框66 85 650 420
    LODOP.ADD_PRINT_SHAPE(2, 60, 5, 710, 238, 0, 1, "#000000"); //1是斜线2是矩形3是椭圆形4是矩形实心5是椭圆形实心，最后两值为边框线的样式（1-3为不同程度虚线）与粗细
    ////外矩形边框66 85 650 420
    LODOP.ADD_PRINT_SHAPE(2, 319, 5, 710, 84, 0, 1, "#000000"); //1是斜线2是矩形3是椭圆形4是矩形实心5是椭圆形实心，最后两值为边框线的样式（1-3为不同程度虚线）与粗细
    LODOP.ADD_PRINT_SHAPE(1, 175, 6, 585, 1, 0, 1, "#000000"); //7
    LODOP.ADD_PRINT_SHAPE(1, 195.6, 6, 585, 1, 0, 1, "#000000"); //8
    LODOP.ADD_PRINT_SHAPE(1, 216.2, 6, 710, 1, 0, 1, "#000000"); //9
    LODOP.ADD_PRINT_SHAPE(1, 236.8, 6, 710, 1, 0, 1, "#000000"); //10
    LODOP.ADD_PRINT_SHAPE(1, 257.4, 6, 710, 1, 0, 1, "#000000"); //11
    LODOP.ADD_PRINT_SHAPE(1, 278, 6, 710, 1, 0, 1, "#000000"); //12
    LODOP.ADD_PRINT_SHAPE(1, 319.2, 6, 710, 1, 0, 1, "#000000"); //14
    LODOP.ADD_PRINT_SHAPE(1, 359.8, 6, 710, 1, 0, 1, "#000000"); //15
//    LODOP.ADD_PRINT_SHAPE(1, 360.4, 6, 710, 1, 0, 1, "#000000");//16
//    LODOP.ADD_PRINT_SHAPE(1, 382, 6, 710, 1, 0, 1, "#000000");//17
//    LODOP.ADD_PRINT_SHAPE(1, 401.6, 6, 710, 1, 0, 1, "#000000");//18
    LODOP.ADD_PRINT_SHAPE(1, 152, 6, 710, 1, 0, 1, "#000000"); //21
    LODOP.ADD_PRINT_SHAPE(1, 128, 6, 710, 1, 0, 1, "#000000"); //22
    LODOP.ADD_PRINT_SHAPE(1, 128, 128, 1, 130, 0, 1, "#000000"); //23
    LODOP.ADD_PRINT_SHAPE(1, 128, 236, 1, 130, 0, 1, "#000000"); //24
    LODOP.ADD_PRINT_SHAPE(1, 128, 354, 1, 130, 0, 1, "#000000"); //25
    LODOP.ADD_PRINT_SHAPE(1, 128, 472, 1, 130, 0, 1, "#000000"); //26
    LODOP.ADD_PRINT_SHAPE(1, 128, 590, 1, 170, 0, 1, "#000000"); //29
//    LODOP.ADD_PRINT_SHAPE(1, 361, 198, 1, 62, 0, 1, "#000000");//61
    LODOP.ADD_PRINT_SHAPE(1, 320, 84, 1, 84, 0, 1, "#000000"); //60
    LODOP.ADD_PRINT_SHAPE(1, 320, 239, 1, 84, 0, 1, "#000000"); //61
    LODOP.ADD_PRINT_SHAPE(1, 320, 317, 1, 84, 0, 1, "#000000"); //62
    LODOP.ADD_PRINT_SHAPE(1, 320, 472, 1, 84, 0, 1, "#000000"); //62
    LODOP.ADD_PRINT_SHAPE(1, 320, 550, 1, 84, 0, 1, "#000000"); //62
    $.ajax({
        type: "GET",
        url: "../../../Noticemng/ajax/action/ck_nmc",
        data: {'id': id},
        dataType: "json",
        async: false,
        success: function (data) {
            var info = eval(data);
            LODOP.ADD_PRINT_TEXT(17, 652, 70, 25, info[0].busim_num); //31
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 13);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(67, 21, 300, 25, "结算单号:" + info[0].nm_notice_num); //40
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(87, 21, 300, 25, "合同单号:" + info[0].lm_num); //41
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(107, 21, 300, 25, "扣款单号:" + info[0].lm_num); //45
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(67, 384, 300, 25, "供应商:" + "   " + info[0].busim_num + "   " + info[0].busim_name); //46
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(87, 384, 300, 25, "结算周期:" + info[0].nmc_receperiod_b + "," + info[0].nmc_receperiod_e); //47
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(107, 384, 300, 25, "结算日期:" + getDate03()); //48
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(158, 26, 88, 25, info[0].nm_tol); //36
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(158, 143, 88, 25, ""); //54
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(158, 255, 88, 25, ""); //76
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(201, 21, 88, 25, ""); //36
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(201, 143, 88, 25, ""); //50
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(201, 254, 88, 25, ""); //50
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            //租金
            var ZJ = 0;
            //电费
            var DF = 0;
            //仓库租金
            var CK = 0;
            for (var i = 0; i < info.length; i++) {
                if (info[i].nmc_ci_id == 1) {
                    ZJ = ZJ + info[i].nmc_amount * 1;
                } else if (info[i].nmc_ci_id == 3) {
                    DF = DF + info[i].nmc_amount * 1;
                } else if (info[i].nmc_ci_id == 31) {
                    CK = CK + info[i].nmc_amount * 1;
                }
            }
            var total = ZJ * 1 + DF * 1 + CK * 1 + info[0].nm_unionpay * 1;
            LODOP.ADD_PRINT_TEXT(179, 622, 70, 25, info[0].nm_tol); //36
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(242, 622, 90, 25, total.toFixed(2)); //54
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(243, 387, 88, 25, CK.toFixed(2)); //38
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(243, 161, 88, 25, DF.toFixed(2)); //51
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(243, 43, 88, 25, ZJ.toFixed(2)); //51
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(243, 262, 88, 25, info[0].nm_unionpay); //37
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(243, 510, 88, 25, ""); //39
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(262, 622, 88, 25, info[0].nm_return); //49
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
            LODOP.ADD_PRINT_TEXT(284, 607, 88, 25, ""); //63
            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//            LODOP.ADD_PRINT_TEXT(325, 614, 88, 25, "会计审核1");//67
//            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
//            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//            LODOP.ADD_PRINT_TEXT(325, 143, 88, 25, "供应商签名1");//68
//            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
//            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//            LODOP.ADD_PRINT_TEXT(325, 391, 88, 25, "业务审核1");//69
//            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
//            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//            LODOP.ADD_PRINT_TEXT(345, 395, 88, 25, "出纳员1");//71
//            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
//            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//            LODOP.ADD_PRINT_TEXT(348, 148, 88, 25, "领导审批1");//72
//            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
//            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//            LODOP.ADD_PRINT_TEXT(345, 609, 88, 25, "附原始单据1");//73
//            LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
//            LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
        }
    });
    LODOP.ADD_PRINT_TEXT(133, 26, 70, 25, "普通销售额"); //36
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(133, 143, 90, 25, "促销销售额"); //54
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(134, 637, 70, 25, "小计"); //36
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(222, 637, 90, 25, "小计"); //54
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(133, 255, 100, 25, "促销赠出分摊额"); //76
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(181, 21, 80, 25, "会员卡分摊额"); //36
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(181, 143, 70, 25, "促销扣点额"); //50
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(181, 254, 100, 25, "促销受增分摊额"); //50
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(223, 43, 42, 25, "租金"); //51
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(223, 161, 34, 25, "电费"); //51
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(223, 262, 75, 25, "银联手续费"); //37
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(223, 387, 62, 25, "仓库租金"); //38
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(223, 510, 50, 25, "其他"); //39
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(262, 547, 38, 25, "实结"); //49
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(284, 547, 38, 25, "备注"); //63
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(303, 8, 355, 25, "*以内容，请各专柜认真核对，如有疑问，请致电财务部:2213939"); //64
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(303, 400, 140, 25, "单据审核:"); //65
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(303, 600, 70, 25, "制单:黄茗"); //66
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(335, 491, 70, 25, "会计审核"); //67
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(335, 18, 75, 25, "供应商签名"); //68
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(335, 255, 75, 25, "业务审核"); //69
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 256, 75, 25, "出纳员"); //71
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 23, 75, 25, "领导审批"); //72
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
    LODOP.ADD_PRINT_TEXT(377, 486, 75, 25, "附原始单据"); //73
    LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//    LODOP.ADD_PRINT_TEXT(410, 420, 165, 16, "80020000001724592");//74
//    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
//    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//    LODOP.ADD_PRINT_TEXT(393, 584, 100, 16, "7696.00");//74
//    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
//    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
//    LODOP.ADD_PRINT_TEXT(410, 584, 100, 16, "1232.00");//75
//    LODOP.SET_PRINT_STYLEA(0, "FontSize", 7);
//    LODOP.SET_PRINT_STYLEA(0, "FontColor", "#000000");
}