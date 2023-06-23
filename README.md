# SAE_203_Site_BDD
Bienvenue dans le rapport de conception de notre site web **Rocket Planet**.

---

# Structure du site

Le site est organisé de la façon suivante : <br>
L'index est les pages les plus importante se trouve dans la racine pour permettre un accés rapide. <br>
Dans le dossier **user_hook** ce trouve tous les fichiers *php* et les scripts qui permettent à un utilisateurs de se créer un compte se connecter ou l'autoriser à rentrer ou non sur certaines pages du site.<br>
Le dossier **sql_usage** contient toutes les fonctions qui génère nos tables dans nos bases de données et permettent la connexion à la base.
Le dossier **Scripts** contient quelques script qui ajoute des animations ou des fonctionnalité spécifique au site comme le changement de thème.
Le dossier **HTML_elements** contient la majorité de nos pages web qui sont organisées dans des sous-dossier adaptés à leur fonction.<br>
Le dossier **filters** contient les script qui font marcher les filtres et qui font les requêtes SQL.<br>
Le dossire **assets** contient les quelques images que nous utilisons sur le site.<br>

---

# Parcours utilisateur

Quand l'utilisateur arrive pour la première sur notre landing page,<br>
il tombe né à né avec la planète Terre notre header et le footer.<br>
<br>
Il peut essayer d'utiliser les filtres mais ceci ne feront que recharger la page : <br> comme l'indique le header, il faut être connecté pour accéder au menu.<br>

Si l'utilisateur clique sur l'icone de personnage haut à droite de la page il pourra se créer un compte ou se connecter si il en à déjà un.<br>
Une fois que l'utilisateur est connecté il peut utiliser les filtre, voir les derniers événement qui ont eu lieu dans le monde et accéder à son profil.<br>

Les filtres sont aditionnelle et n'affiche qu'un type d'événement à la fois pour ne pas saturer la planète.<br>
La page profil permet de changer son pseudo, son mail et son mot de passe, on peut aussi supprimer son compte.<br>

Pour les admins il est possible de modifiers (supprimer, ajouter, editer) les tables contenant les événements ou les utilisateurs.<br>

---

# Notes complémentaire

Nous avons eu du mal à intégrer les filtres sur la page d'accueil il manque donc certaines fonctionnalités.<br>
Si vous voulez voir les filtres à leur potentiel maximum (avec du js) vous pouvez accéder à la page **testing_filters.php**<br>
Nous aurions voulu terminer les pages d'administration mais avons du mettre des placeholder à la place et certaines pages n'ont pas un état CSS acceptable et certaines n'ont pas de CSS du tout.

Fait par Etienne Garcia, Julien Pantel, Gaëtan Bondenet.