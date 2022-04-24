<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'bot';
$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

?>

<?php
$menu1 = "Olá bem vindo ao atendimento virtual da happy faro.\n
Vamos começar, qual filhote você tem interesse\n
 *1* Golden Retriever\n
 *2* Dachshund\n
 *3* Beagle\n
 *4* Husky Siberiano\n
 *5* Lulu da Pomerânia";

$menu2 = "Ok, ja vimos que tem interesse em tananan, aguarde estamos enviando algumas fotos, enquanto isso por que já não vamos combinar a entrega, nos envie seu CEP";

$menu3 = "Forma de pagamento será em cartão, dinheiro ou PIX?";

$menu4 = "Ok muito obrigado, já entraremos em contato para confirmar seu pedido";

$data = date('d-m-Y');
?>

<?php
$msg = $_GET['msg'];
$telefone_cliente = $_GET['telefone'];

$sql = "SELECT * FROM usuario WHERE telefone = '$telefone_cliente'";
$query = mysqli_query($conn, $sql);
$total = mysqli_num_rows($query);

while($rows_usuarios = mysqli_fetch_array($query)){
    $status = $rows_usuarios['status'];
}

if($total > 0){
    if($status == 2 ){
        echo $menu2;
        $resposta = $menu2;
    }
    if($status == 3 ){
        echo $menu3;
        $resposta = $menu3;
    }
    if($status == 4 ){
        echo $menu4;
        $resposta = $menu4;
    }
}else{
    $sql = "INSERT INTO usuario (telefone, status) VALUES('$telefone_cliente', '1')";
    $query = mysqli_query($conn, $sql);

    if(!$query){

    }else{
        echo $menu1;
        $resposta = $menu1;
    }
}
?>

<?php
$sql = "SELECT * FROM usuario WHERE telefone = '$telefone_cliente'";
$query = mysqli_query($conn, $sql);
$total = mysqli_num_rows($query);

while($rows_usuarios = mysqli_fetch_array($query)){
    $status = $rows_usuarios['status'];
}

if($status < 5){
    $status2 = $status + 1;

    $sql = "UPDATE usuario SET status = '$status2' WHERE telefone = '$telefone_cliente'";
    $query = mysqli_query($conn, $sql);

}
?>

<?php
$sql = "INSERT INTO historico (telefone, cliente1, bot, data) VALUES ('$telefone_cliente', '$msg', '$resposta', '$data')";
$query = mysqli_query($conn, $sql);
if(!$query){
}else{
}
?>
