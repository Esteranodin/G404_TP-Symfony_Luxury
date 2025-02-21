# G404-Luxury-Services

* Installer les **dépendances** : 

    ```bash
    composer install
    ```

* Dupliquer le fichier `.env` et le renommer `.env.local`

* Mettre vos informations de **connexion** à la base de donnée

* Créer la BDD :
    
    ```bash
    php bin\console d:d:c
    ```

* Si il y en a, executez les **migrations** :

    ```bash
    php bin\console d:m:m
    ```

* Mettre vos variables d'environnement **Mailtrap**

* Faire tourner Messenger pour les tâches asynchrone comme l'envoie de mail :

    ```bash
    php bin/console messenger:consume async -vv
    ```

* Les **icones** : https://fontawesome.com/v4/icons/

# TO DO / FINISH

* Mettre tous les **Asserts**
* Verifier les **Flash**