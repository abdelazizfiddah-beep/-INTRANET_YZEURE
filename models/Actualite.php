<?php
class Actualite
{
    private $conn;
    private $table = 'actualites';

    public $id;
    public $titre;
    public $contenu;
    public $date_publication;
    public $auteur_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getRecent($limit = 5)
    {
        $query = "SELECT a.*, u.nom, u.prenom 
                  FROM " . $this->table . " a
                  LEFT JOIN users u ON a.auteur_id = u.id
                  ORDER BY a.date_publication DESC
                  LIMIT :limit";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
