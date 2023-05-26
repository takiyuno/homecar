<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name=Generator content="Microsoft Word 15 (filtered)">
    <title></title>
  </head>
  <body>
    <table border="0">
      <tbody>
        <tr>
          <th width="50px"></th>
          <th width="355px">  
        
             บริษัท ชูเกียรติลิสซิ่ง กระบี่ จำกัด
         </th>
          {{-- <th width="305px"></th> --}}
          <th align="right" width="100px">พิมพ์ : {{date('d-m-Y')}} &nbsp;</th>
        </tr>
        <tr >
          <th width="50px"></th>
          <th width="355px">ที่อยู่ 266 ม.2 ต.กระบี่น้อย อ.เมือง จ.กระบี่ 81000 </th>
          <th align="right" width="100px">
            {{-- เลขใบเสร็จ :  &nbsp; --}}
          </th>
        </tr>
        <tr>
          <th width="50px"></th>
          <th width="305px">           
            เบอร์โทร 075-650919 แฟกซ์ 075-650683         
          </th>
        </tr>
      </tbody>
    </table>
    <br>

    <table border="0" style="border-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-style: solid">
      <tbody>
        
        <tr style="line-height: 50%;">
          <th></th>
        </tr>
        <tr>
          <th width="350px">
            <b>ทะเบียนรถ &nbsp;&nbsp;&nbsp; {{$datacar->Number_Regist }} </b>
          </th>
          <th width="200px" align="right"></th>
        </tr>
        <tr >
          <th width="305px">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b></b>
          </th>
        </tr>
        <tr>
          <th width="305px">
          
          </th>
        </tr>
        <tr style="line-height: 200%; font-size: 12px" align="center">
          <th width="100px" style="border-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-style: solid; background-color: #FBE4D5">
            <span><b>ลำดับ</b></span>
          </th>
          <th width="300px" style="border-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-style: solid;background-color: #FBE4D5">
            <b> รายละเอียดสินค้าบริการ</b>
          </th>
          <th width="130px" style="border-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-style: solid; background-color: #FBE4D5">
            <span><b>จำนวนเงิน</b></span>
          </th>
        </tr>
        <tr style="line-height: 200%; font-size: 12px" align="center">
          <th width="100px" >
            <span><b>1.</b></span>
          </th>
          <th width="300px" align="left">
            <b>{{$data->text_expen}}</b><br/>
            <b>{{$data->remark}}</b>
          </th>
          <th width="130px" align="right">
            <span><b>{{number_format($data->price,2)}}</b></span>
          </th>
        </tr>
        <tr style="line-height: 200%; font-size: 12px" align="center">
          <th width="100px" >
            <span><b></b></span>
          </th>
          <th width="300px" >
            <b> </b>
          </th>
          <th width="130px" >
            <span><b></b></span>
          </th>
        </tr>
        
        <tr style="line-height: 200%; font-size: 12px" align="right">
          <th width="400px" style="border-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-style: solid; background-color: #FBE4D5">
            <span><b>รวมราคาสินค้า</b></span>
          </th>
          
          <th width="130px" style="border-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-style: solid; background-color: #FBE4D5">
            {{number_format($data->price,2)}}<span><b>บาท</b></span>
          </th>
        </tr>
        <tr style="line-height: 200%; font-size: 12px">
          <th width="152px" style="border-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-style: solid; background-color: #FBE4D5">
            <span><b>จำนวนเงินเป็นตัวอักษร</b></span>
          </th>
          <th width="380px" align="center" style="border-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-style: solid;">
            <b> ({{baht_text(($data->price))}})</b>
          </th>
        </tr>
        <tr style="line-height: 200%;">
          <th width="300px" style="border-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-style: solid">
            ชื่อผู้นำฝาก______________________
          </th>
          <th width="230px" style="border-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-style: solid; background-color: #FBE4D5;" align="center">
            <span><b>สำหรับเจ้าหน้าที</b></span>
          </th>
        </tr>
        <tr style="line-height: 200%;">
          <th width="300px" style="border-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-style: solid">
            โทรศัพท์________________________
          </th>
          <th width="230px" style="border-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-style: solid;">
            สำหรับเจ้าหน้าที________________________
          </th>
        </tr>
      </tbody>
    </table>
    <br>
    <br>

  </body>
</html>

