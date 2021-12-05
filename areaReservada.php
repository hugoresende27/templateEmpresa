
<?php if (isset($_SESSION['user'])): //SE EXISTIR UM USER?>

    <h1>ÁREA RESERVADA</h1>

<?php else: //SE NÃO EXISTE UM USER?>

<div class="container">
    <div class="row mt-5">
        <div class="offset-3 col-6 ">
       
        <form action="?p=areaReservada" method="post">
        <div class="form-group">
            <input type="text" name="txtUser" placeholder="Usuario" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" name="txtPass" placeholder="password" class="form-control">
        </div>
        <div class="text-center">
            <input type="submit" value="Entrar" class="btn btn-secondary">
        </div>
        </form>

        </div>
    </div>

</div>
  
 

<?php endif; ?>