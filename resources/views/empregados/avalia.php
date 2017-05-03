<?php
/*
 * Formulário de avaliação do contrato temporátio
 *
 * 04 de maio de 2015
 *
 * Autor: Vicente de Paulo Cartaxo
 */


//$pdf= Yii::app()->pdfFactory->getTCPDF();
PDF::SetAutoPageBreak(false, 2);
PDF::setPrintHeader(false);
PDF::setPrintFooter(false);
//PDF::SetMargins(0, 0, 0);
PDF::SetFooterMargin(0);

// Começando o PDF
PDF::AddPage('P','A4');
PDF::SetFont('helvetica','B',12);

PDF::Image(asset('/img/gdf3.jpg'), 13, 12, 17, 25);
//PDF::Image(asset('/img/gdf4.jpg'), 13, 3, 17, 25);

PDF::SetLineWidth(0.4);

PDF::text( 33, 14, 'Governo do Distrito Federal');

PDF::text( 33, 18, 'Secretaria de Estado de Educação');

PDF::text( 33, 22, 'Diretoria Regional de Ensino de Samambaia');

PDF::SetFont('helvetica','BU',13);

PDF::text( 49, 31, 'Avaliação de Desempenho - Contrato Temporário');

PDF::SetFont('helvetica','B',11);

PDF::Rect(10 , 38, 120, 9, 'D'); // Campo nome

PDF::Rect(130 , 38, 60, 9, 'D'); // Campo Nº do contrato

PDF::Rect(10 , 47, 120, 9, 'D'); // Campo DRE

PDF::Rect(130 , 47, 60, 9, 'D'); // Campo Codigo

PDF::Rect(10 , 56, 120, 9, 'D'); // Campo UE

PDF::Rect(130 , 56, 60, 9, 'D'); // Campo Código

PDF::Rect(10 , 65, 120, 4, 'D'); // Campo Area de Atuação

PDF::Rect(72 , 65, 118, 4, 'D'); // Campo Código

PDF::Rect(10 , 69, 120, 6, 'D'); // Campo Area de Atuação

PDF::Rect(72 , 69, 118, 6, 'D'); // Campo Código

PDF::Rect(10 , 75, 120, 6, 'D'); // Campo Area de Atuação

PDF::Rect(72 , 75, 118, 6, 'D'); // Campo Código

PDF::Rect(10 , 81, 120, 6, 'D'); // Campo Area de Atuação

PDF::Rect(72 , 81, 118, 6, 'D'); // Campo Código

PDF::Rect(10 , 87, 120, 6, 'D'); // Campo Area de Atuação

PDF::Rect(72 , 87, 118, 6, 'D'); // Campo Código

PDF::Rect(10 , 93, 120, 6, 'D'); // Campo Area de Atuação

PDF::Rect(72 , 93, 118, 6, 'D'); // Campo Código

PDF::Rect(11 , 70, 3, 3, 'D'); // Quadrado

PDF::Rect(11 , 76, 3, 3, 'D'); // Quadrado

PDF::Rect(11 , 82, 3, 3, 'DF'); // Quadrado

PDF::Rect(11 , 88, 3, 3, 'D'); // Quadrado

PDF::Rect(11 , 94, 3, 3, 'D'); // Quadrado

PDF::Rect(10 , 99, 120, 10, 'D'); // Campo Periodo Trabalhado

PDF::Rect(130 , 99, 60, 10, 'D'); // Campo Total de Dias

PDF::Rect(10 , 109, 120, 10, 'D'); // Campo Fatores / Pontuação

PDF::Line(10, 109, 130, 119); // Linha Diagonal

PDF::Rect(130 , 109, 12, 4, 'D'); // Campo 7pts

PDF::Rect(142 , 109, 12, 4, 'D'); // Campo 5pts

PDF::Rect(154 , 109, 12, 4, 'D'); // Campo 3pts

PDF::Rect(166 , 109, 12, 4, 'D'); // Campo 1pts

PDF::Rect(178 , 109, 12, 4, 'D'); // Campo 0pts

PDF::Rect(130 , 113, 12, 6, 'D'); // Campo Sempre

PDF::Rect(142 , 113, 12, 6, 'D'); // Campo Quase Sempre

PDF::Rect(154 , 113, 12, 6, 'D'); // Campo As vezes

PDF::Rect(166 , 113, 12, 6, 'D'); // Campo Raramente

PDF::Rect(178 , 113, 12, 6, 'D'); // Campo Nunca

for ($i = 1; $i <= 11; $i++){ // Campos dos pontos

	$n = ($i * 10) + 109;

	PDF::Rect(10 , $n, 120, 10, 'D'); // Campo Fatores 1

	PDF::Rect(130 , $n, 12, 10, 'D'); // Campo 7pts

	PDF::Rect(142 , $n, 12, 10, 'D'); // Campo 5pts

	PDF::Rect(154 , $n, 12, 10, 'D'); // Campo 3pts

	PDF::Rect(166 , $n, 12, 10, 'D'); // Campo 1pts

	PDF::Rect(178 , $n, 12, 10, 'D'); // Campo 0pts

}

PDF::Rect(10 , 229, 120, 10, 'D'); // Campo Total

PDF::Rect(130 , 229, 60, 10, 'D'); // Campo Total

PDF::Rect(10 , 239, 180, 15, 'D'); // Campo Ciente

PDF::Rect(10 , 254, 90, 25, 'D'); // Campo Ciente

PDF::Rect(100 , 254, 90, 25, 'D'); // Campo Ciente

PDF::SetFont('helvetica','', 9);

PDF::Text(10, 38, 'Nome:'); // Campo Nomes

PDF::Text(10, 42, ''.$empregado->name.''); // Campo Nomes

PDF::Text(130, 38, 'Matrícula:'); // Campo Disciplina

PDF::Text(130, 42, $empregado->matricula); // Campo Disciplina

PDF::Text(10, 47, 'Diretoria Regional de Ensino:'); // Campo Cargo

PDF::Text(10, 51, 'SAMAMBAIA '); // Campo Cargo

PDF::Text(130, 47, 'Código:'); // Campo Escola

PDF::Text(130, 51, '090003000'); // Campo Admissão

$end = $empregado->endereco;

PDF::Text(10, 56, 'Unidade de exercício:'); // Campo UE

PDF::Text(130, 56, 'Código:'); // Campo COD UE

PDF::Text(10 , 60, 'Centro de Ensino Fundamental 507 de Samambaia'); // Campo UE

PDF::Text(130 , 60, '0633'); // Campo COD UE

PDF::Text(10, 65, 'Área de Atuação'); // Campo AA

PDF::Text(72, 65, 'Componente Curricular'); // Campo CC

PDF::Text(130, 65, 'Código:'); // Campo Cod AA

PDF::Text(14, 70, 'Educação Infantil'); // Campo AA

PDF::Text(14, 76, 'Ensino Fundamental (Até a 4ª Série)'); // Campo AA

PDF::Text(14, 82, 'Ensino Fundamental (De 5ª a 8ª Série)'); // Campo AA

PDF::Text(14, 88, 'Ensino Médio'); // Campo AA

PDF::Text(14, 94, 'Centro de Educação Profissional'); // Campo AA

PDF::Text(10, 99, 'Período Trabalhado:'); // Campo Período trabalhado

PDF::Text(130, 99, 'Total de dias trabalhados:'); // Campo Total de Dias

PDF::Text(10, 104, '_______/_______/_______ a _______/_______/_______'); // Campo Período Trabalhado

PDF::Text(164, 104, '_______ Dias'); // Campo Total de Dias

PDF::Text(10, 124, 'Comparecimento regular e constante na unidade de exercício'); // Campo

PDF::Text(10, 134, 'Cumprimento do horáiro de trabalho (entrada e saída)'); // Campo

PDF::Text(10, 144, 'Observância às normas e às orientações da administração.'); // Campo

PDF::Text(10, 194, 'Cumprimento das obrigações e dos deveres que lhe são delegados.'); // Campo

PDF::Text(10, 204, 'Respeito ás questões individuais e coletivas.'); // Campo


PDF::SetFont('helvetica','', 8);

PDF::Text(10, 154, 'Capacidade de agir, por si próprio, mostrando-se empenhado em executar suas funções.'); // Campo

PDF::Text(10, 162, 'Domínio das habilidades e competência, inovando na prática das atividades docentes, '); // Campo

PDF::Text(10, 165, 'por meio de técnicas e métodos diferenciados.'); // Campo

PDF::Text(10, 172, 'Capacidade de produzir, contribuindo na execução dos trabalhos, apresentando idéias e'); // Campo

PDF::Text(10, 175, 'sugestões para alcançar os objetivos propostos.'); // Campo

PDF::Text(10, 182, 'Cumprimento dos prazos estabelecidos (apresentação de planejamentos, preenchimento'); // Campo

PDF::Text(10, 185, 'de diários de classe, entrega de avaliações, etc.)'); // Campo

PDF::Text(10, 212, 'Capacidade de relacionar-se com urbanidade com a chefia, com os colegas, com a'); // Campo

PDF::Text(10, 215, 'comunidade escolar e com os demais servidores da GRE.'); // Campo

PDF::Text(99, 248, 'Assinatura do docente'); // Campo


PDF::SetFont('helvetica','B', 9);

PDF::Text(10, 115, 'Fatores'); // Campo Fatores

PDF::Text(111, 109, 'Pontuação'); // Campo Pontuação

PDF::Text(130, 109, '7 PTS'); // Campo 7PTS

PDF::Text(142, 109, '5 PTS'); // Campo 5PTS

PDF::Text(154, 109, '3 PTS'); // Campo 3PTS

PDF::Text(166, 109, '1 PTS'); // Campo 1PTS

PDF::Text(178, 109, '0 PTS'); // Campo 0PTS

PDF::Text(10, 119, '1) ASSIDUIDADE:'); // Campo

PDF::Text(10, 129, '2) PONTUALIDADE:'); // Campo

PDF::Text(10, 139, '3) DISCIPLINA:'); // Campo

PDF::Text(10, 149, '4) INICIATIVA:'); // Campo

PDF::Text(10, 159, '5) CONHECIMENTO PROFISSIONAL:'); // Campo

PDF::Text(10, 169, '6) PRODUTIVIDADE:'); // Campo

PDF::Text(10, 179, '7) PRAZOS:'); // Campo

PDF::Text(10, 189, '8) RESPONSABILIDADE:'); // Campo

PDF::Text(10, 199, '9) ÉTICA:'); // Campo

PDF::Text(10, 209, '10) RELACIONAMENTO INTERPESSOAL:'); // Campo

PDF::Text(112, 219, 'Subtotal'); // Campo

PDF::Text(117, 229, 'Total'); // Campo

PDF::Text(10, 239, 'Ciente:'); // Campo

PDF::Text(10, 245, 'Em, _______/_______/_______'); // Campo

PDF::Text(90, 245, '___________________________'); // Campo

PDF::Text(91, 245, '___________________________'); // Campo

PDF::Text(10, 254, '1) À DIRETORIA REGIONAL DE ENSINO DE SAMAMBAIA,'); // Campo

PDF::Text(100, 254, '2) Arquivar no dossiê do docente,'); // Campo

PDF::Text(10, 257, 'para as providência necessárias.'); // Campo

PDF::Text(20, 263, 'Em, _______/_______/_______'); // Campo

PDF::Text(110, 259, 'Em, _______/_______/_______'); // Campo

PDF::Text(25, 269, '___________________________'); // Campo

PDF::Text(26, 269, '___________________________'); // Campo

PDF::Text(115, 267, '___________________________'); // Campo

PDF::Text(116, 267, '___________________________'); // Campo


PDF::SetFont('helvetica','', 6);

PDF::Text(130, 113, 'Sempre'); // Campo Sempre

PDF::Text(142, 113, 'Quase'); // Campo 5PTS

PDF::Text(142, 115, 'Sempre'); // Campo 5PTS

PDF::Text(154, 113, 'As vezes'); // Campo 3PTS

PDF::Text(166, 113, 'Raramente'); // Campo 1PTS

PDF::Text(178, 113, 'Nunca'); // Campo 0PTS

PDF::Text(42, 273, 'Chefia Imediata'); // Campo 0PTS

PDF::Text(116, 271, 'Chefe do Núcleo de Recursos Humanos da DRE'); // Campo 0PTS

PDF::Text(38, 275, '(Assinatura e Carimbo)'); // Campo 0PTS

PDF::Text(128, 274, '(Assinatura e Carimbo)'); // Campo 0PTS

PDF::Output();
?>
