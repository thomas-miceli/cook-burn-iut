<div class="column" id="content">
    <div class="ui grid">
        <div class="row">
            <h1 class="ui huge header">Configurations</h1>
        </div>
        <form action="/?p=admin&panel=config" method="post" enctype="multipart/form-data" class="ui form segment" style="width: 100%">
            <div class="field">
                <label for="theme">Thème : <u><?= $currentTheme['nom']?></u></label>
                <select name="theme" class="ui selection dropdown" id="theme">
                    <option value="">Choisir un thème</option>
                    <?php foreach ($themes as $theme) {?>
                        <option value="<?= $theme['id_theme'] ?>"><?= $theme['nom']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="field">
                <label for="feat">Ingrédient à la une : <u><?php if($currentIngr['id_ingredient'] == 0) echo 'Aucun'; else echo $currentIngr['nom'];?></u></label>
                    <select class="ui search dropdown" id="feat" name="feat">
                        <option value="">Choisir un ingrédient</option>
                        <option value="0">Aucun</option>
                        <?php foreach ($ingredients as $ingredient) {?>
                            <option value="<?= $ingredient['id_ingredient'] ?>"><?= $ingredient['nom']; ?> [<?= $ingredient['id_ingredient'] ?>]</option>
                        <?php } ?>
                    </select>
            </div>

            <div class="field">
                <label for="pagi">Nombre de recettes à afficher sur l'accueil</label>
                <input type="number" class="ui input" id="pagi" name="pagi" min="1" max="4" value="<?= $currentPagi; ?>">
            </div>

            <input type="submit" name="envoyer" class="ui submit button olive">
        </form>
    </div>
</div>
<script>$('#multi-select').dropdown();</script>