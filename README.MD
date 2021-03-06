# Projet Cook & Burn

### Membres de l'équipe
* Thomas Miceli
* Andrea Garcia
* Dylan March
* Ugo Orlando

### URL du site web

http://tomus.alwaysdata.net/

### Présentation du projet

Le projet réalisé est un site web pour la start-up Cook & Burn qui conçoit des barbecus connectés. Le site est public mais la 
majorité des fonctionnalités suivantes sont réservées aux clients de la start-up.
Le site à pour fonctionnalité principale de partager ses recettes et de lire celles des autres, afin d'avoir opportunité d'utiliser
son barbecue. On peut noter les recettes et nouer d'amitié avec les autres clients en allant consulter leur profil.

### Choix techniques

Le site a été conçu sous le modèle de conception MVC, utilsant fortement le langage objet de PHP.
##### Structure
- `core/`     qui regroupe les classes génériques.
- `src/`      qui regroupe les classes spécifiques en suivant le patron de conception MVC.
- `public/`   qui regroupe les fichiers publics et accessibles depuis n'importe quel utilisateur se connectant au site. 
C'est ce dossier que notre serveur web aura pour racine.
- `vendor/`   qui regroupe l'autoloading de composer ainsi que les librairies externes (après avoir fait la commande `composer install`)
	
##### Dépendances externes utilisées
- **respect/validation** :
	Cette librairie est très utile en plus d'être simple et efficace pour valider nos champs de formulaires
	ou d'URL. Afin de compléter et d'exploiter la librairie plus efficacement, la classe Validator (core/validator.php)
	met en forme et affiche les messages d'erreur customisés en utilisant ce que la librairie nous fournit.
	Plus d'infos : https://github.com/Respect/Validation

- **pagerfanta/pagerfanta** : 
	Cette librairie fait office de pagination. Très simple d'utilisation en plus d'être performante.
	Plus d'infos : https://github.com/whiteoctober/pagerfanta

- **google/recaptcha** :
	Cette librairie proposée par Google nous permet d'intégrer un captcha pour nos formulaires afin d'éviter toute tentative de spam
	par des robots. La mise en place requiert d'enregistrer notre site sur le site de Google dédié aux captchas, afin d'obtenir une
	clé publique et secrète pour notre site. Le reste de la vérification tient sur 3 lignes environ.
	Plus d'infos : https://github.com/google/recaptcha
	
- **squizlabs/php_codesniffer** :
	Cette librairie permet de nettoyer le code afin de le mettre aux normes et conventions de codage de PHP.
	Plus d'infos : https://github.com/squizlabs/php_codesniffer
		
		
##### Routing & front controller
L'index de notre site veut imiter très grossièrement certains points d'un routage que l'on peut trouver sur des frameworks connus comme 
Laravel/Slim3 (en tout cas au niveau visuel du code).
On teste nos routes en ayant auparavant instancié la classe [Router](https://github.com/thomas-miceli/cook-burn/blob/master/core/router.php) 
du core et on exécute celle qui correspond à la page demandée. Si un test fonctionne, alors notre instance crée une instance 
du controlleur et de son action demandée, et la logique de l'application prend la suite et renverra une vue/fera une redirection selon le contexte de la page.
	
##### Rendu des vues 
Là également notre site reprend clairement un point essentiel des frameworks qui est le rendering de view. Toutes nos classes de [controlleurs](https://github.com/thomas-miceli/cook-burn/blob/master/src/controllers) 
héritent de la classe mère [Controller](https://github.com/thomas-miceli/cook-burn/blob/master/core/controller.php). 
Cette classe mère a pour seule méthode `render()` qui va rendre une vue avec le template (squelette du HTML) et le contenu
(données dynamiques manipulées par les controlleurs fils).
	
##### Connexion à la BDD et models
Tout d'abord, notre classe [Database](https://github.com/thomas-miceli/cook-burn/blob/master/core/database.php) va construire 
et retourner une instance de PDO avec la connexion à la base de données.
Ensuite, comme nos controlleurs, nos modèles ont une classe mère [Model](https://github.com/thomas-miceli/cook-burn/blob/master/core/model.php) 
qui possède une méthode `getDb()` qui créé l'instance de Database si elle n'existe pas. On pourra donc accéder à PDO dans 
nos modèles avec `$this->getDb()->getPDO()` et ensuite pouvoir utiliser toutes les méthodes que PDO nous fournit pour communiquer
avec notre base de données.
Les classes [modèles](https://github.com/thomas-miceli/cook-burn/blob/master/src/models) sont regroupées par thème : pour 
tout ce qui concerne les recettes, il y a le modèle Recipes qui étend de Model, etc...

##### Configuration logicielle minimale

* PHP 7.1.19 minimum conseillé
* Composer 1.7.2 minimum conseillé
    
*De plus, les extensions PHP suivantes sont requises* :
* `mbstring`
* `pdo_mysql`

##### Identifiants de connexion (`id` - `mdp`)

* **Site web** :
	- Administration : `Tomus` - `oui`
	- Compte de test 1 : `ouais` - `aaaaaa`
	- Compte de test 2 : `Jx13` - `aaaaaa`

* **Hébergement** (*https://admin.alwaysdata.com/login/*) : `tomus.mic@gmail.com` - `cookandburnvevo`
* **Base de données** (*https://phpmyadmin.alwaysdata.com/*) : `tomus` - `oui`
* **FTP** (*ftp-tomus.alwaysdata.net*) : `tomus` - `oui`
* **SSH** (*ssh-tomus.alwaysdata.net*) : `tomus` - `oui`
* **Github** : `cookandprof` - `salutatouslesamis1`
