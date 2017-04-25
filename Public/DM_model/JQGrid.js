/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//主要方法
/**
 * 
 * @param {string} table表格的id
 * @param {string} pager 分页的id
 * @param {string} url 数据地址
 * @param {json} title 抬头名称
 * @param {json} content 内容数据及名称
 * @param {string} data 返回的数据名称
 * @param {string} total 总条数的字段名
 * @param {string} page 当前页的字段名
 * @param {string} records 总条数的字段名
 * @param {int} height 表格高度
 * @param {string} sortname 排序字段
 * @param {desc,asc} sortorder 排序类型
 * @param {Boolean} sortable 是否排序
 * @param {Boolean} multiselect 是否多选
 * @param {Boolean} autowidth 是否自动宽度
 * @param {int} rowNum 初始每页几条
 * @param {json} rowList 下拉每页几条
 * @param {int} isSelectOn 是否触点击事件
 * @param {int} is_load 是否触发页面加载返回事件  字符串方法的参数名必须为 【data】
 * @footerrow {Boolean} true为显示页脚总汇  反之false
 * @checkId {String} id用，隔开，加载或查询自动勾选
 * @returns {void}
 */
function jqGrid_data(table, pager, url, title, content, data, total, page, records, height, sortname, sortorder, multiselect, autowidth, rowNum, top, isSelectOn, is_load, footerrow, checkId) {

    if (footerrow == "" || footerrow == undefined) {
        footerrow = false;
    }
    title = eval(title);
    content = eval(content);
    $("#" + table).jqGrid({
        url: url, //请求数据的url地址 
        datatype: "json", //请求的数据类型 
        colNames: title, //数据列名称（数组） 
        styleUI: 'Bootstrap', //设置jqgrid的全局样式为bootstrap样式  
        colModel: content,
        jsonReader: {
            root: data, //返回数据数组名称
            total: total, //总条数
            page: page, //当前页
            records: records, //代表数据行总数的数据
            repeatitems: false// 如果设为false，则jqGrid在解析json时，会根据name来搜索对应的数据元素（即可以json中元素可以不按顺序）；而所使用的name是来自于colModel中的name设定。
        },
        onSelectRow: function (id) {
            if (isSelectOn != 0) {
                eval(isSelectOn);
            }
        },
        multiselect: multiselect, //可多选，出现多选框 
        caption: top,
        rowNum: 20, //每页显示记录数
        rowList: [20,30, 50, 100, 150, 200, 99999], //分页选项，可以下拉选择每页显示记录数
        pager: '#' + pager, //表格数据关联的分页条，html元素 
        autowidth: autowidth, //自动匹配宽度 
        height: height, //设置高度 
        gridview: false, //加速显示 
        viewrecords: true, //显示总记录数 
        sortable: true, //可以排序 
        sortname: sortname, //排序字段名 
        sortorder: sortorder, //排序方式：倒序，本例中设置默认按id倒序排序
        // autowidth:true, 
//        footerrow: footerrow, //是否显示页脚汇总
//        userDataOnFooter: footerrow, //是否显示页脚汇总数据
//        altRows: footerrow, //什么交替行表格
//        multikey: "ctrlKey", //按中ctrl键才能选中

        //shrinkToFit:false,
        loadComplete: function (data) {
            if (is_load != 0) {
                //alert(123);
                eval(is_load);
            }
        },
        //默认勾选数据
        gridComplete: function () {
            //给grid添加链接 
            var graduateIds = jQuery("#list").jqGrid('getDataIDs');
            for (var i = 0; i < graduateIds.length; i++) {
                var cl = graduateIds[i];
                var link = "<a href=''><font color='red'>xxxxx</font></a>";
                jQuery("#list").jqGrid('setRowData', cl, {employeeNm: link});
            }

            if (checkId != "" && checkId != 0 && checkId != undefined) {
                var id_array = checkId.split(",");
                for (var i = 0; i < id_array.length; i++) {
                    $(this).jqGrid("setSelection", id_array[i]);
                }
            } else {
                $(this).jqGrid("setSelection", -1);
            }

        }
    });
    jQuery("#" + table).navGrid('#' + pager, {edit: false, add: false, del: false, search: false}, {multipleSearch: true, multipleGroup: true, showQuery: true});
}
/**
 * 参数：data_ary {array} 数组索引必须为一下规定的写法
 * @param {string} table表格的id |1
 * @param {string} pager 分页的id |1
 * @param {string} url 数据地址 |1
 * @param {json} title 抬头名称 |1
 * @param {json} content 内容数据及名称 |1
 * @param {string} data 返回的数据名称 |1
 * @param {string} total 总条数的字段名 |1
 * @param {string} page 当前页的字段名 |1
 * @param {string} records 总条数的字段名 |1
 * @param {int} height 表格高度
 * @param {string} sortname 排序字段
 * @param {desc,asc} sortorder 排序类型
 * @param {Boolean} sortable 是否排序
 * @param {Boolean} multiselect 是否多选
 * @param {Boolean} autowidth 是否自动宽度
 * @param {int} rowNum 初始每页几条 |1
 * @param {json} rowList 下拉每页几条
 * @param {string} isSelectOn 是否触发点击事件
 * @param {string} isSelectOnAll 是否触发全选事件
 * @param {int} is_load 是否触发页面加载返回事件  为触发的方法名 别忘了()
 * @param footerrow {Boolean} true为显示页脚总汇  反之false
 * @param checkId {Boolean} 有值为启用 false禁用 (传入元素的标示，在元素里放入所勾选的id,以逗号分隔   值格式为：如果是id #name   如果是class .name)
 * @param group_name {string} 是否启用分组  传入需要分组的字段名称即可
 * @param alt_rows {Boolean} 有值为启用 false禁用 隔行颜色
 * @returns {void}
 */
function jqGrid_Data(data_ary) {
    var group = true;
    //初始化cookie是值
    del_jqrid_cookie();
    if (data_ary.footerrow == "" || data_ary.footerrow == undefined) {
        data_ary.footerrow = false;
    }
    if (data_ary.autowidth == "" || data_ary.autowidth == undefined) {
        data_ary.autowidth = true;
    }
    if (data_ary.checkId == "" || data_ary.checkId == undefined) {
        data_ary.checkId = false;
    }
    if (data_ary.group_name == "" || data_ary.group_name == undefined) {
        group = false;
    }
    if (data_ary.alt_rows == "" || data_ary.alt_rows == undefined) {
        data_ary.alt_rows = false;
    }
    if (data_ary.mtype == "" || data_ary.mtype == undefined) {
        data_ary.mtype == "get";
    }
    data_ary.title = eval(data_ary.title);
    data_ary.content = eval(data_ary.content);
    $("#" + data_ary.table).jqGrid({
        mtype: data_ary.mtype,
        url: data_ary.url, //请求数据的url地址 
        datatype: "json", //请求的数据类型 
        colNames: data_ary.title, //数据列名称（数组） 
        styleUI: 'Bootstrap', //设置jqgrid的全局样式为bootstrap样式  
        colModel: data_ary.content,
        jsonReader: {
            root: data_ary.data, //返回数据数组名称
            total: data_ary.total, //总条数
            page: data_ary.page, //当前页
            records: data_ary.records, //代表数据行总数的数据
            repeatitems: false// 如果设为false，则jqGrid在解析json时，会根据name来搜索对应的数据元素（即可以json中元素可以不按顺序）；而所使用的name是来自于colModel中的name设定。
        },
        onSelectRow: function (rowid, status) {
            var data = ({aRowids: rowid, status: status});
            if (data_ary.isSelectOn != 0) {
                eval(data_ary.isSelectOn);
            }
        },
        onSelectAll: function (aRowids, status) {
            var data = ({aRowids: aRowids, status: status});
            if (data_ary.isSelectOnAll != 0) {
                eval(data_ary.isSelectOnAll);
            }
        },
        multiselect: data_ary.multiselect, //可多选，出现多选框 
        hidegrid: false, //隐藏收起图标
        caption: data_ary.top,
        rowNum: data_ary.rowNum, //每页显示记录数
        rowList: [30, 50, 100, 150, 200, 99999], //分页选项，可以下拉选择每页显示记录数
        pager: '#' + data_ary.pager, //表格数据关联的分页条，html元素 
        autowidth: data_ary.autowidth, //自动匹配宽度 
        height: data_ary.height, //设置高度 
        gridview: false, //加速显示 
        viewrecords: true, //显示总记录数 
        sortable: true, //可以排序 
        sortname: data_ary.sortname, //排序字段名 
        sortorder: data_ary.sortorder, //排序方式：倒序，本例中设置默认按id倒序排序 
        altRows: data_ary.alt_rows, //隔行颜色
        footerrow: data_ary.footerrow, //是否显示页脚汇总
        userDataOnFooter: data_ary.footerrow, //是否显示页脚汇总数据
//        multikey: "ctrlKey", //按中ctrl键才能选中
        //jqgrid加载事件
        grouping: group,
        groupingView: {
            groupField: [data_ary.group_name], //分组属性
            groupColumnShow: [true], //是否显示分组列
            groupText: ['<b>{0} - {1}条</b>'], //表头显示数据(每组中包含的数据量)
            groupCollapse: false, //加载数据时是否只显示分组的组信息
            groupOrder: ['desc'], //分组后组的排列顺序
            groupSummary: true //是否显示汇总  如果为true需要在colModel中进行配置summaryType:'max',summaryTpl:'<b>Max: {0}</b>'
                    //showSummaryOnHide: true//是否在分组底部显示汇总信息并且当收起表格时是否隐藏下面的分组
        },
        loadComplete: function (data) {
            if (data_ary.checkId != false) {
                var jqgrid_check_id = $(data_ary.checkId).val();
                if (jqgrid_check_id != "") {
                    var id_array = jqgrid_check_id.split(",");
                    for (var i = 0; i < id_array.length; i++) {
                        $(this).jqGrid("setSelection", id_array[i]);
                    }
                }
            }
            if (data_ary.is_load != 0) {
                eval(data_ary.is_load);
            }
        },
    });
    jQuery("#" + data_ary.table).navGrid('#' + data_ary.pager, {edit: false, add: false, del: false, search: false}, {multipleSearch: true, multipleGroup: true, showQuery: true});
}
//查询数据
/**
 * 
 * @param {string} id_name 需要查询数据的界面id，后台获取也为此名字，多个以逗号分割
 * @param {string} url 控制器路径 没有{}这个
 * @returns {string}
 */
function gridReload(id_name, url) {
    if (id_name != "") {
        var data = id_name.split(",");
        for (var i = 0; i < data.length; i++) {
            var v =  $("#" + data[i]).val();

            if (v != "" && typeof(v)!=='undefined') {

                url += "/" + data[i] + "/" + $("#" + data[i]).val();
            }
        }
    }
    return url;
}
//勾选记忆
/**
 * data 回调参数
 * fig 多个表格区分
 * *****PS：如果初始化页面，就存在的某些id，那就必须把这些id放入 save_jqgrid_id_ 此cookie里面****
 * 可以参考例子：CsSys/View/HandOverBldg/add
 * 可以参考例子：CsSys/View/HandOverBldg/up
 */
function save_jqgrid_id(data, fig) {
    //获取不同id的cookie名字的标示
    var jqgrid_id_cookie_name = getCookie("jqgrid_id_cookie_name");
    //如果不是第一次进入
    if (jqgrid_id_cookie_name != "null") {
        //拆分标示为数组
        var jqgrid_id_cookie_name = jqgrid_id_cookie_name.split(",");
        //检查是否包含当前传入标示
        if (IndexOfStr(jqgrid_id_cookie_name, fig) < 1) {
            //如果不包含 则加入
            document.cookie = "jqgrid_id_cookie_name=" + jqgrid_id_cookie_name + "," + fig;
        }
    } else {
        //如果是第一次进入，直接赋值
        document.cookie = "jqgrid_id_cookie_name=" + fig;
    }
//选中返回的id
    var id = data.aRowids;
    //选中状态  true：勾选  false：取消勾选
    var status = data.status;
    //如果当前id不为数组
    if (id instanceof Array === false) {
        //转换为数组
        id = id.split(",");
    }
    //获取保存在cookie里的id
    var ids = document.cookie = getCookie("save_jqgrid_id_" + fig);
    //如果是第一次进入
    if (ids == "null") {
        //直接赋值
        ids = id;
    } else {
        //不是第一次进入，拆分数组
        ids = ids.split(",");
        for (var i = 0; i < ids.length; i++) {
            //判断是否包含当前选择的id值
            if (id.indexOf(ids[i]) > -1) {
                //包含则剔除
                ids.splice(i, 1);
                i--;
            }
        }
        //如果是勾选
        if (status) {
            //直接添加到数组
            ids.push(id);
        }
    }
    //把当前标示的id数组放入cookie
    document.cookie = "save_jqgrid_id_" + fig + "=" + ids;
    return ids;
}
//获取id
/**
 * 
 * @param {string} id table的ID
 * @param {string} sql_name 需要获取的字段名
 * @param {int} is_more 是否可以获取多个
 * @returns {Boolean|String|getGridId.id3}
 */
function getGridId(id, sql_name, is_more) {
//获取Grid中选中的行id
//            var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
    var ids = $("#" + id).jqGrid('getGridParam', 'selarrrow'); //获取所有
    if (ids != "") {
//                var rowData = jQuery('#List').jqGrid('getGridParam','selarrrow');
        var id3 = "";
        //获取选中id
        for (var i = 0; i < ids.length; i++) {
            var rets = jQuery("#" + id).jqGrid('getRowData', ids[i]);
            id3 += rets[sql_name] + ",";
        }
        id3 = id3.substr(0, id3.length - 1);
        if (is_more == 1 && i > 1) {
            return false;
        } else {
            return id3;
        }
    } else {
        return false;
    }
}
//展示影藏某列
/**
 * 
 * @param {type} id table的id
 * @param {type} cm_name 每一列的name
 * @returns {void}
 */
function showOrHide(id, cm_name) {
    var name = cm_name.split(",");
    if (name.length > 0) {
        for (var i = 0; i < name.length; i++) {
            alert(name[i]);
            jQuery("#" + id).jqGrid('hideCol', name[i]);
        }
    } else {
        alert("数据错误");
    }
}

/*
 * id :表格的id
 * 说明：显示使用hideCols隐藏的列。
 * author:wuzhenghua
 * time:2016/07/13
 * */
function showAllCols(id) {
    for (var i = 0; i < jQuery("#" + id + " td:hidden").length; i = i + 1) {

        var bb = jQuery("#" + id + " td:hidden").eq(i).attr("aria-describedby");
        if (bb) {
            var colname = bb.substring(5);
            jQuery("#" + id).setGridParam().showCol(colname);
        }

    }
    $("#" + id).setGridWidth($(window).width() - 10);
}

/*
 * id:表格的id
 * 说明：双击隐藏对应的列，双击的位置不能在列头。要在<script>直接调用此函数
 * author:wuzhenghua
 * time:2016/07/13
 * */
function hideCols(id) {
    $(document).bind("dblclick", function (e) {
        var tt = $(e.target).attr("aria-describedby");
        var colname = tt.substring(5);
        jQuery("#" + id).setGridParam().hideCol(colname);
        $("#" + id).setGridWidth($(window).width() - 10);
    });
}

/*
 * url:获取隐藏字段的方法 cf_tab_name:表单名称，每一个jqGrid对应唯一名称 jqgrid_name:jqGrid的id
 * 说明：获取隐藏的列表
 * author:chenzeao
 * time:2017/02/09
 * */
function get_hide_col(url, cf_tab_name, jqgrid_name) {
    $.ajax({
        type: "POST",
        url: url,
        data: "cf_tab_name=" + cf_tab_name,
        dataType: "json",
        success: function (msg) {
            var arr = eval(msg);
            for (var i = 0; i < arr.length; i++) {
                jQuery("#" + jqgrid_name).setGridParam().hideCol(arr[i]).trigger("reloadGrid");
            }
        }
    });
}

/*
 * id:表格id
 * 说明：打印表格的数据，最好在页面加上
 * <style type="text/css" media="print">
 #accordion h3, #vcol, div.loading, div.ui-tabs-hide,ul.ui-tabs-nav li, td.HeaderRight { display:none }
 .ui-jqgrid-titlebar, .ui-jqgrid-title{ display:none }
 .ui-jqgrid .ui-jqgrid-bdiv_self{position: relative; margin: 1; padding:0; text-align:left;}
 #pager{display:none; z-index:-1;}
 .ui-jqgrid .ui-jqgrid-sortable_self{color: black;font-family: "微软雅黑", YaHei, "黑体"}
 </style>
 这是打印时候的样式，因为，表头和页尾你是不想打印出来的。打印完之后，样式自动还原。
 author:wuzhenghua
 time:2016/07/13
 * */
function jqgridPrint(id) {
    var jqgridObj = jQuery("#" + id);
    var GridHeight = jqgridObj.jqGrid('getGridParam', 'height'); //获取高度
    var GridWidth = jqgridObj.jqGrid('getGridParam', 'width');
    jqgridObj.setGridWidth(GridWidth - 100);
    //jqgridObj.jqGrid('setGridHeight', '100%');//将其高度设置成100%,主要是为了jqgrid 中有Scroll条时 能把该scroll条内内容都打印出来
    $(".ui-jqgrid .ui-jqgrid-bdiv").removeClass().addClass("ui-jqgrid-bdiv_self"); //去除掉overflow属性
    $(".ui-jqgrid .ui-jqgrid-sortable").removeClass().addClass("ui-jqgrid-sortable_self"); //字段颜色加深
    window.focus();
    window.print();
    $(".ui-jqgrid .ui-jqgrid-bdiv_self").removeClass().addClass("ui-jqgrid-bdiv"); //恢复overflow属性，否则会导致jqgrid中scroll条消失
    jqgridObj.jqGrid('setGridHeight', GridHeight); //设置成打印前的高度
    jqgridObj.jqGrid('setGridWidth', GridWidth); //设置成打印前的高度

    return false;
}
//读取cookie
function getCookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg)) {
        return unescape(arr[2]);
    } else {
        return "null";
    }
}

function IndexOfStr(array, val) {
    var s = 0;
    for (var i = 0; i < array.length; i++) {
        if (array[i] == val) {
            s = 1;
        }
    }
    return s;
}
//删除jqgrid的cookie
function del_jqrid_cookie() {
    var fig = getCookie("jqgrid_id_cookie_name");
    if (fig != "null") {
        fig = fig.split(",");
        for (var i = 0; i < fig.length; i++) {
            document.cookie = "save_jqgrid_id_" + fig[i] + "=null";
        }

    }
    document.cookie = "jqgrid_id_cookie_name=null";
}

//cellvalue   当前列的值
//options{
//gid:"list" 当前表格的元素id
//pos:2  //当前为第几列
//rowId:"57" //当前id为多少
//}
//rowObject{
//dateline:"2016/09/28 14:40"
//fields:"0"
//form_desc:"11111"
//form_name:"1111"
//id:"57"
//updatetime:"2016/09/28 14:40"
//}
//function customFmatter(cellvalue, options, rowObject) {
//    return "【32123132323213123" + cellvalue + "】";
//}
//******************子页面操作父页面*************************
// var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
// parent.location.reload(); // 父页面刷新
// parent.layer.tips('Look here', '#parentIframe', {time: 5000});
// parent.layer.close(index);关闭子页面


function table_size(width, height) {
    // 定义表格宽高
    $(window).resize(function (event) {
        fun();
    });

    function fun() {
        $("#list").setGridWidth($(window).width() - width);
        $("#list").setGridHeight($(window).height() - height);
    }

    window.onload = function () {
        $("#list").setGridWidth($(window).width() - width);
        $("#list").setGridHeight($(window).height() - height);
    };
}