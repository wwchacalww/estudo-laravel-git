<?php
// Gerar o PDF do Registro
// @params data

//Funções
function dn($date){
	$x = explode("-", $date);
	if(count($x) == 3){
		return $x[2].'/'.$x[1].'/'.$x[0];
	}else{
		return $date;
	}
}
// Trantando a data
$data = Carbon::parse($ocorrencia->created_at);
// $ex = explode ("-", $ocorrencia->data);
$ex[1] = $data->format('m');
$dia = $data->format('d');
if($ex[1] == 1){$mes = 'janeiro'; }
if($ex[1] == 2){$mes = 'fevereiro'; }
if($ex[1] == 3){$mes = 'março'; }
if($ex[1] == 4){$mes = 'abril'; }
if($ex[1] == 5){$mes = 'maio'; }
if($ex[1] == 6){$mes = 'junho'; }
if($ex[1] == 7){$mes = 'julho'; }
if($ex[1] == 8){$mes = 'agosto'; }
if($ex[1] == 9){$mes = 'setembro'; }
if($ex[1] == 10){$mes = 'outrubro'; }
if($ex[1] == 11){$mes = 'novembro'; }
if($ex[1] == 12){$mes = 'dezembro'; }
$ano = $data->format('Y');

// Iniciando o PDF

PDF::setPrintHeader(false);
PDF::setPrintFooter(false);
PDF::SetMargins(7, 5, 5);
PDF::SetFooterMargin(0);
foreach ($ocorrencia->alunos as $aluno) {
  // Começando o PDF
  PDF::AddPage('P','A4');

  PDF::SetFont('helvetica','B',12);

  PDF::Image(asset('/img/logo.jpg'), 8, 3, 42, 17);

  //PDF::text( 49, 6, 'SECRETARIA DE ESTADO DE EDUCAÇÃO');
  PDF::Cell(45, 7, '', 0, 0, 'C', 0);
  PDF::Cell(155, 7, 'SECRETARIA DE ESTADO DE EDUCAÇÃO', 0, 1, 'L', 0);
  PDF::Cell(45, 7, '', 0, 0, 'C', 0);
  PDF::Cell(155, 7, 'CENTRO DE ENSINO FUNDAMENTAL 507 DE SAMAMBAIA', 0, 1, 'L', 0);
  PDF::ln(3);

  //1º Linha
  PDF::SetFont('times','B',10);

  PDF::Cell(30, 5, 'Estudante', 1, 0, 'L', 0);
  PDF::SetFont('times','',10);
  PDF::Cell(116, 5, $aluno->nome, 1, 0, 'L', 0);
  PDF::SetFont('times','B',10);
  PDF::Cell(15, 5, 'Turma', 1, 0, 'L', 0);
  PDF::SetFont('times','',10);
  PDF::Cell(35, 5, $aluno->turma->turma, 1, 1, 'L', 0);
  PDF::SetFont('times','B',10);


  //2ª Linha - Se existi professor e Equipe
  PDF::SetFont('times','B',10);
  PDF::Cell(35, 5, 'Membro da Equipe', 1, 0, 'L', 0);
  if($ocorrencia->professor_id != NULL){
  	PDF::SetFont('times','',10);
  	PDF::Cell(70, 5, $ocorrencia->equipe->funcao." - ".$ocorrencia->equipe->user->name, 1, 0, 'L', 0);
  	PDF::SetFont('times','B',10);
  	PDF::Cell(25, 5, $ocorrencia->professor->sexo, 1, 0, 'L', 0);
  	PDF::SetFont('times','',10);
  	PDF::Cell(66, 5, $ocorrencia->professor->professor, 1, 1, 'L', 0);
  }else{
  	PDF::SetFont('times','',10);
  	PDF::Cell(161, 5, $ocorrencia->equipe->funcao." - ".$ocorrencia->equipe->user->name, 1, 1, 'L', 0);
  }

	//3º Linha
  PDF::SetFont('times','B',10);

  PDF::Cell(30, 5, 'Responsável', 1, 0, 'L', 0);
  PDF::SetFont('times','',10);
  PDF::Cell(96, 5, $aluno->mae, 1, 0, 'L', 0);
  PDF::SetFont('times','B',10);
  PDF::Cell(15, 5, 'Telefone', 1, 0, 'L', 0);
  PDF::SetFont('times','',10);
  PDF::Cell(55, 5, str_replace("#", ", ",$aluno->telefone), 1, 1, 'L', 0);
  PDF::SetFont('times','B',10);

  PDF::ln();
  PDF::SetFont('helvetica','B',12);
  PDF::Cell(198, 7, $ocorrencia->tipo, 0, 1, 'C', 0);
  PDF::SetFont('helvetica','',12);
  PDF::ln();
	$texto = "                  Aos ".$dia." dias do mês de ".$mes." do ano de ".$ano.", ".$aluno->nome." infringiu as normas do Centro de Ensino Fundamental 507 de Samambaia, como citado na ocorrência abaixo:";
	PDF::MultiCell(200, 5, $texto, 0, 'L');
	PDF::ln(3);
	PDF::SetFont('helvetica','B',12);
	$fato = "                  ".$ocorrencia->descricao;
	PDF::MultiCell(200, 5, $fato, 0, 'L');
	PDF::ln();
	$texto = "                  $aluno->nome foi notificado pelo ".$ocorrencia->equipe->funcao.' '.$ocorrencia->equipe->user->name.'.';
	PDF::SetFont('helvetica','',12);
	PDF::MultiCell(200, 5, $texto, 0, 'L');
	// if($ocorrencia->restricao == 'Assinatura do Responsável'){
	$texto = '                  Requeremos assim a assinatura do responsável neste documento demonstrando ciência do fato ocorrido.';
	// }elseif ($ocorrencia->restricao == 'Presença do Responsável'){
	// 	$texto = '                  Requeremos assim a presença do responsável.';
	// }else{ $texto = ''; }
	PDF::MultiCell(200, 5, $texto, 0, 'L');
	PDF::ln(3);
	PDF::MultiCell(200, 5, 'Brasília - DF, '.$dia.' de '.$mes.' de '.$ano , 0, 'C');
	PDF::ln(3);
	PDF::Cell(50,5, '', 0, 0, 'L', 0);
	PDF::Cell(100,5, '', 'B', 0, 'L', 0);
	PDF::Cell(50,5, '', 0, 1, 'L', 0);
	PDF::Cell(50,5, '', 0, 0, 'L', 0);
	PDF::Cell(100,5, 'Assinatura do Responsável', '', 0, 'C', 0);
	PDF::Cell(50,5, '', 0, 1, 'L', 0);
	PDF::ln(10);

	// Segunda Via
	if (PDF::getY() < 134) {
		PDF::SetLineStyle(array('dash' => 4,));
		PDF::Cell(195,5, '', 'B', 1, 'L', 0);
		PDF::ln(10);
	}else{
		PDF::AddPage('P','A4');
	}
	PDF::SetLineStyle(array('dash' => 0,));
	PDF::SetFont('helvetica','B',12);
	$y = PDF::getY() - 2;

	PDF::Image(asset('/img/logo.jpg'), 8, $y, 42, 17);

	//PDF::text( 49, 6, 'SECRETARIA DE ESTADO DE EDUCAÇÃO');
	PDF::Cell(45, 7, '', 0, 0, 'C', 0);
	PDF::Cell(155, 7, 'SECRETARIA DE ESTADO DE EDUCAÇÃO', 0, 1, 'L', 0);
	PDF::Cell(45, 7, '', 0, 0, 'C', 0);
	PDF::Cell(155, 7, 'CENTRO DE ENSINO FUNDAMENTAL 507 DE SAMAMBAIA', 0, 1, 'L', 0);
	PDF::ln(3);

	//1º Linha
  PDF::SetFont('times','B',10);

  PDF::Cell(30, 5, 'Estudante', 1, 0, 'L', 0);
  PDF::SetFont('times','',10);
  PDF::Cell(116, 5, $aluno->nome, 1, 0, 'L', 0);
  PDF::SetFont('times','B',10);
  PDF::Cell(15, 5, 'Turma', 1, 0, 'L', 0);
  PDF::SetFont('times','',10);
  PDF::Cell(35, 5, $aluno->turma->turma, 1, 1, 'L', 0);
  PDF::SetFont('times','B',10);

	//2ª Linha - Se existi professor e Equipe
  PDF::SetFont('times','B',10);
  PDF::Cell(35, 5, 'Membro da Equipe', 1, 0, 'L', 0);
  if($ocorrencia->professor_id != NULL){
  	PDF::SetFont('times','',10);
  	PDF::Cell(70, 5, $ocorrencia->equipe->funcao." - ".$ocorrencia->equipe->user->name, 1, 0, 'L', 0);
  	PDF::SetFont('times','B',10);
  	PDF::Cell(25, 5, $ocorrencia->professor->sexo, 1, 0, 'L', 0);
  	PDF::SetFont('times','',10);
  	PDF::Cell(66, 5, $ocorrencia->professor->professor, 1, 1, 'L', 0);
  }else{
  	PDF::SetFont('times','',10);
  	PDF::Cell(161, 5, $ocorrencia->equipe->funcao." - ".$ocorrencia->equipe->user->name, 1, 1, 'L', 0);
  }

	//3º Linha
  PDF::SetFont('times','B',10);

  PDF::Cell(30, 5, 'Responsável', 1, 0, 'L', 0);
  PDF::SetFont('times','',10);
  PDF::Cell(96, 5, $aluno->mae, 1, 0, 'L', 0);
  PDF::SetFont('times','B',10);
  PDF::Cell(15, 5, 'Telefone', 1, 0, 'L', 0);
  PDF::SetFont('times','',10);
  PDF::Cell(55, 5, str_replace("#", ", ",$aluno->telefone), 1, 1, 'L', 0);
  PDF::SetFont('times','B',10);

	PDF::ln();
  PDF::SetFont('helvetica','B',12);
  PDF::Cell(198, 7, $ocorrencia->tipo, 0, 1, 'C', 0);
  PDF::SetFont('helvetica','',12);
  PDF::ln();
	$texto = "                  Aos ".$dia." dias do mês de ".$mes." do ano de ".$ano.", ".$aluno->nome." infringiu as normas do Centro de Ensino Fundamental 507 de Samambaia, como citado na ocorrência abaixo:";
	PDF::MultiCell(200, 5, $texto, 0, 'L');
	PDF::ln(3);
	PDF::SetFont('helvetica','B',12);

	PDF::MultiCell(200, 5, $fato, 0, 'L');
	PDF::ln();
	$texto = "                  $aluno->nome foi notificado pelo ".$ocorrencia->equipe->funcao.' '.$ocorrencia->equipe->user->name.'.';
	PDF::SetFont('helvetica','',12);
	PDF::MultiCell(200, 5, $texto, 0, 'L');
	// if($ocorrencia->restricao == 'Assinatura do Responsável'){
	$texto = '                  Requeremos assim a assinatura do responsável neste documento demonstrando ciência do fato ocorrido.';
	// }elseif ($ocorrencia->restricao == 'Presença do Responsável'){
	// 	$texto = '                  Requeremos assim a presença do responsável.';
	// }else{ $texto = ''; }
	PDF::MultiCell(200, 5, $texto, 0, 'L');
	PDF::ln(3);
	PDF::MultiCell(200, 5, 'Brasília - DF, '.$dia.' de '.$mes.' de '.$ano , 0, 'C');
	PDF::ln(3);
	PDF::Cell(50,5, '', 0, 0, 'L', 0);
	PDF::Cell(100,5, '', 'B', 0, 'L', 0);
	PDF::Cell(50,5, '', 0, 1, 'L', 0);
	PDF::Cell(50,5, '', 0, 0, 'L', 0);
	PDF::Cell(100,5, 'Assinatura do Responsável', '', 0, 'C', 0);
	PDF::Cell(50,5, '', 0, 1, 'L', 0);



} //Fim Foreach


//

// // Segunda Via
// PDF::SetLineStyle(array('dash' => 0,));
// PDF::SetFont('helvetica','B',12);
// $y = PDF::getY() - 2;
// PDF::Image(Yii::app()->request->baseUrl.'/images/logo.jpg', 8, $y , 42, 17);
//
// //PDF::text( 49, 6, 'SECRETARIA DE ESTADO DE EDUCAÇÃO');
// PDF::Cell(45, 7, '', 0, 0, 'C', 0);
// PDF::Cell(155, 7, 'SECRETARIA DE ESTADO DE EDUCAÇÃO', 0, 1, 'L', 0);
// PDF::Cell(45, 7, '', 0, 0, 'C', 0);
// PDF::Cell(155, 7, 'CENTRO DE ENSINO FUNDAMENTAL 507 DE SAMAMBAIA', 0, 1, 'L', 0);
// PDF::ln(3);
//
// //1º Linha
// PDF::SetFont('times','B',10);
// if($ocorrencia->aluno['sexo'] == 'Masculino'){
// 	PDF::Cell(30, 5, 'Nome do Aluno', 1, 0, 'L', 0);
// }else{
// 	PDF::Cell(30, 5, 'Nome da Aluna', 1, 0, 'L', 0);
// }
// PDF::SetFont('times','',10);
// PDF::Cell(73, 5, $ocorrencia->aluno['nome_aluno'], 1, 0, 'L', 0);
// PDF::SetFont('times','B',10);
// PDF::Cell(15, 5, 'Turma', 1, 0, 'L', 0);
// PDF::SetFont('times','',10);
// PDF::Cell(35, 5, $ocorrencia->aluno->turma['rotulo'], 1, 0, 'L', 0);
// PDF::SetFont('times','B',10);
// PDF::Cell(22, 5, 'Registro n.º', 1, 0, 'L', 0);
// PDF::SetFont('times','',10);
// PDF::Cell(21, 5, str_pad($ocorrencia->id, 5, 0, STR_PAD_LEFT), 1, 1, 'R', 0);
//
// //2ª Linha
// PDF::SetFont('times','B',10);
// PDF::Cell(35, 5, 'Data do Registro', 1, 0, 'L', 0);
// PDF::SetFont('times','',10);
// PDF::Cell(35, 5, dn($ocorrencia->data_registro), 1, 0, 'C', 0);
// PDF::SetFont('times','B',10);
// PDF::Cell(25, 5, 'Restrição', 1, 0, 'L', 0);
// PDF::SetFont('times','',10);
// PDF::Cell(101, 5, $ocorrencia->restricao, 1, 1, 'C', 0);
//
// //3ª Linha - Se existi professor e Equipe
// PDF::SetFont('times','B',10);
// PDF::Cell(35, 5, 'Membro da Equipe', 1, 0, 'L', 0);
// if($ocorrencia->professor_id != NULL){
// 	PDF::SetFont('times','',10);
// 	PDF::Cell(70, 5, $ocorrencia->equipe['cargo']." ".$ocorrencia->equipe['nome'], 1, 0, 'L', 0);
// 	PDF::SetFont('times','B',10);
// 	if($ocorrencia->professor['sexo'] == 'Femenino'){
// 		PDF::Cell(25, 5, 'Professora', 1, 0, 'L', 0);
// 	}else{ PDF::Cell(25, 5, 'Professor', 1, 0, 'L', 0); }
// 	PDF::SetFont('times','',10);
// 	PDF::Cell(66, 5, $ocorrencia->professor['nome'], 1, 1, 'L', 0);
// }else{
// 	PDF::SetFont('times','',10);
// 	PDF::Cell(161, 5, $ocorrencia->equipe['cargo']." ".$ocorrencia->equipe['nome'], 1, 1, 'L', 0);
// }
//
// PDF::ln();
// PDF::SetFont('helvetica','B',12);
// PDF::Cell(198, 7, $ocorrencia->tipo_registro, 0, 1, 'C', 0);
// PDF::SetFont('helvetica','',12);
// PDF::ln();
// if($ocorrencia->aluno['sexo'] == 'Masculino'){
// $aluno = 'o aluno';}else{
// $aluno = 'a aluna';}
// $texto = "                  Aos ".$dia." dias do mês de ".$mes." do ano de ".$ano.", o aluno ".$ocorrencia->aluno['nome_aluno']." infringiu as normas do Centro de Ensino Fundamental 507 de Samambaia, com citado na ocorrência abaixo:";
// PDF::MultiCell(200, 5, $texto, 0, 'L');
// PDF::ln(3);
// PDF::SetFont('helvetica','B',12);
// $texto = "                  ".$ocorrencia->descricao;
// PDF::MultiCell(200, 5, $texto, 0, 'L');
// PDF::ln();
// $texto = "                  O aluno foi notificado pelo ".$ocorrencia->equipe['cargo'].' '.$ocorrencia->equipe['nome'].'.';
// PDF::SetFont('helvetica','',12);
// PDF::MultiCell(200, 5, $texto, 0, 'L');
// if($ocorrencia->restricao == 'Assinatura do Responsável'){
// 	$texto = '                  Requeremos assim a assinatura do responsável neste documento demonstrando ciência do fato ocorrido.';
// }elseif ($ocorrencia->restricao == 'Presença do Responsável'){
// 	$texto = '                  Requeremos assim a presença do responsável.';
// }else{ $texto = ''; }
// PDF::MultiCell(200, 5, $texto, 0, 'L');
// PDF::ln(3);
// PDF::MultiCell(200, 5, 'Brasília - DF, '.$dia.' de '.$mes.' de '.$ano , 0, 'C');
// PDF::ln(3);
// PDF::Cell(50,5, '', 0, 0, 'L', 0);
// PDF::Cell(100,5, '', 'B', 0, 'L', 0);
// PDF::Cell(50,5, '', 0, 1, 'L', 0);
// PDF::Cell(50,5, '', 0, 0, 'L', 0);
// PDF::Cell(100,5, 'Assinatura do Responsável', '', 0, 'C', 0);
// PDF::Cell(50,5, '', 0, 1, 'L', 0);

// Fim da Segunda Via


PDF::Output();
?>
