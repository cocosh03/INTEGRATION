<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {

// connexion à la base de données

    $db_username = 'root';
    $db_password = 'cotiro-x-54';
    $db_name = 'db_web';
    $db_host = '127.0.0.1';
    $db = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    $username = mysqli_real_escape_string($db, htmlspecialchars($_POST['username']));
    $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));

    if ($username !== "" && $password !== "") {
        $requete = "SELECT COUNT(*) FROM utilisateur WHERE nom_utilisateur = '" . $username . "' AND mot_de_passe = '" . $passvword . "' ";
        $exec_requete = mysqli_query($db, $requete);
        $reponse = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if ($count != 0) {
            $_SESSION['username'] = $username;
            header('Location : principale.php');
        } else {
            header('Location : login.php?erreur = 1'); // user ou mdp incorrect
        }
    } else {
        header('Location : login.php?erreur = 2'); // user ou mdp vide
    }
} else {
    header('Location : login.php');
}
mysqli_close($db);