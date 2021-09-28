<?php
require 'fpdf.php';
$db = new PDO('mysql:host=localhost;dbname=healthsystem','root','xerxescodes');

class myPDF extends FPDF{
    function header(){
       //$this->Image('logo.png',10,6);
       $this->SetFont('Arial','B',14);
       $this->Cell(276,10,'PATIENT DOCUMENTS',0.0,'C');
       $this->Ln();
       $this->setFont('Times','',12);
       $this->Cell(276,10,'Location Address Of Patient',0,0,'C');
       $this->Ln(20);
    }

    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
    }

    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(20,10,'ID',1,0,'C');
        $this->Cell(40,10,'NAME',1,0,'C');
        $this->Cell(40,10,'LOCATION',1,0,'C');
        $this->Cell(60,10,'DIAGNOSIS',1,0,'C');
        $this->Cell(36,10,'PRESCRIPTION',1,0,'C');
        $this->Ln();
    }

    function viewTable($db){
      $this->SetFont('Times','',12);
      $stmt = $db->query('SELECT * FROM patient');
      while($data = $stmt->fetch(PDO::FETCH_OBJ)){
        $this->Cell(20,10,$data->id,1,0,'C');
        $this->Cell(40,10,$data->name,1,0,'C');
        $this->Cell(40,10,$data->location,1,0,'C');
        $this->Cell(60,10,$data->diagnosis,1,0,'C');
        $this->Cell(36,10,$data->prescription,1,0,'C');
        $this->Ln();
      }
    }
}

$pdf = new myPDF();
$pdf -> AliasNbPages();
$pdf -> AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf -> Output();



?>