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
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(7);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(9);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(7);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(7);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);



			$objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'ยี่ห้อ');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'ปีรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'ทะเบียนรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'เลขไมล์');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'แหล่งที่มา');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'สถานะ');
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ประเภท');
			$objPHPExcel->getActiveSheet()->setCellValue('I1', 'สีรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('J1', 'เกียร์');
			$objPHPExcel->getActiveSheet()->setCellValue('K1', 'รุ่นย่อย');
			$objPHPExcel->getActiveSheet()->setCellValue('L1', 'ราคาตั้งขาย');
			$objPHPExcel->getActiveSheet()->setCellValue('M1', 'ธนชาติ');
			$objPHPExcel->getActiveSheet()->setCellValue('N1', 'ทิสโก้');
			$objPHPExcel->getActiveSheet()->setCellValue('O1', 'SCB');
			$objPHPExcel->getActiveSheet()->setCellValue('P1', 'AY');
			$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Chookiat');
			$objPHPExcel->getActiveSheet()->setCellValue('R1', 'เกียรตินาคิน');
			$objPHPExcel->getActiveSheet()->setCellValue('S1', 'กสิกร');
			// $objPHPExcel->getActiveSheet()->setCellValue('R1', 'AY ไม่');
			// $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Chookiat');

			// Set alignments จัดรูปแบบหน้า ตรงกลางซ้ายขวากึ่งกลาง
			//echo date('H:i:s') . " Set alignments\n";
			$objPHPExcel->getActiveSheet()->getStyle('A1:T1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:T1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			// $objPHPExcel->getActiveSheet()->getStyle('A6:L6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			// $objPHPExcel->getActiveSheet()->getStyle('A2:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


			 
			// Set style for header row using alternative method 
			//echo date('H:i:s') . " Set style for header row using alternative method\n";
			$objPHPExcel->getActiveSheet()->getStyle('A1:T1')->applyFromArray(
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
      		$r = 1;
			
		   for($i=1;$i<8;$i++){

		   	if($i==6){
		   		continue;
		   	}
			$data = DB::table('data_cars')
	                ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
	                  return $q->whereBetween('create_date',[$fdate,$tdate]);
	                })
	                ->where('Car_type','=',$i)
	                ->orderBy('Brand_Car', 'ASC')
	                ->get();
			//$sql = "SELECT * FROM data_cars  WHERE Car_type='".$i."' and create_date between '".."' and '".."' order by create_date ASC";
			//$result = mysql_query($sql);
			 
			 				
							

			          $objPHPExcel->getActiveSheet()->setCellValue('A'.($r+1),$arrayCarType[$i]);	
			          $objPHPExcel->getActiveSheet()->mergeCells('A'.($r+1).':S'.($r+1));
			          $no = 1;
						//while($row = mysql_fetch_array($result)) {
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
								$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$d_car->Net_Price);
								$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$d_car->Price_Thana);
								$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$d_car->Price_Tisco);
								$objPHPExcel->getActiveSheet()->setCellValue('O'.($r+2),$d_car->Price_Scb);
								$objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$d_car->Price_AY);
								$objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$d_car->Price_Choo);
								$objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),$d_car->Price_Kiatnakin);
								$objPHPExcel->getActiveSheet()->setCellValue('S'.($r+2),$d_car->Price_KLeasing);
								// $objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$d_car->Price_NonScb);
								// $objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$d_car->Price_AY);
								// $objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),$d_car->Price_NonAY);
								// $objPHPExcel->getActiveSheet()->setCellValue('S'.($r+2),$d_car->Price_Choo);
			                                //echo number_format($p_balance,2);
								
								$r++;
								$no++;
								
							
							}
							$r=$r+1; 
						}
							$objPHPExcel->getActiveSheet()->getStyle('A2'.':T'.($r+1))->getFont()->setName('Arial');
							$objPHPExcel->getActiveSheet()->getStyle('A2'.':T'.($r+1))->getFont()->setSize(8);
							$objPHPExcel->getActiveSheet()->getStyle('A2:T'.($r+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
							
														
							
							
						
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':T'.($r+2))->getFont()->setName('Candara');
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':T'.($r+2))->getFont()->setSize(16);
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':T'.($r+2))->getFont()->setBold(true);
							
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':T'.($r+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							
							$objPHPExcel->getActiveSheet()->getStyle('A2:T'.($r+2))->applyFromArray(
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

		if($report=='mgr'){
			
			$objPHPExcel->createSheet();	
			$objPHPExcel->setActiveSheetIndex(1);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(11);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(5);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(5);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(12);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(14);




			$objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'ยี่ห้อ');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'วันที่ซื้อเข้า');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'ทะเบียนรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'เลขตัวถัง');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'เลขไมล์');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'แหล่งที่มา');
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'สถานะ');
			$objPHPExcel->getActiveSheet()->setCellValue('I1', 'ต้นทุนซื้อ');
			$objPHPExcel->getActiveSheet()->setCellValue('J1', 'ค่าทำสีรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('K1', 'ค่าซ่อม');
			$objPHPExcel->getActiveSheet()->setCellValue('L1', 'ราคาเพิ่มเติม');
			$objPHPExcel->getActiveSheet()->setCellValue('M1', 'ค่าของแถม');
			$objPHPExcel->getActiveSheet()->setCellValue('N1', 'ค่าประกันรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('O1', 'ค่าโอน');
			$objPHPExcel->getActiveSheet()->setCellValue('P1', 'คอมเซลล์เทิร์น');
			$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'คอมเซลล์ขาย');
			$objPHPExcel->getActiveSheet()->setCellValue('R1', 'ต้นทุนรวม');
			$objPHPExcel->getActiveSheet()->setCellValue('S1', 'ราคาตั้งขาย');
			$objPHPExcel->getActiveSheet()->setCellValue('T1', 'ประเภท');
			$objPHPExcel->getActiveSheet()->setCellValue('U1', 'สีรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('V1', 'เกียร์');
			$objPHPExcel->getActiveSheet()->setCellValue('W1', 'รุ่นย่อย');
			$objPHPExcel->getActiveSheet()->setCellValue('X1', 'ปีรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('Y1', 'ผู้รับผิดชอบ');
			$objPHPExcel->getActiveSheet()->setCellValue('Z1', 'แหล่งที่ซื้อเข้า');


			// Set alignments จัดรูปแบบหน้า ตรงกลางซ้ายขวากึ่งกลาง
			//echo date('H:i:s') . " Set alignments\n";
			$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			// $objPHPExcel->getActiveSheet()->getStyle('A6:L6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			// $objPHPExcel->getActiveSheet()->getStyle('A2:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


			 
			// Set style for header row using alternative method 
			//echo date('H:i:s') . " Set style for header row using alternative method\n";
			$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->applyFromArray(
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
      		$r = 1;
			
		   for($i=1;$i<8;$i++){
		   		if($i==6){
		   		continue;
		   	}
			$data = DB::table('data_cars')
	                ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
	                  return $q->whereBetween(DB::raw("DATE_FORMAT(create_date, '%Y-%m-%d')"),[$fdate,$tdate]);
	                })
	                ->where('Car_type','=',$i)
	                ->orderBy('Brand_Car', 'ASC')
	                ->get();
			//$sql = "SELECT * FROM data_cars  WHERE Car_type='".$i."' and create_date between '".."' and '".."' order by create_date ASC";
			//$result = mysql_query($sql);
			 
			 				
							

			          $objPHPExcel->getActiveSheet()->setCellValue('A'.($r+1),$arrayCarType[$i]);	
			          $objPHPExcel->getActiveSheet()->mergeCells('A'.($r+1).':Q'.($r+1));
			          $no = 1;
						//while($row = mysql_fetch_array($result)) {
						 foreach($data as $d_car){

								$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
								$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$d_car->Brand_Car);
								$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$d_car->create_date);
								$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$d_car->Number_Regist);
								$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$d_car->Chassis_car);
								$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2), $d_car->Number_Miles);
								$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2), @$arrayOriginType[$d_car->Origin_Car]);
								$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$d_car->BookStatus_Car);
								$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$d_car->Fisrt_Price);
								$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$d_car->Color_Price);
								$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$d_car->Repair_Price);
								$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$d_car->Add_Price);
								$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$d_car->Budget_Gift);
								$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$d_car->Insur_Price);
								$objPHPExcel->getActiveSheet()->setCellValue('O'.($r+2),$d_car->Tran_Fee);
								$objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$d_car->Comsale_turn);
								$objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$d_car->com_sale);

								$total_price=($d_car->Fisrt_Price+$d_car->Repair_Price+$d_car->Color_Price+$d_car->Add_Price+$d_car->Budget_Gift+$d_car->Comsale_turn+$d_car->Insur_Price+$d_car->Tran_Fee+$d_car->com_sale);

								$objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),"=SUM(H".($r+2).":P".($r+2).")");
								$objPHPExcel->getActiveSheet()->setCellValue('S'.($r+2),$d_car->Net_Price);
								$objPHPExcel->getActiveSheet()->setCellValue('T'.($r+2),$d_car->Model_Car);
								$objPHPExcel->getActiveSheet()->setCellValue('U'.($r+2),$d_car->Color_Car);
								$objPHPExcel->getActiveSheet()->setCellValue('V'.($r+2),$d_car->Gearcar);
								$objPHPExcel->getActiveSheet()->setCellValue('W'.($r+2),$d_car->Version_Car);
								$objPHPExcel->getActiveSheet()->setCellValue('X'.($r+2),$d_car->Year_Product);
								$objPHPExcel->getActiveSheet()->setCellValue('Y'.($r+2),$d_car->Name_Sale);
								$objPHPExcel->getActiveSheet()->setCellValue('Z'.($r+2),@$arrayOriginType[$d_car->Origin_Car]);
			                                //echo number_format($p_balance,2);
								
								$r++;
								$no++;
								
							
							} 
							$r=$r+1; 
						}
							$objPHPExcel->getActiveSheet()->getStyle('A2'.':Y'.($r+1))->getFont()->setName('Arial');
							$objPHPExcel->getActiveSheet()->getStyle('A2'.':Y'.($r+1))->getFont()->setSize(8);
							$objPHPExcel->getActiveSheet()->getStyle('A2:Y'.($r+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
							
														
							
							
						
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':Y'.($r+2))->getFont()->setName('Candara');
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':Y'.($r+2))->getFont()->setSize(16);
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':Y'.($r+2))->getFont()->setBold(true);
							
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':Y'.($r+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							
							$objPHPExcel->getActiveSheet()->getStyle('A2:Y'.($r+2))->applyFromArray(
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
			$objPHPExcel->getActiveSheet()->setTitle('MGR');
			//if($type==6){
			$objPHPExcel->createSheet();	
			$objPHPExcel->setActiveSheetIndex(2);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(11);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10);



			$objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'ยี่ห้อ');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'วันที่ซื้อเข้า');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'ทะเบียนรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'เลขไมล์');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'สถานะ');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'ต้นทุนซื้อ');
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ค่าทำสีรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('I1', 'ค่าซ่อม');
			$objPHPExcel->getActiveSheet()->setCellValue('J1', 'ต้นทุนรวม');
			$objPHPExcel->getActiveSheet()->setCellValue('K1', 'ราคาตั้งขาย');
			$objPHPExcel->getActiveSheet()->setCellValue('L1', 'ขายออก');
			$objPHPExcel->getActiveSheet()->setCellValue('M1', 'ประเภท');
			$objPHPExcel->getActiveSheet()->setCellValue('N1', 'สีรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('O1', 'เกียร์');
			$objPHPExcel->getActiveSheet()->setCellValue('P1', 'รุ่นย่อย');
			$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'ปีรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('R1', 'ผู้รับผิดชอบ');
			$objPHPExcel->getActiveSheet()->setCellValue('S1', 'แหล่งที่ซื้อเข้า');
			$objPHPExcel->getActiveSheet()->setCellValue('T1', 'ประเภทการขาย');
			$objPHPExcel->getActiveSheet()->setCellValue('U1', 'เลขตัวถัง');

			// Set alignments จัดรูปแบบหน้า ตรงกลางซ้ายขวากึ่งกลาง
			//echo date('H:i:s') . " Set alignments\n";
			$objPHPExcel->getActiveSheet()->getStyle('A1:T1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:T1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			// $objPHPExcel->getActiveSheet()->getStyle('A6:L6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			// $objPHPExcel->getActiveSheet()->getStyle('A2:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


			 
			// Set style for header row using alternative method 
			//echo date('H:i:s') . " Set style for header row using alternative method\n";
			$objPHPExcel->getActiveSheet()->getStyle('A1:T1')->applyFromArray(
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
      		$r = 1;
			
		   // for($i=1;$i<8;$i++){
		   // 		if($i==6){
		   // 		continue;
		   // 	}
			$data = DB::table('data_cars')
	                ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
	                  return $q->whereBetween(DB::raw("DATE_FORMAT(create_date, '%Y-%m-%d')"),[$fdate,$tdate]);
	                })
	                ->where('Car_type','=',6)
	                ->orderBy('Brand_Car', 'ASC')
	                ->get();
			//$sql = "SELECT * FROM data_cars  WHERE Car_type='".$i."' and create_date between '".."' and '".."' order by create_date ASC";
			//$result = mysql_query($sql);
			 
			 				
							

			          $objPHPExcel->getActiveSheet()->setCellValue('A'.($r+1),$arrayCarType[6]);	
			          $objPHPExcel->getActiveSheet()->mergeCells('A'.($r+1).':Q'.($r+1));
			          $no = 1;
						//while($row = mysql_fetch_array($result)) {
						 foreach($data as $d_car){

								$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
								$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$d_car->Brand_Car);
								$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$d_car->create_date);
								$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$d_car->Number_Regist);
								$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$d_car->Number_Miles);
								$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$d_car->BookStatus_Car);
								$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$d_car->Fisrt_Price);
								$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$d_car->Color_Price);
								$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$d_car->Repair_Price);
								
								$total_price=($d_car->Fisrt_Price+$d_car->Repair_Price+$d_car->Color_Price+$d_car->Add_Price+$d_car->Budget_Gift+$d_car->Comsale_turn+$d_car->Insur_Price+$d_car->Tran_Fee+$d_car->com_sale);

								$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$total_price);
								$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$d_car->Net_Price);
								$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$d_car->Net_Priceplus);
								$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$d_car->Model_Car);
								$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$d_car->Color_Car);
								$objPHPExcel->getActiveSheet()->setCellValue('O'.($r+2),$d_car->Gearcar);
								$objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$d_car->Version_Car);
								$objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$d_car->Year_Product);
								$objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),$d_car->Name_Sale);
								$objPHPExcel->getActiveSheet()->setCellValue('S'.($r+2),$arrayOriginType[$d_car->Origin_Car]);
								$objPHPExcel->getActiveSheet()->setCellValue('T'.($r+2),$d_car->Type_Ofsale);
								$objPHPExcel->getActiveSheet()->setCellValue('U'.($r+2),$d_car->Chassis_car);
			                                //echo number_format($p_balance,2);
								
								$r++;
								$no++;
								
							
							} 
							$r=$r+1; 
						
							$objPHPExcel->getActiveSheet()->getStyle('A2'.':T'.($r+1))->getFont()->setName('Arial');
							$objPHPExcel->getActiveSheet()->getStyle('A2'.':T'.($r+1))->getFont()->setSize(8);
							$objPHPExcel->getActiveSheet()->getStyle('A2:T'.($r+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
							
														
							
							
						
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':T'.($r+2))->getFont()->setName('Candara');
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':T'.($r+2))->getFont()->setSize(16);
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':T'.($r+2))->getFont()->setBold(true);
							
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':T'.($r+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							
							$objPHPExcel->getActiveSheet()->getStyle('A2:T'.($r+2))->applyFromArray(
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
			$objPHPExcel->getActiveSheet()->setTitle('SoldOut');
			//}
		}
				$fname = 'tmp\instalmentLoan.xlsx';
				$nameFile = "instalmentLoan.xlsx";
						
			
			// header ('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header ('Content-Disposition: attachment; filename=instalmentLoan.xlsx');
			// header ('Content-Transfer-Encoding: binary');
	

		// 		$fh=fopen($fname, "rb");
		// 		fpassthru($fh);

		// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		// 	$objWriter->save($fname);
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="instalmentLoan.xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;

?>