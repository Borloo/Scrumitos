<?php
  // Vérifiez si le formulaire de recherche a été soumis
  if (isset($_GET['search'])) {
    // Récupérez la valeur saisie dans le champ de recherche
    $search = $_GET['search'];
    
    // Requête SQL pour rechercher dans la base de données
    $sql = "SELECT * FROM Emplacement WHERE Nom_Emplacement LIKE '%$search%'";
    
    // Exécutez la requête SQL
    $result = mysqli_query($conn, $sql);

    // Affichez les résultats dans un tableau HTML
    if (mysqli_num_rows($result) > 0) {
      echo "<table>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["colonne1"] . "</td>";
        // Ajoutez des colonnes supplémentaires pour chaque champ que vous souhaitez afficher
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "Aucun résultat trouvé.";
    }
  }
?>
