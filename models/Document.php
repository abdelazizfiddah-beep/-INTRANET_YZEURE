<?php
class Document
{
    private $conn;
    private $table = 'documents';

    public $id;
    public $titre;
    public $description;
    public $categorie;
    public $fichier;
    public $date_creation;
    public $auteur_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll($categorie = null)
    {
        $query = "SELECT d.*, u.nom, u.prenom 
                  FROM " . $this->table . " d
                  LEFT JOIN users u ON d.auteur_id = u.id";

        if ($categorie) {
            $query .= " WHERE d.categorie = :categorie";
        }

        $query .= " ORDER BY d.date_creation DESC";

        $stmt = $this->conn->prepare($query);

        if ($categorie) {
            $stmt->bindParam(':categorie', $categorie);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($terme)
    {
        $query = "SELECT d.*, u.nom, u.prenom 
                  FROM " . $this->table . " d
                  LEFT JOIN users u ON d.auteur_id = u.id
                  WHERE d.titre LIKE :terme 
                  OR d.description LIKE :terme
                  ORDER BY d.date_creation DESC";

        $stmt = $this->conn->prepare($query);
        $terme = "%{$terme}%";
        $stmt->bindParam(':terme', $terme);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
