<?php

require_once __DIR__ . '/Controllers/ReservationController.php';
class Router
{
    private function __construct()
    {
        // constructor vide pour empêcher l'instanciation de la classe
    }

    public  static  function run():void
    {
        $controller = new ReservationController();

        $uri=$_SERVER['REQUEST_URI'];
        switch ($uri) {
            case '/reservation/index':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['annul'])) {
                        $controller->annulerReservations();
                    } else {
                        $controller->createReservation();
                    }
                } else {
                    $controller->listerReservationActive();
                }
                break;
            default:
                $controller->listerReservationActive();
                break;
            }
              
    }
}

Router::run();
