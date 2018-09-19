<?php
// Relatório do Aluno
// 18 de junho de 2017
//
// Dados pessoais
// Notas
// Horario Escolar
// Professores
// Ocorrencias

// Iniciando o PDF
//PDF::SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

PDF::SetAutoPageBreak(false, 2);
PDF::setPrintHeader(false);
PDF::setPrintFooter(false);
// Começando o PDF
PDF::AddPage('P','A4');

PDF::SetFont('helvetica','B',14);
PDF::setFillColor(230,230,230);

//Linha 1
PDF::Cell(190, 6, 'Centro de Ensino Fundamental 507 de Samambaia', 1, 1, 'C',0 );
//Linha 2
PDF::SetFont('helvetica','',10);
PDF::Cell(22, 5, 'Estudante', 1, 0, 'C',1 );
PDF::Cell(124, 5, $aluno->nome, 1, 0, 'L',0 );
PDF::Cell(22, 5, 'Matrícula', 1, 0, 'C',1 );
PDF::Cell(22, 5, $aluno->matricula, 1, 1, 'C',0 );
//Linha 3
PDF::Cell(22, 5, 'Telefone', 1, 0, 'C',1 );
PDF::Cell(124, 5, str_replace("#", ", ", $aluno->telefone), 1, 0, 'L',0 );
PDF::Cell(22, 5, 'CEP', 1, 0, 'C',1 );
PDF::Cell(22, 5, $aluno->cep, 1, 1, 'C',0 );
//Linha 4
PDF::Cell(22, 5, 'Endereço', 1, 0, 'C',1 );
PDF::Cell(168, 5, $aluno->endereco, 1, 1, 'L',0 );
//Linha 5
if ($aluno->pai != NULL) {
  PDF::Cell(22, 5, 'Pai', 1, 0, 'C',1 );
  PDF::Cell(168, 5, $aluno->pai, 1, 1, 'L',0 );
}
//Linha 6
PDF::Cell(22, 5, 'Mãe', 1, 0, 'C',1 );
PDF::Cell(168, 5, $aluno->mae, 1, 1, 'L',0 );
PDF::ln();

//Linha 7
PDF::SetFont('helvetica','B',14);
PDF::Cell(190, 5, $aluno->turma->turma, 0, 1, 'C',0 );
PDF::ln();
//Colunas
$esquerda = '<h5>Professores</h5>';
$direita = '<h5>Horário</h5>';
  //Professores
foreach ($aluno->turma->disciplinas as $disciplina) {
  $esquerda .= '<font style="margin-left: 0; font-size: 10px">'. $disciplina->professor->professor.' - '.$disciplina->habilidade.'</font><br>';

}

  //Horario
foreach ($aluno->turma->horarios as $horario) {
  $horarios[$horario->horario][$horario->dia]= $horario->disciplina->disciplina;
}
$direita .= '
  <table style="font-size: 10px; border: 1px solid #000; text-align: center;" border = "1">
    <thead>
      <tr>
        <th width="20"></th>
        <th>Segunda</th><th>Terça</th><th>Quarta</th><th>Quinta</th><th>Sexta</th>
      </tr>
    </thead>
    <tbody>';
foreach ($horarios as $key => $value) {

    $direita .='
    <tr>
      <td width="20">'.$key.'º</td>
      <td>'.$value['Segunda'].'</td>
      <td>'.$value['Terça'].'</td>
      <td>'.$value['Quarta'].'</td>
      <td>'.$value['Quinta'].'</td>
      <td>'.$value['Sexta'].'</td>
    </tr>';

}
$direita .= '
    </tbody>
  </table>
';


// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
PDF::writeHTMLCell(110, '', '', '', $direita, 0, 0, 0, true);
PDF::writeHTMLCell(10, '', '', '', '', 0, 0, 0, true);
PDF::writeHTMLCell(70, '', '', '', $esquerda, 1, 1, 0, true);

// foto do aluno
if(File::exists(public_path().'/fotos/'.$aluno->matricula.'.jpg')){
    PDF::Image(asset('/fotos/'.$aluno->matricula.'.jpg'), 11, 102, 38, 38, '', '', '', false, 300, '', false, false, 1);
}else{
    PDF::Image(asset('/img/semfoto.jpg'), 11, 102, 30, 30, '', '', '', false, 300, '', false, false, 1);
}




// Boletim
if(count($aluno->rendimentos) > 0){

  PDF::SetFont('helvetica','B',14);
  PDF::Cell(190, 5, 'Boletim', 0, 1, 'C',0 );
  PDF::ln();
  //Iniciando table do Boletim
  PDF::SetFont('helvetica','B',11);
  PDF::Cell(70, 10, 'Disciplinas', 1, 0, 'C',0 );
  PDF::Cell(30, 5, '1º Bimestre', 1, 0, 'C',0 );
  PDF::Cell(30, 5, '2º Bimestre', 1, 0, 'C',0 );
  PDF::Cell(30, 5, '3º Bimestre', 1, 0, 'C',0 );
  PDF::Cell(30, 5, '4º Bimestre', 1, 1, 'C',0 );

  PDF::SetFont('helvetica','',10);
  PDF::Cell(70, 5, '', 0, 0, 'C',0 );
  PDF::Cell(15, 5, 'Nts', 1, 0, 'C',0 );
  PDF::Cell(15, 5, 'Fts', 1, 0, 'C',0 );
  PDF::Cell(15, 5, 'Nts', 1, 0, 'C',0 );
  PDF::Cell(15, 5, 'Fts', 1, 0, 'C',0 );
  PDF::Cell(15, 5, 'Nts', 1, 0, 'C',0 );
  PDF::Cell(15, 5, 'Fts', 1, 0, 'C',0 );
  PDF::Cell(15, 5, 'Nts', 1, 0, 'C',0 );
  PDF::Cell(15, 5, 'Fts', 1, 1, 'C',0 );

  $disciplinas = ['Artes', 'Ciências Naturais', 'Educação Física', 'Geografia', 'História', 'Inglês', 'Matemática', 'Português', 'Práticas Diversificadas I', 'Práticas Diversificadas II'];

  foreach ($disciplinas as $disciplina) {
    $boletim['primeiro'][$disciplina] = '';
    $boletim['segundo'][$disciplina] = '';
    $boletim['terceiro'][$disciplina] = '';
    $boletim['quarto'][$disciplina] = '';
  }

  foreach ($aluno->rendimentos as $rendimento) {
    if ($rendimento['bimestre'] == 1) {
      $boletim['primeiro'][$rendimento->disciplina->habilidade]['nota'] = $rendimento->nota;
      $boletim['primeiro'][$rendimento->disciplina->habilidade]['faltas'] = $rendimento->faltas;
    }elseif ($rendimento['bimestre'] == 2) {
      $boletim['segundo'][$rendimento->disciplina->habilidade]['nota'] = $rendimento->nota;
      $boletim['segundo'][$rendimento->disciplina->habilidade]['faltas'] = $rendimento->faltas;
    }elseif ($rendimento['bimestre'] == 3) {
      $boletim['terceiro'][$rendimento->disciplina->habilidade]['nota'] = $rendimento->nota;
      $boletim['terceiro'][$rendimento->disciplina->habilidade]['faltas'] = $rendimento->faltas;
    }elseif ($rendimento['bimestre'] == 4) {
      $boletim['quarto'][$rendimento->disciplina->habilidade]['nota'] = $rendimento->nota;
      $boletim['quarto'][$rendimento->disciplina->habilidade]['faltas'] = $rendimento->faltas;
    }
  }

  foreach ($disciplinas as $disciplina) {
    PDF::Cell(70, 5, $disciplina, 1, 0, 'C',0 );

    if (count($boletim['primeiro'][$disciplina]) == 2) {
      PDF::Cell(15, 5, $boletim['primeiro'][$disciplina]['nota'], 1, 0, 'C',0 );
      PDF::Cell(15, 5, $boletim['primeiro'][$disciplina]['faltas'], 1, 0, 'C',0 );
    }else{
      PDF::Cell(15, 5, '', 1, 0, 'C',0 );
      PDF::Cell(15, 5, '', 1, 0, 'C',0 );
    }

    if (count($boletim['segundo'][$disciplina]) == 2) {
      PDF::Cell(15, 5, $boletim['segundo'][$disciplina]['nota'], 1, 0, 'C',0 );
      PDF::Cell(15, 5, $boletim['segundo'][$disciplina]['faltas'], 1, 0, 'C',0 );
    }else{
      PDF::Cell(15, 5, '', 1, 0, 'C',0 );
      PDF::Cell(15, 5, '', 1, 0, 'C',0 );
    }

    if (count($boletim['terceiro'][$disciplina]) == 2) {
      PDF::Cell(15, 5, $boletim['terceiro'][$disciplina]['nota'], 1, 0, 'C',0 );
      PDF::Cell(15, 5, $boletim['terceiro'][$disciplina]['faltas'], 1, 0, 'C',0 );
    }else{
      PDF::Cell(15, 5, '', 1, 0, 'C',0 );
      PDF::Cell(15, 5, '', 1, 0, 'C',0 );
    }

    if (count($boletim['quarto'][$disciplina]) == 2) {
      PDF::Cell(15, 5, $boletim['quarto'][$disciplina]['nota'], 1, 0, 'C',0 );
      PDF::Cell(15, 5, $boletim['quarto'][$disciplina]['faltas'], 1, 1, 'C',0 );
    }else{
      PDF::Cell(15, 5, '', 1, 0, 'C',0 );
      PDF::Cell(15, 5, '', 1, 1, 'C',0 );
    }
  }
} // /Boletim

//Ocorrencias

if(count($aluno->ocorrencias) > 0){
  PDF::ln();
  PDF::SetFont('helvetica','B',14);
  PDF::Cell(190, 5, 'Ocorrências', 0, 1, 'C',0 );
  PDF::ln();
  foreach ($aluno->ocorrencias as $value) {
    if (PDF::GetY() > 255) {
      PDF::AddPage('P','A4');
    }
    PDF::SetFont('helvetica','B',10);
    PDF::Cell(20, 5, 'Tipo', 1, 0, 'C', 1);
    PDF::Cell(120, 5, $value->tipo, 1, 0, 'L', 0);
    PDF::Cell(20, 5, 'Data', 1, 0, 'C', 1);
    PDF::Cell(30, 5, Carbon::parse($value->created_at)->format('d/m/Y'), 1, 1, 'C', 0);
    if($value->professor_id != NULL){
      PDF::Cell(20, 5, 'Professor', 1, 0, 'C', 1);
      PDF::Cell(50, 5, $value->professor->professor, 1, 0, 'L', 0);
      PDF::Cell(20, 5, 'Equipe', 1, 0, 'C', 1);
      PDF::Cell(100, 5, $value->equipe->funcao." ".$value->equipe->empregado->name, 1, 1, 'L', 0);
    }else{
      PDF::Cell(20, 5, 'Equipe', 1, 0, 'C', 1);
      PDF::Cell(170, 5, $value->equipe->funcao." ".$value->equipe->empregado->name, 1, 1, 'L', 0);
    }
    $estudantes = '';
    foreach($value->alunos as $pupilo){
      $estudantes .= $pupilo->nome.", ";
    }
    $estudantes = substr($estudantes, 0, -2);
    $estudantes .= '.';

    // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
    // PDF::MultiCell(50, 5, 'Estudantes Envolvidos', 1, 'C', 1, 0,'', '', true, 0, false, true, 40, 'T');
    // PDF::MultiCell(140, 5, '',1, 'C', 0, 1,'', '', true, 0, false, true, 40, 'T');
    // Vertical alignment
    PDF::MultiCell(190, 5, 'Estudantes Envolvidos: '.$estudantes, 1, 'L', 0, 1, '', '', true, 0, false, true, 0, 'T');

    PDF::MultiCell(190, 5, 'Ocorrência: '.$value->descricao, 1, 'L', 0, 1, '', '', true, 0, false, true, 0, 'T');

    PDF::ln();
  }

}

PDF::Output();

 ?>
