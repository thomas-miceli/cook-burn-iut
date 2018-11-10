<div class="column" id="content">
    <div class="ui grid">
        <div class="row">
            <h1 class="ui huge header">Utilisateurs</h1>
        </div>
        <a href="/?p=admin&panel=usercreate"><button class="ui button teal">Nouveau</button></a>
        <div class="row">
            <table class="ui single line striped selectable table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Pseudo</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Role</th>
                    <th>Inscription</th>
                    <th>Profil</th>
                    <th>Editer</th>
                    <th>Bannir</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><img src="/img/avatars/<?= $user['avatar']; ?>" class="ui avatar image"><?= $user['pseudo'] ?></td>
                    <td><?= $user['prenom'] ?></td>
                    <td><?= $user['nom'] ?></td>
                    <td><?php if ($user['role'] == 3) echo 'Administrateur'; if ($user['role'] == 2) echo 'Modérateur'; if ($user['role'] == 1) echo 'Membre' ?></td>
                    <td><?= $user['insc'] ?></td>
                    <td><a href="/?p=profile&id=<?= $user['id']; ?>"><button class="ui button">Profil</button></a></td>
                    <td><a href="/?p=admin&panel=userupdate&id=<?= $user['id']; ?>"><button class="ui button olive">Editer</button></a></td>

                    <?php if ($user['role'] < $_SESSION['role']) { ?>
                    <td><a href="/?p=admin&panel=toggleban&id=<?= $user['id']; ?>"><button class="ui button <?php if ($user['actif'] == 1) echo 'orange">Bannir'; else if($user['actif'] == 0) echo 'blue">Débannir'; ?></button></a></td>
                    <?php } else { ?>
                    <td><button class="ui button disabled <?php if ($user['actif'] == 1) echo 'orange">Bannir'; else if($user['actif'] == 0) echo 'blue">Débannir'; ?></button></a></td>
                    <?php } ?>
                    <?php if ($user['role'] < $_SESSION['role']) echo '<td><a href="/?p=admin&panel=userdelete&id=' . $user['id'] . '"><button class="ui button red ">Supprimer</button>';
                                                            else echo '<td><button class="ui button disabled red ">Supprimer</button>'?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
