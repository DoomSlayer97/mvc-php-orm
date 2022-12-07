<?php require_once "./view/template/header.php" ?>

<div class="container p-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4">
            <div class="card shadow">
                <div class="card-header">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form id="loginForm" >
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input 
                                        placeholder="Email"
                                        id="EmailForm"
                                        type="email"
                                        class="form-control" 
                                        name="Nombre" >
                                </div>
                                <div class="mb-3">
                                    <input 
                                        placeholder="Contraseña"
                                        id="PasswordForm"
                                        type="password"
                                        class="form-control" 
                                        name="Nombre" >
                                </div>
                            </div>
                            <div class="col-12">
                                <button 
                                    id="buttonLogin" 
                                    type="submit" 
                                    class="btn btn-primary" >Ingresar</button>
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