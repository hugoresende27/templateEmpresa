<?php

    include 'gestor.php'; //incluir a classe Gestor no gestor.php

    $user1 = new Gestor(); // oobjeto user1 criado com base na classe Gestor()
    $dados = $user1->EXE_QUERY("SELECT * FROM emails");  //-> para chamar a função, um SELECT em sql

    //$dados[0]['id'] = "Hugo";
    //$dados[1] = "Resende";
    echo ($dados[0]['id']);
    echo ($dados[1]['email']); // Undefined offset: 10 se $dados[10]
    echo '<pre>';
    print_r($dados); //Prints human-readable information about a variable
    var_dump($dados);//Dumps information about a variable

    die('TERMINADO!');