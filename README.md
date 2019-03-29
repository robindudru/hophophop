# BrewMate
# Une base de données de recettes de bières développée avec Symfony 4
#
#
# Pour installer le projet, vous devez avoir un environnement Symfony et yarn installé sur votre ordinateur.
#
# Dans votre CLI préférée, rendez vous dans le dossier du projet, et exécutez les commandes :
# composer install
# yarn install
# 
# Vous aurez alors installé tous les bundles utilisés par BrewMate.
#
# Importez la base de données fournie sur votre serveur local.
# Vous devez maintenant configurer la base de données. Rendez-vous dans le fichier env à la racine du projet.
# A la ligne 27, éditez les données de connexion à votre base de données comme suit :
# DATABASE_URL=mysql://nom-d-utilisateur:mot-de-passe@127.0.0.1:3306/nom-de-la-base-donnees
#
# Si vous utilisez WAMP et que vous gardez le nom hophophop, vous n'avez rien à toucher.
#
# Ensuite, lancez le serveur avec la la commande 
# php bin/console server:run
#
# Vous devez maintenant générer le build de nos assets. Pour cela, vous devez lancer la commande
# yarn encore dev --watch
# Vous avez maintenant vos assets. Si vous les modifiez, le build sera regénéré automatiquement.
#
# Pour tester les fonctionnalités du site, vous avez 2 comptes avec les roles Utilisateur et Administrateur pré-enregistrés.
#
# Compte administrateur:
# mail: admin@admin.com
# mot de passe: password
#
# Compte Utilisateur:
# mail: user@user.com
# mot de passe: password
#
# C'est bon, vous avez BrewMate sur votre machine !