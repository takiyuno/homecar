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


			// Create a first sheet, representing sales data

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(10);


$objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'วันที่ดูรถ');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'ประเภทการซื้อ');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'แหล่งที่มา');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'ชื่อหน้าเล่ม');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'ชื่อลูกค้า');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'ฝ่ายขาย');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'วันที่เซ็นต์สัญญา');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'ทะเบียนรถ');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'ยี่ห้อรถ');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'รุ่นรถ');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'ปีรถ');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'ขนาดรถ (CC)');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'สภาพรถ');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'สถานะไฟแนนซ์');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'ราคาตีเทิร์น');
$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'ค่าคอมฝ่ายขาย');
$objPHPExcel->getActiveSheet()->setCellValue('R1', 'สถานะรถรับเข้า');
$objPHPExcel->getActiveSheet()->setCellValue('S1', 'วันที่รับรถเข้า');
$objPHPExcel->getActiveSheet()->setCellValue('T1', 'การตีเทิร์น');
$objPHPExcel->getActiveSheet()->setCellValue('U1', 'ประเภท');
$objPHPExcel->getActiveSheet()->setCellValue('V1', 'เคลมMMTH');



			// Set alignments จัดรูปแบบหน้า ตรงกลางซ้ายขวากึ่งกลาง
			//echo date('H:i:s') . " Set alignments\n";
$objPHPExcel->getActiveSheet()->getStyle('A1:U1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:U1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			// $objPHPExcel->getActiveSheet()->getStyle('A6:L6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			// $objPHPExcel->getActiveSheet()->getStyle('A2:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:U1')->getAlignment()->setWrapText(true);


			// Set style for header row using alternative method 
			//echo date('H:i:s') . " Set style for header row using alternative method\n";
$objPHPExcel->getActiveSheet()->getStyle('A1:U1')->applyFromArray(
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

$arrayCarType = [
	1 => 'รถยนต์นำเข้าใหม่',
	2 => 'รถยนต์ระหว่างทำสี',
	3 => 'รถยนต์รอซ่อม',
	4 => 'รถยนต์ระหว่างซ่อม',
	5 => 'รถยนต์พร้อมขาย',
	6 => 'รถยนต์ที่ขายแล้ว',
	7 => 'รถยนต์ส่งประมูล',
];
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

$resource =[ 1 => "ป้ายโฆษณา/รถแห่/วิทยุ/จดหมาย",
2 => "ลูกค้าไฟแนนซ์เก่า/ลูกค้าซื้อขายเก่า",
3 => "นายหน้า/ลูกค้าแนะนำ",
4 => "ศูนย์บริการ",
5 => "FB บริษัท",
6 => "FB ส่วนตัว",
7 => "Line บริษัท",
8 => "Walk In",
9 => "Call In",
10 => "อื่นๆ"];


$data = DB::table('data_cars_ins')
->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
	return $q->whereBetween('Date_Car_in',[$fdate,$tdate]);
})
->leftjoin('data_cars','data_cars_ins.Nameid_Car_in','=','data_cars.Number_Regist')
->leftjoin('status_cars_in','data_cars_ins.id','=','status_cars_in.id_car_in')
//->whereIn('data_cars.Origin_Car', [5, 6, 7])
->orderBy('data_cars_ins.Date_Car_in', 'ASC')
->orderBy('data_cars_ins.Sale_Name', 'ASC')
->get();
			//$sql = "SELECT * FROM data_cars  WHERE Car_type='".$i."' and create_date between '".."' and '".."' order by create_date ASC";
			//$result = mysql_query($sql);



$r = 0;
$no = 1;
						//while($row = mysql_fetch_array($result)) {
foreach($data as $d_car){
$user = DB::table('users')->where('username',$d_car->Sale_Name)->first();
	$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$d_car->Date_Car_in);
	if($d_car->Return_car!=NULL){
		$OT = $arrayOriginType[$d_car->Return_car];
	}else{
		$OT = '';
	}
	$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$OT);
	if($d_car->CarType_in!=NULL){
		$res = $resource[$d_car->CarType_in];
	}else{
		$res = '';
	}
	$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$res);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$d_car->Name_Cus_Car);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$d_car->Name_Cus_in);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$user->name);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$d_car->Date_Carry_in);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$d_car->Nameid_Car_in);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$d_car->Brand_Car_in);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$d_car->Model_Car_in);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$d_car->Car_Year_in);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$d_car->Size_Car_in);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$d_car->Detail_Car_in);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.($r+2),$d_car->StatusFN_Car_in);
	$objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$d_car->Price_head);
	$objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$d_car->Comsale_in);
	if($d_car->Look_Car_in=='yes'){
		$look = 'เห็นรถจริง';
	}else{
		$look = 'ดูจากรูปภาพ';
	}
	if($d_car->Datacar_id!=NULL){
		$store_t = 'รับรถเข้า Stock แล้ว';
	}else{
		$store_t = '';
	}
	$objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),$store_t);
	$objPHPExcel->getActiveSheet()->setCellValue('S'.($r+2),$d_car->Date_Status_car);
	if($d_car->Car_type!=NULL){
		$arr_car = $arrayCarType[$d_car->Car_type];
	}else{
		$arr_car = "";
	}
	$objPHPExcel->getActiveSheet()->setCellValue('T'.($r+2), $look);
	$objPHPExcel->getActiveSheet()->setCellValue('U'.($r+2), $arr_car);
	$objPHPExcel->getActiveSheet()->setCellValue('V'.($r+2),$d_car->claim_MMTH);
	// if($d_car->Status_Car_in=='yes'){
	// 	$stats_in = 'จอง';
	// }else{
	// 	$stats_in = 'ไม่จอง';
	// }
	// $objPHPExcel->getActiveSheet()->setCellValue('V'.($r+2),$stats_in);
	// $objPHPExcel->getActiveSheet()->setCellValue('W'.($r+2),$d_car->Status_Detail);
	// $objPHPExcel->getActiveSheet()->setCellValue('X'.($r+2),$d_car->Remark);
	// $objPHPExcel->getActiveSheet()->setCellValue('Y'.($r+2),$d_car->Date_See_Car);

	// $objPHPExcel->getActiveSheet()->setCellValue('Z'.($r+2),);
	// $objPHPExcel->getActiveSheet()->setCellValue('AA'.($r+2),);
			                                //echo number_format($p_balance,2);

	$r++;
	$no++;


}


$objPHPExcel->getActiveSheet()->getStyle('A2'.':V'.($r+1))->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A2'.':V'.($r+1))->getFont()->setSize(8);
$objPHPExcel->getActiveSheet()->getStyle('A2:V'.($r+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);





$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':V'.($r+2))->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':V'.($r+2))->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':V'.($r+2))->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':V'.($r+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A2:V'.($r+2))->applyFromArray(
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
			$objPHPExcel->getActiveSheet()->setTitle('PP');


			$fname = 'tmp\tradeinreport.xlsx';
			$nameFile = "tradeinreport.xlsx";

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save($fname);

			header ('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header ('Content-Disposition: attachment; filename=tradeinreport.xlsx');
			header ('Content-Transfer-Encoding: binary');
			//header ('Content-Length: '.$fileSize);
			$fh=fopen($fname, "rb");
			fpassthru($fh);
		?>