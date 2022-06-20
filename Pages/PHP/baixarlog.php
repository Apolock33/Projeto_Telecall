
<?php
///------------------------------Tela que transforma o os dados do BD em um PDF----------------------///
include_once("dompdf/autoload.inc.php");
include_once("config.php");
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

$query_log = "SELECT * FROM log";
$result_log = mysqli_query($mysqli, $query_log);
while ($log = mysqli_fetch_assoc($result_log)) {
	$html .= '<tr><td>' . $log['log_id'] . "</td>";
	$html .= '<td>' . $log['usu_id'] . "</td>";
	$html .= '<td>' . $log['log_data'] . "</td>";
	$html .= '<td>' . $log['log_meth'] . "</td>";
	$html .= '<td>' . $log['log_status'] . "</td>";
	
}

$html .= '</tbody>';
$html .= '</table';


//referenciar o DomPDF com namespace
use Dompdf\Dompdf;

// include autoloader


//Criando a Instancia
$dompdf = new DOMPDF();

// Carrega seu HTML
$dompdf->load_html('
			<h1 style="text-align: center;">Telecall Registros de Acesso</h1>
			' . $html . '
		');

//Renderizar o html
$dompdf->render();

//Exibibir a página
$dompdf->stream(
	"logs_telecall.pdf",
	array(
		"Attachment" => true //Para realizar o download somente alterar para true
	)
);
?>