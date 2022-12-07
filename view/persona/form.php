    <?php require_once "./view/template/header.php" ?>

<div class="container p-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
            <div class="card shadow">
                <div class="card-header">
                    <h3><?= $isNew ? "Agregar" : "Editar" ?></h3>
                </div>
                <div class="card-body">
                    <form  id="personaForm" method="POST" >
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label 
                                        for="" 
                                        class="form-label"
                                        >Nombre (s)</label>
                                    <input 
                                    
                                    id="NombreForm"
                                    type="text"
                                    class="form-control" 
                                    name="Nombre" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                <label 
                                    for="" 
                                    class="form-label"
                                    >Apellido Paterno</label>
                                <input 
                                    required
                                    id="ApellidoPaternoForm"
                                    type="text"
                                    class="form-control" 
                                    name="ApellidoPaterno" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                <label 
                                    for="" 
                                    class="form-label"
                                    >Apellido Materno</label>
                                <input 
                                    required
                                    id="ApellidoMaternoForm"
                                    type="text"
                                    class="form-control" 
                                    name="ApellidoMaterno" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                <label 
                                    for="" 
                                    class="form-label"
                                    >Telefono</label>
                                <input 
                                    required
                                    id="TelefonoForm"
                                    type="text"
                                    class="form-control" 
                                    name="Telefono" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                <label 
                                    for="" 
                                    class="form-label"
                                    >Correo</label>
                                <input 
                                    required
                                    id="CorreoForm"
                                    type="email"
                                    class="form-control" 
                                    name="Correo" >
                                </div>
                            </div>
                            <div class="col-12">
                                <button 
                                    id="buttonSave" 
                                    type="submit" 
                                    class="btn btn-primary" ><?= $isNew ? "Agregar" : "Guardar cambios" ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "./view/template/scripts.php" ?>

<script src="./resources/js/persona/form.js"></script>

<?php require_once "./view/template/footer.php" ?>