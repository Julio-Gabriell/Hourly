<?php 

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try{
        $mysqli = new mysqli("localhost", "root", "", "hourly_bd");

        $email = $_POST['email'];
        $senha1 = $_POST['senha1'];
        $senha2 = $_POST['senha2'];
        $nome = $_POST['nome'];

        if ($senha1 !== $senha2) {
            header("Location: index.php?p=12");
            exit();
        }

        $email = htmlentities(htmlspecialchars($email));
        $nome = htmlentities(htmlspecialchars($nome));
        $senha = htmlentities(htmlspecialchars($senha1));
        $senha = md5($senha);
        // echo $nome;
        // $email = $_POST['email'];

        $stmt = $mysqli -> prepare("insert into USUARIOS (senha, email, nomeCompleto) values (?, ?, ?)");
        
        if (!$stmt){
            throw new Exception("Preparação de declaração falhou: " . $mysqli->error);
        }

        $stmt->bind_param('sss', $senha, $email, $nome);
        $stmt->execute();
        $result = $stmt->get_result();

        if(!$result){
            header("Location: Login/home_logado.php");
        }
        else{
            echo "Erro ao cadastrar dados";
        }

        $stmt->close();
        }
    catch(mysqli_sql_exception $e){
        echo "Erro MySQL:" . $e->getMessage();
    }
    catch(Exception $e){
        echo "Erro:" . $e->getMessage();
    }
    finally {
        if (isset($mysqli)){
            $mysqli->close();
        }
    } 
?>