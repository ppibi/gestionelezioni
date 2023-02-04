<?= session()->getFlashdata("error") ?>
<?= validation_list_errors() ?>

<?php 
    $RiferimentoLezioni = new \App\Models\Lezioni();
    
    $RiferimentoIstruttori = new \App\Models\Istruttori();
    
    $ModelloIdentitaUtente = new \CodeIgniter\Shield\Models\UserIdentityModel;
    $UtenteLoggato = auth()->user();
    $UtenteIstruttore = $UtenteLoggato->inGroup('istruttori');

    if (!isset($IdIstruttore)) :
        if ($UtenteIstruttore) :
            $IdIstruttore = auth()->id();
        else:
            $IdIstruttore = 0;
        endif;
    endif; ?>
    
    <?php
    if ($IdIstruttore == 0) : 
        $ElencoIstruttori = $RiferimentoIstruttori->ritornaIstruttori();
        $NrIstruttori = count($ElencoIstruttori); ?>
        <div class="container pt-3">
        <form class="form-inline" action="/presenze/inseriscipresenze" method="post">
            <input class="btn btn-primary my-1 ml-3 mr-3" type="submit" name="submit" value="Seleziona istruttore">

            <select class="custom-select my-1 mr-sm-2" id="selezionaIstruttore" name="IdIstruttore" size="<?php echo $NrIstruttori;?>" autofocus="yes"> 
                <?php foreach ($ElencoIstruttori as $Istruttore) : ?>
                <option value="<?= esc ($Istruttore["IdIstruttore"]);?>">
                    <?= esc ($Istruttore["Istruttore"]);?>
                </option> 
                
                <?php endforeach; ?>
            </select>
        </form>
        </div>
    <?php
    else: 
        if (!$UtenteIstruttore) : 
            $DatiIstruttore = $RiferimentoIstruttori->ritornaIstruttori($IdIstruttore); ?>
            <div class="container-fluid text-center pt-3"> 
                <h3>Istruttore: <?= esc ($DatiIstruttore[0]["Istruttore"]);?></h3></div>
            </div>
        <?php 
        endif;
        $RicercaLezione = 0;
        if ($IdLezioni == 0) :
            $ElencoLezioni = $RiferimentoLezioni->ritornaLezioniIstruttore($IdIstruttore);
            $NrLezioni = count($ElencoLezioni); 
            if ($NrLezioni > 1 ):
                $RicercaLezione = 1;
            endif;
        else:
            $ElencoLezioni = $RiferimentoLezioni->ritornaLezioni($IdLezioni); 
        endif;
        if ($RicercaLezione ): ?>

            <div class="container pt-3">
            <form class="form-inline" action="/presenze/inseriscipresenze" method="post">
                <input class="btn btn-primary my-1 ml-3 mr-3" type="submit" name="submit" value="Seleziona tipo lezione">
                <select class="custom-select my-1 mr-sm-2" id="selezionaLezione" name="IdLezione" size="<?php echo $NrLezioni;?>" autofocus="yes"> 
                    <?php 
                    foreach ($ElencoLezioni as $Lezione) : 
                        $NomeLezione = $Lezione["Disciplina"] . "-" . substr($Lezione["Lezioni_GiornoSettimana"],2) . "-" .  $Lezione["Lezioni_Ora"];
                        ?>
                    <option value="<?= esc ($Lezione["IdLezioni"]);?>">
                        <?= esc ($NomeLezione);?>
                    </option> 
                
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="IdIstruttore" value="<?php echo $IdIstruttore;?>">
            </form>
            </div>
        <?php else: 
            $NomeLezione = $ElencoLezioni[0]["Disciplina"] . "-" . substr($ElencoLezioni[0]["Lezioni_GiornoSettimana"],2) . "-" .  $ElencoLezioni[0]["Lezioni_Ora"]; ?>
            <div class="container-fluid text-center pt-3"> 
                <h4>Lezione: <?= esc ($NomeLezione);?></h4></div>
            </div>
            
        <?php endif; ?>
    <?php endif; ?>


<?php /*
<form action="/admin/lezioni/nuovalezione" method="post">
    <?= csrf_field() ?>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Istruttore</span>
        </div>
        <select class="form-control" name="Lezioni_IdIstruttore" size="<?php echo $NrIstruttori;?>" autofocus="yes"> 
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
*/?>