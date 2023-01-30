    <table class="table table-hover table-bordered ">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Istruttore</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Note</th>
            </tr>
        </thead>
        <tbody>

        <?php 
            foreach ($ElencoIstruttori as $Istruttore): 
                $ClasseRiga = "";
                if (isset($IdNuovoIstruttore) AND ($IdNuovoIstruttore == $Istruttore["IdIstruttore"])) :
                    $ClasseRiga = "class='table-primary'";
                endif;
                
                ?>
            <tr <?php echo $ClasseRiga;?>>
                <th class="col-md-1" scope="row">
                </th>
                <td class="col-md-2">
                    <?php echo anchor("admin/istruttori/" . $Istruttore["Istruttore"], $Istruttore["Istruttore"]); ?>
                </td>
                <td class="col-md-2"><?= esc($Istruttore["UsernameIstruttore"]) ?></td>
                <td class="col-md-2"><?= esc($Istruttore["PasswordIstruttore"]) ?></td>
                <td class="col-md-2"><?= esc($Istruttore["Note"]) ?></td>
            </tr>
        <?php endforeach ?>
            <tr>
                <td class="text-center" colspan="5">
                    <?php echo anchor("admin/istruttori/nuovoistruttore", "Nuovo istruttore", "class='btn btn-primary' role='button'"); ?>
                </td>
                
            </tr>
            
        </tbody>
    </table>

<?php /*
    <div class="text-center">
         <?php echo anchor("admin/istruttori/nuovoistruttore", "Inserisci istruttore", "class='btn btn-primary stretched-link'"); 
//             "Titolo='Inserisci istruttore'"); ?>
           </<div> */?>


