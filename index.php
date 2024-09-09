<?php
        require "vendor/autoload.php";
        require_once "topo.php";
?>

<?php
    if (isset($_GET['p'])){
        $p = $_GET['p'];
        switch($p){
                case 2: require_once "home.php";
                    break;
                case 4: require_once "fale.php";
                    break;
                case 5: require_once "login.php";
                    break;
                case 6: require_once "cadastro.php";
                    break;
                case 7: require_once "home_logado.php";
                    break;
                case 8: require_once "pop_up.php";
                    break;
                case 9: require_once "esqueceu_senha.php";
                    break;
                case 10: require_once "erro_senha.php";
                    break;
                case 11: require_once "user_nao_encontrado.php";
                    break;
                case 12: require_once "diferentes_senhas.php";
                    break;
                case 13: require_once "redefine_senha.php";
                    break;            
        }
    }else{
        require_once "home.php";
    }
?>
<?php
    require_once "rodape.php";
?>