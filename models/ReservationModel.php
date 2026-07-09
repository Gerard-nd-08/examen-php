<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../Entity/ReservationEntity.php';


class ReservationModel extends Database
{
    public function __construct()
    {
       parent::__construct();
    }
    public  function selectAll(): array
    {
      try {
        $this->openConnexion();
        $sql = "SELECT * FROM " . $this->tableName;
        $stm= $this->pdo->prepare($sql);
        $stm->execute();
        $this->closeConnexion();
        return   $stm->fetchAll(\PDO::FETCH_CLASS,$this->classeName);
      } catch (\PDOException $e) {
        echo "Connection failed " . $e->getMessage();
        return [];
      }
    }

    public  function insert(ReservationEntity $reservation): int
    {
        $this->openConnexion();

        $nom=$reservation->getNom_client();
        $numero=$reservation->getNumero_chambre();
        $nuits=$reservation->getNombre_nuits();
        $type=$reservation->getType_chambre();
        $statut=$reservation->getStatut();

        $sql = "INSERT INTO " . $this->tableName . " (nom_client,numero_chambre, nombre_nuits, type_chambre, statut) 
        VALUES ( '$nom', '$numero', '$nuits', '$type', '$statut')";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $this->closeConnexion();
        return $stmt->rowCount();
    }

    public function update(ReservationEntity $reservation): int
    {
        $this->openConnexion();

        $id=$reservation->getId();
        $nom=$reservation->getNom_client();
        $numero=$reservation->getNumero_chambre();
        $nuits=$reservation->getNombre_nuits();
        $type=$reservation->getType_chambre();
        $statut="ANNULEE";

        $sql = "UPDATE " . $this->tableName . " SET nom_client='$nom', numero_chambre='$numero', nombre_nuits='$nuits', type_chambre='$type', statut='$statut' WHERE id='$id'";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $this->closeConnexion();
        return $stmt->rowCount();
    }

    public function selectByStatut(string $statut): array
    {
        $this->openConnexion();

        $sql = "SELECT * FROM " . $this->tableName . " WHERE statut='$statut'";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $this->closeConnexion();
        
        return   $stmt->fetchAll(\PDO::FETCH_CLASS,$this->classeName);
    }

    public function selectLongSejour(): array
    {
        $this->openConnexion();

        $sql = "SELECT * FROM reservations WHERE statut = 'VALIDEE' AND nombre_nuits = (
                SELECT MAX(nombre_nuits) FROM reservations WHERE statut = 'VALIDEE'
            )";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $this->closeConnexion();

        return $stmt->fetchAll(\PDO::FETCH_CLASS,$this->classeName);
    }

}