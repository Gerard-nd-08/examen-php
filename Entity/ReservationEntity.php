<?php

class ReservationEntity
{
    private int $id ;
    private string $nom_client;
    private int $numero_chambre;
    private int $nombre_nuits;
    private string $type_chambre;
    private string $statut;

    public function __construct()
    {
        $this->statut = "VALIDEE";
    }

    public function getId(): int{
        return $this->id;
    }

    public function setId(int $id): void{
        $this->id = $id;
    }

    public function getNom_client(): string{
        return $this->nom_client;
    }

    public function setNom_client(string $nom_client): void{
        $this->nom_client = $nom_client;
    }

    public function getNumero_chambre(): int{
        return $this->numero_chambre;
    }

    public function setNumero_chambre(int $numero_chambre): void{
        $this->numero_chambre = $numero_chambre;
    }

    public function getNombre_nuits(): int{
        return $this->nombre_nuits;
    }

    public function setNombre_nuits(int $nombre_nuits): void{
        $this->nombre_nuits = $nombre_nuits;
    }

    public function getType_chambre(): string{
        return $this->type_chambre;
    }

    public function setType_chambre(string $type_chambre): void{
        $this->type_chambre = $type_chambre;
    }

    public function getStatut(): string{
        return $this->statut;
    }

    public function setStatut(string $statut): void{
        $this->statut = $statut;
    }

    public function __toString(): string
    {
        return "ID: {$this->id} | Client: {$this->nom_client} | Chambre: {$this->numero_chambre} | Nuits: {$this->nombre_nuits} | Type: {$this->type_chambre} | Statut: {$this->statut}";
    }

}