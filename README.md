# TP Luxury Services

## 📑 Cahier des charges

Ce document définit et encadre le projet de création d'un site de recrutement qui comprendra une base clients, une CVthèque des candidats et des candidatures pour les offres d'emploi publiées. 
L'identité graphique préalablement définie sera à intégrer à l'aide des fichiers HTML, CSS & JS fournis par le client : [TP-LuxuryService-Template](https://github.com/g404-dev-web/TP-LuxuryService-Template)

## 💻 Front-office

### Pages

#### 👀 Visiteurs

- 1-1 Page d'accueil
- 1-2 Compagnie
- 1-3 Offres d'emploi
- 1-4 Page contact
- 1-5 Inscription

#### 🤵 Candidats

- 2-1 Mon profil
- 2-2 Se connecter / Mot de passe oublié

### 👀 VISITEURS

#### 1-1 Page d'accueil

- La page d'accueil devra présenter les **10 dernières offres d'emploi** en liste et **filtrable par catégorie**.
- La page d'accueil devra comporter des sections d'appels à l'action pour optimiser la conversion de l'utilisateur en candidat.

#### 1-2 Compagnie

- Cette page de contenu texte et images présentera l'histoire et les services de la plateforme de recrutement.

#### 1-3 Offres d'emploi

- Les offres d'emploi seront présentées en liste et filtrable par catégorie.
- Les offres disponibles ne devront pas afficher le nom du client.
- Seuls les utilisateurs inscrits (= candidats) dont le profil est complété à 100% pourront postuler aux offres d'emploi.

#### 1-4 Page contact

- Cette page comportera :
  - Les informations générales de contact.
  - Un formulaire de contact avec les champs suivants :
    - Prénom
    - Nom
    - Email
    - Téléphone
    - Message
  - Le cabinet de recrutement géolocalisé sur une carte (à intégrer via Google Maps)(Mettre l’adresse de Garage404).

#### 1-5 Inscription

- Le formulaire d'inscription des candidats comportera les champs suivants :
  - Email
  - Mot de passe
- L’utilisateur devra accepter les conditions générales d'utilisation de la plateforme pour finaliser son inscription (checkbox).

### 🤵CANDIDATS

#### 2-1 Mon profil

- Cette page est accessible par les utilisateurs inscrits à la plateforme.
- Le profil est sous la forme d'un formulaire dont la complétion est affichée en pourcentage.
- Les candidats devront avoir un profil complété à 100% pour postuler à une offre d'emploi.
- Les champs du profil sont fournis par le client dans le document suivant : [Champs formulaire candidats](https://docs.google.com/spreadsheets/d/17IH141EIAfFGCSOH48WSkKSEyFPy--2awHtNNzuIRz8/edit?usp=sharing).
- Les candidats pourront aussi modifier leur mot de passe sur cette page et auront la possibilité de supprimer leurs comptes de la plateforme.

#### 2-2 Connexion / Mot de passe oublié

- La connexion des candidats se fait avec la paire d'identifiants email / mot de passe définis lors de l'inscription.
- Un formulaire de récupération de mot de passe permet aux candidats de recevoir un lien de récupération de compte par email.

## 🛠 Back-office

**L'administrateur** se connecte via la même page de connexion que les candidats, mais arrivera sur la page d'accueil de l'administration de la plateforme. Il n'y a pas de templates fournis pour le back office, à vous de le créer. Soyez simples et efficaces.

### Pages

- **1-1 Dashboard (tableau de bord)**
- **1-2 Candidats**
- **1-3 Clients**
- **1-4 Offres d'emploi**
- **1-5 Candidatures**

### 1-1 Dashboard

Le tableau de bord de l'application présentera des statistiques simples telles que :

- Nombre de candidats
- Nombre de clients
- Nombre d'offres d'emploi
- Nombre de candidatures

### 1-2 Candidats

Les candidats seront présentés en liste ordonnée chronologiquement avec les colonnes suivantes :

- Nom / Prénom
- Email
- Ville
- Secteur d'activité
- Disponibilité
- Date d'inscription

L'administrateur pourra :

- Visualiser le profil détaillé d'un candidat, celui-ci reprendra l'ensemble des champs définis dans le document suivant : [Champs formulaire candidats](https://docs.google.com/spreadsheets/d/17IH141EIAfFGCSOH48WSkKSEyFPy--2awHtNNzuIRz8/edit?usp=sharing)
- Télécharger les fichiers uploadés du candidat (bonus)
- Uploader des fichiers sur le candidat
- Visualiser les candidatures en liste ordonnée chronologiquement du candidat
- Ajouter une note via un formulaire simple (textarea) (bonus)
- Créer un nouveau candidat
- Supprimer un candidat

### 1-3 Clients

Les clients seront présentés en liste ordonnée chronologiquement avec les colonnes suivantes :

- Nom de la société
- Nom du contact
- Email du contact
- Téléphone du contact
- Date de création

L'administrateur pourra :

- Visualiser le profil détaillé d'un client, celui-ci reprendra l'ensemble des champs définis dans le document suivant : [Champs formulaires](https://docs.google.com/spreadsheets/d/17IH141EIAfFGCSOH48WSkKSEyFPy--2awHtNNzuIRz8/edit?usp=sharing)
- Ajouter une note via un formulaire simple (textarea) (bonus)
- Créer un nouveau client
- Supprimer un client

### 1-4 Offres d'emploi

Les offres d'emploi seront présentées en liste ordonnée chronologiquement avec les colonnes suivantes :

- Titre de l'offre
- Nom de la société
- Nom du contact
- Email du contact
- Téléphone du contact
- Statut
- Date de création
- Date de clôture

L'administrateur pourra :

- Créer une nouvelle offre d'emploi avec les champs définis dans le document suivant : [Champs formulaire offres](https://docs.google.com/spreadsheets/d/17IH141EIAfFGCSOH48WSkKSEyFPy--2awHtNNzuIRz8/edit?usp=sharing)
- Visualiser la page détaillée d'une offre d'emploi
- Visualiser les candidatures en liste ordonnée chronologiquement pour l'offre
- Ajouter une note via un formulaire simple (textarea) (bonus)
- Modifier le statut d'une offre (activée/désactivée)
- Supprimer une offre d'emploi

### 1-5 Candidatures

Les candidatures seront présentées en liste ordonnée chronologiquement avec les colonnes suivantes :

- Nom du candidat
- Email du candidat
- Titre de l'offre d'emploi
- Nom de la société
- Nom du contact
- Email du contact
- Date du dépôt de candidature

L'administrateur pourra :

- Visualiser la page détaillée d'une candidature, celle-ci reprendra les champs de l'offre d'emploi et les champs du candidat
- Télécharger les fichiers uploadés du candidat
- Ajouter une note via un formulaire simple (textarea)
- Supprimer une candidature

# Consignes et Ressources

## 🖼 Pour faire fonctionner les assets et le CSS, vous devez ajouter dans votre /etc/hosts cette adresse : `54.38.40.80 kys.idmkr.io`

## 1️⃣ Dans un premier temps, explorez la maquette ! Repérez les formulaires à remplir (il y en a au minimum 5) : [Champs formulaires](https://docs.google.com/spreadsheets/d/17IH141EIAfFGCSOH48WSkKSEyFPy--2awHtNNzuIRz8/edit?usp=sharing)

- Le formulaire de création de compte
- Le formulaire de candidature
- Le formulaire de création d'un client (dans l'admin)
- Le formulaire de création d'une offre d'emplois (dans l'admin)
- Le formulaire de contact (optionnel)

## 🆔 Création du diagramme de la BDD

Avant de vous lancer, vous devez réfléchir à la base de données ! Vous devrez concevoir le diagramme avec ses relations entre les tables et le présenter au formateur avant de passer à sa conception.

Vous pourrez ensuite passer par Symfony pour la créer.

## 🙋 Mettre en place une authentification

Utilisez le FormLoginAuthenticator de Symfony : [ici](https://symfony.com/doc/current/security.html#form-login). L'authentification comprend la gestion de la table "user". Une grande partie des pages du site ne sera accessible que si les visiteurs sont authentifiés ou administrateurs.

## 🌱 Donnez vie à vos formulaires

Sur ce projet, nous voulons enregistrer beaucoup de choses dans notre base de données ! Attention, certains champs de formulaires des candidats ne sont visibles que par l'admin.

## 🏃 Dynamisez vos pages

Le contenu de la maquette est en dur, il faut le rendre dynamique !

- La liste des offres d'emplois
- Les données du profil candidat
- La liste des clients du site
- La liste des candidats inscrits sur le site
- Les détails sur les offres d'emplois
- ...

## 📚 Ressources

### **Les relations ManyToOne/OneToMany:**
- [Relation ManyToOne et OneToMany - 1..n - Doctrine 2](https://zestedesavoir.com/tutoriels/1713/doctrine-2-a-lassaut-de-lorm-phare-de-php/les-relations-avec-doctrine-2/relation-manytoone-et-onetomany-1-n/)
- [Annotations Reference - Doctrine Object Relational Mapper (ORM)](https://www.doctrine-project.org/projects/doctrine-orm/en/2.11/reference/annotations-reference.html)

### **L'authentification avec Symfony:**
- [Le composant security sur Symfony](https://symfony.com/doc/current/security.html)
- [YouTube Lior Chamla](https://www.youtube.com/watch?v=_GjHWa9hQic)