<?php
require 'conectarBD.php';

session_start();
$id = $_SESSION["id"];
$data = date("d/m/Y");
$nome = $_SESSION["nome"];

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
}




$resultA = mysqli_query($conn,"SELECT CodAnimal,CodPessoa FROM animal WHERE Nome LIKE '$nome'");

$rowA = mysqli_fetch_assoc($resultA);

$codAnimal = $rowA["CodAnimal"];
$codPessoa = $rowA["CodPessoa"];

$sql = "INSERT INTO postagem (CodAnimal, CodPessoa, DataPostagem) 
    VALUES ('$codAnimal', '$id', '$data')";


if ($result = mysqli_query($conn, $sql)) {
    unset($_SESSION["nome"]);
    ?>
    
    <script>
    window.location.replace("paginaPrincipal.php");
    </script>
    <?php
} else {
    
    ?>
    
    <script>
    window.location.replace("../paginas/paginaAnimal.html");
    alert("<?php echo "Erro executando INSERT: " . mysqli_error($conn);?>");
    </script>
    <?php
}

mysqli_close($conn);
?>