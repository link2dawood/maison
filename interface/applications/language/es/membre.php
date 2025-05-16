<?php
session_start();
define('HEADER_TITLE', 'Espace membre');
define('HEADER_DESCRIPTION', 'Devenez membre de notre site change de maison et couch surfing');
define('HEADER_KEYWORDS', 'change de maison, echange de maison, change maison, couch surfing, couchsurfing, couch surfing gratuit, couch gratuit, couch voyage, voyage gratuit, hospitalit gratuite, voyager gratuit, courch surfing, couch surf');

define('H1_DE_LA_PAGE', 'Espace membre');
define('H2_DE_LA_PAGE', 'Mon espace membre');

define('IDENTITE_TITRE', 'Mon identit');
define('IDENTITE_PSEUDO', 'Pseudo');
define('IDENTITE_PASSE', 'Mot de passe');
define('IDENTITE_EMAIL', 'Adresse email');
define('IDENTITE_NOM', 'Nom');
define('IDENTITE_PRENOM', 'Prnom');
define('IDENTITE_ADRESSE', 'Adresse');
define('IDENTITE_CODE_POSTAL', 'Code postal');
define('IDENTITE_VILLE', 'Ville');
define('IDENTITE_PAYS', 'Pays');
define('IDENTITE_PROFESSION', 'Type annonce');
define('IDENTITE_BOUTON', 'Modifier');

define('MON_ANNONCE_TITRE', 'Mon annonce');
define('MON_ANNONCE_DEPOSER', 'Dposer une annonce');
define('MON_ANNONCE_LIBELLE_ECHANGE', 'Echange de maison');
define('MON_ANNONCE_LIBELLE_COUCHSURFING', 'Couchsurfing');
define('MON_ANNONCE_VALIDER', 'Valider');
define('MON_ANNONCE_VOIR', 'Voir');
define('MON_ANNONCE_MODIFIER', 'Modifier');
define('MON_ANNONCE_SUPPRIMER', 'Supprimer');
define('MON_ANNONCE_EN_COURS', 'Mon annonce en cours');

define('MON_ABONNEMENT_TITRE', 'Mon abonnement');
define('MON_ABONNEMENT_DATE_DEBUT', 'Date abonnement');
define('MON_ABONNEMENT_DATE_FIN', 'Date de cloture');
define('MON_ABONNEMENT_SOUSCRIRE', 'Souscrire');
define('MON_ABONNEMENT_RENOUVELLEMENT', 'Renouvellement');
define('MON_ABONNEMENT_GRATUIT', '<span style="font-size:10px;color:green;font-weight:bolder;">[gratuit]</span>');
define('MON_ABONNEMENT_HISTORIQUE', 'Historique');

define('EASYPSEUDO_TITRE', 'Recherche de membre');
define('EASYPSEUDO_LIBELLE', 'Son pseudo');
define('EASYPSEUDO_SUBMIT', 'Rechercher');

define('FAVORI_TITRE', 'Mes contacts favoris');
define('FAVORI_ANCHOR', 'Mes favoris');

define('VOYAGES_COMMENTAIRES_TITRE', 'Mes voyages - mes commentaires');
define('VOYAGES_COMMENTAIRES_TEXTE', 'Votre commentaire sur le site');
define('VOYAGES_COMMENTAIRES_AJOUTER', '+ Ajouter');
define('VOYAGES_COMMENTAIRES_EN_ATTENTE', '[en attente]');
define('VOYAGES_COMMENTAIRES_EN_LIGNE', '[en ligne]');
define('VOYAGES_COMMENTAIRES_BLOG', 'Mon carnet de voyage');
define('VOYAGES_COMMENTAIRES_BLOG_CREER', 'Crer/Modifier');

define('MON_COMPTE_TITRE', 'La gestion de mon compte');
define('MON_COMPTE_DESCRIPTION', HTTP_WARNING.' Vous pouvez  tout moment vous dsinscrire du site ECHANGE-MAISON.BIZ. Par cette action, votre compte sera totalement supprim et vous devrez vous rinscrire pour revenir sur notre site.');
define('MON_COMPTE_MOT_PASSE', 'Veuillez saisir 2 fois votre mot de passe de connexion :');
define('MON_COMPTE_PASSE_1', 'Saisir votre mot de passe :');
define('MON_COMPTE_PASSE_2', 'Ressaisir votre mot de passe :');
define('MON_COMPTE__DESINSCRIPTION', 'Confirmer votre dsinscription');

define('MON_COMPTE_ERREUR_1', 'Nous sommes dsols mais les mots de passes ne sont pas identiques!');
define('MON_COMPTE_ERREUR_2', 'Nous sommes dsols mais le mot de passe dclar ne correspond pas avec celui-ci en ligne!');
define('MON_COMPTE_SUPPRIME', 'Votre compte a t supprim avec tous les fichiers et donnes rattaches!');

define('ESPACE_BLACKLISTAGE_TITRE', 'Liste noire');
define('ESPACE_BLACKLISTAGE_TEXTE', 'Vous souhaitez ne plus tre contact par un membre? Vous pouvez bloquer son accs pour ne plus recevoir de messages par tchat ou courrier.');

define('FORMULAIRE_MODIFIER_IDENTITE', 'Modifier mon identit');
define('FORMULAIRE_MODIFIER_IDENTITE_SUCCES', 'Vous pouvez fermer la fentre !<br />Modification effectue !');
define('FORMULAIRE_MODIFIER_IDENTITE_ERREUR_EMAIL', 'Nous sommes dsols.<br />Cet email n\'est pas valide !');
define('FORMULAIRE_MODIFIER_IDENTITE_ERREUR_TYPE_ECHANGE', 'Nous sommes dsols.<br />Ce type d\'change n\'est pas valide !');
define('FORMULAIRE_ERREUR_IMAGE', 'Nous sommes dsols.<br />Cette image n\'est pas valide !');
define('FORMULAIRE_SUCCES_IMAGE', 'Vous pouvez fermer la fentre !<br />Image charge !');
define('FORMULAIRE_SUPRESSION_IMAGE', 'Vous pouvez fermer la fentre !<br />Image supprime !');

define('FORMULAIRE_AJOUTER_IMAGE_1', 'Ajouter une image N1');
define('FORMULAIRE_AJOUTER_IMAGE_2', 'Ajouter une image N2');
define('FORMULAIRE_AJOUTER_IMAGE_3', 'Ajouter une image N3');
define('FORMULAIRE_AJOUTER_IMAGE_4', 'Ajouter une image N4');
define('FORMULAIRE_MODIFIER_IMAGE_1', 'Modifier une image N1');
define('FORMULAIRE_MODIFIER_IMAGE_2', 'Modifier une image N2');
define('FORMULAIRE_MODIFIER_IMAGE_3', 'Modifier une image N3');
define('FORMULAIRE_MODIFIER_IMAGE_4', 'Modifier une image N4');
define('FORMULAIRE_IMAGE_FORMATS_ACCEPTES', 'formats accepts : jpg, png et gif');

define('BT_SUBMIT_MULTIMEDIA', 'bt_send_fr.png');
define('FORMULAIRE_MULTIMEDIA_VIDEO_OK', 'Flicitation... votre VIDEO a t ajout...<br />Elle va tre contrle par notre quipe!');
define('FORMULAIRE_MULTIMEDIA_VIDEO_ERREUR', 'Nous sommes dsols mais votre enregistrement VIDEO n\'a pas t effectu!');
define('FORMULAIRE_MULTIMEDIA_SUPPRESSION_FICHIER', 'Fichier supprim !');
define('FORMULAIRE_MULTIMEDIA_AUDIO_OK', 'Flicitation... votre enregistrement AUDIO a t ajout...<br />Il va tre contrl par notre quipe!');
define('FORMULAIRE_MULTIMEDIA_AUDIO_ERREUR', 'Nous sommes dsols mais votre enregistrement AUDIO n\'a pas t effectu!');

define('FENETRE_ACTIVE_PASSE', 'Cliquer pour voir !');
define('FENETRE_ACTIVE_PASSE_ALERTE', 'Mon mot de passe est : ');
define('MESSAGE_INFO_ANNONCE_EN_ATTENTE', '<span style="font-size:10px;">[en attente]</span>');
define('MESSAGE_INFO_ANNONCE_VALIDE', '<span style="font-size:10px;">[en ligne]</span>');



?>
