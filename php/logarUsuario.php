<?php
require 'conectarBD.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
}


$result = mysqli_query($conn,"SELECT * FROM pessoa WHERE Nome_Usuario LIKE '$nome'");
while ($row = mysqli_fetch_assoc($result)) {
    if($row["Nome_Usuario"] == $nome && $row["Email"] == $email && $row["Senha"] == $senha){
        session_start();
        $_SESSION["id"] = $row["CodPessoa"];
        
        ?>
            
            <script>
            window.location.replace("paginaPrincipal.php");
            </script>
        <?php
}
    else{
        ?>
        <script>
            alert("Login Incorreto");
            window.location.replace("loginUsuario.php");
            </script>
        <?php
    }
        


}


mysqli_close($conn);
?>