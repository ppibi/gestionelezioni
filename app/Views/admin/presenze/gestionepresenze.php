<?= session()->getFlashdata("error") ?>
<?= validation_list_errors() ?>

<?php 
    $ModelloLezioni = new \App\Models\Admin\Admin_Lezioni();
    $ModelloIstruttori = new \App\Models\Admin\Admin_Istruttori();
    $ModelloPresenze = new \App\Models\Presenze;
    $ModelloAllievi = new \App\Models\Allievi;
    
 ?>

    <div class="form-elements-wrapper pt-3">
        <div class="row">
    
    <?php
    switch (TRUE) :
        case (!isset($IdIstruttore) OR $IdIstruttore == 0) : 
            $ElencoIstruttori = $ModelloIstruttori->ritornaIstruttori();
            $NrIstruttori = min(count($ElencoIstruttori),4); ?>
            <div class="col-lg-6 gx-1">
            <form action="/admin/presenze/gestionepresenze" method="post">
                <?= csrf_field() ?>
               <div class="card-style-1 mb-1 text-center">
                    <div class="select-style-1 mb-1">
                        <label><?php echo MsgIstruttore;?></label>
                        <div class="select-position">
                            <select class="mx-3" id="selezionaIstruttore" name="IdIstruttore" size="<?php echo $NrIstruttori;?>" autofocus="yes"> 
                                <?php foreach ($ElencoIstruttori as $Istruttore) : ?>
                                    <option value="<?= esc ($Istruttore["IdIstruttore"]);?>">
                                        <?= esc ($Istruttore["Istruttore"]);?>
                                    </option> 
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                <input class="btn btn-primary my-1 ml-3 mr-3" type="submit" name="submit" value="Seleziona istruttore">
            </form>
            </div>
            <?php 
            break;

        case ($IdLezione == 0) : 
            $DatiIstruttore = $ModelloIstruttori->ritornaIstruttori($IdIstruttore); ?>
            <div class="col-lg-4 gx-1"> 
                <div class="card-style-1 mb-5 text-center">
                    <h4 class="fst-italic">Istruttore:</h4>
                    <h3><?= esc ($DatiIstruttore[0]["Istruttore"]);?></h3>
                </div>
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
                <?= csrf_field() ?>
                <div class="card-style-1 mb-1 text-center">
                    <div class="select-style-1">
                        <label>Selezione Lezione</label>
                        <div class="select-position">
                            <select id="selezionaLezione" name="IdLezione" size="<?php echo $NrLezioni;?>" autofocus="yes"> 
                            <?php 
                                foreach ($ElencoLezioni as $Lezione) : 
                                    $NomeLezione = $Lezione["Disciplina"] . "-" . substr($Lezione["Lezioni_GiornoSettimana"],2) . "-" .  $Lezione["Lezioni_Ora"];?>
                                    <option value="<?= esc ($Lezione["IdLezione"]);?>">
                                        <?= esc ($NomeLezione);?>
                                    </option> 
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="IdIstruttore" value="<?php echo $IdIstruttore;?>">
                    <input class="btn btn-primary my-1 ml-3 mr-3" type="submit" name="submit" value="Seleziona tipo lezione">
                </form>
                </div>
                <?php
                break;
            endif;    
        
        case (!isset($GiornoLezione) OR strlen($GiornoLezione) < 1) : 
            if (!isset ($RicercaLezione)) :
                $DatiIstruttore = $ModelloIstruttori->ritornaIstruttori($IdIstruttore); 
                $ElencoLezioni = $ModelloLezioni->ritornaLezioniIstruttore($IdIstruttore); ?>
                <div class="col-lg-4 gx-1"> 
                    <div class="card-style-1 mb-5 text-center">
                        <h4 class="fst-italic">Istruttore:</h4>
                        <h3><?= esc ($DatiIstruttore[0]["Istruttore"]);?></h3>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-8 gx-1"> 
                <div class="card-style-1 mb-5 text-center">
                    <h4 class="fst-italic">Lezione:</h4>
                    <div class="row">
                        <div class="col-6">
                            <h3><?= esc ($ElencoLezioni[0]["Disciplina"]);?></h3>
                        </div>    
                        <div class="col-3">
                            <h3><?= esc (substr($ElencoLezioni[0]["Lezioni_GiornoSettimana"],2));?></h3>
                        </div>    
                        <div class="col-3">
                            <h3><?= esc ($ElencoLezioni[0]["Lezioni_Ora"]);?></h3>
                        </div>    
                    </div>
                </div>
            </div>
            <?php $ElencoDateRichieste = ritornaDateGiornoSettimanadaOggi(substr($ElencoLezioni[0]["Lezioni_GiornoSettimana"],0,1), NumeroLezioniDaRicercare); ?>
            <div class="col-lg-3 gx-1">
                <form class="form-inline" action="/admin/presenze/gestionepresenze" method="post">
                    <?= csrf_field() ?>
                    <div class="card-style-1 mb-5 text-center">
                        <div class="select-style-1">
                            <label>Selezione Giorno Lezione</label>
                            <div class="select-position">
                            <select id="selezionaGiornoLezione" name="GiornoLezione" size="<?php echo NumeroLezioniDaRicercare;?>" autofocus="yes"> 
                            <?php foreach ($ElencoDateRichieste as $Data) : ?>
                                <option class="text-center" value="<?= esc ($Data);?>">
                                    <?= esc ($Data);?>
                                </option> 
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <input class="btn btn-primary my-1 ml-3 mr-3" type="submit" name="submit" value="Seleziona data">
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
            <div class="col-lg-4 gx-1"> 
                <div class="card-style-1 mb-5 text-center">
                    <h4 class="fst-italic">Istruttore:</h4>
                    <h3><?= esc ($DatiIstruttore[0]["Istruttore"]);?></h3>
                </div>
            </div>
            <div class="col-lg-8 gx-1">
                <div class="card-style-1 mb-5 text-center">
                    <h4 class="fst-italic">Lezione: </h4>
                    <div class="row">
                        <div class="col-6">
                            <h3><?= esc ($ElencoLezioni[0]["Disciplina"]);?></h3>
                        </div>    
                        <div class="col-3">
                            <h3><?= esc ($GiornoLezione);?></h3>
                        </div>    
                        <div class="col-3">
                            <h3><?= esc ($ElencoLezioni[0]["Lezioni_Ora"]);?></h3>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="card-group">
                        
            <?php 
            
            $PartecipantiLezione = $ModelloPresenze->ritornaPartecipantiLezione ($ElencoLezioni[0]["IdLezione"], $GiornoLezione);
            if (count($PartecipantiLezione) > 0) : ?>
                <div class="col-lg-6 gx-2"> 
                    <div class="card-style-1 text-center">
                        <div class="card-header">Partecipanti registrati:</div>
                        <ul  class="list-group list-group-flush">
                        <?php
                            $NProgPartecipante = 1;
                            foreach ($PartecipantiLezione as $Partecipante) : ?>
                                <li class="list-group-item">
                                    <?php echo ($Partecipante["TesseratoNomeCognome"]); ?>
                                </li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

            <?php endif;
            
            $TesseratiNonPartecipantiLezione = $ModelloPresenze->ritornaTesseratiTipoLezioneNonPresenti($ElencoLezioni[0]["IdLezione"], $GiornoLezione);
            if (count($TesseratiNonPartecipantiLezione) > 0) : ?>

                <div class="col-lg-6 gx-2"> 
                    <form class="form-inline" action="/admin/presenze/gestionepresenze" method="post">
                        <?= csrf_field() ?>
                        <div class="card-style-1 mb-5 text-center">
                            <div class="select-style-1">
                                <h6>Selezione Partecipanti</h6>
                                <?php
                                $NProgPartecipante = 1;
                                foreach ($TesseratiNonPartecipantiLezione as $Tesserato) : 
                                    $Riferimento = "TesseratoPartecipante_" . $Tesserato["IdTesserato"] ;?>
                                    <input class="form-check-input" type="checkbox" name="<?php echo $Riferimento;?>" value="" id="<?php echo $Riferimento;?>">
                                    <label class="form-check-label" for="<?php echo $Riferimento;?>">
                                        <?php echo ($Tesserato["TesseratoNomeCognome"]); ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <input class="btn btn-primary my-1 ml-3 mr-3" type="submit" name="submit" value="Seleziona partecipanti">
                        <input type="hidden" name="IdIstruttore" value="<?php echo $IdIstruttore;?>">
                        <input type="hidden" name="IdLezione" value="<?php echo $ElencoLezioni[0]["IdLezione"];?>">
                        <input type="hidden" name="GiornoLezione" value="<?php echo $GiornoLezione;?>">
                        <input type="hidden" name="SelezionePresenze" value="1">
                    </form>
                </div>

            <?php endif;
            
            $TesseratiOPES = $ModelloAllievi->ritornaTesseratiOPESnonRegistrati ($ElencoLezioni[0]["IdLezione"]); ?>

            <div class="col-lg-6 gx-2"> 
                <div class="card-style-1 text-center">
                    <form class="form-inline" action="/admin/presenze/gestionepresenze" method="post">
                        <?= csrf_field() ?>
                        <h6 class="mb-1">Altri Partecipanti</h6>
                        <div class="select-position">
                            <select class="form-select" id="selezionaGiornoLezione" name="IdTesserato" size="4" autofocus="yes"> 
                                <?php foreach ($TesseratiOPES as $Tesserato) : ?>
                                    <option class="text-center" value="<?= esc ($Tesserato["IdTesserato"]);?>">
                                        <?= esc ($Tesserato["TesseratoNomeCognome"]);?>
                                    </option> 
                                    <?php endforeach; ?>
                            </select>
                        </div>
                    <input class="btn btn-primary my-1 ml-3 mr-3" type="submit" name="submit" value="Seleziona altri partecipanti">
                    <input type="hidden" name="IdIstruttore" value="<?php echo $IdIstruttore;?>">
                    <input type="hidden" name="IdLezione" value="<?php echo $ElencoLezioni[0]["IdLezione"];?>">
                    <input type="hidden" name="GiornoLezione" value="<?php echo $GiornoLezione;?>">
                    <input type="hidden" name="SelezionePresenze" value="1">
                    </form>
                 </div>
            </div>
        </div>
                    
            <div class="container-fluid text-center">
                <?php
                $AltriDati = array (
                    "Titolo" => TitoloMenuGestionePresenze,
                    "class"  => "btn btn-primary"
                );
                echo anchor("admin/presenze/gestionepresenze", "Registrazione presenze altro giorno", $AltriDati); ?>
            </div>    
            <?php    
            break;
    endswitch; ?>

            
                


