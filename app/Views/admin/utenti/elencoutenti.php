    <table class="table table-hover table-bordered ">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Username</th>
                <th scope="col">Gruppo</th>
                <th scope="col">E-mail</th>
            </tr>
        </thead>
        <tbody>

        <?php 
            foreach ($ElencoUtenti as $Utente): 
                $ClasseRiga = "";
                if (isset($IdNuovoUtente) AND ($IdNuovoUtente == $Utente["IdUtente"])) :
                    $ClasseRiga = "class='table-primary'";
                endif;
                
                ?>
            <tr <?php echo $ClasseRiga;?>>
                <th class="col-md-1" scope="row">
                </th>
                <td class="col-md-2">
                    <?php echo anchor("admin/utenti/" . $Utente["username"], $Utente["username"]); ?>
                </td>
                <td class="col-md-2"><?= esc($Utente["group"]) ?></td>
                <td class="col-md-2"><?= esc($Utente["email"]) ?></td>
            </tr>
        <?php endforeach ?>
            <tr>
                <td class="text-center" colspan="4">
                    <?php echo anchor("admin/utenti/nuovoutente", "Nuovo utente", "class='btn btn-primary' role='button'"); ?>
                </td>
                
            </tr>
            
        </tbody>
    </table>

<?php /*
    <div class="text-center">
         <?php echo anchor("admin/utenti/nuovoutente", "Inserisci utente", "class='btn btn-primary stretched-link'"); 
//             "Titolo='Inserisci utente'"); ?>
           </<div> */?>


