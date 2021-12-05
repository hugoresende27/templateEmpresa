<?php
/*
incluir todos os ficheiros trnasversais às páginas

    *html_header (layout)
    *topo ou nav (layout)
        (conteudo = inicio | empresa | servicos | contatos)
    *footer (layout)
    *html_footer (layout)

*/

    session_start();

    include ('layout/html_header.php');
    include ('layout/nav.php');

    $pag = "inicio";
    

    /*
    //$_SESSION['user'] = 'hugo';
    //print_r($_SESSION);


    if(isset($_SESSION['user']) && ($_SESSION['user'] == 'hugo')) {
        echo 'logado!';
    } else {
        echo 'NAO LOGADO!';
    }

    */

    if (isset($_GET['p'])){/*Se existe a variavel p?, se está definida, isset ($_GET['p']*/
        $pag = $_GET['p']; //superglobal GET, vai buscar todas as var na query string ?p=
    }
    
    //include ($pag. '.php');     //concatenar todas as $pag a .php

// SISTEMA DE ROTEAMENTO /////////////////////////////////////////////////

//COM ESTRUTURA IF'S

    // if ($pag == "inicio"){
    //     include ('inicio.php');
    // } elseif ($pag == "empresa"){
    //     include ('empresa.php');
    // } elseif ($pag == "servicos"){
    //     include ('servicos.php');
    // } elseif ($pag == "contatos"){
    //     include ('contatos.php');
    // } else {        //no caso de não existir a pagina no query, prevenção de erros
    //     include ('inicio.php');
    // }

//COM ESTRUTURA SWITCH CASE

    switch($pag){
        case 'inicio':
            include ('inicio.php');
            break;
        case 'empresa':
            include ('empresa.php');
            break;
        case 'servicos':
            include ('servicos.php');
            break;
        case 'contatos':
            include ('contatos.php');
            break;
        case 'areaReservada':
            //VERIFICA SE HOUVE SUBMISSÃO DO FORMULÁRIO
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                //die('formulário submetido!');
                //VOU CRIAR UMA FUNÇÃO PARA USAR PARA VERIFICAR O LOGIN, EM VEZ DE ESCREVER TODO O CÓDIGO AQUI
                verificarLogin();
            }
            include ('areaReservada.php');
            break;
        default:
            include ('inicio.php');
            break;
    }
    
    include ('layout/footer.php');
    include ('layout/html_footer.php');

function verificarLogin(){
    $user = 'admin';
    $pass = '1234';
    //verifica se os dados do post correspondem
    if(($_POST['txtUser'] == $user) && ($_POST['txtPass'] == $pass)){
        //echo 'OK!';
        /////CRIAR DADOS DA SESSÃO 
       
        $_SESSION['user'] = $user;  //  <-- AQUI ESTOU A CRIAR NA SESSION O USER, E A DIZER Q vai receber a var $user ou ao $_POST['txtUSer'] que vai ser igual ao $user no caso de login com sucesso
        return true;
    } else {
        //echo 'NOT OK';
        return false;
    }
}


?>