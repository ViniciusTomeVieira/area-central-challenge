<?php 

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'areacentral') or die(mysqli_error($mysqli));

$id = 0;

if(isset($_POST['cadastrar_venda'])){
    $id = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $valor_unitario = $_POST['valor_unitario'];
    $valor_total = $_POST['valor_total'];

    if($quantidade == 0 || $valor_unitario == 0|| $valor_total == 0){
        $_SESSION['message'] = "Venda não cadastrada! Verifique os campos do formulário!";
        $_SESSION['msg_type'] = "danger";
    
        header("location: ../../form-venda.php");
    }else{
        if(isset($_POST['atualizar_valor_unitario'])){
            $mysqli->query("UPDATE produtos SET valor_unitario='$valor_unitario'
                            WHERE id=$id") or die($mysqli->error());
        }

        $nome_produto = "";
        $result = $mysqli->query("SELECT * FROM produtos WHERE id=$id") or die($mysqli->error());
        if($result !== null){
            $row = $result->fetch_array();
            $estoque = $row['estoque'] - 1;
            $total_vendas = $row['total_vendas'] + 1;
            $date = new DateTime();
            $data_ultima_venda = date('Y-m-d H:i:s:u');
            $nome_produto = $row['descricao'];

            if($nome_produto != ""){
                $mysqli->query("UPDATE produtos SET estoque='$estoque',total_vendas='$total_vendas', data_ultima_venda='$data_ultima_venda'
                            WHERE id=$id") or die($mysqli->error());
            }
        }

        $mysqli->query("INSERT INTO vendas (produto, quantidade, valor_unitario, valor_total_venda) 
                    VALUES ('$nome_produto', '$quantidade', '$valor_unitario', '$valor_total')")
                    or die($mysqli->error);

        $_SESSION['message'] = "Venda cadastrada com sucesso!";
        $_SESSION['msg_type'] = "success";

        header("location: ../../form-venda.php");
    }
}   
?>