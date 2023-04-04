<?php
require_once('db_init.php');
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si les champs de formulaire ont été soumis
    var_dump($_POST);
    if (isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
      $username = $_POST['email'];
      $mot_de_passe = $_POST['mot_de_passe'];
      // Vérifier si l'utilisateur existe dans la base de données
      $request = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE email = :email");
      $request->bindParam(':email', $username, PDO::PARAM_STR);
      $request->execute();
      $user = $request->fetch(PDO::FETCH_ASSOC);

      if ($user && password_verify($_POST['mot_de_passe'], $user['mot_de_passe'])) {
        session_start();
        $_SESSION['email'] = $user['email'];
        $_SESSION['mot_de_passe']=$user['mot_de_passe'];
        header("Location: profil.php");
        echo json_encode(['success' => true]);
        exit();
      } else {
         // retourne un code d'erreur HTTP 401 (Unauthorized)
        echo json_encode(['success' => false, 'message' => 'Nom d\'utilisateur ou mot de passe incorrect.']);
  exit();

      }
    }
}
?>







   