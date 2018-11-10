<div class="column" id="content">
    <div class="ui grid">
        <div class="row">
            <h1 class="ui huge header">
                Espace administration
            </h1>
        </div>
        <div class="ui divider"></div>
        <div class="four column center aligned row">
            <div class="column">
                <img class="ui centered small image" src="/img/man-user.svg" />
                <div class="ui hidden divider"></div>
                <a href="/?p=admin&panel=users"><button class="ui button large teal">
                    Utilisateurs
                </button></a>
                <p><b><?php echo $nbusers; ?></b> utilisateurs</p>
            </div>
            <div class="column">
                <img class="ui centered small image" src="/img/spa-bowl-to-mix-treatments-ingredients.svg" />
                <div class="ui hidden divider"></div>
                <a href="/?p=admin&panel=recipes"><button class="ui button large green">
                    Recettes
                    </button></a>
                <p><b><?php echo $nbrecettes; ?></b> recettes</p>
            </div>
            <div class="column">
                <img class="ui centered small image" src="/img/whisk.svg" />

                <div class="ui hidden divider"></div>
                <a href="/?p=admin&panel=ingredients"><button class="ui button large red">
                        Ingrédients
                    </button></a>
                <p><b><?php echo $nbingred; ?></b> ingrédients</p>
            </div>
            <div class="column">
                <img class="ui centered small image" src="/img/settings-work-tool.svg" />

                <div class="ui hidden divider"></div>
                <a href="/?p=admin&panel=config"><button class="ui button large yellow">
                        Configuration
                    </button></a>
            </div>
        </div>
    </div>
</div>
