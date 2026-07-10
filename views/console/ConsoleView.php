<?php

require_once __DIR__ . '/Entity/ReservationEntity.php';

class ConsoleView
{
    public function __construct()
    {
    }

    public static function saisirReservation(): ReservationEntity
    {
        do{
            $nom = readline("Nom du client : ");
            if(empty($nom)){
                echo "Le nom du client ne peut pas être vide.\n";
            }
        }while(empty($nom));

        do{
            $numero = (int) readline("Numéro chambre : ");
            if (!ReservationController::verifiePositif($numero)) {
                echo "Numéro de chambre invalide.\n";
            }
        }while(!ReservationController::verifiePositif($numero));

        do{
            $nuits = (int) readline("Nombre de nuits : ");
            if (!ReservationController::verifiePositif($nuits)) {
                echo "Nombre de nuits invalide.\n";
            }
        }while(!ReservationController::verifiePositif($nuits));

        do{
            $ch = readline("Type de chambre (1-STANDARD, 2-CONFORT, 3-SUITE) : ");
            switch ($ch) {
                case '1':
                    $type = "STANDARD";
                    break;
                case '2':
                    $type = "CONFORT";
                    break;
                case '3':
                    $type = "SUITE";
                    break;
                default:
                    echo "Type de chambre invalide.\n";
            }
        }while(ch!=1 && ch!=2 && ch!=3);

        $r=new Reservation();
        $r->setNom_client($nom);
        $r->setNumero_chambre($numero);
        $r->setNombre_nuits($nuits);
        $r->setType_chambre($type);
        
        return $r;
    }

    public static function saisieId(): int
    {
        do{
            $id = (int) readline("ID de la réservation : ");
            if (!ReservationController::verifiePositif($id)) {
                echo "ID invalide.\n";
            }
        }while(!ReservationController::verifiePositif($id));

        return $id;
    }

    public static function afficherReservations(array $reservations): void
    {
        if (empty($reservations)) {
            echo "Aucune réservation validée.\n";
            return;
        }
        foreach ($reservations as $reservation) {
            echo $reservation->__toString()."\n";
        }
    }
   
}