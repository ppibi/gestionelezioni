<?= session()->getFlashdata("error") ?>
<?= validation_list_errors() ?>

<?php 
    $ModelloLezioni = new \App\Models\Admin\Admin_Lezioni();
    $ModelloIstruttori = new \App\Models\Admin\Admin_Istruttori();
    $ModelloPresenze = new \App\Models\Presenze;
    $ModelloAllievi = new \App\Models\Allievi;
    
 ?>
    
    <?php
    switch (TRUE) :
        case (!isset($IdIstruttore) OR $IdIstruttore == 0) : 
            $ElencoIstruttori = $ModelloIstruttori->ritornaIstruttori();
            $NrIstruttori = count($ElencoIstruttori); ?>
            <div class="container pt-3">
            <form class="form-inline" action="/admin/presenze/gestionepresenze" method="post">
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
            break;

        case ($IdLezione == 0) : 
            $DatiIstruttore = $ModelloIstruttori->ritornaIstruttori($IdIstruttore); ?>
            <div class="container-fluid text-center pt-3"> 
                <h3>Istruttore: <?= esc ($DatiIstruttore[0]["Istruttore"]);?></h3></div>
            </div>
            <?php 
            $RicercaLezione = 0;
            $ElencoLezioni = $ModelloLezioni->ritornaLezioniIstruttore($IdIstruttore);
            $NrLezioni = count($ElencoLezioni); 
            if ($NrLezioni > 1 ):
                $RicercaLezione = 1;
//                $ElencoLezioni = $ModelloLezioni->ritornaLezioni($IdLezione); 
            endif;
            if ($RicercaLezione ): ?>

                <div class="container pt-3">
                <form class="form-inline" action="/admin/presenze/gestionepresenze" method="post">
                    <input class="btn btn-primary my-1 ml-3 mr-3" type="submit" name="submit" value="Seleziona tipo lezione">
                    <select class="custom-select my-1 mr-sm-2" id="selezionaLezione" name="IdLezione" size="<?php echo $NrLezioni;?>" autofocus="yes"> 
                        <?php 
                        foreach ($ElencoLezioni as $Lezione) : 
                            $NomeLezione = $Lezione["Disciplina"] . "-" . substr($Lezione["Lezioni_GiornoSettimana"],2) . "-" .  $Lezione["Lezioni_Ora"];
                            ?>
                        <option value="<?= esc ($Lezione["IdLezione"]);?>">
                            <?= esc ($NomeLezione);?>
                        </option> 
                
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="IdIstruttore" value="<?php echo $IdIstruttore;?>">
                </form>
                </div>
                <?php
                break;
            endif;    
        
        case (!isset($GiornoLezione) OR strlen($GiornoLezione) < 1) : 
            if (!isset ($RicercaLezione)) :
                $DatiIstruttore = $ModelloIstruttori->ritornaIstruttori($IdIstruttore); 
                $ElencoLezioni = $ModelloLezioni->ritornaLezioniIstruttore($IdIstruttore); ?>
                <div class="container-fluid text-center pt-3"> 
                    <h3>Istruttore: <?= esc ($DatiIstruttore[0]["Istruttore"]);?></h3></div>
                </div>
            <?php 
            endif;
            $NomeLezione = $ElencoLezioni[0]["Disciplina"] . "-" . substr($ElencoLezioni[0]["Lezioni_GiornoSettimana"],2) . "-" .  $ElencoLezioni[0]["Lezioni_Ora"]; ?>
            <div class="container-fluid text-center pt-3"> 
                <h4>Lezione: <?= esc ($NomeLezione);?></h4></div>
            </div>
            <?php $ElencoDateRichieste = ritornaDateGiornoSettimanadaOggi(substr($ElencoLezioni[0]["Lezioni_GiornoSettimana"],0,1), NumeroLezioniDaRicercare); ?>
            <div class="container pt-3">
                <form class="form-inline" action="/admin/presenze/gestionepresenze" method="post">
                    <input class="btn btn-primary my-1 ml-3 mr-3" type="submit" name="submit" value="Seleziona data">
                    <select class="custom-select my-1 mr-sm-2" id="selezionaGiornoLezione" name="GiornoLezione" size="<?php echo NumeroLezioniDaRicercare;?>" autofocus="yes"> 
                        <?php 
                        foreach ($ElencoDateRichieste as $Data) : 
                            ?>
                        <option value="<?= esc ($Data);?>">
                            <?= esc ($Data);?>
                        </option> 
                
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="IdIstruttore" value="<?php echo $IdIstruttore;?>">
                    <input type="hidden" name="IdLezione" value="<?php echo $ElencoLezioni[0]["IdLezione"];?>">
                </form>
            </div>
            <?php
            break;            
            
        case (strlen($GiornoLezione) > 1) : 
            $DatiIstruttore = $ModelloIstruttori->ritornaIstruttori($IdIstruttore); 
            $ElencoLezioni = $ModelloLezioni->ritornaLezioniIstruttore($IdIstruttore); 
            $NomeLezione = $ElencoLezioni[0]["Disciplina"] . "-" . substr($ElencoLezioni[0]["Lezioni_GiornoSettimana"],2) . "-" .  $ElencoLezioni[0]["Lezioni_Ora"]; ?>
            <div class="container-fluid text-center pt-3"> 
                <h3>Istruttore: <?= esc ($DatiIstruttore[0]["Istruttore"]);?></h3>
            </div>
            <div class="container-fluid text-center pt-3"> 
                <h4>Lezione: <?= esc ($NomeLezione);?></h4>
            </div>
            <div class="container-fluid text-center pt-3"> 
                <h5>Giorno: <?= esc ($GiornoLezione);?></h5>
            </div>
            <?php 
            
            $PartecipantiLezione = $ModelloPresenze->ritornaPartecipantiLezione ($ElencoLezioni[0]["IdLezione"], $GiornoLezione);
            if (count($PartecipantiLezione) > 0) : ?>
                <div class="container-fluid text-center  pt-3">
                <h6>Partecipanti registrati: </h6>
                <?php
                    $NProgPartecipante = 1;
                    foreach ($PartecipantiLezione as $Partecipante) : 
                    ?>
                        <div class="grid">
                            <?php echo ($Partecipante["Tesserato"]); ?>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endif;
            
            $TesseratiPartecipantiLezione = $ModelloPresenze->ritornaTesseratiTipoLezioneNonPresenti($ElencoLezioni[0]["IdLezione"], $GiornoLezione);
            if (count($TesseratiPartecipantiLezione) > 0) : ?>
                <div class="container-fluid text-center  pt-3">
                <h6>Selezione Partecipanti: </h6>
                <form class="form" action="/admin/presenze/gestionepresenze" method="post">
                    <?php
                    $NProgPartecipante = 1;
                    foreach ($TesseratiPartecipantiLezione as $Tesserato) : 
                        $Riferimento = "TesseratoPartecipante_" . $Tesserato["IdTesserato"] ;
//                        $DatiTesserato = $ModelloAllievi->ritornaDatiTesserato($Tesserato["IdTesserato"]); 
                    ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="<?php echo $Riferimento;?>" value="" id="<?php echo $Riferimento;?>">
                            <label class="form-check-label" for="<?php echo $Riferimento;?>">
                                <?php echo ($Tesserato["Tesserato"]); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <input class="btn btn-primary my-1 ml-3 mr-3" type="submit" name="submit" value="Seleziona partecipanti">
                    <input type="hidden" name="IdIstruttore" value="<?php echo $IdIstruttore;?>">
                    <input type="hidden" name="IdLezione" value="<?php echo $ElencoLezioni[0]["IdLezione"];?>">
                    <input type="hidden" name="GiornoLezione" value="<?php echo $GiornoLezione;?>">
                    <input type="hidden" name="SelezionePresenze" value="1">
                </form>
                </div>

            <?php endif;
            
            $TesseratiOPES = $ModelloAllievi->ritornaTesseratiOPES(); ?>
            
            
            
            
            
            
            
            <button><?php echo anchor("admin/presenze/gestionepresenze", "Registrazione presenze altro giorno"); ?></button>

            <?php    
            break;
    endswitch; ?>

            
                


