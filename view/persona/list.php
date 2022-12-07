<?php require_once "./view/template/header.php" ?>

<div id="mainList" class="container p-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                         <div class="col-10">
                             <h3>Personal</h3>
                         </div>
                         <div class="col-2">
                            <div class="d-grid gap-2">
                                <a class="btn btn-primary" href="/crud-fetch?uri=crear" >Agregar +</a>
                            </div>
                         </div>
                    </div> 
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Apellido Paterno</th>
                                            <th scope="col">Apellido Materno</th>
                                            <th scope="col">Telefono</th>
                                            <th scope="col">Correo</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contentTable">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "./view/template/scripts.php" ?>

<script src="./resources/js/persona/crud.js"></script>

<?php require_once "./view/template/footer.php" ?>