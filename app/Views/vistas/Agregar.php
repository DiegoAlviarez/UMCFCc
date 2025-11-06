<?php echo $cabecera; 

// Anyel este ayuda para saber si hay errores flasheados 
$validation = session()->getFlashdata('errors'); 
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger" role="alert">
                    <h5 class="alert-heading">¡Faltan campos por completar!</h5>
                    <p>Por favor, revisa y corrige lo siguiente:</p>
                    <hr>
                    <?= service('validation')->listErrors() ?>
                </div>
            <?php endif; ?>






            
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Ingresar nuevo jugador</h5>
                    <p class="card-text">
                        
                        <form method="post" action="<?=site_url('/guardar')?>" enctype="multipart/form-data">

                            <div class="form-group mb-3">
                                <label for="nombre">Nombre:</label>
                               
                                <input id="nombre" value="<?= old('nombre')?>" class="form-control" type="text" name="nombre"></div>

                            <div class="form-group mb-3">
                                <label for="edad">Edad:</label>
                                
                                <input id="edad" value="<?= old('edad')?>" class="form-control" type="number" name="edad"></div>

                            
                            <div class="form-group mb-3">
                                <label for="posicion">Posición:</label>
                                
                                <input id="posicion" value="<?= old('posicion')?>" class="form-control" type="text" name="posicion">
                            </div>

                            
                            <div class="form-group mb-4">
                                <label for="dorsal">Dorsal:</label>
                                
                                <input id="dorsal" value="<?= old('dorsal')?>" class="form-control" type="number" name="dorsal">
                            </div>

                            
                            <div class="form-group mb-4">
                                <label for="imagen">Imagen:</label>
                                <input id="imagen" class="form-control-file" type="file" name="imagen">
                            </div>

                          
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-success" type="submit">Guardar</button>
                               
                                <a href="<?= site_url('lobby') ?>" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
// Carga el pie de página
echo $pie; 
?>