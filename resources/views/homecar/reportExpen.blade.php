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




$objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'ยี่ห้อ');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'ปีรถ');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'ทะเบียนรถ');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'เลขไมล์');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'แหล่งที่มา');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'สถานะจอง');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ประเภท');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'สีรถ');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'เกียร์');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'รุ่นย่อย');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'สถานะของรถ');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'เลขถัง');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'ประเภทซ่อม');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'รายละเอียด');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'ยอดซ่อม');

			// $objPHPExcel->getActiveSheet()->setCellValue('L1', 'ราคาตั้งขาย');
			// $objPHPExcel->getActiveSheet()->setCellValue('M1', 'ธนชาติ');
			// $objPHPExcel->getActiveSheet()->setCellValue('N1', 'ทิสโก้');
			// $objPHPExcel->getActiveSheet()->setCellValue('O1', 'SCB');
			// $objPHPExcel->getActiveSheet()->setCellValue('P1', 'AY');
			// $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Chookiat');
			// $objPHPExcel->getActiveSheet()->setCellValue('P1', 'SCB ไม่');
			// $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'AY');
			// $objPHPExcel->getActiveSheet()->setCellValue('R1', 'AY ไม่');
			// $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Chookiat');

			// Set alignments จัดรูปแบบหน้า ตรงกลางซ้ายขวากึ่งกลาง
			//echo date('H:i:s') . " Set alignments\n";
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			// $objPHPExcel->getActiveSheet()->getStyle('A6:L6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			// $objPHPExcel->getActiveSheet()->getStyle('A2:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



			// Set style for header row using alternative method 
			//echo date('H:i:s') . " Set style for header row using alternative method\n";
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray(
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
	9 => 'เทิร์นรถ GWM',
];


	$data = DB::table('tracking_cars')
	->leftjoin('data_cars','tracking_cars.id_cars','=' ,'data_cars.id')
	->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
		return $q->whereBetween('tracking_cars.track_date',[$fdate,$tdate]);
	})
	// ->where(function($query) {
 //                $query->where('data_cars.BookStatus_Car','!=', 'ส่งมอบ')
 //                ->orwhere('data_cars.BookStatus_Car','=', NULL);
 //            })
	->whereRaw("(data_cars.BookStatus_Car != 'ส่งมอบ' OR  ISNULL(data_cars.BookStatus_Car)) GROUP BY data_cars.id")
	->orderBy('data_cars.BookStatus_Car', 'desc')
	
	->get();
			//$sql = "SELECT * FROM data_cars  WHERE Car_type='".$i."' and create_date between '".."' and '".."' order by create_date ASC";
			//$result = mysql_query($sql);



	// $objPHPExcel->getActiveSheet()->setCellValue('A'.($r+1),$arrayCarType[$i]);	
	//$objPHPExcel->getActiveSheet()->mergeCells('A'.($r+1).':S'.($r+1));
	$no = 1;
	$r = 1;					//while($row = mysql_fetch_array($result)) {
	foreach($data as $d_car){

		$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$d_car->Brand_Car);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$d_car->Year_Product);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$d_car->Number_Regist);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$d_car->Number_Miles);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$arrayOriginType[$d_car->Origin_Car]);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$d_car->BookStatus_Car);
		$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$d_car->Model_Car);
		$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$d_car->Color_Car);
		$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$d_car->Gearcar);
		$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$d_car->Version_Car);
		$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$arrayCarType[$d_car->Car_type]);
		$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$d_car->Chassis_car);
								//tracking
		$track = DB::table('data_expenses')->where('Car_id','=',$d_car->id)->get();

		//if($track){
			$tr =4;
			$tn=1;
			$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+3), '#');
			$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+3), 'ประเภทการซ่อม	');
			$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+3), 'รายละเอียด');
			$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+3), 'ราคา	');
			$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+3), 'วันที่ Bill');
			$objPHPExcel->getActiveSheet()->getStyle('B'.($r+3).':E'.($r+3))->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB('33B8FF');
			   
			foreach($track as $track_car){
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+$tr), $tn);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+$tr),$track_car->type_expen );
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+$tr),$track_car->text_expen);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+$tr),$track_car->price );
				$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+$tr),$track_car->date_bill );
				$tn++;
				$tr++;
			}
		//}
		$r=$r+$tr;
		$no++;

	}
	

$objPHPExcel->getActiveSheet()->getStyle('A2'.':L'.($r+1))->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A2'.':L'.($r+1))->getFont()->setSize(8);
$objPHPExcel->getActiveSheet()->getStyle('A2:L'.($r+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);





$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':L'.($r+2))->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':L'.($r+2))->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':L'.($r+2))->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':L'.($r+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A2:L'.($r+2))->applyFromArray(
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
			$objPHPExcel->getActiveSheet()->setTitle('Sale');

		$fname = 'tmp\tracking.xlsx';
		$nameFile = "tracking.xlsx";


			// header ('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header ('Content-Disposition: attachment; filename=instalmentLoan.xlsx');
			// header ('Content-Transfer-Encoding: binary');


		// 		$fh=fopen($fname, "rb");
		// 		fpassthru($fh);

		// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		// 	$objWriter->save($fname);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="tracking.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	?>