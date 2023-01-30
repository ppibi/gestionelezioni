    <table class="table table-hover table-bordered ">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Istruttore</th>
                <th scope="col">Disciplina</th>
                <th scope="col">Giorno</th>
                <th scope="col">Ora</th>
                <th scope="col">N. max allievi</th>
            </tr>
        </thead>
        <tbody>

        <?php 
            foreach ($ElencoLezioni as $Lezione): 
//                echo "<br/>"; print_r ($Lezione); exit();
                $ClasseRiga = "";
                if (isset($IdNuovaLezione) AND ($IdNuovaLezione == $Lezione["IdLezioni"])) :
                    $ClasseRiga = "class='table-primary'";
                endif; 
                
                ?>
                <tr <?php echo $ClasseRiga;?>>
                    <th class="col-md-1" scope="row">
                    </th>
                    <td class="col-md-2"><?= esc($Lezione["Istruttore"]) ?></td>
                    <td class="col-md-2"><?= esc($Lezione["Disciplina"]) ?></td>
                    <td class="col-md-2"><?= esc($Lezione["Lezioni_GiornoSettimana"]) ?></td>
                    <td class="col-md-2"><?= esc($Lezione["Lezioni_Ora"]) ?></td>
                    <td class="col-md-2"><?= esc($Lezione["Lezioni_MaxAllievi"]) ?></td>
                </tr>
        <?php endforeach ?>
            <tr>
                <td class="text-center" colspan="6">
                    <?php echo anchor("admin/lezioni/nuovalezione", "Nuova lezione", "class='btn btn-primary' role='button'"); ?>
                </td>
                
            </tr>
            
        </tbody>
    </table>

<?php /*
    <div class="text-center">
         <?php echo anchor("admin/istruttori/nuovoistruttore", "Inserisci istruttore", "class='btn btn-primary stretched-link'"); 
//             "Titolo='Inserisci istruttore'"); ?>
           </<div> */?>


