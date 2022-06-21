
<?php
include_once("dompdf/autoload.inc.php"); //chama os arquivos baixados pelo composer
include_once("config.php"); //chama o arquivo config.php
//começa a formatação do pdf
$html = '<table';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>logID</th>';
$html .= '<th>Hora de Acesso</th>';
$html .= '<th>Método de Acesso</th>';
$html .= '<th>Status do Acesso</th>';
$html .= '<th>Ip de Acesso</th>';
$html .= '<th>login do Usuário</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$query_log = "SELECT * FROM log"; //codigo sql a ser executado
$result_log = mysqli_query($mysqli, $query_log); //variavel com função de execuçãode query
while ($log = mysqli_fetch_assoc($result_log)) { //transsforma a variavel $log em array
	//apresenta os resultados retornados do banco em formato de linhas da tabela
	$html .= '<tr><td>' . $log['log_id'] . "</td>";
	$html .= '<td>' . $log['usu_id'] . "</td>";
	$html .= '<td>' . $log['log_data'] . "</td>";
	$html .= '<td>' . $log['log_meth'] . "</td>";
	$html .= '<td>' . $log['log_status'] . "</td>";
}

$html .= '</tbody>';
$html .= '</table';

use Dompdf\Dompdf; //aqui ele chama a biblioteca que sera usada para baixar pdfs

$dompdf = new DOMPDF(); //aqui essa biblioteca é instanciada

$dompdf->load_html('
			<h1 style="text-align: center;">Telecall Registros de Acesso</h1>
			' . $html . '
		');

$dompdf->render(); //aqui ele renderiza o html apresentado anteriormente

$dompdf->stream( // aqui ele define se o pdf vai ser mostrado para download(false) ou apenas sera baixado ao clicar(true)
	"logs_telecall.pdf",
	array(
		"Attachment" => true
	)
);
?>