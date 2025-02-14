<?php
require_once __DIR__ . '/Bdd.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getUserByEmail($email) {
        try {
            $query = "SELECT * FROM users WHERE mail = :mail";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':mail' => $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne les infos de l'utilisateur si trouvé
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
            return false;
        }
    }   


    // Crée un nouvel utilisateur
    public function createUser($nom, $prenom, $email, $hashedPassword, $droits) {
        try {
            $query = "INSERT INTO users (nom, prenom, mail, password, droits) VALUES (:nom, :prenom, :mail, :password, :droits)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':mail' => $email,
                ':password' => $hashedPassword,
                ':droits' => $droits
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage(); 
            return false;
        }
    }   
}
?>
