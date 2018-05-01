<?php
/**
 *	Lista para Consulta Pública
 *
 *	Arquivo em PDF - TCPDF
 *	dados em $equipes e $cargas
 */

// Iniciando o PDF
//$pdf= Yii::app()->pdfFactory->getTCPDF();
//PDF::SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

PDF::SetAutoPageBreak(false, 2);
PDF::setPrintHeader(false);
PDF::setPrintFooter(false);
// Começando o PDF
PDF::AddPage('P','A4');

PDF::SetFont('times','',10);
PDF::setFillColor(230,230,230);

//PDF::text( 49, 6, 'GOVERNO DO DISTRITO FEDERAL');
PDF::Cell(190, 4, 'GRUPO DE TRABALHO PARA REVISÃO E ATUALIZAÇÃO', 0, 1, 'C',0 );
PDF::Cell(190, 4, 'DAS DIRETRIZES DE AVALIAÇÃO EDUCACIONAL DA SEEDF - ABRIL/2018', 0, 1, 'C',0 );
PDF::Cell(190, 4, 'CENTRO DE ENSINO FUNDAMENTAL 507 DE SAMAMBAIA', 0, 1, 'C',0 );
PDF::ln();
PDF::SetFont('times','B',12);
PDF::Cell(190, 6, 'CONSULTA PÚBLICA', 0, 1, 'C',0 );
PDF::SetFont('times','B',10);
PDF::Cell(20, 5, 'Matrícula', 1, 0, 'C', 1);
PDF::Cell(120, 5, 'Nome do Professor ou Membro da Equipe', 1, 0, 'C', 1);
PDF::Cell(50, 5, 'Assinatura', 1, 1, 'C', 1);

$cargos = ['Diretor', 'Vice-Diretor', 'Supervisor Pedagógico', 'Coordenador Pedagógico'];
$matriculas = [];
PDF::SetFont('times','',10);
foreach ($equipes as $equipe) {
  if(in_array($equipe->funcao, $cargos)){
    PDF::Cell(20, 5, $equipe->empregado->matricula, 1, 0, 'C', 0);
    PDF::Cell(120, 5, strtoupper($equipe->empregado->name)." ( ".$equipe->funcao.")", 1, 0, 'L', 0);
    PDF::Cell(50, 5, '', 1, 1, 'C', 0);
  }
}

foreach ($cargas as $carga) {
  if(!in_array($carga->professor->empregado->matricula, $matriculas)){
    PDF::Cell(20, 5, $carga->professor->empregado->matricula, 1, 0, 'C', 0);
    PDF::Cell(120, 5, strtoupper($carga->professor->empregado->name)." ( Professor )", 1, 0, 'L', 0);
    PDF::Cell(50, 5, '', 1, 1, 'C', 0);
    $matriculas[] = $carga->professor->empregado->matricula;
  }

}





PDF::Output();
?>
