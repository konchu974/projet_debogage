<!-- Fini  -->

**Librairies**
<!-- 
J'ai l'impression que certaines librairies ne sont pas utilisées. 
Pouvez-vous vérifier et supprimer celles qui ne sont pas nécessaires ? 
-->

**Compatibilité navigateurs et W3C** 

<!-- Nous aimerions savoir sur quel navigateur le site est compatible et si les formulaires sont valides W3C.
N'hésitez pas à faire un audit de sécurité si vous le souhaitez, j'ai un peu peur que le site soit vulnérable.

FireFox, Opera Gx, Google Chrome, Edge, Brave

à tester d'autre navigateur  
-->

**Vendor**

<!-- 
Dans config.php et connection.php il y a une ligne "Pourquoi pas utiliser un .ENV ?" se renseigner et faire ça
il faut utiliser 
-->

**Formulaire de contact**

<!-- 
Pouvez-vous faire en sorte que le formulaire de contact nous envoie un email ?
De plus, la validation du formulaire est un peu violente.. pouvez-vous l'adoucir et rendre le formulaire plus "user friendly" ? 
-->

**Apostrophes dans ses mails**

<!-- 
L'utilisateur peut envoyer des mails avec des apostrophes sans erreurs 
-->

**Validation des formulaires**

<!-- 
Je n'ai pas trop compris comment fonctionne l'envoi de formulaire. 
Pouvez-vous regarder cela et uniformiser si besoin ? Nous avons besoin de faire les calculs côté serveur et non côté client. (pour les logs d'analytics)
Nous avons aussi besoin d'une validation côté back, je n'ai pas l'impression que cela soit le cas actuellement. 
-->


**mL en Litre et Litre en mL**

<!-- 
L'utilisateur peut convertir des millilitres en litres et des litres en millilitres 
-->

**Choisir sa device**

<!-- 
Un utilisateur nous a demandé de pouvoir choisir sa devise (ex: CAD vers JPY / GBP vers USD) dans le formulaire euro-dollars. 
-->

**Code front et back**

<!-- 
Il y a beaucoup de code inutile dans le projet.
Pouvez-vous faire le ménage et supprimer tout ce qui n'est pas utilisé ? 
-->

 <!-- Peut être d'autre bout de code qui ne sont pas utilisé mais 2 fonction pas utilisée de sûr -->

**Bootstrap**

<!--
Bootstrap, comme de nombreuses librairies, semble être chargé depuis un CDN. 
Il serait préférable de le télécharger et de le charger localement. 
Qu'en pensez-vous ?  

J'ai aussi remarqué que bootstrap est en version 4 alors que la version 5 est sortie récemment. 
-->


<!-- Fini  -->


<!-- Code pas utiliser -->

<!-- Fichier database.php, ligne 75-78, fonction find pas utilisée -->
<!-- Fichier router.php, ligne 33-36, fonction redirect pas utilisée -->