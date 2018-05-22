<?php
/**
 *	Declaração de Comparecimento
 *
 *	Arquivo em PDF - TCPDF
 *	dados em $aluno, $resp
 */

// Iniciando o PDF
//$pdf= Yii::app()->pdfFactory->getTCPDF();
//PDF::SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

PDF::SetAutoPageBreak(false, 2);
PDF::setPrintHeader(false);
PDF::setPrintFooter(false);
// Começando o PDF
PDF::AddPage('P','A4');

PDF::SetFont('helvetica','',14);
PDF::setFillColor(230,230,230);
PDF::Image(asset('img/brasao_df.png'), 12, 8, 22, 21);

//PDF::text( 49, 6, 'GOVERNO DO DISTRITO FEDERAL');
PDF::Cell(190, 6, 'GDF - SECRETARIA DE ESTADO DE EDUCAÇÃO', 0, 1, 'C',0 );
PDF::SetFont('helvetica','',11);
PDF::Cell(190, 6, 'CENTRO DE ENSINO FUNDAMENTAL 507 DE SAMAMBAIA', 0, 1, 'C',0 );
PDF::SetFont('helvetica','',10);
PDF::Cell(190, 6, 'QN 507 CONJUNTO 7 LOTE 1 SAMAMBAIA DF (61) 3901-7739', 0, 1, 'C',0 );
PDF::ln(25);
PDF::SetFont('times','B',11);
PDF::Cell(190, 4, 'DECLARAÇÃO', 0, 1, 'C',0 );
PDF::ln(15);
PDF::SetFont('times','',11);
$txt = '                           Declaramos para os devidos fins que '.$resp.', compareceu a esta instituição de Ensino no '.date('d').' de maio de '.date('Y').
' no turno matutino para tratar de assunto relacionado à seu filho(a) '.$aluno->nome.', aluno regularmente matriculado na turma '.$aluno->turma->turma.'.';
PDF::MultiCell(190, 10, ' '.$txt, 0, 'J', 0, 1, '', '', true);
PDF::ln(20);
PDF::Cell(190, 6, 'SAMAMBAIA - DF, '.date('d').' de maio de 2018.', 0, 1, 'R',0 );
PDF::ln(20);
PDF::Cell(100, 6, '', 0, 0, 'R',0 );
PDF::Cell(90, 6, 'DIREÇÃO', 'T', 1, 'C',0 );
PDF::Output();
?>
