<?php



// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include "connect.php"; // Inclure le fichier de connexion


// Récupérer le numéro de demande à partir de la requête GET
if (isset($_POST['numero'])) {
    $numeroDemande = $_POST['numero'];

    // Requête SQL pour récupérer les informations d'intervention, du client associé et du numéro de demande
    // $sql = "SELECT i.numero_demande, c.nom AS nom_client, i.date_demande, i.date_realisation, i.numero_chantier
    //         FROM interventions AS i
    //         INNER JOIN clients AS c ON i.client_id = c.id
    //         WHERE i.numero_demande = ?";
            // Requête SQL pour récupérer les informations d'intervention, du client associé et du numéro de demande
            $sql = "SELECT *
                    FROM interventions 
                    INNER JOIN clients  ON interventions.client_id = clients.id
                    WHERE interventions.numero_demande = ?";
 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $numeroDemande);
    $stmt->execute();
    $result = $stmt->get_result();


    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        
        // Afficher les données récupérées
        echo "Numéro de demande : " . $row['numero_demande'] . "<br>";
        echo "Nom du client : " . $row['nom'] . "<br>";
        echo "Date de demande : " . $row['date_demande'] . "<br>";
        echo "Date de réalisation : " . $row['date_realisation'] . "<br>";
        echo "Numéro de chantier : " . $row['numero_chantier'] . "<br>";

        
    } else {
        echo "Aucune intervention trouvée avec ce numéro de demande.";
    }

    $stmt->close();
}
?>
