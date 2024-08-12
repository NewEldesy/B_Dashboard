<?php
    $client = getNbClient();
    $intervention = getNbIntervention();
    $prestation = getNbPrestation();
    $service = getNbService();
    $coutPrestation = totalCoutP();
    $coutIntervention = totalCoutI();
    $formationDispo = countUpcomingFormations();
    $participant = getNbParticipant();
    $coutFormation = totalCoutFormation(); //var_dump($coutIntervention); exit;
    $nbFacture = countInvoices();
    $nbfPaye = countPaidInvoices();
    $nbfnPaye = countUnpaidInvoices();
    $totalFPaye = TotalPaidInvoices();
    $totalFNpaye = TotalUnPaidInvoices();
    include_once('app/dashboard.php');
    exit;