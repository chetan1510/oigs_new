<?php

namespace App;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// error_reporting(0);

$styleArrayborder = array(
    'borders' => array(
        'outline' => array(
            'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => array('argb' => 'FF4E81BE'),
        ),
    ),
    'fill' => array('type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'color' => array('argb' => 'FF4E81BE',),),
);

$styleArray4 = array(
    'font' => array('bold' => true,'color' => array('argb' => 'FFFFFFFF',),),
    'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,),
    'fill' => array('type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,'color' => array('argb' => 'FF4E81BE',),),
    'borders' => array(
        'outline' => array(
        'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        'color' => array('argb' => 'FF000000'),
        ),
    ),
 );

$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$Excel_writer = new Xlsx($spreadsheet);  /*----- Excel (Xls) Object*/
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();
$activeSheet->setTitle("Current Stocks");

$ar_names = array("SN", "Name", "DOB", "Gender");

$ar_fields = array("sn","name","dob","gender");

$ar_width = array("15","25","20","20");


// $spreadsheet->getActiveSheet()->mergeCells('B2:B4');
// $spreadsheet->getActiveSheet()->setCellValue('B2', 'Falcon Container Terminal');
// $spreadsheet->getActiveSheet()->getStyle('B2:B4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('edde0c');

// $spreadsheet->getActiveSheet()->mergeCells('E3:F3');
// $spreadsheet->getActiveSheet()->setCellValue('E3', $company_name.'LINE DAILY STOCK REPORT');


// $spreadsheet->getActiveSheet()->setCellValue('I3', 'DATE');
// $spreadsheet->getActiveSheet()->setCellValue('J3', $today);

// $spreadsheet->getActiveSheet()->getStyle('J3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('edde0c');

// $spreadsheet->getActiveSheet()->setCellValue('B6','SIZE');
// $spreadsheet->getActiveSheet()->setCellValue('B7','NGFAL');
// $spreadsheet->getActiveSheet()->getStyle('B7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('edde0c');
// $spreadsheet->getActiveSheet()->setCellValue('B8','TOTAL');


// $spreadsheet->getActiveSheet()->setCellValue('C6','20 GP');
// $spreadsheet->getActiveSheet()->setCellValue('D6','20 OT');
// $spreadsheet->getActiveSheet()->setCellValue('E6','40 GP');
// $spreadsheet->getActiveSheet()->setCellValue('F6','40 HC');
// $spreadsheet->getActiveSheet()->setCellValue('G6','40 OT');

// $spreadsheet->getActiveSheet()->setCellValue('C10','TOTAL');
// $spreadsheet->getActiveSheet()->setCellValue('D10','20');
// $spreadsheet->getActiveSheet()->setCellValue('E10','40');
// $spreadsheet->getActiveSheet()->setCellValue('F10','TOTAL TUE');

// $spreadsheet->getActiveSheet()->setCellValue('C12','TEUS');


$seq = 1;
$offset = 0;
$count = 0;
$i = 0;
foreach ($ar_fields as $ar) {

    $cell_val = $i + $offset;
    $cell_val = $this->getNameFromNumber($cell_val);

    $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell_val . $seq, $ar_names[$count]);
    $spreadsheet->getActiveSheet()->getColumnDimension($cell_val)->setWidth($ar_width[$count]);
    $spreadsheet->getActiveSheet()->getStyle($cell_val . $seq)->applyFromArray($styleArrayborder);
    $spreadsheet->getActiveSheet()->getStyle($cell_val . $seq)->getAlignment()->setWrapText(true);
    $i++;
    $count++;
}

$spreadsheet->getActiveSheet()->getStyle('A14:I14')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('edde0c');

$seq++;
$count = 0;

foreach ($students as $row) {
    
    $i = 0;

    foreach ($ar_fields as $ar) {
        $var = '';
        $cell = $i + $offset;
        $cell_val = $this->getNameFromNumber($cell);

        if($ar == 'sn' ){
            $var = ++$count;
        } else {
            $var = (isset($row->{$ar}))?$row->{$ar}:'';
        }
        $i++;

        $spreadsheet->getActiveSheet()->setCellValue($cell_val . $seq, $var);
    }

    $seq++;
}









$filename = 'Students'.date("dmY_his",strtotime("now")).'.xlsx';
$writer = new Xlsx($spreadsheet);

// if($bulkStore == 1){

//     if(env("FTP_STATUS") == 1){
//         $path = app_path()."/../uploads/";
//         $writer->save($path.$filename);
//     } else {
//         header('Content-Type: application/vnd.ms-excel');
//         header('Content-Disposition: attachment;filename="'. $filename); 
//         header('Cache-Control: max-age=0');
//         $writer->save("php://output");
//     }

//     exit();
// }

// if($bulkStore == 2){

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename); 
    header('Cache-Control: max-age=0');
    $Excel_writer = IOFactory::createWriter($spreadsheet,'Xlsx');
    $Excel_writer->save('temp/'.$filename);
    $data['excel_link'] = url('temp/'.$filename);
// }