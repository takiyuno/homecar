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

$objPHPExcel->getActiveSheet()->mergeCells('A1:R1');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ADMIN');
$objPHPExcel->getActiveSheet()->mergeCells('S1:T1');
$objPHPExcel->getActiveSheet()->setCellValue('S1', 'บัญชี');
$objPHPExcel->getActiveSheet()->mergeCells('U1:V1');
$objPHPExcel->getActiveSheet()->setCellValue('U1', 'ราคาขาย');
$objPHPExcel->getActiveSheet()->mergeCells('Y1:Z1');
$objPHPExcel->getActiveSheet()->setCellValue('Y1', 'ราคาทุนซื้อเข้า');

$objPHPExcel->getActiveSheet()->setCellValue('A2', '#');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'ชื่อ-สกุลลูกค้า');
$objPHPExcel->getActiveSheet()->setCellValue('C2', 'ประเภทการขาย');
$objPHPExcel->getActiveSheet()->setCellValue('D2', 'แหล่งที่มาลูกค้า');
$objPHPExcel->getActiveSheet()->setCellValue('E2', 'วันที่จอง');
$objPHPExcel->getActiveSheet()->setCellValue('F2', 'วันที่เซ็นสัญญา');
$objPHPExcel->getActiveSheet()->setCellValue('G2', 'สถานะการขาย');
$objPHPExcel->getActiveSheet()->setCellValue('H2', 'วันที่ส่งมอบจริง');
$objPHPExcel->getActiveSheet()->setCellValue('I2', 'วันนัดหมายส่งมอบ');
$objPHPExcel->getActiveSheet()->setCellValue('J2', 'ที่ปรึกษาการขาย');
$objPHPExcel->getActiveSheet()->setCellValue('K2', 'ยี่ห้อรถ');
$objPHPExcel->getActiveSheet()->setCellValue('L2', 'รุ่นรถ');
$objPHPExcel->getActiveSheet()->setCellValue('M2', 'ทะเบียนรถ');
$objPHPExcel->getActiveSheet()->setCellValue('N2', 'ประเภทการขาย');
$objPHPExcel->getActiveSheet()->setCellValue('O2', 'ไฟแนนท์');
$objPHPExcel->getActiveSheet()->setCellValue('P2', 'แหล่งที่มาของรถ');
$objPHPExcel->getActiveSheet()->setCellValue('Q2', 'ประเภทการซื้อเข้า');
$objPHPExcel->getActiveSheet()->setCellValue('R2', 'วันที่เฟิร์มเคส');
$objPHPExcel->getActiveSheet()->setCellValue('S2', 'วันที่เงินเข้า');
$objPHPExcel->getActiveSheet()->setCellValue('T2', 'วันที่ออกใบเสร็จ(ออกโดยบัญชี)');
$objPHPExcel->getActiveSheet()->setCellValue('U2', 'ยอดจัดรวมดาวน์ ไม่รวมภาษี');
$objPHPExcel->getActiveSheet()->setCellValue('V2', 'ยอดจัดรวมดาวน์ รวมภาษี');
$objPHPExcel->getActiveSheet()->setCellValue('W2', 'เก็บเงินเพิ่มจากลูกค้า กรณีซื้อประดับยนต์เพิ่ม(ใส่เต็ม)');
$objPHPExcel->getActiveSheet()->setCellValue('X2', 'รายได้รวม ');
$objPHPExcel->getActiveSheet()->setCellValue('Y2', 'รวมภาษี');
$objPHPExcel->getActiveSheet()->setCellValue('Z2', 'ไม่รวมภาษี');

$objPHPExcel->getActiveSheet()->setCellValue('AA2', 'ค่าซ่อม GS');
$objPHPExcel->getActiveSheet()->setCellValue('AB2', 'ค่าซ่อม BP');
$objPHPExcel->getActiveSheet()->setCellValue('AC2', 'ค่าคอมเซลเทิร์น');
$objPHPExcel->getActiveSheet()->setCellValue('AD2', 'ค่าของแถมมาตรฐาน');
$objPHPExcel->getActiveSheet()->setCellValue('AE2', 'ค่าประกัน');
$objPHPExcel->getActiveSheet()->setCellValue('AF2', 'ค่าโอน');
$objPHPExcel->getActiveSheet()->setCellValue('AG2', 'ค่านายหน้า');
$objPHPExcel->getActiveSheet()->setCellValue('AH2', 'ค่าพิเศษไฟแนนท์');
$objPHPExcel->getActiveSheet()->setCellValue('AI2', 'ส่วนลดเงินดาวน์');
$objPHPExcel->getActiveSheet()->setCellValue('AJ2', 'รวมทุนซื้อ');
$objPHPExcel->getActiveSheet()->setCellValue('AK2', 'Margin before Com Sale');
$objPHPExcel->getActiveSheet()->setCellValue('AL2', 'เก็บงบเหลือจากSC');
$objPHPExcel->getActiveSheet()->setCellValue('AM2', 'Com SCรายคัน');
$objPHPExcel->getActiveSheet()->setCellValue('AN2', 'Com งบเหลือ');
$objPHPExcel->getActiveSheet()->setCellValue('AO2', 'Other Com ');
$objPHPExcel->getActiveSheet()->setCellValue('AP2', 'Margin นำคำนวณคอม ');
$objPHPExcel->getActiveSheet()->setCellValue('AQ2', '%Margin allocation ');
$objPHPExcel->getActiveSheet()->setCellValue('AR2', 'ยอดแบ่ง');
$objPHPExcel->getActiveSheet()->setCellValue('AS2', 'ดอกเบี้ย');
$objPHPExcel->getActiveSheet()->setCellValue('AT2', 'ระยะเวลาผ่อน(ใส่เป็นปี)');
$objPHPExcel->getActiveSheet()->setCellValue('AU2', 'ดาวน์');
$objPHPExcel->getActiveSheet()->setCellValue('AV2', 'ยอดจัด');
$objPHPExcel->getActiveSheet()->setCellValue('AW2', 'ค่าประกันPA');
$objPHPExcel->getActiveSheet()->setCellValue('AX2', 'คอมไฟแนนซ์ ');
$objPHPExcel->getActiveSheet()->setCellValue('AY2', 'รวมโอน');
$objPHPExcel->getActiveSheet()->setCellValue('AZ2', 'ยอดเงินเข้าบัญชี');
$objPHPExcel->getActiveSheet()->setCellValue('BA2', 'Net Margin');
$objPHPExcel->getActiveSheet()->setCellValue('BB2', 'หมายเหตุ');

$objPHPExcel->getActiveSheet()->getStyle('A1:BB2')->getAlignment()->setWrapText(true);
			// Set alignments จัดรูปแบบหน้า ตรงกลางซ้ายขวากึ่งกลาง
			//echo date('H:i:s') . " Set alignments\n";
$objPHPExcel->getActiveSheet()->getStyle('A1:BB2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:BB2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:BB2')->getAlignment()->setWrapText(true);
			// $objPHPExcel->getActiveSheet()->getStyle('A6:L6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			// $objPHPExcel->getActiveSheet()->getStyle('A2:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



			// Set style for header row using alternative method 
			//echo date('H:i:s') . " Set style for header row using alternative method\n";
$objPHPExcel->getActiveSheet()->getStyle('A1:BB2')->applyFromArray(
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
// ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
// 	return $q->whereBetween('data_customers.DateSale_Cus',[$fdate,$tdate]);
// })
->leftjoin('data_cars','data_customers.Datacar_id','=','data_cars.id')
// ->where('data_customers.Datacar_id','<>',NULL)
// ->where('data_customers.Status_Cus','<>','ส่งมอบ')
->where('data_customers.Status_Cus','=','จอง')
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
	$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$d_cus->Name_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$d_cus->Status_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$resource[$d_cus->Origin_Cus]);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$d_cus->Reserve_date);
		if($d_cus->Contract_Date==NULL){
		$dateC= $d_cus->Date_cont;
	}else{
		$dateC= $d_cus->Contract_Date;
	}
	$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$dateC);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$d_cus->Status_cont);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$d_cus->SendCar_Date);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$d_cus->SendCar_Date);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$user->name);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$d_cus->Brand_Car);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$d_cus->Version_Car);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$d_cus->Number_Regist);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$d_cus->Type_Sale);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.($r+2),$d_cus->Finance_Name);
	$tp = "";
	if($d_cus->Origin_Car!=''){
		$tp =$arrayOriginType[$d_cus->Origin_Car];
	}
	$objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$tp);
	$objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$d_cus->Type_buy);
	$objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),$d_cus->FirmCase);
	$objPHPExcel->getActiveSheet()->setCellValue('S'.($r+2),$d_cus->Date_Withdraw);
	$objPHPExcel->getActiveSheet()->setCellValue('T'.($r+2),$d_cus->Date_invoice);

	$u=0;
	$v=0;
	
	if($d_cus->Vat_car_sale == 'รวมVat'){  //ถอด7
		$u=($d_cus->Net_Priceplus)/1.07;
		$v= $d_cus->Net_Priceplus;
	}else if($d_cus->Vat_car_sale == 'ก่อนVat'){
		$u=$d_cus->Net_Priceplus;
		$v=$d_cus->Net_Priceplus*1.07;
	}else if($d_cus->Vat_car_sale == 'ไม่มีVat'){
		$u=$d_cus->Net_Priceplus;
		$v=$d_cus->Net_Priceplus;
	}



	$objPHPExcel->getActiveSheet()->setCellValue('U'.($r+2),$u);

	$vat_price = (($d_cus->Net_Priceplus-$d_cus->Down_Price)*1.07)+$d_cus->Down_Price;

	$objPHPExcel->getActiveSheet()->setCellValue('V'.($r+2),$v);
	$objPHPExcel->getActiveSheet()->setCellValue('W'.($r+2),$d_cus->Add_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('X'.($r+2),($u+$d_cus->Add_Price));

	$cost_price = ($d_cus->Fisrt_Price+$d_cus->Repair_Price+$d_cus->Color_Price+$d_cus->Budget_Gift+$d_cus->Insur_Price+$d_cus->Tran_Fee+$d_cus->Add_Price);

	$y=0;
	$z=0;
	if($d_cus->Vat_car_buy == 'รวมVat'){  //ถอด7
		$z=($d_cus->Fisrt_Price)/1.07;
		$y= $d_cus->Fisrt_Price;
	}else if($d_cus->Vat_car_buy == 'ก่อนVat'){
		$z=$d_cus->Fisrt_Price;
		$y=$d_cus->Fisrt_Price*1.07;
	}else if($d_cus->Vat_car_buy == 'ไม่มีVat'){
		$y=$d_cus->Fisrt_Price;
		$z=$d_cus->Fisrt_Price;
	}

	$objPHPExcel->getActiveSheet()->setCellValue('Y'.($r+2),$y);
	$objPHPExcel->getActiveSheet()->setCellValue('Z'.($r+2),$z);

	$objPHPExcel->getActiveSheet()->setCellValue('AA'.($r+2),$d_cus->Repair_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AB'.($r+2),$d_cus->Color_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AC'.($r+2),$d_cus->Comsale_turn);
	$objPHPExcel->getActiveSheet()->setCellValue('AD'.($r+2),$d_cus->Budget_Gift);
	$objPHPExcel->getActiveSheet()->setCellValue('AE'.($r+2),$d_cus->Insur_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AF'.($r+2),$d_cus->Tran_Fee);
	$objPHPExcel->getActiveSheet()->setCellValue('AG'.($r+2),$d_cus->Intro_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AH'.($r+2),$d_cus->Special_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AI'.($r+2),$d_cus->Subdown_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AJ'.($r+2),'=SUM(AA'.($r+2).':AI'.($r+2).')');
	$objPHPExcel->getActiveSheet()->setCellValue('AK'.($r+2),'=Y'.($r+2).'-'.'AJ'.($r+2));
	$objPHPExcel->getActiveSheet()->setCellValue('AL'.($r+2),$d_cus->Balance_Budget);
	$objPHPExcel->getActiveSheet()->setCellValue('AM'.($r+2),$d_cus->comendSale);
	$objPHPExcel->getActiveSheet()->setCellValue('AN'.($r+2),'=AL'.($r+2).'/2');
	$objPHPExcel->getActiveSheet()->setCellValue('AO'.($r+2),$d_cus->comendAdmin);
	$objPHPExcel->getActiveSheet()->setCellValue('AP'.($r+2),'=AK'.($r+2).'-AM'.($r+2).'-AN'.($r+2).'-AO'.($r+2));
	$objPHPExcel->getActiveSheet()->setCellValue('AQ'.($r+2),$d_cus->Margin_allocation);
	$objPHPExcel->getActiveSheet()->setCellValue('AR'.($r+2),'=(AP'.($r+2).'*AQ'.($r+2).')/100');
	$objPHPExcel->getActiveSheet()->setCellValue('AS'.($r+2),$d_cus->Increase);
	$objPHPExcel->getActiveSheet()->setCellValue('AT'.($r+2),$d_cus->Finance_Instal);
	$objPHPExcel->getActiveSheet()->setCellValue('AU'.($r+2),$d_cus->Down_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AV'.($r+2),$d_cus->Topcar_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AW'.($r+2),$d_cus->Insurance_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AX'.($r+2),$d_cus->comendFinance);
	$objPHPExcel->getActiveSheet()->setCellValue('AY'.($r+2),'');
	$objPHPExcel->getActiveSheet()->setCellValue('AZ'.($r+2),$d_cus->Amount_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('BA'.($r+2),'=(AP'.($r+2).'-AR'.($r+2).')+AX'.($r+2));
	$objPHPExcel->getActiveSheet()->setCellValue('BB'.($r+2),$d_cus->Note_Cus);
	
	
	$r++;
	$no++;
	
	
}
$data2 = DB::table('data_customers')
->leftjoin('data_cars','data_customers.Datacar_id','=','data_cars.id')
->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
	return $q->whereBetween('data_cars.SendCar_Date',[$fdate,$tdate]);
})

->where('data_customers.Datacar_id','<>',NULL)
->where('data_customers.Status_Cus','=','ส่งมอบ')
->orderBy('data_customers.created_at', 'ASC')
->get();
foreach($data2 as $d_cus){

	$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$d_cus->Name_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$d_cus->Status_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$resource[$d_cus->Origin_Cus]);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$d_cus->Reserve_date);
	if($d_cus->Contract_Date==NULL){
		$dateC= $d_cus->Date_cont;
	}else{
		$dateC= $d_cus->Contract_Date;
	}

	$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$dateC);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$d_cus->Status_cont);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$d_cus->SendCar_Date);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$d_cus->SendCar_Date);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$d_cus->Sale_Cus);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$d_cus->Brand_Car);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$d_cus->Version_Car);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$d_cus->Number_Regist);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$d_cus->Type_Sale);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.($r+2),$d_cus->Finance_Name);
	$tp = "";
	if($d_cus->Origin_Car!=''){
		$tp =$arrayOriginType[$d_cus->Origin_Car];
	}
	$objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$tp);
	$objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$d_cus->Type_buy);
	$objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),$d_cus->FirmCase);
	$objPHPExcel->getActiveSheet()->setCellValue('S'.($r+2),$d_cus->Date_Withdraw);
	$objPHPExcel->getActiveSheet()->setCellValue('T'.($r+2),$d_cus->Date_invoice);

	if($d_cus->Vat_car_sale == 'รวมVat'){  //ถอด7
		$u=($d_cus->Net_Priceplus)/1.07;
		$v= $d_cus->Net_Priceplus;
	}else if($d_cus->Vat_car_sale == 'ก่อนVat'){
		$u=$d_cus->Net_Priceplus;
		$v=$d_cus->Net_Priceplus*1.07;
	}else if($d_cus->Vat_car_sale == 'ไม่มีVat'){
		$u=$d_cus->Net_Priceplus;
		$v=$d_cus->Net_Priceplus;
	}



	$objPHPExcel->getActiveSheet()->setCellValue('U'.($r+2),$u);
	$vat_price = (($d_cus->Net_Priceplus-$d_cus->Down_Price)*1.07)+$d_cus->Down_Price;
	$objPHPExcel->getActiveSheet()->setCellValue('V'.($r+2),$v);
	$objPHPExcel->getActiveSheet()->setCellValue('W'.($r+2),$d_cus->Add_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('X'.($r+2),($u+$d_cus->Add_Price));

	$cost_price = ($d_cus->Fisrt_Price+$d_cus->Repair_Price+$d_cus->Color_Price+$d_cus->Budget_Gift+$d_cus->Insur_Price+$d_cus->Tran_Fee+$d_cus->Add_Price);
	
	$y=0;
	$z=0;
	if($d_cus->Vat_car_buy == 'รวมVat'){  //ถอด7
		$z=($d_cus->Fisrt_Price)/1.07;
		$y= $d_cus->Fisrt_Price;
	}else if($d_cus->Vat_car_buy == 'ก่อนVat'){
		$z=$d_cus->Fisrt_Price;
		$y=$d_cus->Fisrt_Price*1.07;
	}else if($d_cus->Vat_car_buy == 'ไม่มีVat'){
		$y=$d_cus->Fisrt_Price;
		$z=$d_cus->Fisrt_Price;
	}

	$objPHPExcel->getActiveSheet()->setCellValue('Y'.($r+2),$y);
	$objPHPExcel->getActiveSheet()->setCellValue('Z'.($r+2),$z);

	$objPHPExcel->getActiveSheet()->setCellValue('AA'.($r+2),$d_cus->Repair_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AB'.($r+2),$d_cus->Color_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AC'.($r+2),$d_cus->Comsale_turn);
	$objPHPExcel->getActiveSheet()->setCellValue('AD'.($r+2),$d_cus->Budget_Gift);
	$objPHPExcel->getActiveSheet()->setCellValue('AE'.($r+2),$d_cus->Insur_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AF'.($r+2),$d_cus->Tran_Fee);
	$objPHPExcel->getActiveSheet()->setCellValue('AG'.($r+2),$d_cus->Intro_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AH'.($r+2),$d_cus->Special_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AI'.($r+2),$d_cus->Subdown_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AJ'.($r+2),'=SUM(AA'.($r+2).':AI'.($r+2).')');
	$objPHPExcel->getActiveSheet()->setCellValue('AK'.($r+2),'=Y'.($r+2).'-'.'AJ'.($r+2));
	$objPHPExcel->getActiveSheet()->setCellValue('AL'.($r+2),$d_cus->Balance_Budget);
	$objPHPExcel->getActiveSheet()->setCellValue('AM'.($r+2),$d_cus->comendSale);
	$objPHPExcel->getActiveSheet()->setCellValue('AN'.($r+2),'=AL'.($r+2).'/2');
	$objPHPExcel->getActiveSheet()->setCellValue('AO'.($r+2),$d_cus->comendAdmin);
	$objPHPExcel->getActiveSheet()->setCellValue('AP'.($r+2),'=AK'.($r+2).'-AM'.($r+2).'-AN'.($r+2).'-AO'.($r+2));
	$objPHPExcel->getActiveSheet()->setCellValue('AQ'.($r+2),$d_cus->Margin_allocation);
	$objPHPExcel->getActiveSheet()->setCellValue('AR'.($r+2),'=(AP'.($r+2).'*AQ'.($r+2).')/100');
	$objPHPExcel->getActiveSheet()->setCellValue('AS'.($r+2),$d_cus->Increase);
	$objPHPExcel->getActiveSheet()->setCellValue('AT'.($r+2),$d_cus->Finance_Instal);
	$objPHPExcel->getActiveSheet()->setCellValue('AU'.($r+2),$d_cus->Down_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AV'.($r+2),$d_cus->Topcar_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AW'.($r+2),$d_cus->Insurance_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('AX'.($r+2),$d_cus->comendFinance);
	$objPHPExcel->getActiveSheet()->setCellValue('AY'.($r+2),'');
	$objPHPExcel->getActiveSheet()->setCellValue('AZ'.($r+2),$d_cus->Amount_Price);
	$objPHPExcel->getActiveSheet()->setCellValue('BA'.($r+2),'=(AP'.($r+2).'-AR'.($r+2).')+AX'.($r+2));
	$objPHPExcel->getActiveSheet()->setCellValue('BB'.($r+2),$d_cus->Note_Cus);
	
	
	$r++;
	$no++;
	
	
}

// COUNT( IF(Status_Cus='จอง',IF(Status_cont='สัญญาผ่าน',1,NULL),NULL)) AS pass,
// COUNT( IF(Status_Cus='จอง',IF(Status_cont='ยังไม่เซ็นสัญญา',1,NULL),NULL))AS no_sign,
// COUNT( IF(Status_Cus='จอง',IF(Status_cont='รอผลตรวจสอบ',1,NULL),NULL))AS waitng,
// COUNT( IF(Status_Cus='ส่งมอบ',IF(DATE_FORMAT(Send_date, '%m/%Y')=DATE_FORMAT(CURDATE(), '%m/%Y'),1,NULL),NULL)) AS in_mm,
$dateSelect = date('Y-m', strtotime($fdate));

$date2= date('Y,m,d', strtotime($fdate));

$sql = "SELECT COUNT(Status_Cus) AS in_num FROM data_customers WHERE Status_Cus='จอง' AND  DATE_FORMAT(Reserve_date, '%Y-%m') NOT IN ('".$dateSelect."') ";
$result2 = DB::select($sql);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((4),($r+6),"ยอดยกมา");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((4),($r+7),"จองในเดือน");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((4),($r+8),"ยังไม่เซ็นสัญญา");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((4),($r+9),"รอผลตรวจสอบ");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((4),($r+10),"สัญญาผ่าน");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((4),($r+11),"ส่งมอบ");
 //foreach($result2 as  $value) {

	//$before = ($result2[0]->pass+$result2[0]->waitng+$result2[0]->no_sign)-$result2[0]->in_num;
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((5),($r+6),$result2[0]->in_num);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((5),($r+7),'=SUMPRODUCT(1*(MONTH(E3:E'.($r+1).')=MONTH(DATE('.$date2.'))))');
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((5),($r+8),'=COUNTIF(G3:G'.($r+1).',"=ยังไม่เซ็นสัญญา")');
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((5),($r+9),'=COUNTIF(G3:G'.($r+1).',"=รอผลตรวจสอบ")');
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((5),($r+10),'=(COUNTIF(G3:G'.($r+1).',"=สัญญาผ่าน"))-(COUNTIF(C3:C'.($r+1).',"=ส่งมอบ"))');
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((5),($r+11),'=COUNTIF(C3:C'.($r+1).',"=ส่งมอบ")');

							//$r=$r+1; 
						//}\
$objPHPExcel->getActiveSheet()->getStyle('U3'.':BA'.($r+1))->getNumberFormat()->setFormatCode("#,##0.00");
$objPHPExcel->getActiveSheet()->getStyle('A3'.':BA'.($r+1))->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A3'.':BA'.($r+1))->getFont()->setSize(8);
$objPHPExcel->getActiveSheet()->getStyle('A3:BA'.($r+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
// $objPHPExcel->getActiveSheet()->getStyle('Z')->getAlignment()->setWrapText(true);
// $objPHPExcel->getActiveSheet()->getStyle('AA')->getAlignment()->setWrapText(true);				
// $objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setWrapText(true);			



$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':BA'.($r+2))->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':BA'.($r+2))->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':BA'.($r+2))->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':BA'.($r+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A2:BA'.($r+2))->applyFromArray(
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