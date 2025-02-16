C'est un projet très simple et basique pour un système de réseau social qui repose uniquement sur la création de publications, l'envoi et la réception de demandes d'ami, ainsi que leur acceptation ou leur refus.

Sur votre page personnelle, vous verrez vos publications ainsi que celles de tous vos amis, classées du plus récent au plus ancien.

Étant un site de test, chaque utilisateur peut se définir comme un simple utilisateur ou un administrateur (cela ne fera aucune différence).
L'utilisateur peut supprimer son compte ou modifier ses informations, comme son nom d'utilisateur et son mot de passe (mais pas son ID).

L'utilisateur peut également télécharger un fichier PDF contenant ses informations de compte de base.

Il est possible de basculer entre les langues arabe et anglais.

Comment faire fonctionner le site ?

Pour exécuter le site, vous aurez besoin de XAMPP.

Lancez Apache et MySQL.

Créez une base de données appelée eco, avec le type utf8mb4_general_ci.

Accédez à la base de données, sélectionnez l'option Importer, puis choisissez le fichier eco.sql depuis les fichiers du projet.

Copiez tous les fichiers du site dans un dossier du projet à l'intérieur du dossier htdocs de XAMPP.

Accéder au site :
Ouvrez votre navigateur et entrez l'adresse suivante :
.
http://localhost/nom_du_dossier_du_projet
.
Vous pouvez maintenant utiliser le site. Toutes les données seront enregistrées, y compris les publications, les amis, et les demandes d'ami en attente de traitement.

Développé par :
Jamal Abou Kassem
