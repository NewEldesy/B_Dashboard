<?php
    include_once('partials/header.php');
?>


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-users fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Nombre Clients</p>
                                <h6 class="mb-0"><?=$client;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-tag fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Nombre Interventions</p>
                                <h6 class="mb-0"><?=$intervention;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-copy fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Nombre Prestations</p>
                                <h6 class="mb-0"><?=$prestation;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-list fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Nombre Services</p>
                                <h6 class="mb-0"><?=$service;?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Cout Prestation</p>
                                <h6 class="mb-0"><?=$coutPrestation;?> XOF</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Cout Intervention</p>
                                <h6 class="mb-0"><?=$coutIntervention;?> XOF</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fas fa-battery-half fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Cout Intervention En Cours</p>
                                <h6 class="mb-0"><?=$enCours;?> XOF</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fas fa-battery-full fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Cout Intervention Terminé</p>
                                <h6 class="mb-0"><?=$termine;?> XOF</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Cout Prestation</p>
                                <h6 class="mb-0"><?=$coutPrestation;?> XOF</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Cout Intervention</p>
                                <h6 class="mb-0"><?=$coutIntervention;?> XOF</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fas fa-battery-half fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Cout Intervention En Cours</p>
                                <h6 class="mb-0"><?=$enCours;?> XOF</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fas fa-battery-full fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Cout Intervention Terminé</p>
                                <h6 class="mb-0"><?=$termine;?> XOF</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

<?php
    include_once('partials/footer.php');
?>