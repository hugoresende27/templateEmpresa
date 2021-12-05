<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center fundo-rodape p-3 fixed-bottom"><!--fixed-bottom rodapé sempre no fundo -->

            Empresa &copy; 
            <span class="ml-3 mr-3"> | <span class="ml-3 mr-3">
                <a href="mailto:hugoresende27@gmail.com" class="link-email">empresa@empresa.com</a>
            <span class="ml-3 mr-3"> | <span class="ml-3 mr-3">
                <a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
            
            <a href="https://www.twitter.com" target="_blank" class="ml-4"><i class="fa fa-twitter-square fa-2x"></i></a>
            
            <a href="https://www.instagram.com" target="_blank" class="ml-4"><i class="fa fa-instagram fa-2x"></i></a>&nbsp;
            
            <?php   echo date('d-m-Y') ;//conteudo dinâmico, ano ('Y')
                    echo '&nbsp&nbsp Horas: '; 
                    echo date ('H:i:s') ;//Hora minutos e segundos
            ?> 

        
        </div>
    </div>
</div>