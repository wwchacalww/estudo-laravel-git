<?php
/**
 *	Lista de Turma para camisas do interclasse
 *
 *	Arquivo em PDF - TCPDF
 *	dados em $turma
 */

// Iniciando o PDF
//$pdf= Yii::app()->pdfFactory->getTCPDF();
//PDF::SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

PDF::SetAutoPageBreak(false, 2);
PDF::setPrintHeader(false);
PDF::setPrintFooter(false);

foreach ($turmas as $turma) {
  // Começando o PDF
  PDF::AddPage('P','A4');

  PDF::SetFont('times','',10);
  PDF::setFillColor(230,230,230);
  PDF::Image(asset('img/brasao_df.png'), 12, 8, 22, 21);

  //PDF::text( 49, 6, 'GOVERNO DO DISTRITO FEDERAL');
  PDF::Cell(190, 4, 'GOVERNO DO DISTRITO FEDERAL', 0, 1, 'C',0 );
  PDF::Cell(190, 4, 'SECRETARIA DE ESTADO DE EDUCAÇÃO', 0, 1, 'C',0 );
  PDF::Cell(190, 4, 'CENTRO DE ENSINO FUNDAMENTAL 507 DE SAMAMBAIA', 0, 1, 'C',0 );
  PDF::ln();
  PDF::SetFont('times','B',12);
  PDF::Cell(190, 6, 'LISTA DE TURMA '.$turma->turma, 0, 1, 'C',0 );
  PDF::ln();

  PDF::Cell(20, 7, 'Matrícula', 1, 0, 'C', 1);
  PDF::Cell(100, 7, 'Nome do Aluno', 1, 0, 'C', 1);
  PDF::Cell(7, 7, '8', 1, 0, 'C', 1);
  PDF::Cell(7, 7, '9', 1, 0, 'C', 1);
  PDF::Cell(7, 7, '11', 1, 0, 'C', 1);
  PDF::Cell(7, 7, '12', 1, 0, 'C', 1);
  PDF::Cell(7, 7, '13', 1, 0, 'C', 1);
  PDF::Cell(7, 7, '14', 1, 0, 'C', 1);
  PDF::Cell(7, 7, '15', 1, 0, 'C', 1);
  PDF::Cell(7, 7, 'PT', 1, 0, 'C', 1);
  PDF::Cell(7, 7, 'PT', 1, 0, 'C', 1);
  PDF::Cell(7, 7, 'PT', 1, 1, 'C', 1);
  PDF::SetFont('times','',9);

  foreach ($turma->alunos->sortby('nome') as $aluno) {
    PDF::Cell(20, 7, $aluno->matricula, 1, 0, 'C', 0);
    PDF::Cell(100, 7, $aluno->nome, 1, 0, 'L', 0);
    PDF::Cell(7, 7, '', 1, 0, 'C', 0);
    PDF::Cell(7, 7, '', 1, 0, 'C', 0);
    PDF::Cell(7, 7, '', 1, 0, 'C', 0);
    PDF::Cell(7, 7, '', 1, 0, 'C', 0);
    PDF::Cell(7, 7, '', 1, 0, 'C', 0);
    PDF::Cell(7, 7, '', 1, 0, 'C', 0);
    PDF::Cell(7, 7, '', 1, 0, 'C', 0);
    PDF::Cell(7, 7, '', 1, 0, 'C', 0);
    PDF::Cell(7, 7, '', 1, 0, 'C', 0);
    PDF::Cell(7, 7, '', 1, 1, 'C', 0);
  }


}
PDF::Output();
?>
