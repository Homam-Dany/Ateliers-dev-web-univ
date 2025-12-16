<?php
// =================================================================
// 1. CONFIGURATION et CONNEXION à la base de données (PDO)
// =================================================================

$host = 'localhost';
$db_minichat = 'test1'; 
$user = 'root';
$pass = ''; // Modifie si ton mot de passe est différent

// Variable pour stocker les messages d'erreur ou de succès
$message_status = "";

try {
    // Connexion PDO
    $bdd = new PDO(
        "mysql:host=$host;dbname=$db_minichat;charset=utf8", 
        $user, 
        $pass, 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    $message_status = 'Erreur de connexion à la base de données : ' . $e->getMessage();
}

// =================================================================
// 2. LOGIQUE D'AJOUT DE MESSAGE (POST - Insertion)
// =================================================================

if (isset($_POST['pseudo']) && isset($_POST['message'])) {
    if (isset($bdd)) { // Connexion OK
        try {
            $req = $bdd->prepare('INSERT INTO minichat (pseudo, message) VALUES(?, ?)');
            $req->execute([$_POST['pseudo'], $_POST['message']]);
            $message_status = "Message envoyé avec succès !";
        } catch (Exception $e) {
            $message_status = "Erreur lors de l'insertion du message : " . $e->getMessage();
        }
    } else {
        $message_status = "Impossible d'envoyer le message : connexion à la base échouée.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>MiniChat Complet (PDO)</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; flex-direction: column; align-items: center; padding: 20px; }
        .container { width: 90%; max-width: 500px; }
        .message-form { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; }
        .chat-container { 
            border: 2px solid #007bff; 
            padding: 15px; 
            height: 300px; 
            overflow-y: scroll; 
            background-color: #f8f9fa; 
        }
        .message-chat p { margin: 5px 0; padding: 5px; border-bottom: 1px dotted #eee; color: black; }
        .message-chat strong { color: #333; }
        .status { background: #d35400; color: white; padding: 10px; text-align: center; margin-bottom: 10px; }
        label { display: inline-block; width: 80px; }
    </style>
</head>
<body>

<div class="container">

    <?php if ($message_status): ?>
        <div class="status"><?php echo htmlspecialchars($message_status); ?></div>
    <?php endif; ?>

    <div class="message-form">
        <h2>Envoyer un message</h2>
        <form action="" method="post">
            <p>
                <label for="pseudo">Pseudo</label> : 
                <input type="text" name="pseudo" id="pseudo" required /><br /><br>

                <label for="message">Message</label> : 
                <input type="text" name="message" id="message" required /><br /><br>

                <input type="submit" value="Envoyer" />
            </p>
        </form>
    </div>

    <hr>

    <h3>Messages Récents</h3>
    <div class="chat-container">
        <?php
        if (isset($bdd)) {
            try {
                $reponse = $bdd->query('SELECT pseudo, message FROM minichat ORDER BY ID DESC LIMIT 10');

                while ($donnees = $reponse->fetch()) {
                    echo '<p class="message-chat"><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
                }
                $reponse->closeCursor();
            } catch (Exception $e) {
                echo "<p style='color: red;'>Erreur de lecture des messages : " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        } else {
            echo "<p>Base de données non accessible. Veuillez vérifier la connexion.</p>";
        }
        ?>
    </div>
</div>
</body>
</html>
