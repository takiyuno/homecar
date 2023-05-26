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
             3 => "นายหน้า",
             4 => "ศูนย์บริการ",
             5 => "FB บริษัท",
             6 => "FB ส่วนตัว",
             7 => "Line บริษัท",
             8 => "Walk In",
             9 => "Call In",
             10 => "อื่นๆ",
             11 => "ลูกค้าเก่าแนะนำ"];
			// Create a first sheet, representing sales data
 $marr = [ 1=>"January",
				2=>"February",
				3=>"March",
				4=>"April",
				5=> "May",
				6=> "June",
				7=> "July",
				8=> "August",
				9=> "September",
				10=> "October",
				11=>"November",
				12=> "December"];

$objPHPExcel->setActiveSheetIndex(0);




$objPHPExcel->getActiveSheet()->mergeCells('B2:M2');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'ยอดรวมPPรายเดือน แยกตามแหล่งที่มา');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'เดือน');
$objPHPExcel->getActiveSheet()->setCellValue('C3', $resource[1]);
$objPHPExcel->getActiveSheet()->setCellValue('D3', $resource[2]);
$objPHPExcel->getActiveSheet()->setCellValue('E3', $resource[3]);
$objPHPExcel->getActiveSheet()->setCellValue('F3', $resource[4]);
$objPHPExcel->getActiveSheet()->setCellValue('G3', $resource[5]);
$objPHPExcel->getActiveSheet()->setCellValue('H3', $resource[6]);
$objPHPExcel->getActiveSheet()->setCellValue('I3', $resource[7]);
$objPHPExcel->getActiveSheet()->setCellValue('J3', $resource[8]);
$objPHPExcel->getActiveSheet()->setCellValue('K3', $resource[9]);
$objPHPExcel->getActiveSheet()->setCellValue('L3', $resource[10]);
$objPHPExcel->getActiveSheet()->setCellValue('M3', $resource[11]);
$objPHPExcel->getActiveSheet()->setCellValue('N3', 'รวม');


$objPHPExcel->getActiveSheet()->mergeCells('B19:M19');
$objPHPExcel->getActiveSheet()->setCellValue('B19', 'ยอดรวมPPรายเดือน แยกตามแหล่งที่มา (จอง)');
$objPHPExcel->getActiveSheet()->setCellValue('B20', 'เดือน');
$objPHPExcel->getActiveSheet()->setCellValue('C20', $resource[1]);
$objPHPExcel->getActiveSheet()->setCellValue('D20', $resource[2]);
$objPHPExcel->getActiveSheet()->setCellValue('E20', $resource[3]);
$objPHPExcel->getActiveSheet()->setCellValue('F20', $resource[4]);
$objPHPExcel->getActiveSheet()->setCellValue('G20', $resource[5]);
$objPHPExcel->getActiveSheet()->setCellValue('H20', $resource[6]);
$objPHPExcel->getActiveSheet()->setCellValue('I20', $resource[7]);
$objPHPExcel->getActiveSheet()->setCellValue('J20', $resource[8]);
$objPHPExcel->getActiveSheet()->setCellValue('K20', $resource[9]);
$objPHPExcel->getActiveSheet()->setCellValue('L20', $resource[10]);
$objPHPExcel->getActiveSheet()->setCellValue('M20', $resource[11]);
$objPHPExcel->getActiveSheet()->setCellValue('N20', 'รวม');
	
$objPHPExcel->getActiveSheet()->mergeCells('B36:M36');
$objPHPExcel->getActiveSheet()->setCellValue('B36', 'ยอดรวมPPรายเดือน แยกตามแหล่งที่มา (ส่งมอบ)');
$objPHPExcel->getActiveSheet()->setCellValue('B37', 'เดือน');
$objPHPExcel->getActiveSheet()->setCellValue('C37', $resource[1]);
$objPHPExcel->getActiveSheet()->setCellValue('D37', $resource[2]);
$objPHPExcel->getActiveSheet()->setCellValue('E37', $resource[3]);
$objPHPExcel->getActiveSheet()->setCellValue('F37', $resource[4]);
$objPHPExcel->getActiveSheet()->setCellValue('G37', $resource[5]);
$objPHPExcel->getActiveSheet()->setCellValue('H37', $resource[6]);
$objPHPExcel->getActiveSheet()->setCellValue('I37', $resource[7]);
$objPHPExcel->getActiveSheet()->setCellValue('J37', $resource[8]);
$objPHPExcel->getActiveSheet()->setCellValue('K37', $resource[9]);
$objPHPExcel->getActiveSheet()->setCellValue('L37', $resource[10]);
$objPHPExcel->getActiveSheet()->setCellValue('M37', $resource[11]);
$objPHPExcel->getActiveSheet()->setCellValue('N37', 'รวม');



$objPHPExcel->getActiveSheet()->mergeCells('P2:U2');
$objPHPExcel->getActiveSheet()->setCellValue('P2', 'วิเคราะห์อัตราปิดการขาย (แยกตามที่ปรึกษา) ในเดือน');
$objPHPExcel->getActiveSheet()->setCellValue('P3', 'ฝ่ายขาย');
$objPHPExcel->getActiveSheet()->setCellValue('Q3', 'PP');
$objPHPExcel->getActiveSheet()->setCellValue('R3', 'จอง');
$objPHPExcel->getActiveSheet()->setCellValue('S3', 'ส่งมอบ');
$objPHPExcel->getActiveSheet()->setCellValue('T3', 'Closing Ratio');
$objPHPExcel->getActiveSheet()->setCellValue('U3', 'Delivery Ratio');





			// Set alignments จัดรูปแบบหน้า ตรงกลางซ้ายขวากึ่งกลาง
			//echo date('H:i:s') . " Set alignments\n";
$objPHPExcel->getActiveSheet()->getStyle('B2:AA2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B2:AA2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B2:AA2')->getAlignment()->setWrapText(true);
			




$objPHPExcel->getActiveSheet()->getStyle('B2:N3')->applyFromArray(
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
$objPHPExcel->getActiveSheet()->getStyle('P2:U3')->applyFromArray(
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
$objPHPExcel->getActiveSheet()->getStyle('B36:N37')->applyFromArray(
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
$objPHPExcel->getActiveSheet()->getStyle('B19:N20')->applyFromArray(
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

$r = 2;

for($i=1;$i<13;$i++){
	$month = str_pad($i,2,"0",STR_PAD_LEFT);
    $cus_count = DB::table('data_customers')
             ->select(DB::raw("COUNT(IF(Origin_Cus='1', 1, NULL)) AS a 
								,COUNT(IF(Origin_Cus='2', 1, NULL)) AS b
								,COUNT(IF(Origin_Cus='3', 1, NULL)) AS c
								,COUNT(IF(Origin_Cus='4', 1, NULL)) AS d
								,COUNT(IF(Origin_Cus='5', 1, NULL)) AS e
								,COUNT(IF(Origin_Cus='6', 1, NULL)) AS f
								,COUNT(IF(Origin_Cus='7', 1, NULL)) AS g
								,COUNT(IF(Origin_Cus='8', 1, NULL)) AS h
								,COUNT(IF(Origin_Cus='9', 1, NULL)) AS i
								,COUNT(IF(Origin_Cus='10', 1, NULL)) AS j
								,COUNT(IF(Origin_Cus='11', 1, NULL)) AS k"))
             // ->whereRaw("DATE_FORMAT(DateSale_Cus,'%Y-%m')",'=','2021-'.$month)
              ->whereYear('DateSale_Cus', substr($fdate,0,4))
              ->whereMonth('DateSale_Cus', $month)
             ->get();

$no = 1;
						//while($row = mysql_fetch_array($result)) 
	foreach($cus_count as $data_count){
	$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$marr[$i]);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$data_count->a);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$data_count->b);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$data_count->c);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$data_count->d);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$data_count->e);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$data_count->f);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$data_count->g);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$data_count->h);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$data_count->i);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$data_count->j);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$data_count->k);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),'=SUM(C'.($r+2).':M'.($r+2).')');
	}
	
	
	$r++;
	$no++;
	
}	

$r2=36;
for($i=1;$i<13;$i++){
	$month = str_pad($i,2,"0",STR_PAD_LEFT);
    $cus_count = DB::table('data_customers')
             ->select(DB::raw("COUNT(IF(Origin_Cus='1', 1, NULL)) AS a 
								,COUNT(IF(Origin_Cus='2', 1, NULL)) AS b
								,COUNT(IF(Origin_Cus='3', 1, NULL)) AS c
								,COUNT(IF(Origin_Cus='4', 1, NULL)) AS d
								,COUNT(IF(Origin_Cus='5', 1, NULL)) AS e
								,COUNT(IF(Origin_Cus='6', 1, NULL)) AS f
								,COUNT(IF(Origin_Cus='7', 1, NULL)) AS g
								,COUNT(IF(Origin_Cus='8', 1, NULL)) AS h
								,COUNT(IF(Origin_Cus='9', 1, NULL)) AS i
								,COUNT(IF(Origin_Cus='10', 1, NULL)) AS j
								,COUNT(IF(Origin_Cus='11', 1, NULL)) AS k"))
             // ->whereRaw("DATE_FORMAT(DateSale_Cus,'%Y-%m')",'=','2021-'.$month)
              ->whereYear('DateSale_Cus', substr($fdate,0,4))
              ->whereMonth('DateSale_Cus', $month)
              ->where('Reserve_date','!=',NULL)
             ->get();

			//while($row = mysql_fetch_array($result)) 
	foreach($cus_count as $data_count){
	$objPHPExcel->getActiveSheet()->setCellValue('B'.($r2+2),$marr[$i]);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.($r2+2),$data_count->a);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.($r2+2),$data_count->b);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.($r2+2),$data_count->c);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.($r2+2),$data_count->d);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.($r2+2),$data_count->e);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.($r2+2),$data_count->f);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.($r2+2),$data_count->g);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.($r2+2),$data_count->h);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.($r2+2),$data_count->i);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.($r2+2),$data_count->j);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.($r2+2),$data_count->k);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.($r2+2),'=SUM(C'.($r2+2).':M'.($r2+2).')');
	}
	
	$r2++;
	
}	


$r3=19;
for($i=1;$i<13;$i++){
	$month = str_pad($i,2,"0",STR_PAD_LEFT);
    $cus_count = DB::table('data_customers')
             ->select(DB::raw("COUNT(IF(Origin_Cus='1', 1, NULL)) AS a 
								,COUNT(IF(Origin_Cus='2', 1, NULL)) AS b
								,COUNT(IF(Origin_Cus='3', 1, NULL)) AS c
								,COUNT(IF(Origin_Cus='4', 1, NULL)) AS d
								,COUNT(IF(Origin_Cus='5', 1, NULL)) AS e
								,COUNT(IF(Origin_Cus='6', 1, NULL)) AS f
								,COUNT(IF(Origin_Cus='7', 1, NULL)) AS g
								,COUNT(IF(Origin_Cus='8', 1, NULL)) AS h
								,COUNT(IF(Origin_Cus='9', 1, NULL)) AS i
								,COUNT(IF(Origin_Cus='10', 1, NULL)) AS j
								,COUNT(IF(Origin_Cus='11', 1, NULL)) AS k"))
             // ->whereRaw("DATE_FORMAT(DateSale_Cus,'%Y-%m')",'=','2021-'.$month)
              ->whereYear('DateSale_Cus', substr($fdate,0,4))
              ->whereMonth('DateSale_Cus', $month)
              ->where('Send_date','!=',NULL)
             ->get();

			//while($row = mysql_fetch_array($result)) 
	foreach($cus_count as $data_count){
	$objPHPExcel->getActiveSheet()->setCellValue('B'.($r3+2),$marr[$i]);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.($r3+2),$data_count->a);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.($r3+2),$data_count->b);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.($r3+2),$data_count->c);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.($r3+2),$data_count->d);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.($r3+2),$data_count->e);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.($r3+2),$data_count->f);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.($r3+2),$data_count->g);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.($r3+2),$data_count->h);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.($r3+2),$data_count->i);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.($r3+2),$data_count->j);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.($r3+2),$data_count->k);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.($r3+2),'=SUM(C'.($r3+2).':M'.($r3+2).')');
	}
	
	$r3++;
	
}


 $sale_count = DB::table('data_customers')
             ->select(DB::raw("Sale_Cus,COUNT(Sale_Cus) AS C1 ,COUNT(IF(DATE_FORMAT(Reserve_date, '%Y-%m')='".substr($fdate,0,7)."',1,NULL)) AS C2 ,COUNT(IF(DATE_FORMAT(Send_date, '%Y-%m')='".substr($fdate,0,7)."',1,NULL)) AS C3"))
             ->whereBetween('DateSale_Cus',[$fdate,$tdate])
             ->groupBy('Sale_Cus')
             ->get();
$r4 =2;
foreach($sale_count as $s_count){
	$objPHPExcel->getActiveSheet()->setCellValue('P'.($r4+2),$s_count->Sale_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('Q'.($r4+2),$s_count->C1);
	$objPHPExcel->getActiveSheet()->setCellValue('R'.($r4+2),$s_count->C2);
	$objPHPExcel->getActiveSheet()->setCellValue('S'.($r4+2),$s_count->C3);
	$objPHPExcel->getActiveSheet()->setCellValue('T'.($r4+2),'=R'.($r4+2).'/Q'.($r4+2));
	$objPHPExcel->getActiveSheet()->setCellValue('U'.($r4+2),'=S'.($r4+2).'/R'.($r4+2));
$r4++;
}



										//$r=$r+1; 
						//}
$objPHPExcel->getActiveSheet()->getStyle('B3'.':AA'.($r+1))->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('B3'.':AA'.($r+1))->getFont()->setSize(8);
$objPHPExcel->getActiveSheet()->getStyle('B3:AA'.($r+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);


// $objPHPExcel->getActiveSheet()->getStyle('B'.($r+2).':M'.($r+2))->getFont()->setName('Candara');
// $objPHPExcel->getActiveSheet()->getStyle('B'.($r+2).':M'.($r+2))->getFont()->setSize(16);
// $objPHPExcel->getActiveSheet()->getStyle('B'.($r+2).':M'.($r+2))->getFont()->setBold(true);

// $objPHPExcel->getActiveSheet()->getStyle('B'.($r+2).':M'.($r+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('B3:N'.($r+2))->applyFromArray(
	array(
		
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);

$objPHPExcel->getActiveSheet()->getStyle('B36:N'.($r2+2))->applyFromArray(
	array(
		
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);
$objPHPExcel->getActiveSheet()->getStyle('B19:N'.($r3+2))->applyFromArray(
	array(
		
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);


$objPHPExcel->getActiveSheet()->getStyle('P4:U'.($r4+2))->applyFromArray(
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

			
			$fname = 'tmp\cusCount.xlsx';
			$nameFile = "cusCount.xlsx";
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save($fname);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="cusCount.xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		?>