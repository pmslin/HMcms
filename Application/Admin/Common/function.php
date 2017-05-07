<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2017/5/1
 * Time: 10:35
 */

/*
 *  发书权限检测，roleid=1和4的可以修改，1超管 4教务 6图书管理
 */
function book_check(){
    if(!in_array(session('roleid'),array(1,4,6))) {
        $this->error('没有操作权限');
    }
}



/**
 * Excel导出
 * @param data 导出数据
 * @param title 表格的字段名 字段长度有限制，一般都够用，可以改变 $length1和$length2来增长
 * @return subject 表格主题 命名为主题+导出日期
 * @ary->merge array 合并 例:A1:D1                            A1到D1合并
 * @ary->height array OR string 高度 例:1-10                            第一行高度为10 如果为一个数字，即为默认高度
 * @ary->width array 宽度 例:A-10                      A行宽度为10
 * @ary->size array OR string 字体大小 例:A1-10                  第一行字体为10 如果为一个数字，即为默认大小
 * @ary->bold array 加粗 例:A1:D1                             A1到D1加粗
 * @ary->border array string 边框颜色 例:A1:D1-#CC0000    A1-D1改变边框颜色（注：不能为英文）
 * @ary->background array 背景颜色  例:A1:D1-#CC0000    A1-D1改背景颜色（注：不能为英文）
 * ***********例子**************
$merge[0] = "A1:D1";  //A1到D1合并
$bold[0] = "A2:D2";  //A2到D2字体加粗
$height[0] = "5-50"; //第五行的高度为50
$width[0] = "A-50";  //A列的宽度为50
$border[0] = "A2:D2-#CC0000";  //A2到D2的边框为#CC0000(红色)
$size[0] = "A2:D2-15";  //A2到D2的字体为15
$background[0] = "A2:D2-#CC0000"; //A2到D2的背景为#CC0000(红色)
$ayr = array(
'merge' => $merge,
'bold' => $bold,
'height' => $height,
'width' => $width,
'border' => $border,
'background' => $background,
'size' => $size
);
 */
function exportExcel($data, $title, $subject, $ary = null) {
    Vendor('PHPExcel.PHPExcel');

    Vendor('PHPExcel.PHPExcel.IOFactory');
    Vendor('PHPExcel.PHPExcel.Reader.Excel5');
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    set_time_limit(0);
    @ini_set('memory_limit', '256M');
    // Set properties
    $objPHPExcel->getProperties()->setCreator("ctos")
        ->setLastModifiedBy("ctos")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
    $length1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH');
    $length2 = array('A1', 'B1', 'C1', 'D1', 'E1', 'F1', 'G1', 'H1', 'I1', 'J1', 'K1', 'L1', 'M1', 'N1', 'O1', 'P1', 'Q1', 'R1', 'S1', 'T1', 'U1', 'V1', 'W1', 'X1', 'Y1', 'Z1', 'AA1', 'AB1', 'AC1', 'AD1', 'AE1', 'AF1', 'AG1', 'AH1');
    //set width
    for ($a = 0; $a < count($title); $a++) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($length1[$a])->setWidth(20);
    }
    //set font size bold
    $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle($length2[0] . ':' . $length2[count($title) - 1])->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle($length2[0] . ':' . $length2[count($title) - 1])->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle($length2[0] . ':' . $length2[count($title) - 1])->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

    // set table header content
    for ($a = 0; $a < count($title); $a++) {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($length2[$a], $title[$a]);
    }
    for ($i = 0; $i < count($data); $i++) {
        $buffer = $data[$i];
        $number = 0;
        foreach ($buffer as $value) {
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit($length1[$number] . ($i + 2), $value, PHPExcel_Cell_DataType::TYPE_STRING); //设置单元格为文本格式
            $number++;
        }
        unset($value);
        $objPHPExcel->getActiveSheet()->getStyle($length1[0] . ($i + 2) . ':' . $length1[$number - 1] . ($i + 2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($length1[0] . ($i + 2) . ':' . $length1[$number - 1] . ($i + 2))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getRowDimension($i + 2)->setRowHeight(16);
    }
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    /*     * *******************************样式********************************** */
    //单元格合并
    for ($i = 0; $i < count($ary['merge']); $i++) {
        $objPHPExcel->getActiveSheet()->mergeCells($ary['merge'][$i]);
        $objPHPExcel->getActiveSheet()->getStyle($ary['merge'][$i])->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($ary['merge'][$i])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    }
    // 设置宽度
    for ($i = 0; $i < count($ary['width']); $i++) {
        $w = split("-", $ary['width'][$i]);
        $objPHPExcel->getActiveSheet()->getColumnDimension($w[0])->setWidth($w[1]);
    }
    //设置行高度
    if (is_array($ary['height'])) {
        for ($i = 0; $i < count($ary['height']); $i++) {
            $h = split("-", $ary['height'][$i]);
            $objPHPExcel->getActiveSheet()->getRowDimension($h[0])->setRowHeight($h[1]); //第一行行高
        }
    } else {
        if ($ary['height'] > 0) {
            $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight($ary['height']); //设置默认行高
        }
    }
    //字体和样式
    if (is_array($ary['size'])) {
        for ($i = 0; $i < count($ary['size']); $i++) {
            $s = split("-", $ary['size'][$i]);
            $objPHPExcel->getActiveSheet()->getStyle($s[0])->getFont()->setSize($s[1]); //字体大小
        }
    } else {
        if ($ary['size'] > 0) {
            //默认字体大小
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize($ary['size']);
        }
    }
    //加粗
    for ($i = 0; $i < count($ary['bold']); $i++) {
        $objPHPExcel->getActiveSheet()->getStyle($ary['bold'][$i])->getFont()->setBold(true); //第二行是否加粗
    }
    //边框样式
    for ($i = 0; $i < count($ary['border']); $i++) {
        $b = split("-", $ary['border'][$i]);
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN, //设置border样式
                    'color' => array('argb' => $b[1]),
                ),
            ),
        );

        $objPHPExcel->getActiveSheet()->getStyle($b[0])->applyFromArray($styleArray);
    }
    //背景颜色
    for ($i = 0; $i < count($ary['background']); $i++) {
        $b = split("-", $ary['background'][$i]);
        $objPHPExcel->getActiveSheet()->getStyle($b[0])->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle($b[0])->getFill()->getStartColor()->setARGB($b[1]);
    }
    //全部居中  非合并单元格
    $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    /*     * ***************************************************************** */
    ob_end_clean(); //清除缓冲区,避免乱码
    // Redirect output to a client’s web browser (Excel5)
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename=' . $subject . '(' . date('Y-m-d') . ')生成.xls');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
}