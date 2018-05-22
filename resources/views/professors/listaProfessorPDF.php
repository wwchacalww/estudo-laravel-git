<?php
/**
 *	Lista de contato dos professores
 *
 *	Arquivo em PDF - TCPDF
 *	dados em $cargas
 */

// Iniciando o PDF
//$pdf= Yii::app()->pdfFactory->getTCPDF();
//PDF::SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

PDF::SetAutoPageBreak(false, 2);
PDF::setPrintHeader(false);
PDF::setPrintFooter(false);
// Começando o PDF
PDF::AddPage('L','A4');


PDF::SetFont('helvetica','',14);
PDF::setFillColor(230,230,230);
PDF::Image(asset('img/brasao_df.png'), 12, 8, 22, 21);

//PDF::text( 49, 6, 'GOVERNO DO DISTRITO FEDERAL');
PDF::Cell(270, 6, 'GDF - SECRETARIA DE ESTADO DE EDUCAÇÃO', 0, 1, 'C',0 );
PDF::SetFont('helvetica','',11);
PDF::Cell(270, 6, 'CENTRO DE ENSINO FUNDAMENTAL 507 DE SAMAMBAIA', 0, 1, 'C',0 );
PDF::SetFont('helvetica','',10);
PDF::Cell(270, 6, 'QN 507 CONJUNTO 7 LOTE 1 SAMAMBAIA DF (61) 3901-7739', 0, 1, 'C',0 );
PDF::ln();
PDF::SetFont('helvetica','B',12);
PDF::Cell(270, 4, 'LISTA DE PROFESSORES', 0, 1, 'C',0 );
PDF::ln();
PDF::SetFont('helvetica','B',10);

PDF::Cell(30, 5, 'Matrícula', 1, 0, 'C', 1);
PDF::Cell(40, 5, 'Professor', 1, 0, 'C', 1);
PDF::Cell(40, 5, 'Habilidade', 1, 0, 'C', 1);
PDF::Cell(70, 5, 'E-mail', 1, 0, 'C', 1);
PDF::Cell(90, 5, 'Telefone', 1, 1, 'C', 1);

PDF::SetFont('helvetica','',10);
$ln = 0;
foreach ($cargas as $carga) {
  if($ln < 28 ) {
    PDF::Cell(30, 5, $carga->professor->empregado->matricula, 1, 0, 'L', 0);
    PDF::Cell(40, 5, $carga->professor->professor, 1, 0, 'L', 0);
    PDF::Cell(40, 5, $carga->professor->habilidade, 1, 0, 'L', 0);
    PDF::Cell(70, 5, $carga->professor->empregado->email, 1, 0, 'L', 0);
    PDF::Cell(90, 5, $carga->professor->empregado->telefone, 1, 1, 'L', 0);
    $ln++;
  }else{
    $ln = 0;
    PDF::AddPage('L','A4');


    PDF::SetFont('helvetica','',14);
    PDF::setFillColor(230,230,230);
    PDF::Image(asset('img/brasao_df.png'), 12, 8, 22, 21);

    //PDF::text( 49, 6, 'GOVERNO DO DISTRITO FEDERAL');
    PDF::Cell(270, 6, 'GDF - SECRETARIA DE ESTADO DE EDUCAÇÃO', 0, 1, 'C',0 );
    PDF::SetFont('helvetica','',11);
    PDF::Cell(270, 6, 'CENTRO DE ENSINO FUNDAMENTAL 507 DE SAMAMBAIA', 0, 1, 'C',0 );
    PDF::SetFont('helvetica','',10);
    PDF::Cell(270, 6, 'QN 507 CONJUNTO 7 LOTE 1 SAMAMBAIA DF (61) 3901-7739', 0, 1, 'C',0 );
    PDF::ln();
    PDF::SetFont('helvetica','B',12);
    PDF::Cell(270, 4, 'LISTA DE PROFESSORES', 0, 1, 'C',0 );
    PDF::ln();
    PDF::SetFont('helvetica','B',10);

    PDF::Cell(30, 5, 'Matrícula', 1, 0, 'C', 1);
    PDF::Cell(40, 5, 'Professor', 1, 0, 'C', 1);
    PDF::Cell(40, 5, 'Habilidade', 1, 0, 'C', 1);
    PDF::Cell(70, 5, 'E-mail', 1, 0, 'C', 1);
    PDF::Cell(90, 5, 'Telefone', 1, 1, 'C', 1);

    PDF::SetFont('helvetica','',10);

    PDF::Cell(30, 5, $carga->professor->empregado->matricula, 1, 0, 'L', 0);
    PDF::Cell(40, 5, $carga->professor->professor, 1, 0, 'L', 0);
    PDF::Cell(40, 5, $carga->professor->habilidade, 1, 0, 'L', 0);
    PDF::Cell(70, 5, $carga->professor->empregado->email, 1, 0, 'L', 0);
    PDF::Cell(90, 5, $carga->professor->empregado->telefone, 1, 1, 'L', 0);
    $ln++;
  }
}
PDF::Output();
?>
