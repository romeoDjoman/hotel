
SITE DE RESERVATION D'HOTEL

1. Étape 1 : Préparation de l'environnement de développement
- Installez Symfony en utilisant Composer, en exécutant la commande suivante :
    $ symfony new nom_projet --version="6.2.*" --webapp
        ou
    $ composer require webapp
        ou
    $ composer create-project symfony/skeleton nom_du_projet
  
- Configurez votre serveur web local (par exemple, Apache ou Nginx) pour pointer vers le répertoire public de votre projet Symfony.

2. Étape 2 : Modélisation de la base de données
- Dupliquer le fichier env et renommer par env.local     
- Définir l'utilisateur, le mot de passe et le nom de la base de données
    `DATABASE_URL="mysql://root@127.0.0.1:3306/hotel"`

3. Étape 3 : Génération de la base de données
- Utilisez Doctrine pour générer les tables de base de données à partir de vos entités :
    `$ symfony console doctrine:database:create`

4. Etape 4 : Versioner
- Utiliser GitHub : 
    ``git init``
    ``git add README.md``
    ``git commit -m "first commit"``
    ``git branch -M main``
    ``git remote add origin https://github.com/romeoDjoman/nom_commit.git``
    ``git push -u origin main``

4. Etape 4 : 
Définissez les entités nécessaires pour votre application :
    `membre`
- id_membre (int 3) PK - AI
- pseudo (varchar 20)
- mdp (varchar 60)
- nom (varchar 20)
- prenom (varchar 20)
- email (varchar 50)
- civilite (enum : m,f)
- statut (int 3)
- date_enregistrement (datetime)

    `chambre`
- id_chambre (int 3) PK - AI
- titre (varchar 255) 
- description_courte (varchar 255)
- description_longue (text)
- photo (varchar 255)
- prix_journalier (int 3)
- date_enregistrement (datetime)

    `slider`
- id_slider (int 3) PK - AI
- photo (varchar 255) 
- ordre
- date_enregistrement (datetime)

    `commande`
- id_commande (int 3) PK - AI
- id_chambre (int 3) FK
- date_arrivee (date)
- date_depart (date)
- prix_total (int 3)
- prenom
- nom
- telephone
- email
- date_enregistrement (datetime)

5. Etape 4 : Versionner sur gitHub
- Créer un repository
- Utiliser les commandes suivantes pour mettre en ligne 
    $ git add . 
    $ git commit -m "ecrire_un_commentaire_ici"
    $ git push 

Étape 5 : Création des contrôleurs et des routes
- Créez les contrôleur Symfony pour gérer les fonctionnalités liées aux hôtels. 
- Pour panier : 
    ``composer require lexik/make-cart-bundle``
    ``symfony console make:cart``
- Pour la page de connexion 
    ``symfony console make:auth``
- Pour gérer les formulaires d'inscription
    ``symfony console make:registration-form``


- Définissez les routes correspondantes dans le fichier `routes.yaml`. Par exemple, dans le fichier `config/routes.yaml` :
  ```yaml
  liste_hotels:
    path: /hotels
    controller: App\Controller\HotelController::listeHotels
  ```

Étape 6 : Création des vues
- Créez la vue Twig correspondante pour afficher la liste des hôtels. Par exemple, créez un fichier `liste.html.twig` dans le répertoire `templates/hotel` :
  ```twig
  {% extends 'base.html.twig' %}

  {% block content %}
    <h1>Liste des hôtels</h1>
    <ul>
      {% for hotel in hotels %}
        <li>{{ hotel.nom }}</li>
      {% endfor %}
    </ul>
  {% endblock %}
  ```

Étape 7 : Implémentation des fonctionnalités de réservation
- Mettez en œuvre la logique de réservation d'hôtel. Par exemple, ajoutez une action `reserverChambre` dans le contrôleur `HotelController` :
  ```php
  public function reserverChambre(Hotel $hotel): Response
  {
      // Implémentez la logique de réservation
      // ...

      // Renvoyez la réponse appropriée
      return $this->render('hotel/reservation.html.twig', ['hotel' => $hotel]);
  }
  ```

Étape 8 : Ajout de fonctionnalités supplémentaires
- Ajoutez des fonctionnalités supplémentaires à votre site de réservation d'hôtel. Par exemple, créez un contrôleur `ReservationController` pour gérer les réservations d'hôtel.

Étape 9 : Tests et débogage
- Effectuez des tests unitaires et fonctionnels pour vérifier le bon fonctionnement de votre application. Utilisez des outils tels que PHPUnit pour les tests unitaires et Symfony's WebTestCase pour les tests fonctionnels.

Étape 10 : Déploiement de l'application
- Déployez votre application Symfony sur un serveur de production, en configurant les paramètres de sécurité et de performance appropriés. Vous pouvez utiliser des services d'hébergement tels que AWS, Heroku ou déployer sur votre propre serveur.
- Assurez-vous que votre site de réservation d'hôtel fonctionne correctement sur le serveur de production.

N'oubliez pas que ces exemples sont simplifiés et qu'il est nécessaire d'adapter le code en fonction des besoins spécifiques de votre application. Assurez-vous également de consulter la documentation officielle de Symfony (https://symfony.com/doc) pour obtenir des informations détaillées et des exemples plus complets.