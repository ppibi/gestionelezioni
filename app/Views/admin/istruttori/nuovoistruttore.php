<?= session()->getFlashdata("error") ?>
<?= validation_list_errors() ?>

<form action="/admin/istruttori/nuovoistruttore" method="post">
    <?= csrf_field() ?>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Nome</span>
        </div>
        <input type="text" class="form-control" placeholder="Istruttore" aria-label="Istruttore" aria-describedby="basic-addon1" name="Istruttore" value="<?= set_value("Istruttore") ?>">
    </div> 

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Username</span>
        </div>
        <input type="text" class="form-control" placeholder="UsernameIstruttore" aria-label="UsernameIstruttore" aria-describedby="basic-addon1" name="UsernameIstruttore" value="<?= set_value("UsernameIstruttore") ?>">
    </div> 

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Password</span>
        </div>
        <input type="text" class="form-control" placeholder="PasswordIstruttore" aria-label="PasswordIstruttore" aria-describedby="basic-addon1" name="PasswordIstruttore" value="<?= set_value("PasswordIstruttore") ?>">
    </div> 

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Note</span>
        </div>
        <textarea class="form-control" aria-label="With textarea" name="Note" cols="45" rows="4"><?= set_value("Note") ?></textarea>
    </div>
    <input type="submit" name="submit" value="Inserisci">
</form>