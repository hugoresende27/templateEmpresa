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
    include ('layout/user.php');

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
        case 'logout':
            session_destroy();
            Header('Location: '.$_SERVER['PHP_SELF']);
            return;
            break;
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
            $erro = false;
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                //die('formulário submetido!');
                //VOU CRIAR UMA FUNÇÃO PARA USAR PARA VERIFICAR O LOGIN, EM VEZ DE ESCREVER TODO O CÓDIGO AQUI
                if (verificarLogin()){      //função retorna true ou false
                    include ('layout/user.php');    //////////////////true -> login válido
                } else {
                    $erro = true;                   /////////////////false -> login inválido
                }
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

    /* UTILIZADOR HARDCODED /////////////////////////////
    $user = 'admin';
    $pass = '1234';
    */

    //BUSCAR DADOS DE USER À BD
    // -se user existe = login válido
    // -se user não existe
    //   -verifica se senha é válida
    //     -sim = cria sessão
    //     -não = login inválido

    $user = trim($_POST['txtUser']);  //trim para remover espaços a mais 
    $pass = trim($_POST['txtPass']);

    include '/gestor.php';
    $gestor = new Gestor();
    $params = array (
        ':user' => $user
    );
    $resultado = $gestor->EXE_QUERY("
        SELECT * FROM users  
        WHERE user = :user 
    ",$params);

    // echo '<pre>';
    // print_r($resultado);
    if (count($resultado) == 0){//user não existe na BD
        //die("login inválido!"); 
        return false;
    } else {                    //user existe pelo menos 1 vez na BD
        $senha_BD = $resultado[0]['senha'];
        /*
        Array
    (
    [0] => Array
        (
            [id_user] => 2
            [user] => admin
            [senha] => $2y$10$nrS/9Nu9FEV.kuHxXJECtu6WSXZgreaclGM84ayKyvC3U4oDUdj/u
        )

    )
        */
        /////////////////////VERIFICAÇÃO DA SENHA////////////////////////////////
        if (password_verify($pass,$senha_BD)){//encripta $pass com HASH e $senha_BD e compara, return de true ou false
            
            $_SESSION['user']=$resultado[0]['user'];
            return true;//SENHA VÁLIDA
        } else {
            
            
            return false;//SENHA INVÁLIDA
        }    

    }

    /*
    die();

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

    */
}


?>