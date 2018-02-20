<?php
/**
 *	Relatorio Disciplinar
 *
 *  - Relatorio discriminando todos os dados referente as ocorrencias do ano
 *  Dados
 *    - Total de ocorrencias
 *      - Matutino e Vespertino
 *      - Séries
 *      - Turmas
 *      - Dias da Semana
 *      - Professor
 *      - Faixa etária
 *      - Tipo de ocorrencia
 *
 */

// Função porcento
function porcento($parte, $total)
{
  $x = ($parte * 100) / $total;
  return $x;
}
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
PDF::Image(asset('img/brasao_df.png'), 12, 8, 22, 21);

//PDF::text( 49, 6, 'GOVERNO DO DISTRITO FEDERAL');
PDF::Cell(190, 4, 'GOVERNO DO DISTRITO FEDERAL', 0, 1, 'C',0 );
PDF::Cell(190, 4, 'SECRETARIA DE ESTADO DE EDUCAÇÃO', 0, 1, 'C',0 );
PDF::Cell(190, 4, 'CENTRO DE ENSINO FUNDAMENTAL 507 DE SAMAMBAIA', 0, 1, 'C',0 );
PDF::ln();
PDF::SetFont('times','B',12);
PDF::Cell(190, 4, 'RELATÓRIO DISCIPLINAR', 0, 1, 'C',0 );
PDF::ln();
PDF::SetFont('times','B',10);

// Turno e total

PDF::Cell(35, 5, 'Turno', 1, 0, 'C', 1);
PDF::Cell(22, 5, 'Ocorrências', 1, 0, 'C', 0);
PDF::Cell(35, 5, 'Série/Ano', 1, 0, 'C', 1);
PDF::Cell(22, 5, 'Ocorrências', 1, 0, 'C', 0);
PDF::Cell(35, 5, 'Dia', 1, 0, 'C', 1);
PDF::Cell(22, 5, 'Ocorrências', 1, 1, 'C', 0);

PDF::Cell(35, 5, 'Matutino', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados['turno']['Matutino']['qnt'], 1, 0, 'C', 0);
PDF::Cell(35, 5, '6º Ano', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados[6]['qnt'], 1, 0, 'C', 0);
PDF::Cell(35, 5, 'Segunda', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados['semana'][1]['qnt'], 1, 1, 'C', 0);

PDF::Cell(35, 5, 'Vespertino', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados['turno']['Vespertino']['qnt'], 1, 0, 'C', 0);
PDF::Cell(35, 5, '7º Ano', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados[7]['qnt'], 1, 0, 'C', 0);
PDF::Cell(35, 5, 'Terça', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados['semana'][2]['qnt'], 1, 1, 'C', 0);

PDF::Cell(35, 5, 'Transferidos', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados['T']['qnt'], 1, 0, 'C', 0);
PDF::Cell(35, 5, '8º Ano', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados[8]['qnt'], 1, 0, 'C', 0);
PDF::Cell(35, 5, 'Quarta', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados['semana'][3]['qnt'], 1, 1, 'C', 0);

PDF::Cell(35, 5, 'Total', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados['total']['qnt'], 1, 0, 'C', 0);
PDF::Cell(35, 5, '9º Ano', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados[9]['qnt'], 1, 0, 'C', 0);
PDF::Cell(35, 5, 'Quinta', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados['semana'][4]['qnt'], 1, 1, 'C', 0);

PDF::Cell(35, 5, '', 0, 0, 'C', 0);
PDF::Cell(22, 5, '', 0, 0, 'C', 0);
PDF::Cell(35, 5, '', 0, 0, 'C', 0);
PDF::Cell(22, 5, '', 0, 0, 'C', 0);
PDF::Cell(35, 5, 'Sexta', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados['semana'][5]['qnt'], 1, 1, 'C', 0);

PDF::Cell(114,5,'',0,0,'C',0);
PDF::Cell(35, 5, 'Sábado', 1, 0, 'C', 1);
PDF::Cell(22, 5, $dados['semana'][6]['qnt'], 1, 1, 'C', 0);

//Tipo de Ocorrencia e Equipe

PDF::Cell(50,5, 'Tipo de Ocorrência', 1, 0, 'C',1);
PDF::Cell(30,5, 'Ocorrências', 1, 1, 'C', 0);

PDF::Cell(50, 5, 'Advertência Oral', 1, 0, 'L', 1);
PDF::Cell(30, 5, $dados['tipo']['Advertência Oral']['qnt']." ( ". round(porcento($dados['tipo']['Advertência Oral']['qnt'], $dados['total']['qnt']), 1).'% )', 1, 0, 'R', 0);

  //Equipe
  PDF::Cell(28, 5, '', 0, 0, 'L', 0);
  PDF::Cell(50, 5, 'Equipe', 1, 0, 'L', 1);
  PDF::Cell(32, 5, 'Lançamentos', 1, 1, 'L', 0);
  $controle = 0;

PDF::Cell(50, 5, 'Advertência Escrita', 1, 0, 'L', 1);
PDF::Cell(30, 5, $dados['tipo']['Advertência Escrita']['qnt']." ( ". round(porcento($dados['tipo']['Advertência Escrita']['qnt'], $dados['total']['qnt']), 1).'% )', 1, 0, 'R', 0);

  //Equipe
    PDF::Cell(28, 5, '', 0, 0, 'L', 0);
    PDF::Cell(50, 5, $dados['equipe']['key'][$controle] , 1, 0, 'L', 1);
    PDF::Cell(32, 5, $dados['equipe']['value'][$controle], 1, 1, 'L', 0);
    $controle++;

PDF::Cell(50, 5, 'Suspensão', 1, 0, 'L', 1);
PDF::Cell(30, 5, $dados['tipo']['Suspensão']['qnt']." ( ". round(porcento($dados['tipo']['Suspensão']['qnt'], $dados['total']['qnt']), 1).'% )', 1, 0, 'R', 0);

  //Equipe
    PDF::Cell(28, 5, '', 0, 0, 'L', 0);
    PDF::Cell(50, 5, $dados['equipe']['key'][$controle] , 1, 0, 'L', 1);
    PDF::Cell(32, 5, $dados['equipe']['value'][$controle], 1, 1, 'L', 0);
    $controle++;

PDF::Cell(50, 5, 'Termo de Compromisso', 1, 0, 'L', 1);
PDF::Cell(30, 5, $dados['tipo']['Termo de Compromisso']['qnt']." ( ". round(porcento($dados['tipo']['Termo de Compromisso']['qnt'], $dados['total']['qnt']), 1).'% )', 1, 0, 'R', 0);

  //Equipe
  PDF::Cell(28, 5, '', 0, 0, 'L', 0);
  PDF::Cell(50, 5, $dados['equipe']['key'][$controle] , 1, 0, 'L', 1);
  PDF::Cell(32, 5, $dados['equipe']['value'][$controle], 1, 1, 'L', 0);
  $controle++;

  PDF::Cell(108, 5, '', 0, 0, 'L', 0);
  PDF::Cell(50, 5, $dados['equipe']['key'][$controle] , 1, 0, 'L', 1);
  PDF::Cell(32, 5, $dados['equipe']['value'][$controle], 1, 1, 'L', 0);
  $controle++;

//Tipos de Indisciplina
PDF::Cell(70,5, 'Tipos de Infrações', 1, 0, 'C', 1);
PDF::Cell(30, 5, 'Ocorrências', 1, 0, 'C', 0);

  //Equipe
  PDF::Cell(8, 5, '', 0, 0, 'L', 0);
  PDF::Cell(50, 5, $dados['equipe']['key'][$controle] , 1, 0, 'L', 1);
  PDF::Cell(32, 5, $dados['equipe']['value'][$controle], 1, 1, 'L', 0);
  $controle++;

foreach ($dados['base'] as $key => $value) {
  if (count($dados['equipe']['key']) > $controle) {
    PDF::Cell(70,5, $key, 1, 0, 'L', 1);
    PDF::Cell(30, 5, $value['qnt']." ( ". round( porcento($value['qnt'], $dados['total']['qnt']), 1) ." %)", 1, 0, 'R', 0);

      //Equipe
      PDF::Cell(8, 5, '', 0, 0, 'L', 0);
      PDF::Cell(50, 5, $dados['equipe']['key'][$controle] , 1, 0, 'L', 1);
      PDF::Cell(32, 5, $dados['equipe']['value'][$controle], 1, 1, 'L', 0);
      $controle++;
  }else{
    PDF::Cell(70,5, $key, 1, 0, 'L', 1);
    PDF::Cell(30, 5, $value['qnt']." ( ". round( porcento($value['qnt'], $dados['total']['qnt']), 1) ." %)", 1, 1, 'R', 0);
  }
}
// Observação sobre os dados acima
PDF::SetFont('times','',10);
PDF::Cell(190,5, '* Vale lembrar que uma ocorrência pode conter várias infrações.', 0, 1, 'L', 0);
PDF::ln();

//Tipos de infrações
PDF::SetFont('times','B',10);
PDF::Cell(160, 5, 'Tipos de Ocorrências', 1, 0, 'C', 1);
PDF::Cell(30, 5, 'Ocorrências', 1, 1, 'C', 0);

foreach ($dados['indisciplina'] as $key => $value) {
  // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
  PDF::MultiCell(160, 5, $value['descricao'], 1, 'L', 1, 0);
  PDF::MultiCell(30, 5, $value['qnt'], 1, 'C', 0, 1);
}

PDF::Output();
?>
