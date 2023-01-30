    <table class="table">
        <thead>
            <tr>
                <th scope="col">Istruttore</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Note</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td class="col-md-2"><?= esc($Istruttore["Istruttore"]) ?></td>
                <td class="col-md-2"><?= esc($Istruttore["UsernameIstruttore"]) ?></td>
                <td class="col-md-2"><?= esc($Istruttore["PasswordIstruttore"]) ?></td>
                <td class="col-md-2"><?= esc($Istruttore["Note"]) ?></td>
            </tr>
        </tbody>
    </table>
