<?php

require_once __DIR__ . '/Controllers/ReservationController.php';
require_once __DIR__ . '/Views/Console/ConsoleView.php';
require_once __DIR__ . '/Models/ReservationModel.php';
require_once __DIR__ . '/Entity/ReservationEntity.php';


function main():void{
    $controller = new ReservationController();
    do {
        echo "1 - Créer une réservation\n";
        echo "2 - Afficher les réservations actives\n";
        echo "3 - Annuler une réservation\n";
        echo "4 - Calculer le chiffre d'affaires\n";
        echo "5 - Afficher le plus long séjour\n";
        echo "6 - Quitter\n";

        $choix = readline("Votre choix : ");

        switch ($choix) {
            case 1:
                $reservation = ConsoleView::saisirReservation();
                $controller->ajouterReservation($reservation);
                echo "Réservation enregistrée avec succès.\n";
                break;

            case 2:
                $reservations = $controller->listerReservationActive();
                ConsoleView::afficherReservations($reservations);
                break;

            case 3:
                $id = ConsoleView::saisieId();
                echo $controller->annulerReservation($id) ;
                break;

            case 4:
                $reservations = $controller->listerReservationActive();
                $ca = $controller->calculCA($reservations);
                echo "\nChiffre d'affaires prévisionnel : ".$ca. " FCFA\n";
                break;

            case 5:
                $reservations = $controller->getLongSejour();
                if (empty($reservations)) {
                    echo "Aucun séjour trouvé.\n";
                } else {
                    ConsoleView::afficheLongSejour($reservations);
                }
                break;

            case 6:
                echo "Au revoir !\n";
                break;

            default:
                echo "Choix invalide.\n";
        }

    } while ($choix != 6);
}

main();