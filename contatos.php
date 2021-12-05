<?php

        // if ($_SERVER['REQUEST_METHOD'] == 'POST'){//condição para saber qual o submit de qual formulário
        //     echo $_POST['formulario'];  //pode ser email de input hidden name = email ou input hidden name = newsletter
        //     die(); 
        // }

        $erro_newsletter = "";
        $sucesso_newsletter = "";

        ////////////////////////////VALIDAÇÃO DO FORMULÁRIO///////////////////////////////////////
        // código em php escrito antes do form
        //$email = $_POST['txtEmail'];//Notice: Undefined index: txtEmail
        //echo var_dump($_SERVER);
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){//superglobal server, array com info de headers, paths, scripts, etc
            //die("foi submetido o formulário");//vai mostrar header, msg do die e acaba ali, já não carrega layout de rodapé
            
            //////////////////////////////FORMULÁRIO DE EMAIL///////////////////////////////////
            if($_POST['formulario'] == 'email'){//condição para saber qual o submit de qual formulário

                $erro = '';

                //verifica se existem todos os campos
                if (!isset($_POST['txtEmail']) || 
                    !isset($_POST['txtAssunto']) ||
                    !isset($_POST['txtMsg'])) {
                        $erro = "Pelo menos 1 dos campos não existe";
                    }

                $email = $_POST['txtEmail'];
                $assunto = $_POST['txtAssunto'];
                $msg = $_POST['txtMsg'];

                //ver se os campos estão preenchido
                if (empty($erro)){
                    
                    //ver se o email é válido (php valid email)
                    
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL) ){//https://www.php.net/manual/en/function.filter-var.php
                            $erro = "Email inválido";
                    }
                }
            
                //envio de email 

                if (empty($erro)){ //só vou enviar o email se não existir um erro, empty $erro
                    include('enviarEmail.php');
                }
            }   
            
            //////////////////////////////FORMULÁRIO DE NEWSLETTER///////////////////////////////////
            if($_POST['formulario'] =='newsletter'){
                
                $email = $_POST['txtEmail'];

                include 'gestor.php';
                $g = new Gestor();

                $params = array (
                    ':e' => $email
                );
                 //////////////////////////////VERIFICA SE EMAIL EXISTE NA BD///////////////////////////////////
                 $resultado = $g->EXE_QUERY("SELECT email FROM emails WHERE email = :e", $params);
                //var resultado = todos os emails da tabela emails onde o valor de email = email, verifica se existem este email na BD
                if(count($resultado) != 0){ //se email existir vai devolver count!=0
                    //email já registado
                    //die("Email já existe!");
                    $erro_newsletter = "Email já existe!";  //////////////////////ERRO
                } else {
                    //email não registado
                    //////////////////////////////INSERIR NOVO EMAIL NA BD///////////////////////////////////
                    $g->EXE_NON_QUERY(
                    //'INSERT INTO emails(email) VALUES ("'.$email.'")' //problema de segurança, é possivel injetar SQL por causa da concatenacao .$email.
                    'INSERT INTO emails(email) VALUES (:e)', $params);  //validação segura, com array parametros, previne o SQL injection    
                    //echo "Obrigado pelo registo!";  
                    $sucesso_newsletter =  "Obrigado pelo seu registo!";  //////////////////////SUCESSO
                }                
            }
                                       
    }
?>
<div class="container">
    <div class="row">
        <div class="offset-3 col-6 text-center">
            <?php  if(!empty($erro_newsletter)):  //se não estiver vazio o erro de newsletter?>
                <div class="alert alert-danger m-3">
                    <?php  echo $erro_newsletter ?>
                </div>
            <?php endif;  ?>

            <?php  if(empty($erro_newsletter)):  //se  estiver vazio o erro de newsletter?>
                <div class="alert alert-success m-3">
                    <?php  echo $sucesso_newsletter ?>
                </div>
            <?php endif;  ?> 

           
           

        </div>
    </div>
</div>

<!-- .container>.row>.offset-4.col-6 -->
<div class="container">
    <div class="row mt-2 mb-2">
        <div class="offset-3 col-6">

        <h1>CONTATOS (envio de email)</h1>

        <form action="?p=contatos" method="post">  <!--ESTE FORM EM action vai ser submetido à mesma página, ?p=contatos = index.php?p=contatos-->
            <input type="hidden" name="formulario" value ="email">
            <div class="form-group">
                <input type="email" name="txtEmail" class="form-control" placeholder="Destinatário do email" required >
            </div>
            <div class="form-group">
                <input type="text" name="txtAssunto" class="form-control" placeholder="assunto..." required >
            </div>
            <div class="form-group">
                <textarea name="txtMsg" cols="60" rows="3" class="form-control" required></textarea>
            </div>
            <div class="text-center">
                <input type="submit" value="Enviar Mensagem" class="btn btn-primary"><!-- ao fazer submit recarrega o formulário vazio, porque ?=contatos-->
            </div>
        </form>

        </div>
    </div>

    <div class="row" style="margin-bottom:150px">
        <div class="offset-3 col-6">
        <hr>
        <h1>NEWSLETTER</h1>

            <form action="?p=contatos" method="post" >
                <input type="hidden"  name="formulario" value ="newsletter">
                <div class="form-group">
                    <input type="email" name="txtEmail" placeholder="Email" class="form-control" require>
                </div>
                <div class="text-center">
                    <input type="submit" value="Receber newsletter" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>







<?php if(!empty($erro)):?>   
    <div style="color: red;">  <?php echo $erro ?> </div> 
<?php endif; ?>