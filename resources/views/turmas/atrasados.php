<?php
/**
 *	Guia do Namo em PDF
 *
 *	Arquivo em PDF - TCPDF
 *	dados em $empregado
 */

// Iniciando o PDF
//$pdf= Yii::app()->pdfFactory->getTCPDF();
//PDF::SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
function mes($mes)
{
  if($mes == 1){  $mes = 'janeiro';}
  if($mes == 2){  $mes = 'fevereiro';}
  if($mes == 3){  $mes = 'março';}
  if($mes == 4){  $mes = 'abril';}
  if($mes == 5){  $mes = 'maio';}
  if($mes == 6){  $mes = 'junho';}
  if($mes == 7){  $mes = 'julho';}
  if($mes == 8){  $mes = 'agosto';}
  if($mes == 9){  $mes = 'setembro';}
  if($mes == 10){  $mes = 'outubro';}
  if($mes == 11){  $mes = 'novembro';}
  if($mes == 12){  $mes = 'dezembro';}
  return $mes;
}

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
PDF::Cell(190, 4, 'LISTA DE ALUNOS ATRASADOS', 0, 1, 'C',0 );
PDF::ln();

foreach ($turmas as $turma) {

  //Cabeçalha da Tabela
  PDF::SetFont('helvetica','B',10);
  PDF::setFillColor(141, 254, 101);
  PDF::SetLineStyle(['color'=>[255,255,255]]);
  $idade = 0;
  if ($turma->serie == '6º Ano') {
    $idade = 12;
  }elseif($turma->serie == '7º Ano'){
    $idade = 13;
  }elseif($turma->serie == '8º Ano'){
    $idade = 14;
  }elseif($turma->serie == '9º Ano'){
    $idade = 15;
  }

  if ($atrasados[$turma->id] > 0) {
    if(PDF::getY() < 260 ){
      PDF::Cell(190, 6, $turma->turma.' - '.$atrasados[$turma->id].' '. ($atrasados[$turma->id] == 1 ? 'Aluno' : 'Alunos') .' com idade superior aos '. $idade.' anos ', 1, 1, 'C',1 );
      PDF::Cell(20, 6, 'Matrícula', 1, 0, 'C', 1);
      PDF::Cell(100, 6, 'Nome do Aluno', 1, 0, 'C', 1);
      PDF::Cell(40, 6, 'Nascimento (Idade)', 1, 0, 'C', 1);
      PDF::Cell(30, 6, 'Série', 1, 1, 'C',1);
    }else{
      PDF::SetY(271);
    }


    //Alunos
    PDF::SetFont('helvetica','',10);
    PDF::setFillColor(214, 241, 200);
    $df = 0;
    foreach ($turma->alunos as $aluno) {
      if (Carbon::Parse($aluno->dn)->age > $idade) {

        ///Quebra de Página
        if (PDF::getY() > 270) {
          // Começando o PDF
          //Rodapé
          PDF::SetY(-15);
          PDF::SetFont('helvetica','', 8);
          PDF::Cell(170, 4, 'Sistema de Gestão Escolar Diretor - Criado e Desenvolvido por Vicente Cartaxo', 0, 0, 'C', 0);
          PDF::Cell(20, 4, 'Página '.PDF::getAliasNumPage(), 0, 1, 'C', 0);
          setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
          Carbon::setLocale('pt-br');
          //PDF::Cell(170, 4, 'Brasília - '.Carbon::now()->formatLocalized('%d de %B de %Y'), 0, 1, 'C', 0);
          PDF::Cell(170, 4, 'Brasília - '.date('d').' de '.mes(date('m')).' de '.date('Y'), 0, 1, 'C', 0);

          PDF::AddPage('P','A4');

          PDF::SetFont('times','',10);
          PDF::setFillColor(230,230,230);
          PDF::Image(asset('img/brasao_df.png'), 12, 8, 22, 21);

          //PDF::text( 49, 6, 'GOVERNO DO DISTRITO FEDERAL');
          PDF::Cell(190, 4, 'GOVERNO DO DISTRITO FEDERAL', 0, 1, 'C',0 );
          PDF::Cell(190, 4, 'SECRETARIA DE ESTADO DE EDUCAÇÃO', 0, 1, 'C',0 );
          PDF::Cell(190, 4, 'CENTRO DE ENSINO FUNDAMENTAL 507 DE SAMAMBAIA', 0, 1, 'C',0 );
          PDF::ln();
          PDF::Cell(190, 4, 'LISTA DE ALUNOS ATRASADOS', 0, 1, 'C',0 );
          PDF::ln();

          //Cabeçado da Tabela
          PDF::SetFont('helvetica','B',10);
          PDF::setFillColor(141, 254, 101);
          PDF::SetLineStyle(['color'=>[255,255,255]]);

          PDF::Cell(190, 6, $turma->turma.' - '.$atrasados[$turma->id].' '. ($atrasados[$turma->id] == 1 ? 'Aluno' : 'Alunos') .' com idade superior aos '. $idade.' anos ', 1, 1, 'C',1 );
          PDF::Cell(20, 6, 'Matrícula', 1, 0, 'C', 1);
          PDF::Cell(100, 6, 'Nome do Aluno', 1, 0, 'C', 1);
          PDF::Cell(40, 6, 'Nascimento (Idade)', 1, 0, 'C', 1);
          PDF::Cell(30, 6, 'Série', 1, 1, 'C',1);

          //Styles Alunos
          PDF::SetFont('helvetica','',10);
          PDF::setFillColor(214, 241, 200);

        }

        PDF::Cell(20, 4, $aluno->matricula, 1, 0, 'L', $df);
        PDF::Cell(100, 4, $aluno->nome, 1, 0, 'L', $df);
        PDF::Cell(40, 4, Carbon::Parse($aluno->dn)->format('d/m/Y').' ('.Carbon::Parse($aluno->dn)->age.' anos)', 1, 0, 'L', $df);
        PDF::Cell(30, 4, $turma->serie, 1, 1, 'L',$df);
        $df = $df == 0 ? 1 : 0;
      }

    }
  }

}

//Resumo

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
PDF::Cell(190, 4, 'LISTA DE ALUNOS ATRASADOS', 0, 1, 'C',0 );
PDF::ln();

//Cabeçalha da Tabela
PDF::SetFont('helvetica','B',10);
PDF::setFillColor(141, 254, 101);
PDF::SetLineStyle(['color'=>[255,255,255]]);

PDF::Cell(38, 6, '6º Ano', 1, 0, 'C', 1);
PDF::Cell(38, 6, '7º Ano', 1, 0, 'C', 1);
PDF::Cell(38, 6, '8º Ano', 1, 0, 'C', 1);
PDF::Cell(38, 6, '9º Ano', 1, 0, 'C', 1);
PDF::Cell(38, 6, 'Total', 1, 1, 'C', 1);
//Alunos
PDF::SetFont('helvetica','',10);
PDF::setFillColor(214, 241, 200);
PDF::Cell(38, 6, $atrasados['6º Ano'], 1, 0, 'C', 1);
PDF::Cell(38, 6, $atrasados['7º Ano'], 1, 0, 'C', 1);
PDF::Cell(38, 6, $atrasados['8º Ano'], 1, 0, 'C', 1);
PDF::Cell(38, 6, $atrasados['9º Ano'], 1, 0, 'C', 1);
PDF::Cell(38, 6, $atrasados['Total'], 1, 1, 'C', 1);
PDF::ln();

//Cabeçalha da Tabela
PDF::SetFont('helvetica','B',10);
PDF::setFillColor(141, 254, 101);
PDF::SetLineStyle(['color'=>[255,255,255]]);

PDF::Cell(50, 6, 'Turma', 1, 0, 'C', 1);
PDF::Cell(38, 6, 'Alunos Atrasados', 1, 0, 'C', 1);
PDF::Cell(38, 6, 'Total de Alunos', 1, 1, 'C', 1);

//Alunos
PDF::SetFont('helvetica','',10);
PDF::setFillColor(214, 241, 200);

$df = 0;
foreach ($turmas as $turma) {
  PDF::Cell(50, 4, $turma->turma, 1, 0, 'L', $df);
  PDF::Cell(38, 4, $atrasados[$turma->id], 1, 0, 'C', $df);
  PDF::Cell(38, 4, count($turma->alunos), 1, 1, 'C', $df);
  $df = $df == 0 ? 1 : 0;
}

//Rodapé
PDF::SetY(-15);
PDF::SetFont('helvetica','', 8);
PDF::Cell(170, 4, 'Sistema de Gestão Escolar Diretor - Criado e Desenvolvido por Vicente Cartaxo', 0, 0, 'C', 0);
PDF::Cell(20, 4, 'Página '.PDF::getAliasNumPage(), 0, 1, 'C', 0);
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
Carbon::setLocale('pt-br');

PDF::Cell(170, 4, 'Brasília - '.date('d').' de '. mes(date('m')) .' de '.date('Y'), 0, 1, 'C', 0);

PDF::Output();
?>
