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
			// Create a first sheet, representing sales data

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(30);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(10);


$objPHPExcel->getActiveSheet()->setCellValue('A2', '#');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'วันที่รับรองลูกค้า');
$objPHPExcel->getActiveSheet()->setCellValue('C2', 'สถานะสัญญา');
$objPHPExcel->getActiveSheet()->setCellValue('D2', 'วันที่เซ็นสัญญา');
$objPHPExcel->getActiveSheet()->setCellValue('E2', 'ชื่อลูกค้า');
$objPHPExcel->getActiveSheet()->setCellValue('F2', 'เบอร์โทร');
$objPHPExcel->getActiveSheet()->setCellValue('G2', 'ที่อยู่');
$objPHPExcel->getActiveSheet()->setCellValue('H2', 'จังหวัด');
$objPHPExcel->getActiveSheet()->setCellValue('I2', 'ยี่ห้อที่สนใจ');
$objPHPExcel->getActiveSheet()->setCellValue('J2', 'ประเภทรถ');
$objPHPExcel->getActiveSheet()->setCellValue('K2', 'เกียร์');
$objPHPExcel->getActiveSheet()->setCellValue('L2', 'หมายเหตุ');
$objPHPExcel->getActiveSheet()->setCellValue('M2', 'แหล่งที่มา');
$objPHPExcel->getActiveSheet()->setCellValue('N2', 'เงินจอง');
$objPHPExcel->getActiveSheet()->setCellValue('O2', 'ฝ่ายขาย');
$objPHPExcel->getActiveSheet()->setCellValue('P2', 'วันส่งมอบรถ');

$objPHPExcel->getActiveSheet()->setCellValue('Q2', 'เรื่องที่สอบถาม');
$objPHPExcel->getActiveSheet()->setCellValue('R2', 'สถานะ ');
$objPHPExcel->getActiveSheet()->setCellValue('S2', 'วันที่สถานะ');
$objPHPExcel->getActiveSheet()->setCellValue('T2', 'ยี่ห้อรถที่ใช้งานอยู่');
$objPHPExcel->getActiveSheet()->setCellValue('U2', 'ประวัติลูกค้า');
$objPHPExcel->getActiveSheet()->setCellValue('V2', 'เคยมีประวัติผ่อนที่ไหน');
$objPHPExcel->getActiveSheet()->setCellValue('W2', 'รายได้เฉลี่ย/เดือน');
$objPHPExcel->getActiveSheet()->setCellValue('X2', 'อาชีพ');
$objPHPExcel->getActiveSheet()->setCellValue('Y2', 'ภาระผ่อนต่อเดือน');
$objPHPExcel->getActiveSheet()->setCellValue('Z2', 'ระบุรุ่นรถเทิร์น');
$objPHPExcel->getActiveSheet()->setCellValue('AA2', 'ความคิดเห็นฝ่ายขาย');
$objPHPExcel->getActiveSheet()->setCellValue('AB2', 'ความคิดเห็นผู้จัดการ ');
			// $objPHPExcel->getActiveSheet()->setCellValue('AB2', 'ทิสโก้');
			// $objPHPExcel->getActiveSheet()->setCellValue('AC2', 'ทิสโก้ ไม่');
			// $objPHPExcel->getActiveSheet()->setCellValue('AD2', 'SCB');
			// $objPHPExcel->getActiveSheet()->setCellValue('AE2', 'SCB ไม่');
			// $objPHPExcel->getActiveSheet()->setCellValue('AF2', 'AY');

			// Set alignments จัดรูปแบบหน้า ตรงกลางซ้ายขวากึ่งกลาง
			//echo date('H:i:s') . " Set alignments\n";
$objPHPExcel->getActiveSheet()->getStyle('A2:AB2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A2:AB2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A2:AB2')->getAlignment()->setWrapText(true);
			// $objPHPExcel->getActiveSheet()->getStyle('A6:L6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			// $objPHPExcel->getActiveSheet()->getStyle('A2:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



			// Set style for header row using alternative method 
			//echo date('H:i:s') . " Set style for header row using alternative method\n";
$objPHPExcel->getActiveSheet()->getStyle('A2:AB2')->applyFromArray(
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
->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
	return $q->whereBetween('data_customers.DateSale_Cus',[$fdate,$tdate]);
})
->orderBy('data_customers.created_at', 'ASC')
->get();
			//$sql = "SELECT * FROM data_cars  WHERE Car_type='".$i."' and create_date between '".."' and '".."' order by create_date ASC";
			//$result = mysql_query($sql);




$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+1),"");	

$no = 1;
						//while($row = mysql_fetch_array($result)) {
foreach($data as $d_cus){

$user = DB::table('users')->where('username',$d_cus->Sale_Cus)->first();
	$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$d_cus->DateSale_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$d_cus->Status_cont);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$d_cus->Date_cont);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$d_cus->Name_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$d_cus->Phone_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$d_cus->Address_Cus." ".$d_cus->Zip_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$d_cus->Province_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$d_cus->BrandCarUse);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$d_cus->ModelCar);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$d_cus->GearcarUse);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$d_cus->Note_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$resource[$d_cus->Origin_Cus]);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$d_cus->CashStatus_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.($r+2),$user->name);
	$objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$d_cus->Send_date);
	$objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$d_cus->talkTitle);
	$objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),$d_cus->Status_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('S'.($r+2),$d_cus->DateStatus_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('T'.($r+2),$d_cus->BrandCarUse);
	$objPHPExcel->getActiveSheet()->setCellValue('U'.($r+2),$d_cus->cusLoneStatus);
	$objPHPExcel->getActiveSheet()->setCellValue('V'.($r+2),$d_cus->instalDetail);
	$objPHPExcel->getActiveSheet()->setCellValue('W'.($r+2),$d_cus->cusIncome);
	$objPHPExcel->getActiveSheet()->setCellValue('X'.($r+2),$d_cus->Career_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('Y'.($r+2),'');
	$objPHPExcel->getActiveSheet()->setCellValue('Z'.($r+2),$d_cus->cusTurnCar);

	$dataTrack = DB::table('tracking_cuses')
	->where('F_DataCus_id','=',$d_cus->DataCus_id)
	->orderBy('Tracking_id', 'ASC')
	->get();

	$saleRemark = '';
	$managerRemark = '';        
	foreach($dataTrack as $track){
		$saleRemark .= $track->Tracking_id."/".$track->Follow_Tracking." ".$track->Date_Tracking."\n";
		$managerRemark .= $track->Tracking_id."/".$track->Note_tracking." ".$track->updated_at."\n";
	}

	$objPHPExcel->getActiveSheet()->setCellValue('AA'.($r+2),$saleRemark);
	$objPHPExcel->getActiveSheet()->setCellValue('AB'.($r+2),$managerRemark);
	
	
	$r++;
	$no++;
	
	
}
							//$r=$r+1; 
						//}
$objPHPExcel->getActiveSheet()->getStyle('A3'.':AA'.($r+1))->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A3'.':AA'.($r+1))->getFont()->setSize(8);
$objPHPExcel->getActiveSheet()->getStyle('A3:AA'.($r+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$objPHPExcel->getActiveSheet()->getStyle('Z')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('AA')->getAlignment()->setWrapText(true);				
$objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setWrapText(true);			



$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':AA'.($r+2))->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':AA'.($r+2))->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':AA'.($r+2))->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':AA'.($r+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A2:AA'.($r+2))->applyFromArray(
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

			
			$fname = 'tmp\cusdetail.xlsx';
			$nameFile = "cusdetail.xlsx";
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save($fname);

			
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="cusdetail.xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		?>