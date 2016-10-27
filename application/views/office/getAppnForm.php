<?php 
$appNo=$this->uri->segment(4);
if(findValidApplicationNo($appNo)){
 $sql="select * from admission where appNo={$appNo}";
$sql=$this->db->query($sql);
$sql=$sql->row_array();
extract($sql);
require 'fpdf/fpdf.php';
$pdf = new fpdf();

$pdf->AliasNbPages();
$pdf->AddPage();

$img=  base_url('final.jpg');
$pdf->Image($img,0,0,210);
$pdf->SetFont('Arial','B',15);
$pdf->SetFontSize('12');
$pdf->Cell(0, 13,"",0,1);
$course="                                                ".$courses;
$pdf->Cell(67, 10,$course,0,0,"L");
$no="                                                                      ".$appNo;
$pdf->Cell(60, 10,$no,0,0,"L");
$pdf->Ln();
$myname='                                '.$name;
$pdf->Cell(0, 10,$myname,0,1);

$group='                     '.$plus2group;
$pdf->SetFontSize('11');
$pdf->Cell(30, 10,$group,0,0);
$pdf->SetFontSize('12');
$mark='                                         '.$plus2mark;
$pdf->Cell(30, 10,$mark,0,0);
$recog='                                                                 '.$recNeed;
$pdf->Cell(30, 10,$recog,0,1);
$gender='                                '.$gender;
$pdf->Cell(30, 15,$gender,0,0);
$dobp='                                                                     '.$dob;

$pdf->Cell(30, 15,$dobp,0,1);
$pdf->SetFont('Arial','B',11);
$acategory='                                       '.$admCat;
$pdf->Cell(30, 5,$acategory,0,1);
$anninc='                                               '.$aIncome;
$pdf->Cell(30, 15,$anninc,0,0);
$chalan_no='                                                                           '.$chalan;
$pdf->Cell(30, 11,$chalan_no,0,0);

$date='                                                                         '.$chlndate;
$pdf->Cell(30, 11,$date,0,1);
//$pdf->SetFont('Arial','B',15);

$bg='                                       '.$blood;
$pdf->Cell(30, 9,$bg,0,0);
$date='                                                                          '.$chlnbranch;
$pdf->Cell(30, 4,$date,0,1);

$mobno1='                                '.$stMobile;
$pdf->Cell(30, 16,$mobno1,0,0);
$mobno2='                                                                                  '.$ptMobile;
$pdf->Cell(30, 16,$mobno2,0,1);
$caste='                                '.$religion;
$pdf->Cell(30, 1,$caste,0,0);
$categ='                                                                                                            '.$category;
$pdf->Cell(30, 1,$categ,0,1);
$father='                                '.$fname;
$pdf->Cell(80, 13,$father,0,0);
$foccup='                                                                             '.$fOccu;
$pdf->Cell(30, 13,$foccup,0,1);

$mother='                                '.$mname;
$pdf->Cell(80, 1,$mother,0,0);
$moccup='                                                                             '.$mOccu;
$pdf->Cell(30, 1,$moccup,0,1);
$house1='                       '.$padr1;
$pdf->Cell(30, 14,$house1,0,0);

$house2='                                                                                                               '.$cadr1;
$pdf->Cell(50, 14,$house2,0,1);
$po1='                       '.$padr2;
$pdf->Cell(-10, 8,$po1,0,0,"L");
$po2='                                                                                                                                                      '.$cadr2;
$pdf->Cell(100, 8,$po2,0,1);

$place1='                       '.$padr3;
$pdf->Cell(30, 8,$place1,0,0);
$place2='                                                                                                               '.$cadr3;
$pdf->Cell(50, 8,$place2,0,1);
$po1='                        '.$padr4;
$pdf->Cell(50, 8,$po1,0,0,"L");

$pin1='                                   '.$ppin;
$pdf->SetFontSize('10');
$pdf->Cell(30, 7,$pin1,0,0);
$pin1='                                                                       '.$cadr4;

$pdf->Cell(30, 7,$pin1,0,0);


$pin2='                                                                            '.$cpin;
$pdf->Cell(50, 7,$pin2,0,1);
$pdf->SetFontSize('12');

$rollno='                                            '.$tenRoll;
$pdf->Cell(30, 7,$rollno,0,0);
$month='                                                                                '.$tenMonth;
$pdf->Cell(50, 7,$month,0,0);
$year='                                                                         '.$tenYear;
$pdf->Cell(50, 7,$year,0,1);
$school='                                                                             '.$tenSchool;
$pdf->Cell(50, 7,$school,0,1);
$board='                                                                       '.$tenBoard;
$pdf->Cell(50, 7,$board,0,1);

$group='                                            '.$plus2group;
$pdf->Cell(30, 16,$group,0,0);
$regno='                                                              '.$plus2roll;
$pdf->Cell(30, 16,$regno,0,0);
$month1='                                                                     '.$twoMonths;
$pdf->Cell(30, 16,$month1,0,0);
$year1='                                                                       '.$twoYear;
$pdf->Cell(30, 16,$year1,0,1);
$school1='                                                                            '.$twoSchoolName;
$pdf->Cell(30, 1,$school1,0,1);
$exam='                                                                          '.$twoExamName;
$pdf->Cell(30, 17,$exam,0,1);
$board1='                                                                          '.$twoBoardName;
$pdf->Cell(50, -1,$board1,0,1);
$tcno='                                                      '.$tcno;
$pdf->Cell(30, 17,$tcno,0,0);
$tcdate='                                                                        '.$tcdate;
$pdf->Cell(30, 17,$tcdate,0,1);
$tcinst='                                                                '.$tcname;
$pdf->Cell(30, -1,$tcinst,0,0);


/////////////////////////////


$pdf->AddPage();

$img='admission.jpg';
$img=  base_url('admission.jpg');
$pdf->Image($img,0,0,210);
$pdf->SetFont('Arial','B',15);
$pdf->SetFontSize('12');
$tcinst=$name;
$pdf->Cell(20, 36,"                    ",0,0);
$pdf->MultiCell(60, 36,$tcinst);

$tcinst="
".$name;
$pdf->Cell(70, 43,"                    ",0,0);
$pdf->MultiCell(60, 43,$tcinst);
$tcinst=$fname;
$pdf->Cell(70, -28,"                    ",0,0);
$pdf->MultiCell(60, -28,$tcinst);
$tcinst="
".$name;
$pdf->Cell(20, 46,"                    ",0,0);
$pdf->MultiCell(60, 46,$tcinst);

$tcinst="







".$name;
$pdf->Cell(70, 7,"                    ",0,0);
$pdf->MultiCell(60, 7,$tcinst);
$tcinst=$fname;
$pdf->Cell(70, 10,"                    ",0,0);
$pdf->MultiCell(60, 10,$tcinst);
//////////////////////////////////////////

$pdf->AddPage();

$img=  base_url('rules.jpg');
$pdf->Image($img,0,0,210);
$pdf->SetFont('Arial','B',15);
$pdf->SetFontSize('12');
$tcinst="            












".$name;
$pdf->Cell(85, 18,"                                   ",0,0);
$pdf->MultiCell(60, 18,$tcinst);

////////////////////////////////


$pdf->AddPage();

$img=base_url('id2.jpg');
$pdf->Image($img,0,0,210);
$pdf->SetFont('Arial','B',15);
$pdf->SetFontSize('12');
$tcinst=$name;
$pdf->Cell(30, 84,"                    ",0,0);
$pdf->Cell(60, 84,$tcinst,0,0);

$tcinst=$fname;
$pdf->Cell(35, 84,"                    ",0,0);
$pdf->Cell(60, 84,$tcinst,0,1);

$tcinst=$padr1;
$pdf->Cell(25, -73,"                    ",0,0);
$pdf->Cell(60, -73,$tcinst,0,0);

$tcinst="$padr1";
$pdf->Cell(35, -70,"                    ",0,0);
$pdf->Cell(60, -70,$tcinst,0,1);

$tcinst="$padr2";
$pdf->Cell(25, 80,"                    ",0,0);
$pdf->Cell(60, 80,$tcinst,0,0);

$tcinst="$padr2";
$pdf->Cell(35, 80,"                    ",0,0);
$pdf->Cell(60, 80,$tcinst,0,1);

$tcinst="$padr3";
$pdf->Cell(25, -67,"                    ",0,0);
$pdf->Cell(60, -67,$tcinst,0,0);

$tcinst=$ppin;
$pdf->Cell(25, -60,"                    ",0,0);
$pdf->Cell(60, -60,$tcinst,0,1);

$tcinst="$padr4";
$pdf->Cell(15, 65,"                    ",0,0);
$pdf->Cell(60, 65,$tcinst,0,0);

$tcinst=$ppin;
$pdf->Cell(-12, 67,"                    ",0,0);
$pdf->Cell(60, 67,$tcinst,0,0);

$tcinst=$ptMobile;
$pdf->Cell(-8	, 72,"                    ",0,0);
$pdf->Cell(60, 72,$tcinst,0,1);
$tcinst=$fname;
$pdf->Cell(25,-50 ,"                    ",0,0);
$pdf->Cell(60, -50,$tcinst,0,0);

$tcinst=$stMobile;
$pdf->Cell(30,-58 ,"                    ",0,0);
$pdf->Cell(60, -58,$tcinst,0,1);
$tcinst=$ptMobile;
$pdf->Cell(25,80 ,"                    ",0,0);
$pdf->Cell(60, 80,$tcinst,0,0);

$tcinst="";
$pdf->Cell(30,70 ,"                    ",0,0);
$pdf->Cell(60, 70,$tcinst,0,0);
////////////////////////////////


$pdf->AddPage();

$img=base_url('id4.jpg');
$pdf->Image($img,0,0,210);
$pdf->SetFont('Arial','B',15);
$pdf->SetFontSize('12');
$tcinst=$name;
$pdf->Cell(30, 84,"                    ",0,0);
$pdf->Cell(60, 84,$tcinst,0,0);

$tcinst=$fname;
$pdf->Cell(35, 84,"                    ",0,0);
$pdf->Cell(60, 84,$tcinst,0,1);

$tcinst=$padr1;
$pdf->Cell(25, -73,"                    ",0,0);
$pdf->Cell(60, -73,$tcinst,0,0);

$tcinst="$padr1";
$pdf->Cell(35, -70,"                    ",0,0);
$pdf->Cell(60, -70,$tcinst,0,1);

$tcinst="$padr2";
$pdf->Cell(25, 80,"                    ",0,0);
$pdf->Cell(60, 80,$tcinst,0,0);

$tcinst="$padr2";
$pdf->Cell(35, 80,"                    ",0,0);
$pdf->Cell(60, 80,$tcinst,0,1);

$tcinst="$padr3";
$pdf->Cell(25, -67,"                    ",0,0);
$pdf->Cell(60, -67,$tcinst,0,0);

$tcinst=$ppin;
$pdf->Cell(25, -60,"                    ",0,0);
$pdf->Cell(60, -60,$tcinst,0,1);

$tcinst="$padr4";
$pdf->Cell(15, 65,"                    ",0,0);
$pdf->Cell(60, 65,$tcinst,0,0);

$tcinst=$ppin;
$pdf->Cell(-12, 67,"                    ",0,0);
$pdf->Cell(60, 67,$tcinst,0,0);

$tcinst=$ptMobile;
$pdf->Cell(-8	, 72,"                    ",0,0);
$pdf->Cell(60, 72,$tcinst,0,1);
$tcinst=$fname;
$pdf->Cell(25,-50 ,"                    ",0,0);
$pdf->Cell(60, -50,$tcinst,0,0);

$tcinst=$stMobile;
$pdf->Cell(30,-58 ,"                    ",0,0);
$pdf->Cell(60, -58,$tcinst,0,1);
$tcinst=$ptMobile;
$pdf->Cell(25,80 ,"                    ",0,0);
$pdf->Cell(60, 80,$tcinst,0,0);

$tcinst="";
$pdf->Cell(30,70 ,"                    ",0,0);
$pdf->Cell(60, 70,$tcinst,0,0);
/////////////////////////////////////
$pdf->AddPage();

$img=base_url('record.jpg');
$pdf->Image($img,0,0,210);
$pdf->SetFont('Arial','',15);
$pdf->SetFontSize('13');
$pdf->SetXY('83', '43');
$pdf->Cell(10, 10, $courses );
$pdf->SetXY('42', '56');
$pdf->Cell(10, 10, $name );
$pdf->SetXY('160', '56');
$pdf->Cell(10, 10, $classNo );
$pdf->SetXY('50', '66');
$pdf->Cell(10, 10, $dob );
$pdf->SetXY('89', '66');
$pdf->Cell(10, 10, $gender );
$pdf->SetXY('168', '66');
$pdf->Cell(10, 10, $blood );
$pdf->SetXY('55', '76');
$pdf->Cell(10, 10, $stMobile );
$pdf->SetXY('130', '76');
$pdf->Cell(10, 10, 'EMail Address' );
$pdf->SetXY('87', '90');
$pdf->Cell(10, 10, $hostelName );
$pdf->SetXY('58', '86');
$pdf->Cell(10, 10, $residential );
$pdf->SetXY('63', '97');
$pdf->Cell(10, 10, $vehicle );
$pdf->SetXY('90', '97');
$pdf->Cell(10, 10, $vehicleNo );
$pdf->SetXY('90', '105');
$pdf->Cell(10, 10, $religion );
$pdf->SetXY('140', '105');
$pdf->Cell(10, 10, $category );
$pdf->SetXY('70', '115');
$pdf->Cell(10, 10, $twoSchoolName );
$pdf->SetXY('65', '126');
$pdf->Cell(10, 10, $plus2mark );
$pdf->SetXY('170', '126');
$pdf->Cell(10, 10, $twoYear );
$pdf->SetXY('65', '133');
$pdf->Cell(10, 10, $tenMark );
$pdf->SetXY('170', '133');
$pdf->Cell(10, 10, $tenYear );
$pdf->SetXY('80', '158');
$pdf->Cell(10, 10, $padr1 );
$pdf->SetXY('70', '165');
$pdf->Cell(10, 10, $padr2);
$pdf->SetXY('119', '165');
$pdf->Cell(10, 10, $padr3);
$pdf->SetXY('67', '173');
$pdf->Cell(10, 10, $padr4);
$pdf->SetXY('150', '173');
$pdf->Cell(10, 10, $ppin);
$pdf->SetXY('80', '190');
$pdf->Cell(10, 10, $fname.', '.$fOccu);
$pdf->SetXY('60', '196');
$pdf->Cell(10, 10, $ptMobile);
$pdf->SetXY('90', '196');
$pdf->Cell(10, 10, '');//OFFICE PHONE SPACE
$pdf->SetXY('85', '204');
$pdf->Cell(10, 10, $mname.', '.$mOccu);
$pdf->SetXY('67', '213');
$pdf->SetFontSize('10');
$pdf->MultiCell(100 , 4, $guardian);
$pdf->SetFontSize('14');
$pdf->SetXY('50', '240');
$pdf->Cell(10, 10, $rel1 );
$pdf->SetXY('143', '240');
$pdf->Cell(10, 10, $rel1Job );
$pdf->SetXY('50', '247');
$pdf->Cell(10, 10, $rel2 );
$pdf->SetXY('143', '247');
$pdf->Cell(10, 10, $rel2Job );
$pdf->SetXY('50', '254');
$pdf->Cell(10, 10, $rel3 );
$pdf->SetXY('143', '254');
$pdf->Cell(10, 10, $rel3Job );
$pdf->SetXY('70', '261');
$pdf->Cell(10, 10, $extra1 );
$pdf->SetXY('100', '266.5');
$pdf->Cell(10, 10, $extra2 );
$pdf->Output();


}
    else{
    alert('ERROR');
    jsRedirect(base_url('/office/page/printApplication'));
}
?>
