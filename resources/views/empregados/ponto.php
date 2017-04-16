<?php
// Folha de Ponto Laravel
// 10/04/2017 10:11
//

//\\ Função Data
function Qdia($mes,$dia){
	//$d = $mes + $dia;
	//$di = $d % 7;
	$ano = date('Y');
	$di = date('w', mktime(0,0,0, $mes,$dia,$ano));
	if(($di == 0) or ($di == 6)){
		return 'DF';
	}else{
		return 'D';
	}
}
//\\ Coletando dados sobre o mês
// if(isset($mos)){
// 	$mm = $mos;
// }else {$mm = date('m'); }
// $mes = date('z', mktime(0,0,0, $mm, 1, date('Y')))+1;
// $mesAgenda = $mm;
// if($mm == 1){ $m[1]= 'JANEIRO';}
// if($mm == 2){ $m[1]= 'FEVEREIRO';}
// if($mm == 3){ $m[1]= 'MARÇO';}
// if($mm == 4){ $m[1]= 'ABRIL';}
// if($mm == 5){ $m[1]= 'MAIO';}
// if($mm == 6){ $m[1]= 'JUNHO';}
// if($mm == 7){ $m[1]= 'JULHO';}
// if($mm == 8){ $m[1]= 'AGOSTO';}
// if($mm == 9){ $m[1]= 'SETEMBRO';}
// if($mm == 10){ $m[1]= 'OUTUBRO';}
// if($mm == 11){ $m[1]= 'NOVEMBRO';}
// if($mm == 12){ $m[1]= 'DEZEMBRO';}

PDF::SetAutoPageBreak(false, 2);
PDF::setPrintHeader(false);
PDF::setPrintFooter(false);
// Começando o PDF
PDF::AddPage('P','A4');
PDF::SetFont('Times','B',18);
PDF::Image(asset('/img/gdf4.jpg'), 13, 7, 20, 17);
PDF::SetLineWidth(0.4);
PDF::Rect(10 , 3, 190, 23, 'D'); // Topo
PDF::Rect(10 , 26, 190, 8, 'D'); // Topo
PDF::Rect(10 , 38, 190, 14, 'D'); // DADOS
PDF::Rect(10 , 52, 190, 19, 'D'); // DADOS
PDF::Rect(10 , 74, 190, 6, 'D'); // Dias
PDF::Rect(20 , 74, 90, 6, 'D'); // Dias
PDF::Rect(10 , 80, 190, 5, 'D'); // Dias
PDF::Rect(20 , 80, 75, 5, 'D'); // Dias
PDF::Rect(80 , 80, 30, 5, 'D'); // Dias
PDF::Rect(170 , 80, 15, 5, 'D'); // Dias
PDF::Rect(10 , 273, 190, 19, 'D'); // Observação
// Dias do mês
PDF::SetFont('helvetica','B',11);
PDF::SetFillColor(200,200,200);

$a = 85;
$b = 85;
$ano = $data->year;
//$m[2] = date('t', mktime(0,0,0, $mesAgenda, 01, $ano));
for ($i = 1; $i <= $data->daysInMonth; $i++) {
	$DF = Qdia($data->month, $i);
	PDF::Rect(10 , $a, 190, 6, $DF); // Dias
	PDF::Rect(20 , $a, 75, 6, 'D'); // Dias
	PDF::Rect(80 , $a, 30, 6, 'D'); // Dias
	PDF::Rect(170 , $a, 15, 6, 'D'); // Dias
	if($i < 10){
		PDF::text(11.5, $b, '0'.$i.'');
	}else{
		PDF::text(11.5, $b, $i);
	}
	$a = $a + 6;
	$b = $b + 6;
}

//\\\ Fim dos dias do mês
PDF::SetFont('Times','B',18);
PDF::text( 42, 5.7, 'SECRETARIA DE ESTADO DE EDUCAÇÃO');
PDF::SetFont('Times','',10);
PDF::text( 86, 12.5, 'CGC: 00.394.676/0001-07');
PDF::SetFont('helvetica','B',13);
PDF::text( 25, 27.5, 'FOLHA DE FREQÜÊNCIA');
PDF::SetFont('helvetica','B',11);
// if($m[1] == "MARCO"){$m[1] = 'MARÇO';}
PDF::text( 114, 28.3, 'REFERÊNCIA: '.ucfirst( $data->formatLocalized('%B')).'      /'.$data->year.'');
PDF::SetFont('Courier','BI',11);
PDF::text( 10, 39.3, 'UA: 010 DIR.REG.ENSINO - SAMAMBAIA');
PDF::text( 10, 46.4, 'Exercício: CENTRO DE ENSINO FUNDAMENTAL 507                   090003000633');
PDF::SetFont('helvetica','B',11);
PDF::text( 10, 53.3, 'Matrícula: '.$empregado->matricula.'             Nome: '.$empregado->name.'');
PDF::text( 10, 59.3, 'Cargo/Especialidade: '.$empregado->funcao.'     C.H.:0'.$empregado->ch.'');
PDF::text( 10, 65.3, 'Função:');
PDF::text( 20, 75, 'Turno:');
PDF::text( 111, 75, 'Turno:');
PDF::SetFont('helvetica','',10);
PDF::text( 11, 80.5, 'Dia');
PDF::text( 30, 80.5, 'Assinatura do Servidor');
PDF::text( 80, 80.5, 'Entrada');
PDF::text( 96.5, 80.5, 'Saída');
PDF::text( 124, 80.5, 'Assinatura do Servidor');
PDF::text( 170.5, 80.5, 'Entrada');
PDF::text( 186.5, 80.5, 'Saída');
PDF::SetFont('helvetica','B',10);
PDF::text( 11, 273.5, 'Observações:');
PDF::AddPage();
PDF::Rect(10 , 8, 190, 6, 'F'); // Topo
PDF::Rect(10 , 8, 190, 12, 'D'); // Topo
PDF::Rect(45 , 8, 20, 12, 'D'); // Topo
PDF::Rect(65 , 8, 20, 12, 'D'); // Topo
PDF::Rect(10 , 22, 190, 6, 'F'); // Resumo da Freqüência
PDF::Rect(10 , 22, 190, 90, 'D'); // Resumo da Freqüência
PDF::Rect(10 , 112, 190, 65, 'D'); // Resumo da Freqüência
PDF::Rect(10 , 177, 190, 28, 'D'); // Assinatura
PDF::Rect(74 , 177, 64, 28, 'D'); // Assinatura

 $y = 39;
for ($i = 1; $i < 7; $i++){
	PDF::SetFillColor(255,255,255);
	PDF::Rect(16.5 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(16.8 , ($y-1), 7.3, 2, 'F'); // Quadrados
	PDF::Rect(34 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(42 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(50 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(58 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(66 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(34.2 , ($y-1), 39.7, 2, 'F'); // Quadrados
	PDF::Rect(81 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(81.4 , ($y-1), 7.2, 2, 'F'); // Quadrados
	PDF::Rect(95.5 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(103.5 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(95.9 , ($y-1), 15.2, 2, 'F'); // Quadrados
	PDF::Rect(118 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(126 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(134 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(142 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(150 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(118.4 , ($y-1), 39.2, 2, 'F'); // Quadrados
	PDF::Rect(160 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(168 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(160.4 , ($y-1), 15.2, 2, 'F'); // Quadrados
	PDF::Rect(180 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(188 , $y, 8, 8, 'D'); // Quadrados
	PDF::Rect(180.2 , ($y-1), 15.4, 2, 'F'); // Quadrados
	$y = $y + 12;
}
PDF::SetFillColor(200,200,200);
PDF::Rect(16 , 134, 178, 5, 'DF'); // Tabela de Códigos
PDF::Rect(16 , 134, 178, 30, 'D'); // Tabela de Códigos
PDF::Rect(30 , 134, 75, 30, 'D'); // Tabela de Códigos
PDF::Rect(105 , 134, 14, 30, 'D'); // Tabela de Códigos
PDF::Line(15, 198, 68, 198);
PDF::Line(80, 198, 133, 198);
PDF::Line(143, 198, 196, 198);
PDF::Rect(10 , 208, 190, 75, 'D'); // Mesengem

PDF::SetFont('helvetica','B',11);
PDF::text( 11, 9, 'Matrícula');
PDF::text( 45, 9, 'UA');
PDF::text( 65, 9, 'C.H.');
PDF::text( 85, 9, 'Local de Exercício');
PDF::SetFont('Courier','BI',11);
PDF::text( 11, 14.5, ''.$empregado->matricula.'');
PDF::text( 45, 14.5, '010');
PDF::text( 65, 14.5, ''.$empregado->ch.'');
PDF::text( 85, 14.5, 'CENTRO DE ENSINO FUNDAMENTAL 507');
PDF::SetFont('helvetica','B',11);
PDF::text( 11, 22.5, 'Resumo da Freqüência');
PDF::SetFont('helvetica','',11);
PDF::text( 15, 30, 'Oper.');
PDF::text( 33, 30, 'Código');
PDF::text( 79, 30, 'Carga');
PDF::text( 94, 30, 'N.º meses');
PDF::text( 119, 30, 'N.º horas/dias');
PDF::text( 159, 30, 'Dia início');
PDF::text( 179, 30, 'Dia fim');
PDF::SetFont('helvetica','B',11);
PDF::text( 11, 113, 'LEGENDA:');
PDF::text( 15, 121, '* Oper.(operação):     I - Inclusão       A - Alteração       E - Exclusão');
PDF::text( 15, 128, '* Tabela de Códigos:');
PDF::SetFont('helvetica','B',10);
PDF::text( 16, 134.5, 'Código    Descrição                                                         Código     Descrição');
PDF::SetFont('helvetica','',9);
PDF::text( 17, 139.5, '12646');
PDF::text( 17, 143.5, '12658');
PDF::text( 17, 147.5, '12671');
PDF::text( 17, 151.5, '12683');
PDF::text( 17, 155.5, '12701');
PDF::text( 17, 159.5, '18077');
PDF::text( 31, 139.5, 'Gratificação por exercício zona rural - CMPDF');
PDF::text( 31, 143.5, 'G.A.T.E. - CMPDF');
PDF::text( 31, 147.5, 'G.A.T.E. - CAE');
PDF::text( 31, 151.5, 'Gratificação por exercício zona rural - CAE');
PDF::text( 31, 155.5, 'Gratificação de regência de classe - GRC');
PDF::text( 31, 159.5, 'Adicional noturno');
PDF::text( 106, 139.5, '18569');
PDF::text( 106, 143.5, '40010');
PDF::text( 106, 147.5, '40034');
PDF::text( 106, 151.5, '40046');
PDF::text( 106, 155.5, '40083');
PDF::text( 120, 139.5, 'Gratificação de Alfabetização - GAL');
PDF::text( 120, 143.5, 'Falta');
PDF::text( 120, 147.5, 'Falta paralisação');
PDF::text( 120, 151.5, 'Horas não trabalhadas');
PDF::text( 120, 155.5, 'Abono Lei nº 1.303/96');
PDF::SetFont('helvetica','B',9);
PDF::text( 15, 165.5, '* Carga:   1- Garga |     2- Carga ||      3- Ambas as cargas');
PDF::text( 15, 170.5, '* Nº de meses: Previsão do período a ser incluído');
PDF::text( 10, 178.5, 'Responsável pelas informações');
PDF::text( 74, 178.5, 'Assinatura da Chefia Imediata');
PDF::text( 139, 178.5, 'Assinatura do Superior Hieráquico');
PDF::SetFont('helvetica','',8);
PDF::text( 26, 199, 'Assinatura / Matrícula');
PDF::text( 91, 199, 'Assinatura / carimbo');
PDF::text( 154, 199, 'Assinatura / carimbo');
PDF::SetFont('helvetica','B',11);
PDF::text( 12, 210, 'MENSAGEM');

PDF::Output();
?>
