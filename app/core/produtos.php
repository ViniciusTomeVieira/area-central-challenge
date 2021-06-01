<?php 

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'areacentral') or die(mysqli_error($mysqli));

$id = 0;

if(isset($_POST['cadastrar_produto'])){
    $descricao = $_POST['descricao'];
    $estoque = $_POST['estoque'];
    $codigo_de_barras = $_POST['codigo_de_barras'];
    $valor_unitario = $_POST['valor_unitario'];
    $total_vendas = 0;
    $excluido = false;

    if($descricao == "" || $estoque == "" || $codigo_de_barras == ""|| $valor_unitario == 0){
        $_SESSION['message'] = "Produto não cadastrado! Verifique os campos do formulário!";
        $_SESSION['msg_type'] = "danger";
    
        header("location: ../../form-produto.php");
    }else{
        $mysqli->query("INSERT INTO produtos (descricao, valor_unitario, estoque, total_vendas, codigo_de_barras, excluido) 
                    VALUES ('$descricao', '$valor_unitario', '$estoque', '$total_vendas', '$codigo_de_barras', '$excluido')")
                    or die($mysqli->error);

    $_SESSION['message'] = "Produto cadastrado com sucesso!";
    $_SESSION['msg_type'] = "success";

    header("location: ../../produtos.php");
    }
}

if(isset($_GET['deletar_produto'])){
    $id = $_GET['deletar_produto'];
    $mysqli->query("DELETE FROM produtos WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Produto deletado com sucesso!";
    $_SESSION['msg_type'] = "danger";

    header("location: ../../produtos-excluidos.php");
}

if(isset($_GET['editar_produto'])){
    $id = $_GET['editar_produto'];
    $result = $mysqli->query("SELECT * FROM produtos WHERE id=$id") or die($mysqli->error());
    if($result !== null){
        $row = $result->fetch_array();
        $descricao = $row['descricao'];
        $estoque = $row['estoque'];
        $codigo_de_barras = $row['codigo_de_barras'];
        $valor_unitario = $row['valor_unitario'];
    }
}

if(isset($_POST['alterar_produto'])){
    $id = $_POST['id'];
    $descricao = $_POST['descricao'];
    $estoque = $_POST['estoque'];
    $codigo_de_barras = $_POST['codigo_de_barras'];
    $valor_unitario = $_POST['valor_unitario'];

    if($descricao == "" || $estoque == "" || $codigo_de_barras == ""|| $valor_unitario == 0){
        $_SESSION['message'] = "Produto não cadastrado! Verifique os campos do formulário!";
        $_SESSION['msg_type'] = "danger";
    
        header("location: ../../form-produto.php");
    }else{
        $mysqli->query("UPDATE produtos SET descricao='$descricao', estoque='$estoque', 
                    codigo_de_barras='$codigo_de_barras', valor_unitario='$valor_unitario'
                    WHERE id=$id") or die($mysqli->error());

        $_SESSION['message'] = "Produto atualizado com sucesso!";
        $_SESSION['msg_type'] = "success";

        header("location: ../../produtos.php");
    } 
}

if(isset($_GET['reciclar_produto'])){
    $id = $_GET['reciclar_produto'];
    $result = $mysqli->query("SELECT * FROM produtos WHERE id=$id") or die($mysqli->error());
    $excluido = null;
    if($result !== null){
        $row = $result->fetch_array();
        $excluido = !$row['excluido'];
        $mysqli->query("UPDATE produtos SET excluido='$excluido'
                    WHERE id=$id") or die($mysqli->error());
    }
    
    $_SESSION['message'] = "Produto reciclado com sucesso!";
    $_SESSION['msg_type'] = "success";

    if($excluido){
        header("location: ../../produtos.php");
    }else{
        header("location: ../../produtos-excluidos.php");
    }
}
?>