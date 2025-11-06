<?=$cabecera?>

<div class="mb-3">
    <a href="<?=base_url('Agregar')?>" class="btn btn-success btn-lg rounded-pill shadow-sm">
        <i class="bi bi-plus-circle-fill"></i> Agregar jugador 
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered border-primary rounded-3 shadow-lg">
        <thead class="table-dark text-uppercase">
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">IMAGEN</th>
                <th scope="col">NOMBRE</th>
                <th scope="col" class="text-center">EDAD</th>
                <th scope="col" class="text-center">POSICION</th>
                <th scope="col" class="text-center">DORSAL</th>
                <th scope="col" class="text-center">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($futbolistas as $futbolista): ?>
            <tr>
                <td class="align-middle text-center font-weight-bold"><?=$futbolista ['ID']?></td>
                <td class="align-middle text-center">
                    <img class="img-thumbnail rounded-circle border border-primary border-3"
                         src="<?=base_url()?>/public/imagenes/<?=$futbolista ['imagen']?>"
                         width="80" 
                         alt="Foto de <?=$futbolista ['nombre']?>">
                </td>
                <td class="align-middle"><?=$futbolista ['nombre']?></td>
                <td class="align-middle text-center"><?=$futbolista ['edad']?></td>
                <td class="align-middle text-center"><?=$futbolista ['posicion']?></td>
                <td class="align-middle text-center fs-5 text-primary"><?=$futbolista ['dorsal']?></td>
                <td class="align-middle text-center">
                    <div class="btn-group" role="group">
                        <a href="<?=base_url('editar/'.$futbolista['ID'])?>" class="btn btn-info btn-sm rounded-start">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <a href="<?=base_url('borrar/'.$futbolista['ID'])?>" class="btn btn-danger btn-sm rounded-end">
                            <i class="bi bi-trash-fill"></i> Borrar
                        </a> 
                    </div>
                </td>
            </tr>
        <?php endforeach?> 
        </tbody>
    </table>
</div>
<?=$pie?>