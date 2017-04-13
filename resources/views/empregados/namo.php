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
PDF::Cell(190, 4, 'SECRETARIA DE ESTADO DE GESTÃO ADMINISTRATIVA E DESBUROCRATIZAÇÃO', 0, 1, 'C',0 );
PDF::Cell(190, 4, 'SUBSECRETARIA DE SEGURANÇA E SAÚDE NO TRABALHO', 0, 1, 'C',0 );
PDF::Cell(190, 4, 'COORDENAÇÃO DE PERÍCIAS MÉDICAS', 0, 1, 'C',0 );
PDF::ln();
PDF::SetFont('times','B',10);
PDF::Cell(190, 4, 'GUIA DE INSPEÇÃO MÉDICA', 1, 1, 'C',1 );
PDF::Cell(190, 4, 'SOLICITAÇÃO DE HOMOLOGAÇÃO DE ATESTADO MÉDICO', 1, 1, 'C',1 );
//Linha 1
PDF::Cell(8, 4, '', 'LR', 0, 'C',0 );
PDF::Cell(92, 4, 'Nome do Servidor:', 'LR', 0, 'L',0 );
PDF::Cell(30, 4, 'CPF:', 'LR', 0, 'L',0 );
PDF::Cell(35, 4, 'Data de Nascimento:', 'LR', 0, 'L',0 );
PDF::Cell(25, 4, 'Matrícula:', 'LR', 1, 'L',0 );
//Linha 2 Vazia
PDF::SetFont('times','',10);
PDF::Cell(8, 6, 'M', 'LR', 0, 'C',0 );
PDF::Cell(92, 6, $empregado->name, 'LBR', 0, 'L',0 );
PDF::Cell(30, 6, $empregado->cpf, 'LBR', 0, 'L',0 );
PDF::Cell(35, 6, '_____/_____/______', 'LBR', 0, 'L',0 );
PDF::Cell(25, 6, $empregado->matricula, 'LBR', 1, 'L',0 );
//Linha3
PDF::SetFont('times','B',10);
PDF::Cell(8, 5, 'Ó', 'LR', 0, 'C',0 );
PDF::Cell(122, 5, '(  ) Servidor Efetivo', 'LR', 0, 'L', 0);
PDF::Cell(40, 5, 'Sec./órgão de Origem', 'LR', 0, 'L', 0);
PDF::Cell(20, 5, 'Setor', 'LR', 1, 'L', 0);
//Linha4
PDF::SetFont('times','B',10);
PDF::Cell(8, 5, 'D', 'LR', 0, 'C',0 );
PDF::Cell(122, 5, '(  ) Cedido para:____________________', 'LR', 0, 'L', 0);
PDF::Cell(40, 5, '', 'LR', 0, 'L', 0);
PDF::Cell(20, 5, '', 'LR', 1, 'L', 0);
//Linha5
PDF::SetFont('times','B',10);
PDF::Cell(8, 5, 'U', 'LR', 0, 'C',0 );
PDF::Cell(122, 5, '(  ) Empregado público - Celetista (C.L.T.)', 'LR', 0, 'L', 0);
PDF::Cell(40, 5, '', 'LR', 0, 'L', 0);
PDF::Cell(20, 5, '', 'LR', 1, 'L', 0);
//Linha6
PDF::SetFont('times','B',10);
PDF::Cell(8, 5, 'L', 'LR', 0, 'C',0 );
PDF::Cell(122, 5, '(  ) Servidor comissionado de livre exoneração ou Contrato temporário', 'LBR', 0, 'L', 0);
PDF::Cell(40, 5, '', 'LBR', 0, 'L', 0);
PDF::Cell(20, 5, '', 'LBR', 1, 'L', 0);
//Linha7
PDF::SetFont('times','B',10);
PDF::Cell(8, 5, 'O', 'LR', 0, 'C',0 );
PDF::Cell(30, 5, 'Telefone do Setor', 'LR', 0, 'L', 0);
PDF::Cell(40, 5, 'Telefone residencial / cel.', 'LR', 0, 'L', 0);
PDF::Cell(47, 5, 'Data da Solicitação da Perícia', 'LR', 0, 'L', 0);
PDF::Cell(65, 5, 'Ass. e carimbo do chefe', 'LR', 1, 'L', 0);
//Linha8
PDF::SetFont('times','',10);
PDF::Cell(8, 4, '', 'LR', 0, 'C',0 );
PDF::Cell(30, 4, '3901-7739', 'LR', 0, 'L', 0);
PDF::Cell(40, 4, '', 'LR', 0, 'L', 0);
PDF::Cell(47, 4, date('d/m/Y'), 'LR', 0, 'L', 0);
PDF::Cell(65, 4, '', 'LR', 1, 'L', 0);
//Linha9
PDF::SetFont('times','B',10);
PDF::Cell(8, 4, 'I', 'LR', 0, 'C',0 );
PDF::Cell(30, 4, '', 'LBR', 0, 'L', 0);
PDF::Cell(40, 4, '', 'LBR', 0, 'L', 0);
PDF::Cell(47, 4, '', 'LBR', 0, 'L', 0);
PDF::Cell(65, 4, '', 'LBR', 1, 'L', 0);
//Linha10
PDF::Cell(8, 4, '', 'LR', 0, 'C',0 );
PDF::Cell(182, 4, 'Endereço residencial', 'LR', 1, 'L',0 );
//Linha11
PDF::Cell(8, 5, '', 'LBR', 0, 'C',0 );
PDF::SetFont('times','',10);
PDF::Cell(182, 5, $empregado->endereco, 'LBR', 1, 'L',0 );
// Fim do Módulo I

PDF::Cell(190, 3, '', 1,1,'L',1);
PDF::SetFont('times','B',10);

PDF::Cell(190, 5, 'Servidor alega que a queixa atual é decorrente de acidente de trabalho ou acidente de trajeto? (   )sim  (   ) não', 1,1,'L',0);

PDF::Cell(8, 5, '', 'LR', 0, 'C', 0);
PDF::Cell(162, 5, 'Avalição Médica (use o verso se necessário)', 'LR', 0, 'L', 0);
PDF::Cell(20, 5, 'CID-10', 'LR', 1, 'L', 0);

PDF::Cell(8, 50, '', 'LR', 0, 'C', 0);
PDF::Cell(162, 50, '', 'LBR', 0, 'L', 0);
PDF::Cell(20, 50, '', 'LBR', 1, 'L', 0);

PDF::Cell(8, 5, '', 'LR', 0, 'C', 0);
PDF::Cell(91, 5, '(   ) Atestado homologado. Período da licença:', 'LR', 0, 'L', 0);
PDF::Cell(91, 5, '(   ) Atestado não homologado ou pendente (cont. verso)', 'LR', 1, 'L', 0);

PDF::Cell(8, 9, '', 'LR', 0, 'C', 0);
PDF::Cell(91, 9, '____/____/______  à  ____/____/______', 'LBR', 0, 'C', 0);
PDF::Cell(91, 9, '', 'LBR', 1, 'L', 0);

PDF::SetFont('times','B',11);
PDF::setFillColor(230,230,230);
PDF::Cell(8, 6, '', 'LR', 0, 'C', 0);
PDF::Cell(62, 6, 'Tipo de Vínculo', 'LBR', 0, 'C', 1);
PDF::Cell(100, 6, 'Descrição - Licença:', 'LBR', 0, 'C', 1);
PDF::Cell(20, 6, 'SGRH', 'LBR', 1, 'C', 1);
PDF::SetFont('times','',10);

PDF::Cell(8, 4, 'M', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(100, 4, '(   ) licença para tratamento de saúde', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '306', 'LBR', 1, 'C', 0);
//Linha1
PDF::Cell(8, 4, 'Ó', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(100, 4, '(   ) prorrogação de licença para aposentadoria', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '202', 'LBR', 1, 'C', 0);
//Linha2
PDF::Cell(8, 4, 'D', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(100, 4, '(   ) licença por acidente de trabalho / profissional', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '204', 'LBR', 1, 'C', 0);
//Linha3
PDF::Cell(8, 4, 'U', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, '(   ) Servidor efetivo', 'LR', 0, 'L', 0);
PDF::Cell(100, 4, '(   ) por motivo de doença em pessoa da família c/ remuneração', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '205', 'LBR', 1, 'C', 0);
//Linha4
PDF::Cell(8, 4, 'L', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(100, 4, '(   ) por motivo de doença em pessoa da família s/ remuneração', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '206', 'LBR', 1, 'C', 0);
//Linha5
PDF::Cell(8, 4, 'O', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(100, 4, '(   ) licença maternidade', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '207', 'LBR', 1, 'C', 0);
//Linha6
PDF::Cell(8, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(100, 4, '(   ) licença maternidade (aborto)', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '275', 'LBR', 1, 'C', 0);
//Linha7
PDF::Cell(8, 4, 'II', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, '', 'LBR', 0, 'C', 0);
PDF::Cell(100, 4, '(   ) licença maternidade (natimorto)', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '274', 'LBR', 1, 'C', 0);
//Fim módulo II
PDF::Cell(8, 3, '', 'LR', 0, 'C', 0);
PDF::Cell(182, 3, '', '1', 1, 'C', 1);

PDF::Cell(8, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(100, 4, '(   ) até 15 dias', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '250', 'LBR', 1, 'C', 0);

PDF::Cell(8, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(100, 4, '(   ) com encaminhamento ao INSS', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '251', 'LBR', 1, 'C', 0);

PDF::Cell(8, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, '(   ) Servidor comissionado de', 'LR', 0, 'L', 0);
PDF::Cell(100, 4, '(   ) por acidente de trabalho / profissional 15 dias', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '252', 'LBR', 1, 'C', 0);

PDF::Cell(8, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, 'livre exoneração ou Contrato', 'LR', 0, 'L', 0);
PDF::Cell(100, 4, '(   ) por acidente de trabalho / profissional e encaminhado ao INSS', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '253', 'LBR', 1, 'C', 0);

PDF::Cell(8, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, 'temporário ou Empregado', 'LR', 0, 'L', 0);
PDF::Cell(100, 4, '(   ) licença maternidade', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '209', 'LBR', 1, 'C', 0);

PDF::Cell(8, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, 'público', 'LR', 0, 'L', 0);
PDF::Cell(100, 4, '(   ) licença maternidade (aborto)', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '277', 'LBR', 1, 'C', 0);

PDF::Cell(8, 4, '', 'LR', 0, 'C', 0);
PDF::Cell(62, 4, '', 'LBR', 0, 'C', 0);
PDF::Cell(100, 4, '(   ) licença maternidade (natimorto)', 'LBR', 0, 'L', 0);
PDF::Cell(20, 4, '276', 'LBR', 1, 'C', 0);

PDF::Cell(8, 5, '', 'LR', 0, 'C', 0);
PDF::Cell(91, 5, 'Data da Perícia:', 'LR', 0, 'C', 0);
PDF::Cell(91, 5, 'Assinatura e carimbo do médico', 'LR', 1, 'C', 0);


PDF::Cell(8, 8, '', 'LBR', 0, 'C', 0);
PDF::Cell(91, 8, '____/____/______', 'LBR', 0, 'C', 0);
PDF::Cell(91, 8, '__________________________________________', 'LBR', 1, 'C', 0);

PDF::ln();

PDF::Cell(190, 4, 'Coordenação de Perícias Médicas - COPEM/Subsaúde/SEGAD', 0, 1, 'C', 0);
PDF::Cell(190, 4, 'SCS-Setor Comercial Sul, Quadra 9, Lote C, Ed Parque Cidade Corporate,', 0, 1, 'C', 0);
PDF::Cell(190, 4, 'Torre A, 1º Subsolo - Asa Sul - Brasília-DF. CEP 70.308-200.', 0, 1, 'C', 0);
PDF::Cell(190, 4, 'Telefone: 3344-8547', 0, 1, 'C', 0);

PDF::Output();
?>
