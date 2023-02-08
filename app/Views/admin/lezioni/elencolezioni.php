<div class="Container-fluid text-center">
    <?php if (!isset($SoloLezioniAttive) OR ($SoloLezioniAttive == 1) ) :
        echo anchor("admin/lezioni/tuttelezioni", MsgAbilitaTutte, "class='btn btn-primary' role='button'");     
    else:
        echo anchor("admin/lezioni/sololezioniattive", MsgSoloAttive, "class='btn btn-primary' role='button'");
    endif; 
    ?>
</div>


<div class="table-wrapper table-responsive">    

    <table class="table table-hover table-bordered ">
        <thead>
            <tr>
                <th scope="col"></th>
                <th class="ps-2"><h5>Istruttore</h5></th>
                <th class="ps-2"><h5>Disciplina</h5></th>
                <th class="text-center"><h5>Giorno</h5></th>
                <th class="text-center"><h5>Ora</h5></th>
                <th class="text-center"><h5>N. max allievi</h5></th>
            </tr>
        </thead>
        <tbody>

        <?php 
            foreach ($ElencoLezioni as $Lezione): 
                $VisualizzaLezione = 1;
                if (!isset($SoloLezioniAttive) OR ($SoloLezioniAttive == 1) ) :
                    $VisualizzaLezione = $Lezione["Lezioni_Attiva"];
                endif;
                if ($VisualizzaLezione) :
                    $ClasseRiga = "";
                    if (isset($IdNuovaLezione) AND ($IdNuovaLezione == $Lezione["IdLezione"])) :
                        $ClasseRiga = "class='table-primary'";
                    endif; 
                    if ($Lezione["Lezioni_Attiva"] == 0) :
                        $RouteAzione = "admin/lezioni/attivalezione/" . $Lezione["IdLezione"];
                        $Icona = '<i class="lni lni-checkmark"></i>';
                        $MessaggioIcona = MsgAttivazione;
                    else:
                        $RouteAzione = "admin/lezioni/disattivalezione/" . $Lezione["IdLezione"];
                        $Icona = '<i class="lni lni-close"></i>';
                        $MessaggioIcona = MsgDisattivazione;
                    endif;
                    ?>
                    <tr <?php echo $ClasseRiga;?>>
                        <td class="py-0">
                            <div class="action">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Disattiva">
                                    <?php 
                                    $ValoriDaPassare = array (
                                        "data-bs-toggle"            => "tooltip",
                                        "data-bs-placement"         => "top", 
                                        "data-bs-original-title"    => $MessaggioIcona,
                                    );
                                    echo anchor($RouteAzione, $Icona, $ValoriDaPassare); ?>
                                </button>
                            </div>
                        </td>
                        <td class="min-width py-1"><?= esc($Lezione["Istruttore"]) ?></td>
                        <td class="min-width py-1"><?= esc($Lezione["Disciplina"]) ?></td>
                        <td class="min-width py-1 text-center"><?= esc(substr($Lezione["Lezioni_GiornoSettimana"],2)) ?></td>
                        <td class="min-width py-1 text-center"><?= esc($Lezione["Lezioni_Ora"]) ?></td>
                        <td class="min-width py-1 text-center"><?= esc($Lezione["Lezioni_MaxAllievi"]) ?></td>
                    </tr>
                <?php
                endif;
             endforeach ?>
                    
            <tr>
                <td class="text-center" colspan="6">
                    <?php echo anchor("admin/lezioni/nuovalezione", "Nuova lezione", "class='btn btn-primary' role='button'"); ?>
                </td>
                
            </tr>
            
        </tbody>
    </table>
</div>

<?php /*
    <div class="text-center">
         <?php echo anchor("admin/istruttori/nuovoistruttore", "Inserisci istruttore", "class='btn btn-primary stretched-link'"); 
//             "Titolo='Inserisci istruttore'"); ?>
           </<div> */?>


