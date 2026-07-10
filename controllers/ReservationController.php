<?php
require_once __DIR__ . '/../models/ReservationModel.php';


class ReservationController{
    private ReservationModel $model;

    public function __construct()
    {
        $this->model = new ReservationModel();
    }

    public function createReservation(){
        $nom=trim($_POST['nom']??'');
        $numero_chambre=trim($_POST['numero_chambre']??'');
        $nombre_nuits=trim($_POST['nombre_nuits']??'');
        $type_chambre=trim($_POST['type_chambre']??'');
          
        $r=new reservationEntity();
        $r->setNom_client($nom);
        $r->setNumero_chambre($numero_chambre);
        $r->setNombre_nuits($nombre_nuits);
        $r->setType_chambre($type_chambre);

        $this->model->insert($r);

        $reservations = $this->model->selectByStatut("VALIDEE");
        $ca=$this->calculCA($reservations);
        $viewData = [
        "data" => $reservations,
        "errors" => [],
        "ca" => $ca,
        "old" => []
            ];
        require_once __DIR__ . '/../views/web/reservation.html.php';

    }

    public static function verifiePositif(int $valeur): bool
    {
        if ($valeur <= 0) {
            echo "La valeur doit être un entier positif.\n";
            return false;
        }
        return true;
    }

    public function listerReservationActive(): void
    {
        $reservations = $this->model->selectByStatut("VALIDEE");
        
        $ca=$this->calculCA($reservations);
        $viewData = [
        "data" => $reservations,
        "errors" => [],
        "ca" => $ca,
        "old" => []
            ];
        require_once __DIR__ . '/../views/web/reservation.html.php';
    }

    public function annulerReservations(): void
    {
        $id = (int)trim($_POST['id'] ?? '');
        $reservation = $this->model->selectById($id);
        if ($reservation !== null && $reservation->getStatut() === "VALIDEE") {
            $this->model->update($reservation);
        }
        $reservations = $this->model->selectByStatut("VALIDEE");
        $viewData = [
            "data"    => $reservations,
            "errors"  => [],
            "ca"      => $this->calculCA($reservations),
            "old"     => []
        ];
        require_once __DIR__ . '/../views/web/reservation.html.php';
    }

    public function calculCA(array $reservations): float
    {
        $caTotal = 0;
        foreach ($reservations as $reservation) {
            if ($reservation->getType_chambre() === "STANDARD") {
                $prix = 25000;
            } elseif ($reservation->getType_chambre() === "CONFORT") {
                $prix = 50000;
            } elseif ($reservation->getType_chambre() === "SUITE") {
                $prix = 100000;
            }
            $caTotal += $prix * $reservation->getNombre_nuits();
        }
        return $caTotal;
    }

}