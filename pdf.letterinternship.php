<?php
require("include/main.inc.php");
require("models/Model.php");
require("models/ModelRequests.php");
require('lib/pdfcreator/fpdf.php');

if (isset($_GET['id'])) {
    $_GET['id'] = $_GET['id'] + 0;
    $model = new ModelRequests();
    $arrRequests = $model->findsome(array('S.ID'=>$_GET['id']));
    if ($arrRequests[0]) {
        $data['empresa'] = $arrRequests[0]['EMPRESA'];
        $data['estudiante'] = $arrRequests[0]['ESTUDIANTE'];

        $document = array(
            "Santo Domingo",
            "Para {$data['empresa']}",
            "Presente",
            "Me dirijo a ud., en la oportunidad de aceptar a el (la) bachiller {$data['estudiante']}, ",
            "para realizar su pasantia profesional en esta empresa y por un periodo minimo de 16 semanas",
            "consecutivas de acuerdo al convenio FUNDEI.",
            "",
            "Sin mas a que hacer referencia."
        );

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTitle("Carta de Pasantia ,Generada por: " . __SITENAME__);
        $pdf->SetSubject("subject");
        foreach ($document as $v) {
            $pdf->Cell(30, 7, $v, 0, 1);
        }
        $pdf->Output();
    }
}
?>