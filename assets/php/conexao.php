
<?php

if (!function_exists('conectarAoBanco')) {
   
    
function conectarAoBanco() {
    
    $conn = mysqli_connect('localhost', 'root', '', 'sistemaprofessores');
   
    if (!$conn) {
        die('Erro de conexão: ' . mysqli_connect_error());
    }
    
    return $conn;


}
}

?>