<?php
include "connect.php"; // Inclure le fichier de connexion

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Traiter les données du client
    $nomClient = escape($_POST['client']);
    $adresseClient = escape($_POST['adresse']);
    $telephoneClient = escape($_POST['telephone']);

    // Traiter les autres données de la partie "Client"
$dateDemande = escape($_POST['dateDemande']);
$dateIntervention = escape($_POST['dateIntervention']);
$numChantier = escape($_POST['numChantier']);
$interventionDemandee = escape($_POST['interventionDemandee']);
$numDemande = escape($_POST['numDemande']); // Nouveau champ "numéro de demande"

// Préparer et exécuter la requête SQL pour insérer les données du client
$sqlInsertClient = "INSERT INTO clients (nom, adresse, telephone) VALUES (?, ?, ?)";
$stmtInsertClient = $conn->prepare($sqlInsertClient);
$stmtInsertClient->bind_param("sss", $nomClient, $adresseClient, $telephoneClient);

if ($stmtInsertClient->execute()) {
    $clientID = $stmtInsertClient->insert_id; // ID du client inséré
    // Utilise $clientID comme référence pour d'autres parties du formulaire si nécessaire

    // Insérer les autres données de la partie "Client"
    $sqlInsertIntervention = "INSERT INTO interventions (client_id, date_demande, date_realisation, intervenant, numero_chantier, numero_demande) VALUES (?, ?, ?, ?, ?, ?)";
    $stmtInsertIntervention = $conn->prepare($sqlInsertIntervention);
    $stmtInsertIntervention->bind_param("isssss", $clientID, $dateDemande, $dateIntervention, $interventionDemandee, $numChantier, $numDemande);

    if ($stmtInsertIntervention->execute()) {
        // Traitement réussi
    } else {
        echo "Une erreur s'est produite lors de l'insertion des données d'intervention.";
    }
}


    $stmtInsertClient->close();
}

    // Le reste du traitement pour les autres parties du formulaire
    // ...
    // Traiter les données de la partie "Désignation Travaux"
    $designationTravaux = $_POST['designationTravaux'];
    $refArticles = $_POST['refArticles'];
    $quantite = $_POST['quantite'];
    $prixUnitaire = $_POST['prixUnitaire'];

    // Boucler à travers les données de la partie "Désignation Travaux"
    for ($i = 0; $i < count($designationTravaux); $i++) {
        $designation = escape($designationTravaux[$i]);
        $refArticle = escape($refArticles[$i]);
        $qte = intval($quantite[$i]);
        $prix = floatval($prixUnitaire[$i]);

        // Préparer et exécuter la requête SQL pour insérer les données de la désignation des travaux
        $sqlInsertTravaux = "INSERT INTO travaux (intervention_id, designation, reference_article, quantite, prix_unitaire) VALUES (?, ?, ?, ?, ?)";
        $stmtInsertTravaux = $conn->prepare($sqlInsertTravaux);
        $stmtInsertTravaux->bind_param("isssd", $interventionID, $designation, $refArticle, $qte, $prix);

        if ($stmtInsertTravaux->execute()) {
            // Traitement réussi
        } else {
            echo "Une erreur s'est produite lors de l'insertion des données de la désignation des travaux.";
        }

        $stmtInsertTravaux->close();
    }

    // Traiter les données de la partie "Main d'œuvre"
    $jours = $_POST['jour'];
    $techniciens = $_POST['technicien'];
    $heures = $_POST['heures'];
    $forfaits = $_POST['forfait'];
    $observations = $_POST['observations'];

    // Boucler à travers les données de la partie "Main d'œuvre"
    for ($i = 0; $i < count($jours); $i++) {
        $jour = escape($jours[$i]);
        $technicien = escape($techniciens[$i]);
        $heure = floatval($heures[$i]);
        $forfait = floatval($forfaits[$i]);
        $observation = escape($observations[$i]);

        // Préparer et exécuter la requête SQL pour insérer les données de la main d'œuvre
        $sqlInsertMainOeuvre = "INSERT INTO planification (intervention_id, jour_semaine, technicien, heures_passees, forfait_deplacement, observations) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInsertMainOeuvre = $conn->prepare($sqlInsertMainOeuvre);
        $stmtInsertMainOeuvre->bind_param("isssds", $interventionID, $jour, $technicien, $heure, $forfait, $observation);

        if ($stmtInsertMainOeuvre->execute()) {
            // Traitement réussi
        } else {
            echo "Une erreur s'est produite lors de l'insertion des données de la main d'œuvre.";
        }

        $stmtInsertMainOeuvre->close();
    }

    // Le reste du traitement pour les autres parties du formulaire
    // ...

    // Traiter les données de la partie "Signatures"
    $clientSignature = escape($_POST['clientSignature']);
    $technicienSignature = escape($_POST['technicienSignature']);

    // Préparer et exécuter la requête SQL pour insérer les données de signatures
    $sqlInsertSignatures = "INSERT INTO signatures (intervention_id, client_signature, technicien_signature) VALUES (?, ?, ?)";
    $stmtInsertSignatures = $conn->prepare($sqlInsertSignatures);
    $stmtInsertSignatures->bind_param("iss", $interventionID, $clientSignature, $technicienSignature);

    if ($stmtInsertSignatures->execute()) {
        // Traitement réussi
    } else {
        echo "Une erreur s'est produite lors de l'insertion des données de signatures.";
    }

    $stmtInsertSignatures->close();

    
?>
