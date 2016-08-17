<?php
include("../../view/template/top.view.php");
?>

<body onLoad="init()">

<?php
include("../../view/template/menu.view.php");

?>

    <div class="container-fluid">
        <!--        <form class="form col-md-8 col-md-offset-2" role="form" id="odmForm" method="post" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">-->
        <form class="form col-md-10 col-md-offset-1" role="form" id="odmForm" method="post" action="traitement.ctrl.php">

            <div class="form-group">
                <br><p><em>* champs obligatoires</em></p>
            </div>
            <!-- ###################################################################################################### -->
            <!--          VOTRE STATUT     -->
            <!-- ###################################################################################################### -->
            <div class="form-group well" style="background-color:lavender;" id="statutDiv">
                <div class="well"><h4><span class="glyphicon glyphicon-user"></span> Votre statut<em> *</em></h4>
                    <div class="row">
                        <div class="col-sm-4 well" style="background-color:lavender;">
                            <label class="radio-inline testradio" for="personnel"><input type="radio" id="personnel" value="Personnel" name="statut_user" required>Personnel / Stagiaire</label>

                            <div id="divPersonnelSub" class="well" style="background-color:#bce8f1;" hidden>
                                <p class="alert alert-info"><strong>Préciser<em> *</em></strong></p>
                                <div class="radio">
                                    <label for="persAgefpi"><input type="radio" id="persAgefpi" value="1" name="radioPersonnel" class="radioPersonnel" >Personnel Agefpi</label>
                                </div>
                                <div class="radio">
                                    <label for="nonPermAgefpi"><input type="radio" id="nonPermAgefpi" value="2" name="radioPersonnel" class="radioPersonnel">Non permanent Agefpi</label>
                                </div>
                                <div class="radio">
                                    <label for="persInp"><input type="radio" id="persInp" value="3" name="radioPersonnel" class="radioPersonnel">Personnel Inp</label>
                                </div>
                                <div class="radio">
                                    <label for="nonPermInp"><input type="radio" id="nonPermInp" value="4" name="radioPersonnel" class="radioPersonnel">Non permanent Inp</label>
                                </div>
                                <div class="radio">
                                    <label for="statutAutre"><input type="radio" id="statutAutre" value="12" name="radioPersonnel" class="radioPersonnel">Autre</label>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-4 well" style="background-color:lavenderblush;">
                            <label class="radio-inline" for="apprenti"><input type="radio" id="apprenti" value="Apprenti" name="statut_user">Apprenti</label>

                            <div id="divApprentiSub" hidden>
                                <div class="form-group">
                                    <p class="alert alert-warning"><strong>Préciser<em> *</em></strong></p>
                                    <div class="radio">
                                        <label for="inge3"><input type="radio" id="inge3" value="5" class="ingeLpro" name="radioApprenti">Cycle ingénieur en 3 ans</label>
                                    </div>

                                    <div id="divInge3" class="well" hidden>
                                        <p class="alert alert-info"><strong>Préciser<em> *</em></strong></p>
                                        <div class="radio">
                                            <label for="inge3a1"><input type="radio" id="inge3a1" value="1re_annee" name="radioCycle3" class="radioEtudiantApprentiM radioApprenti radioInge3">1ère année</label>
                                        </div>
                                        <div class="radio">
                                            <label for="inge3a2"><input type="radio" id="inge3a2" value="2e_annee" name="radioCycle3" class="radioEtudiantApprentiM radioApprenti radioInge3">2ème année</label>
                                        </div>
                                        <div class="radio">
                                            <label for="inge3a3"><input type="radio" id="inge3a3" value="3e_annee" name="radioCycle3" class="radioEtudiantApprentiM radioApprenti radioInge3">3ème année</label>
                                        </div>
                                    </div>

                                    <div class="radio">
                                        <label for="inge2"><input type="radio" id="inge2" value="6" class="ingeLpro" name="radioApprenti">Cycle ingénieur en 2 ans</label>
                                    </div>

                                    <div id="divInge2" class="well" hidden>
                                        <p class="alert alert-info"><strong>Préciser<em> *</em></strong></p>
                                        <div class="radio">
                                            <label for="inge2a2"><input type="radio" id="inge2a2" value="2e_annee" name="radioCycle2" class="radioEtudiantApprentiM radioApprenti radioInge2">2ème année</label>
                                        </div>
                                        <div class="radio">
                                            <label for="inge2a3"><input type="radio" id="inge2a3" value="3e_annee" name="radioCycle2" class="radioEtudiantApprentiM radioApprenti radioInge2">3ème année</label>
                                        </div>
                                    </div>

                                    <div class="radio">
                                        <label for="lpro"><input type="radio" id="lpro" value="7" name="radioApprenti" class="radioEtudiantApprentiM radioApprenti ingeLpro">Licence professionnelle</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 well" style="background-color:lavender;">
                            <label class="radio-inline" for="etudiant"><input type="radio" id="etudiant" value="Etudiant" name="statut_user" >Étudiant</label>

                            <div id="divEtudiantSub" class="well" style="background-color:#bce8f1;" hidden>
                                <p class="alert alert-info"><strong>Préciser<em> *</em></strong></p>
                                <div class="radio">
                                    <label for="e1a"><input type="radio" id="e1a" value="8" name="radioEtudiant" class="radioEtudiantApprentiM radioEtudiant">1re année</label>
                                </div>
                                <div class="radio">
                                    <label for="e2a"><input type="radio" id="e2a" value="9" name="radioEtudiant" class="radioEtudiantApprentiM radioEtudiant">2e année</label>
                                </div>
                                <div class="radio">
                                    <label for="e3a"><input type="radio" id="e3a" value="10" name="radioEtudiant" class="radioEtudiantApprentiM radioEtudiant">3e année</label>
                                </div>
                                <div class="radio">
                                    <label for="epm"><input type="radio" id="epm" value="11" name="radioEtudiant" class="radioEtudiantApprentiM radioEtudiant">Post Master</label>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- ###################################################################################################### -->
                <!--          CADRE DU DEPLACEMENT     -->
                <!-- ###################################################################################################### -->
                <div class="well"><h4><span class="glyphicon glyphicon-info-sign"></span> Cadre du déplacement<em> *</em> </h4>
                    <div class="row">

                        <div class="col-sm-4 well cadreAll" style="background-color:lavender;" id="divFormation" hidden>
                            <label class="radio-inline" for="formation"><input type="radio" id="formation" value="Formation" name="cadre_depl" class="cadre_depl" required >De la formation</label>
                            <div id="divFormationSub" class="well cadreSubAll" hidden>
                                <p class="alert alert-info"><strong>Préciser<em> *</em></strong></p>
                                <div class="radio">
                                    <label for="cfa"><input type="radio" id="cfa" value="1" name="radioFormation" onClick="afficheNomApprenti()" class="other radioFormation">CFA</label>
                                </div>
                                <div class="radio">
                                    <label for="forum"><input type="radio" id="forum" value="2" name="radioFormation" class="other otherFormation radioFormation" >Forum / Salon</label>
                                </div>
                                <div class="radio">
                                    <label for="fc"><input type="radio" id="fc" value="3" name="radioFormation" class="other otherFormation radioFormation">Formation continue</label>
                                </div>
                                <div class="radio">
                                    <label for="PFE"><input type="radio" id="PFE" value="4" name="radioFormation" class="other otherFormation radioFormation">Projet de fin d'études</label>
                                </div>
                                <div class="radio">
                                    <label for="voyEtu"><input type="radio" id="voyEtu" value="5" name="radioFormation" class="other otherFormation radioFormation">Voyage d'études</label>
                                </div>
                                <div class="radio">
                                    <label for="reunion"><input type="radio" id="reunion" value="6" name="radioFormation" class="other otherFormation radioFormation">Réunion</label>
                                </div>
                                <div class="radio">
                                    <label for="formAutre"><input type="radio" id="formAutre" value="7" name="radioFormation" class="autre otherFormation radioFormation">Autre</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 well cadreAll" style="background-color:lavenderblush;" id="divRecherche" hidden>
                            <label class="radio-inline" for="recherche"><input type="radio" id="recherche" value="Recherche" name="cadre_depl" class="cadre_depl">De la recherche</label>

                            <div id="divRechercheSub" class="well cadreSubAll" hidden>
                                <p class="alert alert-info"><strong>Préciser<em> *</em></strong></p>
                                <div class="radio">
                                    <label for="conference"><input type="radio" id="conference" value="8" name="radioRecherche" class="other radioRecherche">Conférence/ congrès</label>
                                </div>
                                <div class="radio">
                                    <label for="contrat"><input type="radio" id="contrat" value="9" name="radioRecherche" class="other radioRecherche">Contrat/ collaboration</label>
                                </div>
                                <div class="radio">
                                    <label for="jurythese"><input type="radio" id="jurythese" value="10" name="radioRecherche" class="other radioRecherche">Jury de thèse</label>
                                </div>
                                <div class="radio">
                                    <label for="essaiindus"><input type="radio" id="essaiindus" value="11" name="radioRecherche" class="other radioRecherche">Essai industriel</label>
                                </div>
                                <div class="radio">
                                    <label for="rechAutre"><input type="radio" id="rechAutre" value="12" name="radioRecherche" class="autre radioRecherche">Autre</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 well cadreAll" style="background-color:lavender;" id="divAdministration" hidden>
                            <label class="radio-inline" for="administration"><input type="radio" id="administration" value="Fonctionnement" name="cadre_depl" class="cadre_depl">Du fonctionnement École</label>
                            
                            <div id="divAdministrationSub" class="well cadreSubAll" hidden>
                                <p class="alert alert-info"><strong>Préciser<em> *</em></strong></p>
                                <div class="radio">
                                    <label for="fondDotation"><input type="radio" id="fondDotation" value="13" name="radioAdministration" class="other radioAdministration">Fond de dotation</label>
                                </div>
                                <div class="radio">
                                    <label for="RI"><input type="radio" id="RI" value="14" name="radioAdministration" class="other radioAdministration">Relations Internationales</label>
                                </div>
                                <div class="radio">
                                    <label for="relEnt"><input type="radio" id="relEnt" value="15" name="radioAdministration" class="other radioAdministration">Relations Entreprises</label>
                                </div>
                                <div class="radio">
                                    <label for="gouvEcol"><input type="radio" id="gouvEcol" value="16" name="radioAdministration" class="other radioAdministration">Gouvernance &Eacute;cole</label>
                                </div>
                                <div class="radio">
                                    <label for="admAutre"><input type="radio" id="admAutre" value="17" name="radioAdministration" class="autre radioAdministration">Autre</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="divAutre" class="form-group" hidden>
                        <label for="textAutre">Autre<em> *</em></label>
                        <input type="text" id="textAutre" class="form-control" placeholder="Veuillez préciser" name="textAutre" value="">
                    </div>
                    <div class="checkbox">
                        <label for="motifMultiple"><input type="checkbox" id="motifMultiple" value="motifMultiple" name="motifMultiple" data-toggle="collapse" data-target="#motifMultipleDiv">Motif multiple de déplacement</label>
                    </div>
                    <div id="motifMultipleDiv" class="collapse">
                        <div class="form-group">
                            <label class="sr-only" for="text_motif_multiple">Motif multiple de déplacement</label>
                            <input type="text" class="form-control" id="text_motif_multiple" value="" name="text_motif_multiple" placeholder="Saisir ici le ou les motifs de déplacement">
                        </div>
                    </div>


                    <div id="divNomApprenti" class="form-group" hidden>
                        <label for="nomApprenti">Nom(s) Apprenti(s)? (si besoin)</label>
                        <input type="text" id="nomApprenti" value="" name="nomApprenti" class="form-control" placeholder="Saisir pour chaque apprenti son nom, prénom et cursus suivi.">
                    </div>

                    <div id="divApprentiSubCfa" hidden>
                        <div class="form-group">
                            <p class="alert alert-warning"><strong>Préciser<em> *</em></strong></p>
                            <div class="radio">
                                <label for="inge3cfa"><input type="radio" id="inge3cfa" value="inge3cfa" class="ingeLprocfa" name="radioApprenticfa">Cycle ingénieur en 3 ans</label>
                            </div>
                            <div id="divInge3cfa" class="well" hidden>
                                <p class="alert alert-info"><strong>Préciser<em> *</em></strong></p>
                                <div class="radio">
                                    <label for="inge3a1cfa"><input type="radio" id="inge3a1cfa" value="1re_annee" name="radioCycle3cfa" class="radioEtudiantApprentiMcfa radioApprenticfa radioInge3cfa">1ère année</label>
                                </div>
                                <div class="radio">
                                    <label for="inge3a2cfa"><input type="radio" id="inge3a2cfa" value="2e_annee" name="radioCycle3cfa" class="radioEtudiantApprentiMcfa radioApprenticfa radioInge3cfa">2ème année</label>
                                </div>
                                <div class="radio">
                                    <label for="inge3a3cfa"><input type="radio" id="inge3a3cfa" value="3e_annee" name="radioCycle3cfa" class="radioEtudiantApprentiMcfa radioApprenticfa radioInge3cfa">3ème année</label>
                                </div>
                            </div>
                            <div class="radio">
                                <label for="inge2cfa"><input type="radio" id="inge2cfa" value="inge2cfa" class="ingeLprocfa" name="radioApprenticfa">Cycle ingénieur en 2 ans</label>
                            </div>
                            <div id="divInge2cfa" class="well" hidden>
                                <p class="alert alert-info"><strong>Préciser<em> *</em></strong></p>
                                <div class="radio">
                                    <label for="inge2a2cfa"><input type="radio" id="inge2a2cfa" value="2e_annee" name="radioCycle2cfa" class="radioEtudiantApprentiMcfa radioApprenticfa radioInge2cfa">2ème année</label>
                                </div>
                                <div class="radio">
                                    <label for="inge2a3cfa"><input type="radio" id="inge2a3cfa" value="3e_annee" name="radioCycle2cfa" class="radioEtudiantApprentiMcfa radioApprenticfa radioInge2cfa">3ème année</label>
                                </div>
                            </div>
                            <div class="radio">
                                <label for="lprocfa"><input type="radio" id="lprocfa" value="lprocfa" name="radioApprenticfa" class="radioEtudiantApprentiMcfa radioApprenticfa ingeLprocfa">Licence professionnelle</label>
                            </div>
                        </div>
                    </div>



                </div>

                <div class="well"><h4><span class="glyphicon glyphicon-calendar"></span> Dates du déplacement</h4>
                    <div class="row">
                        <div class="form-group  col-md-6">
                            <label for="debut_depl">Du<em> *</em></label>
                            <input type="text" class="form-control" id="debut_depl" name="debut_depl" value="" data-toggle="tooltip" title="au format JJ/MM/AAAA" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fin_depl">Au<em> *</em></label>
                            <input type="text" class="form-control" id="fin_depl" name="fin_depl" value="" data-toggle="tooltip" title="au format JJ/MM/AAAA" required>
                        </div>
                    </div>
                </div>

                <div class="well">
                    <div class="form-group">
                        <label for="lieu_depl">Lieu<em> *</em></label>
                        <input type="text" class="form-control input_varchar" id="lieu_depl" name="lieu_depl" value="" data-toggle="tooltip" placeholder="Entrer le lieu de votre déplacement" required>
                    </div>
                </div>

                <div class="well">
                    <div class="form-group">
                        <label for="objet_depl">Objet du déplacement<em> *</em></label>
                        <textarea class="form-control" rows="3" id="objet_depl" name="objet_depl" placeholder=" exemple : visite CFA suivi 2A..." required></textarea>
                    </div>
                </div>
                <div class="form-group" id="divLigneBudgetaire" hidden>
                    <label for="lig_budget_depl">Ligne budgétaire<em> *</em></label>
                    <input class="form-control " type="text" id="lig_budget_depl" value="" name="lig_budget_depl" placeholder="ligne budgétaire">
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn1 btn-primary">SUIVANT <span class="glyphicon glyphicon-arrow-right"></span></button>
                </div>
            </div>
            <!-- ###################################################################################################### -->
            <!--          FRAIS DIVERS     -->
            <!-- ###################################################################################################### -->
            <div class="form-group well" style="background-color:lavender;" hidden id="fraisDiv">
                <div class="well well-sm alert"><span class="glyphicon glyphicon-plane"></span><strong>Frais divers / déplacement</strong></div>
                <div class="well">
                    <div class="form-group">
                        <label for="parking_euros">Parking</label>
                        <input type="text" class="form-control money input_varchar" id="parking_euros" value="" name="parking_euro" placeholder="Entrez vos frais de parking (en euros)">
                    </div>
                    <div class="form-group">
                        <label for="autoroute_euro">Autoroute</label>
                        <input type="text" class="form-control money" id="autoroute_euro" value="" name="autoroute_euro" placeholder="Entrez vos frais d'autoroute (en euros)">
                    </div>
    
                    <div class="form-group">
                        <label for="taxi_euro">Taxi</label>
                        <input type="text" class="form-control money" id="taxi_euro" value="" name="taxi_euro" placeholder="Entrez vos frais de taxi (en euros)">
                    </div>
    
                    <div class="form-group">
                        <label for="rer_euro">R.E.R</label>
                        <input type="text" class="form-control money" id="rer_euro" value="" name="rer_euro" placeholder="Entrez vos frais de R.E.R, de bus ou de Tramway (en euros)">
                    </div>
    
                    <div class="form-group">
                        <label for="train_euro">Train</label>
                        <input type="text" class="form-control money" id="train_euro" value="" name="train_euro" placeholder="Entrez vos frais de train (en euros)">
                    </div>
                    <div class="form-group">
                        <label for="avion_euro">Avion</label>
                        <input type="text" class="form-control money" id="avion_euro" value="" name="avion_euro" placeholder="Entrez vos frais d'avion (en euros)">
                    </div>
                    <div class="form-group">
                        <label for="navette_euro">Navette</label>
                        <input type="text" class="form-control money" id="navette_euro" value="" name="navette_euro" placeholder="Entrez vos frais de navette (en euros)">
                    </div>
                    <div class="checkbox">
                        <label for="carburant"><input type="checkbox" id="carburant" value="carburant" name="carburant" data-toggle="collapse" data-target="#carburantDiv">Carburant (uniquement si voiture de location)</label>
                    </div>
                    <div id="carburantDiv" class="collapse">
                        <div class="form-group">
                            <label class="sr-only" for="carburant_euro">Carburant (uniquement si voiture de location)</label>
                            <input type="text" class="form-control money" id="carburant_euro" value="" name="carburant_euro" placeholder="Entrez vos frais (en euros) de carburant (uniquement si voiture de location)">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="sr-only" for="text_carburant_vol">Volume carburant</label>
                                <input type="text" class="form-control money" id="text_carburant_vol" value="" name="carburant_vol" placeholder="Entrer le volume de carburant" data-toggle="tooltip" title="Cf. votre ticket de carburant">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="sr-only" for="sel2">Type carburant</label>
                                <select class="form-control" id="sel2" name="carburant_type">
                                    <option>Type carburant</option>
                                    <option>Diesel</option>
                                    <option>Essence</option>
                                    <option>GPL</option>
                                    <option>GNV</option>
                                    <option>Electrique</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            
            <!-- ###################################################################################################### -->
            <!--        FRAIS SEJOUR       -->
            <!-- ###################################################################################################### -->
            <div class="form-group well" style="background-color:lavenderblush;">
                <p class="well"><span class="glyphicon glyphicon-cutlery"></span>&nbsp;&nbsp;Frais de séjour</p>
                <div class="checkbox">
                    <label for="hotel"><input type="checkbox" id="hotel" value="hotel" name="hotel" data-toggle="collapse" data-target="#hotelDiv">Hôtel</label>
                </div>
                <div id="hotelDiv" class="collapse">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="sr-only" for="hotel_euro">Frais d'hôtel</label>
                            <input type="text" class="form-control money" id="hotel_euro" value="" name="hotel_euro" placeholder="Entrez le montant total en euros (exemple : 24.85)">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="sr-only" for="nuitees">Nombre de nuitées</label>
                            <input type="number" class="form-control" id="nuitees" min="0" name="nuitees" placeholder="Entrez le nombre de nuitées">
                        </div>
                    </div>
                </div>
    
                <div class="checkbox">
                    <label for="repas"><input type="checkbox" id="repas" value="repas" name="repas" data-toggle="collapse" data-target="#repasDiv">Repas</label>
                </div>
                <div id="repasDiv" class="collapse">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="sr-only" for="repas_euro">Frais de repas</label>
                            <input type="text" class="form-control money" id="repas_euro" name="repas_euro" value="" placeholder="Entrez le montant total en euros (exemple : 24.85)">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="sr-only" for="repas_nb">Nombre de repas pris au restaurant (invités compris)</label>
                            <input type="number" class="form-control" id="repas_nb" min="0" name="repas_nb" placeholder="Entrez le nombre de repas (invités compris)">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group btn-group">
                <button type="button" class=" btn btn2 btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> PRÉCÉDENT</button>
                <button type="button" class=" btn btn3 btn-primary">SUIVANT <span class="glyphicon glyphicon-arrow-right"></span></button>
            </div>
        </div>
    <!-- ###################################################################################################### -->
    <!--          TRAJETS / MODE DE TRANSPORT     -->
    <!-- ###################################################################################################### -->
    <div class="form-group well" style="background-color:lavender;" id="etape" hidden>
        <div class="well well-sm"><span class="glyphicon glyphicon-road"></span><strong>  TRAJETS / MODE DE TRANSPORT</strong></div>
        <div class="alert alert-warning"><strong>Attention!</strong> Ne pas renseigner les étapes de transport intra-urbain (métro, tram, bus...).</div>
        <div class="alert alert-warning"><strong>Version Beta!</strong> Pour le moment le calcul de distance ne se fait qu'en fonction du mode Voiture, les distance entre aéroport doivent être renseignées à la main</div>
        <fieldset class="no-help form-group">
            <div class="list-number">
                <ul class="form-list number-list list-group">
                    <li class="fields list-group-item"><h4>Etape 1</h4>
                        <div class="field">
                        <!-- ###################################################################################################### -->
                        <!--        MODES       -->
                        <!-- ###################################################################################################### -->
                        <div class="form-group well well-sm">
                            <label>Choisir le mode approprié<em> *</em></label>
                            <div class="radio">
                                <label for="modeTrain"><input type="radio" id="modeTrain" value="modeTrain" name="radioMode1" required>Train / R.E.R</label>
                            </div>
                            <div class="radio">
                                <label for="modeAvion"><input type="radio" id="modeAvion" value="modeAvion" name="radioMode1" >Avion</label>
                            </div>
                            <div class="radio">
                                <label for="modeTaxi"><input type="radio" id="modeTaxi" value="modeTaxi" name="radioMode1">Taxi</label>
                            </div>
                            <div class="radio">
                                <label for="modeNavetteCar"><input type="radio" id="modeNavetteCar" value="modeNavetteCar" name="radioMode1">Navette / Car</label>
                            </div>
                            <div class="radio">
                                <label for="modeVoitLoc"><input type="radio" id="modeVoitLoc" value="modeVoitLoc" name="radioMode1">Voiture de location</label>
                            </div>
                            <div class="radio">
                                <label for="modeVoitPerso"><input type="radio" id="modeVoitPerso" value="modeVoitPerso" name="radioMode1" data-toggle="collapse" data-target="#voitPersoDiv">Voiture personnelle</label>
                            </div>
                            <div id="voitPersoDiv" class="collapse">
                                <label class="sr-only" for="puisFisc1">Puissance fiscale du véhicule</label>
                                <input type="number" class="form-control" id="puisFisc1" min="0" value="" name="puisFisc1" min="1" max="15" placeholder="Entrez le nombre de CV figurant sur la carte grise">
                            </div>
                        </div>
                        <!-- ###################################################################################################### -->
                        <!--        DEPART - DESTINATION       -->
                        <!-- ###################################################################################################### -->
                        <div class="form-group" id="depart-div1">
                            <label for="depart-input1">Ville de départ 1<em> *</em></label>
                            <input type="text" class="form-control" id="depart-input1" value="" name="depart1" placeholder="Entrez la ville de départ" required>
                        </div>
                        <div class="form-group" id="destination-div1">
                            <label for="destination-input1">Ville d'arrivée 1<em> *</em></label>
                            <input type="text" class="form-control" id="destination-input1" name="destination1" value="" placeholder="Entrez la ville d'arrivée" required>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-info" onClick="calcDist('depart-input1','destination-input1','distance1')"><span class="glyphicon glyphicon-search"></span>  Vérifier distance</button>
                            <div id="distDiv1" hidden>
                                <div class="form-group">
                                    <label class="sr-only" for="distance1">Kilométrage</label>
                                    <input type="text" class="form-control distance" id="distance1" value="" name="distance1" placeholder="">
                                </div>
                            </div>
                        </div>
						<div id="occurence" hidden>
                            <div class="alert alert-warning"><strong>Info!</strong> Estimation à partir de Google Maps, corriger si nécessaire.</div>
                            <label>Occurence</label>
                            <div class="form-group">
                                <label class="radio-inline" for="allersimple"><input type="radio" name="radioAllerRetour" id="allersimple" onClick="allerSimple('distance1')" checked>Aller simple</label>
                                <label class="radio-inline" for="allerretour"><input type="radio" name="radioAllerRetour" id="allerretour" onClick="allerRetour('distance1')">Aller et retour</label>
                            </div>
						</div>
                    </div>
                </li>

                <!-- ###################################################################################################### -->
                <!--        POUR CHAQUE ETAPE AJOUTÉE, ON AJOUTE UNE <li>   ICI   -->
                <!-- ###################################################################################################### -->

            </ul>
            <button class="btn btn-primary add-number" type="button" title="Ajouter une étape"><span class="glyphicon glyphicon-plus"></span><span> Ajouter une étape</span></button>
        </div>
    </fieldset>

    <!-- ###################################################################################################### -->
    <!--        VALIDATION       -->
    <!-- ###################################################################################################### -->
    <p class="alert alert-warning"><strong>Attention </strong> Joindre impérativement tous les justificatifs</p>
    <input type="hidden" id="etat_depl" value="2" name="etat_depl">
    <div id="mode" hidden><?php echo $mode; ?></div>
    <p id="demo"></p>

    <div class="form-group" id="groupButton">
        <button type="button" class="btn btn4 btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> PRÉCÉDENT</button>
        <button type="button" class="btn btnsave btn-warning"><span class="glyphicon glyphicon-repeat"></span> toJson</button>
        <button type="submit" class="submit btn btn-success" onClick="afficheAll()"><span class="glyphicon glyphicon-ok"></span> Valider pour édition pdf</button>
        <button type="button" class="btn btnRecord btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Enregistrer</button>
        <button type="button" class="btn btnFormJSON btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Create Form JSON</button>
        
    </div>
</div>

    </form>
    <div id="id_depl" class="<?php echo $_SESSION['id_depl'] ?>"></div>
</div>
<script>











/////////////////////////


</script>
<?php
include("../../view/template/bottom.view.php");
?>
