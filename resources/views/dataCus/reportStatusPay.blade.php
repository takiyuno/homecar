<?php
// echo $fdate." to ".$tdate;
// exit();
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Poobate Khunthong")
->setLastModifiedBy("Poobate Khunthong")
->setTitle("Office 2007 XLSX ")
->setSubject("Office 2007 XLSX ")
->setDescription("document for Office 2007 XLSX")
->setKeywords("office 2007 openxml php")
->setCategory("result file");

$resource =[ 1 => "ป้ายโฆษณา/รถแห่/วิทยุ/จดหมาย",
             2 => "ลูกค้าไฟแนนซ์เก่า/ลูกค้าซื้อขายเก่า",
             3 => "นายหน้า/ลูกค้าแนะนำ",
             4 => "ศูนย์บริการ",
             5 => "FB บริษัท",
             6 => "FB ส่วนตัว",
             7 => "Line บริษัท",
             8 => "Walk In",
             9 => "Call In",
              11 => "ลูกค้าเก่าแนะนำ",
             10 => "อื่นๆ"];
$arrayOriginType = [
	1 => 'CKL',
	2 => 'รถประมูล',
	3 => 'รถยึด',
	4 => 'ฝากขาย',
	5 => 'เทิร์นรถใหม่',
	6 => 'เทิร์นรถมือสอง',
	7 => 'ซื้อหน้าเต็นท์',
	8 => 'นายหน้า',
	9 => 'เทิร์นรถ GWM',
];
			// Create a first sheet, representing sales data

$objPHPExcel->setActiveSheetIndex(0);



$objPHPExcel->getActiveSheet()->setCellValue('A2', '#');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'ชื่อ-สกุลลูกค้า');
$objPHPExcel->getActiveSheet()->setCellValue('C2', 'วันที่จอง');
$objPHPExcel->getActiveSheet()->setCellValue('D2', 'วันที่เซ็นสัญญา');
$objPHPExcel->getActiveSheet()->setCellValue('E2', 'วันนัดหมายส่งมอบ');
$objPHPExcel->getActiveSheet()->setCellValue('F2', 'ฝ่ายขาย');
$objPHPExcel->getActiveSheet()->setCellValue('G2', 'ยี่ห้อรถ');
$objPHPExcel->getActiveSheet()->setCellValue('H2', 'รุ่นรถ');
$objPHPExcel->getActiveSheet()->setCellValue('I2', 'ทะเบียนรถ');
$objPHPExcel->getActiveSheet()->setCellValue('J2', 'ไฟแนนท์');
$objPHPExcel->getActiveSheet()->setCellValue('K2', 'วันที่เฟิร์มเคส');
$objPHPExcel->getActiveSheet()->setCellValue('L2', 'วันที่เงินเข้า');
$objPHPExcel->getActiveSheet()->setCellValue('M2', 'วันที่ PO');
$objPHPExcel->getActiveSheet()->setCellValue('N2', 'ยอดเงินเข้าบัญชี');

$objPHPExcel->getActiveSheet()->getStyle('A1:N2')->getAlignment()->setWrapText(true);
			// Set alignments จัดรูปแบบหน้า ตรงกลางซ้ายขวากึ่งกลาง
			//echo date('H:i:s') . " Set alignments\n";
$objPHPExcel->getActiveSheet()->getStyle('A1:N2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:N2')->getAlignment()->setWrapText(true);
			// $objPHPExcel->getActiveSheet()->getStyle('A6:L6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			// $objPHPExcel->getActiveSheet()->getStyle('A2:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



			// Set style for header row using alternative method 
			//echo date('H:i:s') . " Set style for header row using alternative method\n";
$objPHPExcel->getActiveSheet()->getStyle('A1:N2')->applyFromArray(
	array(
		'font'    => array(
			'bold'      => true
		),
		
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		),
		'fill' => array(
			'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
			'rotation'   => 90,
			'startcolor' => array(
				'argb' => 'FFA0A0A0'
			),
			'endcolor'   => array(
				'argb' => 'FFFFFFFF'
			)
		)
	)
);


$r = 1;

		   //for($i=1;$i<8;$i++){
$data = DB::table('data_customers')
->leftjoin('data_cars','data_customers.Datacar_id','=','data_cars.id')
->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
	return $q->whereBetween('data_cars.SendCar_Date',[$fdate,$tdate]);
})

->where('data_customers.Datacar_id','<>',NULL)
->where('data_customers.Status_Cus','=','ส่งมอบ')
->orderBy('data_customers.created_at', 'ASC')
->get();



$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+1),"");	

$no = 1;
						//while($row = mysql_fetch_array($result)) {
foreach($data as $d_cus){
$user = DB::table('users')->where('username',$d_cus->Sale_Cus)->first();
	$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$d_cus->Name_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$d_cus->Reserve_date);
	if($d_cus->Contract_Date==NULL){
		$dateC= $d_cus->Date_cont;
	}else{
		$dateC= $d_cus->Contract_Date;
	}
	$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$dateC);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$d_cus->SendCar_Date);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$user->name);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$d_cus->Brand_Car);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$d_cus->Version_Car);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$d_cus->Number_Regist);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$d_cus->Finance_Name);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$d_cus->FirmCase);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$d_cus->Date_Withdraw);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$d_cus->Po_Date);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$d_cus->Amount_Price);
	
	
	
	$r++;
	$no++;
	
	
}


							//$r=$r+1; 
						//}\
$objPHPExcel->getActiveSheet()->getStyle('U3'.':BA'.($r+1))->getNumberFormat()->setFormatCode("#,##0.00");
$objPHPExcel->getActiveSheet()->getStyle('A3'.':BA'.($r+1))->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A3'.':BA'.($r+1))->getFont()->setSize(8);
$objPHPExcel->getActiveSheet()->getStyle('A3:BA'.($r+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
// $objPHPExcel->getActiveSheet()->getStyle('Z')->getAlignment()->setWrapText(true);
// $objPHPExcel->getActiveSheet()->getStyle('AA')->getAlignment()->setWrapText(true);				
// $objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setWrapText(true);			



$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':N'.($r+2))->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':N'.($r+2))->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':N'.($r+2))->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':N'.($r+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A2:N'.($r+2))->applyFromArray(
	array(
		
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);



$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BInvoice&RPrinted on &D');
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

			// Set page orientation and size
			//echo date('H:i:s') . " Set page orientation and size\n";
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75); // กำหนดระยะขอบ บน
			$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.25); // กำหนดระยะขอบ ขวา
			$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.25); // กำหนดระยะขอบ ซ้าย
			$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75); // กำหนดระยะขอบ ล่าง
			// Rename sheet
			//echo date('H:i:s') . " Rename sheet\n";
			$objPHPExcel->getActiveSheet()->setTitle('PP CUS');

			
			$fname = 'tmp\monthly.xlsx';
			$nameFile = "monthly.xlsx";
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save($fname);

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="monthly.xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		?>