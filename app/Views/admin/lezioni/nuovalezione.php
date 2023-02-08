<?= session()->getFlashdata("error") ?>
<?= validation_list_errors() ?>

<?php 
    $RiferimentoIstruttori = new \App\Models\Admin\Admin_Istruttori();
    $ElencoIstruttori = $RiferimentoIstruttori->ritornaIstruttori();
    $NrIstruttori = min(count($ElencoIstruttori),4);
    $NrIstruttori = NumeroOpzioniSelectLezione;
    
    $RiferimentoDiscipline = new \App\Models\Admin\Admin_Discipline();
    $ElencoDiscipline = $RiferimentoDiscipline->ritornaDiscipline(); 
    $NrDiscipline = min(count($ElencoDiscipline),4);
    $NrDiscipline = NumeroOpzioniSelectLezione;
    
?>
<div class="form-elements-wrapper pt-3">

    <form action="/admin/lezioni/nuovalezione" method="post">
        <?= csrf_field() ?>
        <div class="row justify-content-center">

            <div class="col-lg-3 gx-1">
                <div class="card-style-1 mb-1 text-center">
                    <div class="select-style-1 mb-1">
                        <label>
                            <?php echo MsgIstruttore;?>
                        </label>
                        <div class="select-position py-0">
                            <select class="py-0" id="selezionaIstruttore" name="Lezioni_IdIstruttore" size="<?php echo $NrIstruttori;?>" autofocus="yes"> 
                                <?php foreach ($ElencoIstruttori as $Istruttore) : ?>
                                    <option class="text-center" value="<?= esc ($Istruttore["IdIstruttore"]);?>">
                                        <?= esc ($Istruttore["Istruttore"]);?>
                                    </option> 
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 gx-1">
                <div class="card-style-1 mb-1 text-center">
                    <div class="select-style-1 mb-1">
                        <label>
                            <?php echo MsgDisciplina;?>
                        </label>
                        <div class="select-position py-0">
                            <select class="py-0" id="selezionaDisciplina" name="Lezioni_IdDisciplina" size="<?php echo $NrDiscipline;?>" autofocus="yes"> 
                                <?php foreach ($ElencoDiscipline as $Disciplina) : ?>
                                    <option class="text-center" value="<?= esc ($Disciplina["IdDisciplina"]);?>">
                                        <?= esc ($Disciplina["Disciplina"]);?>
                                    </option> 
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 gx-1">
                <div class="card-style-1 mb-1 text-center">
                    <div class="select-style-1 mb-1">
                        <label>
                            <?php echo MsgGiorno;?>
                        </label>
                        <div class="select-position py-0">
                                <select class="py-0" id="selezionaDisciplina" name="Lezioni_GiornoSettimana" size="<?php echo NumeroOpzioniSelectLezione;?>" autofocus="yes"> 
                                    <?php foreach (GiorniSettimana as $Giorno) : ?>
                                        <option class="text-center" value="<?= esc ($Giorno);?>">
                                            <?= esc (substr($Giorno,2));?>
                                        </option> 
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card-style-1 mb-1 text-center">
                    <div class="row">
                        <div class="col-sm-4 d-flex justify-content-center">
                            <span class="align-self-center">
                                <?php echo MsgOra;?>
                            </span>
                        </div>
                        <div class="col-sm-6">
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Lezioni_Ora" 
                            aria-label="Lezioni_Ora"
                            aria-describedby="basic-addon1" 
                            name="Lezioni_Ora" 
                            value="<?= set_value("Lezioni_Ora") ?>">
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-5">
                <div class="card-style-1 mb-1 text-center">
                    <div class="row">
                        <div class="col-sm-4 d-flex justify-content-center">
                            <span class="align-self-center">
                                <?php echo MsgNMaxAllievi;?>
                            </span>
                        </div>
                        <div class="col-sm-6">
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Lezioni_MaxAllievi" 
                            aria-label="Lezioni_MaxAllievi"
                            aria-describedby="basic-addon1" 
                            name="Lezioni_MaxAllievi" 
                            value="<?= set_value("Lezioni_MaxAllievi") ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col align-self-center">
                <input class="btn btn-primary my-1 ml-3 mr-3" type="submit" name="submit" value="<?php echo MsgInserimento;?>">
            </div>
        </div>
    </div>

</form>