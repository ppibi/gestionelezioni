<?= session()->getFlashdata("error") ?>
<?= validation_list_errors() ?>

<?php 
    $RiferimentoIstruttori = new \App\Models\Admin\Admin_Istruttori();
    $ElencoIstruttori = $RiferimentoIstruttori->ritornaIstruttori();
    $NrIstruttori = count($ElencoIstruttori);
    
    $RiferimentoDiscipline = new \App\Models\Admin\Admin_Discipline();
    $ElencoDiscipline = $RiferimentoDiscipline->ritornaDiscipline(); 
    $NrDiscipline = count($ElencoDiscipline);
    
?>

<form action="/admin/lezioni/nuovalezione" method="post">
    <?= csrf_field() ?>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Istruttore</span>
        </div>
        <select name="Lezioni_IdIstruttore" size="<?php echo $NrIstruttori;?>" autofocus="yes"> 
            <?php for ($i=0; $i < $NrIstruttori; $i++ ) : ?>
                <option value="<?php echo $ElencoIstruttori[$i]["IdIstruttore"];?>"
                    <?php if ($i == 0) :
                            echo " selected";
                        endif; ?>>
                    <?php echo $ElencoIstruttori[$i]["Istruttore"];?>
                </option> 
                
            <?php endfor; ?>
        </select>
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Disciplina</span>
        </div>

        <select name="Lezioni_IdDisciplina" size="7" autofocus="yes"> 
            <?php for ($i=0; $i < $NrDiscipline; $i++ ) : ?>
                <option value="<?php echo $ElencoDiscipline[$i]["IdDisciplina"];?>"
                     <?php if ($i == 0) :
                            echo " selected";
                        endif; ?>>
                    <?php echo $ElencoDiscipline[$i]["Disciplina"];?>
                </option> 
                
            <?php endfor; ?>
        </select>
    
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Giorno della settimana</span>
        </div>

        <select name="Lezioni_GiornoSettimana" size="7" autofocus="yes"> 
            <?php for ($i=0; $i < 7; $i++ ) : ?>
                <option value="<?php echo GiorniSettimana[$i];?>"
                    <?php if ($i == 0) :
                            echo " selected";
                        endif; ?>>
                    <?php echo GiorniSettimana[$i];?>
                </option> 
                
            <?php endfor; ?>
        </select>

    </div>
    
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Ora</span>
        </div>
        <input type="text" class="form-control" placeholder="Lezioni_Ora" aria-label="Lezioni_Ora" aria-describedby="basic-addon1" name="Lezioni_Ora" value="<?= set_value("Lezioni_Ora") ?>">
    </div> 

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">N. max allievi</span>
        </div>
        <input type="integer" class="form-control" placeholder="Lezioni_MaxAllievi" aria-label="Lezioni_MaxAllievi" aria-describedby="basic-addon1" name="Lezioni_MaxAllievi" >
    </div> 

    <input type="submit" name="submit" value="Inserisci">
</form>