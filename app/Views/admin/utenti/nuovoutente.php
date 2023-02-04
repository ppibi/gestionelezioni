<?= session()->getFlashdata("error") ?>
<?= validation_list_errors() ?>

<?php 
    $RiferimentoUtenti = new \App\Models\Admin\Admin_Utenti();
    $ElencoGruppiUtenti = $RiferimentoUtenti->ritornaGruppiUtenti();
    $NrGruppi = count ($ElencoGruppiUtenti);
?>

<form action="/admin/utenti/nuovoutente" method="post">
    <?= csrf_field() ?>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Username</span>
        </div>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="Username" value="<?= set_value("Username") ?>">
    </div> 

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Gruppo utenti</span>
        </div>
        <select class="form-control" name="Gruppo" size="<?php echo $NrGruppi;?>" autofocus="yes"> 
            <?php foreach ($ElencoGruppiUtenti as $Gruppo) : ?>
                <option value="<?= esc ($Gruppo["gruppo"]);?>">
                    <?= esc ($Gruppo["gruppo"]);?>
                </option> 
                
            <?php endforeach; ?>
        </select>
    </div> 

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Email</span>
        </div>
        <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="Email" value="<?= set_value("Email") ?>">
    </div> 

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Password</span>
        </div>
        <input type="text" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="Password" value="<?= set_value("Password") ?>">
    </div> 

    <input type="submit" name="submit" value="Inserisci">
</form>