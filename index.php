<!DOCTYPE html>
<html lang="no">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="helseskjema">
    <meta name="author" content="Gunnar Pauls">
    <title>helseskjema</title>
    <!-- Favicons-->
    <link rel="icon" type="image/x-icon" href="img/favicons/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="img/favicons/public-health-icon-152-213230.png">
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="img/favicons/public-health-icon-144-213230.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/favicons/public-health-icon-152-213230.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicons/public-health-icon-144-213230.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/favicons/public-health-icon-120-213230.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/favicons/public-health-icon-114-213230.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/favicons/public-health-icon-72-213230.png">
    <link rel="apple-touch-icon-precomposed" href="img/favicons/public-health-icon-57-213230.png">
    <link rel="icon" href="img/favicons/public-health-icon-32-213230.png" sizes="32x32">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/jquery-ui.min.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/date_time_picker.css" rel="stylesheet">
    <link href="css/icon_fonts/css/all_icons_min.css" rel="stylesheet">
    <link href="css/skins/square/grey.css" rel="stylesheet">

    <link href="css/chosen.min.css" rel="stylesheet">

    <style>
        .ui-widget-content {
            border: 0px;
        }

        .ui-progressbar {
            height: 0.5em;
        }

        #progressbar .ui-widget-header {
            background: #6C3;
        }

        .ui-widget-header {
            background: #F60;
        }

        form label.error {
            font-style: italic;
        }

        form label.submit-error {
            font-style: italic;
        }
    </style>
</head>

<body>
    
    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Preload -->

    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-3">
                    <div id="logo_home">
                        <h1><a href="index.html">helseskjema</a></h1>
                    </div>
                </div>
                <div class="col-xs-9">
                    <div id="social">
                        <ul>
                            <li><a href="#0"><i class="icon-facebook"></i></a></li>
                            <li><a href="#0"><i class="icon-twitter"></i></a></li>
                            <li><a href="#0"><i class="icon-google"></i></a></li>
                            <li><a href="#0"><i class="icon-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <!-- /social -->
                </div>
            </div>
        </div>
        <!-- container -->
    </header>
    <!-- End Header -->

    <main>
        <div id="form_container">
            <div class="row">
                <div class="col-md-5">
                    <div id="left_form">
                        <figure><img src="img/registration_bg.svg" alt=""></figure>
                        <h2>Helseskjema</h2>
                        <p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p>
                        <a href="#0" id="more_info" data-toggle="modal" data-target="#more-info"><i class="pe-7s-info"></i></a>
                    </div>
                </div>
                <div class="col-md-7">

                    <div id="wizard_container">
                        <div id="top-wizard">
                            <div id="progressbar"></div>
                        </div>
                        <!-- /top-wizard -->
                        <form name="helseskjema" id="helseskjema" method="POST" action="helseskjema_submit.php" class="wizard-form" novalidate="novalidate">
                            <!-- Leave for security protection, read docs for details -->
                            <div id="middle-wizard" class="wizard-branch wizard-wrapper">
                                <span class="wizard-step-current"></span>
                                <div class="step">
                                    <h3 class="main_question wizard-header">Your social security number</h3>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input type="tel" name="fodselsnr" class="form-control fodselsnr required" placeholder="Fodselsnr">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input minlength="5" type="tel" maxlength="5" name="personnummer" class="form-control required" placeholder="Person nummer">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="step">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="fornavn" class="form-control" placeholder="Fornavn">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="etternavn" class="form-control" placeholder="Etternavn">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="text" name="adresse" class="form-control" placeholder="Adresse">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" name="postnr" class="form-control" placeholder="Postnummer">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" name="sted" class="form-control" placeholder="Sted">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" name="mobtlf" class="form-control" placeholder="Mobiltelefon">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="email" name="epost" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="arbeidssted" class="form-control" placeholder="Arbeidssted">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group radio_input">
                                                <label><input type="radio" value="Mannlig" name="yrke" class="icheck">Mannlig</label>
                                                <label><input type="radio" value="Kvinne" name="yrke" class="icheck">Kvinne</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group radio-input">
                                                <select id="editable-select" class="form-control" placeholder="Where did you find us">
                                                    <option>Friend</option>
                                                    <option>Newspaper ad</option>
                                                    <option>Radio</option>
                                                    <option>Social</option>
                                                    <option>TV</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step">
                                    <h3 class="main_question wizard-header">Helse</h3>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="hjertekar" name="hjertekar" type="checkbox" class="icheck" value="T">
                                                <label for="hjertekar">Hjerte/karsykdommer</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="tungpustet" name="tungpustet" type="checkbox" class="icheck" value="T">
                                                <label for="tungpustet">Tungpustet av trapper</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="blodtrykk" name="blodtrykk" type="checkbox" class="icheck" value="T">
                                                <label for="blodtrykk">Høyt blodtrykk</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="lokalbed" name="lokalbed" type="checkbox" class="icheck" value="T">
                                                <label for="lokalbed">Plager med lokalbedøvelse</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="etterblodning" name="etterblodning" type="checkbox" class="icheck" value="T">
                                                <label for="etterblodning">Blødersykdom / etterblødning</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="bihulene" name="bihulene" type="checkbox" class="icheck" value="T">
                                                <label for="bihulene">Problemer med bihulene</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="psykiskeprobl" name="psykiskeprobl" type="checkbox" class="icheck" value="T">
                                                <label for="psykiskeprobl">Psykiske problemer</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="stralebeh" name="stralebeh" type="checkbox" class="icheck" value="T">
                                                <label for="stralebeh">Strålebeh. i hode/hals</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="spiseforst" name="spiseforst" type="checkbox" class="icheck" value="T">
                                                <label for="spiseforst">Spiseforstyrrelse</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="lungesykd" name="lungesykd" type="checkbox" class="icheck" value="T">
                                                <label for="lungesykd">Lungesykdom</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="hjerneblodn" name="hjerneblodn" type="checkbox" class="icheck" value="T">
                                                <label for="hjerneblodn">Hjerneblødning</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="raumatisk" name="raumatisk" type="checkbox" class="icheck" value="T">
                                                <label for="raumatisk">Reumatisk sykdom</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="chkinnopererteproteser" name="chkinnopererteproteser" type="checkbox" class="icheck" value="T">
                                                <label for="chkinnopererteproteser">Innopererte proteser</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="immunitetssykdommer" name="immunitetssykdommer" type="checkbox" class="icheck" value="T">
                                                <label for="immunitetssykdommer">Immunitetssykdommer</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="osteoporose" name="osteoporose" type="checkbox" class="icheck" value="T">
                                                <label for="osteoporose">Osteoporose/benskjørhet</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step">
                                    <h3 class="main_question wizard-header">Helse</h3>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="astma" name="astma" type="checkbox" class="icheck" value="T">
                                                <label for="astma">Astma</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="diabetes" name="diabetes" type="checkbox" class="icheck" value="T">
                                                <label for="diabetes">Diabetes</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="diett" name="diett" type="checkbox" class="icheck" value="T">
                                                <label for="diett">Diett</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="giktfeber" name="giktfeber" type="checkbox" class="icheck" value="T">
                                                <label for="giktfeber">Giktfeber</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="hivaids" name="hivaids" type="checkbox" class="icheck" value="T">
                                                <label for="hivaids">HIV / AIDS</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="parkinsons" name="parkinsons" type="checkbox" class="icheck" value="T">
                                                <label for="parkinsons">Parkinson</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="kreft" name="kreft" type="checkbox" class="icheck" value="T">
                                                <label for="kreft">Kreft</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="hepatitt" name="hepatitt" type="checkbox" class="icheck" value="T">
                                                <label for="hepatitt">Hepatitt</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="epilepsi" name="epilepsi" type="checkbox" class="icheck" value="T">
                                                <label for="epilepsi">Epilepsi</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="klaus" name="klaus" type="checkbox" class="icheck" value="T">
                                                <label for="klaus">Klaustrofobi</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="chkcave" name="chkcave" type="checkbox" class="icheck" value="T">
                                                <label for="chkcave">Tannlegeskrekk / odontofobi </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="nedsyn" name="nedsyn" type="checkbox" class="icheck" value="T">
                                                <label for="nedsyn">Nedsatt syn</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="nedtale" name="nedtale" type="checkbox" class="icheck" value="T">
                                                <label for="nedtale">Nedsatt taleevne</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="nedhorsel" name="nedhorsel" type="checkbox" class="icheck" value="T">
                                                <label for="nedhorsel">Nedsatt hørsel</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-box">
                                                <input id="nedforlighet" name="nedforlighet" type="checkbox" class="icheck" value="T">
                                                <label for="nedforlighet">Nedsatt førlighet</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step">
                                    <h3 class="main_question wizard-header">Helseopplysninger</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea name="additional_message" class="form-control" style="height:150px;" placeholder="Andre sykdommer / opplysninger"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step">
                                    <h3 class="main_question wizard-header">Munn og tenner</h3>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="ommetyggem" name="ommetyggem" type="checkbox" class="icheck" value="T">
                                                <label for="ommetyggem">Ømme tyggemuskler</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="tanngnissing" name="tanngnissing" type="checkbox" class="icheck" value="T">
                                                <label for="tanngnissing">Tanngnissing</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="darligande" name="darligande" type="checkbox" class="icheck" value="T">
                                                <label for="darligande">Dårlig ånde</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="stadigomhet" name="stadigomhet" type="checkbox" class="icheck" value="T">
                                                <label for="stadigomhet">Stadig ømhet i tunge/lepper/svelg</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="munnsar" name="munnsar" type="checkbox" class="icheck" value="T">
                                                <label for="munnsar">Plaget med munnsår</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="munntorrhet" name="munntorrhet" type="checkbox" class="icheck" value="T">
                                                <label for="munntorrhet">Munntørrhet</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="tannkjblod" name="tannkjblod" type="checkbox" class="icheck" value="T">
                                                <label for="tannkjblod">Blødning i tannkjøttet</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="royker" name="royker" type="checkbox" class="icheck" value="T">
                                                <label for="royker">Røyker</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="fingersuger" name="fingersuger" type="checkbox" class="icheck" value="T">
                                                <label for="fingersuger">Fingersuger</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="munnpuster" name="munnpuster" type="checkbox" class="icheck" value="T">
                                                <label for="munnpuster">Munnpuster</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="kompltidlbeh" name="kompltidlbeh" type="checkbox" class="icheck" value="T">
                                                <label for="kompltidlbeh">Komplikasjoner etter tidligere tannbehandling</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="chkmunnannet" name="chkmunnannet" type="checkbox" class="icheck" value="T">
                                                <label for="chkmunnannet">Snuser</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea name="additional_message" class="form-control" style="height:50px;" placeholder="Annet"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step">
                                    <h3 class="main_question wizard-header">Allergi/overømfintlighet</h3>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="apenicillin" name="apenicillin" type="checkbox" class="icheck" value="T">
                                                <label for="apenicillin">Penicillin</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="alokalbed" name="alokalbed" type="checkbox" class="icheck" value="T">
                                                <label for="alokalbed">Lokalbedøvelse</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="amat" name="amat" type="checkbox" class="icheck" value="T">
                                                <label for="amat">Matvarer</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="alatex" name="alatex" type="checkbox" class="icheck" value="T">
                                                <label for="alatex">Latex</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="chkaannet" name="chkaannet" type="checkbox" class="icheck" value="T">
                                                <label for="chkaannet">L.E.D lamper</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="apollen" name="apollen" type="checkbox" class="icheck" value="T">
                                                <label for="apollen">Pollen</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-box">
                                                <input id="anikkel" name="anikkel" type="checkbox" class="icheck" value="T">
                                                <label for="anikkel">Nikkel</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea name="additional_message" class="form-control" style="height:100px;" placeholder="Annet"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step">
                                    <h3 class="main_question wizard-header">Helseopplysninger</h3>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input type="text" name="fastlege" class="form-control" placeholder="Fastlege">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step submit">
                                    <h3 class="main_question wizard-header">Medikamentbruk</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <?php
                                                    include "helseskjema_db.php";
                                                ?>
                                                <select data-placeholder="<?php print ucwords($MEDISIN_INPUT) ?>" multiple
                                                    id="<?php print $MEDISIN_INPUT ?>"
                                                    name="<?php print $MEDISIN_INPUT ?>[]"
                                                    class="form-control">
                                                            <?php
                                                                $medisins_file = $MEDISIN_INPUT . 's.txt';
                                                                if (file_exists($medisins_file) == FALSE) {
                                                                    include $MEDISIN_INPUT . "s.php";
                                                                }
                                                                $medisins = file_get_contents($medisins_file);
                                                                $medisins = explode(PHP_EOL, $medisins);
                                                                foreach ($medisins as $medisin) {
                                                                    $medisin = trim($medisin);
                                                                    if (strlen($medisin) > 0)
                                                                        print("<option>$medisin</option>");
                                                                }
                                                            ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div id="submit-error">
                                                    <label class="submit-error"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /middle-wizard -->
                            <div id="bottom-wizard">
                                <button type="button" name="backward" class="backward">Backward </button>
                                <button type="submit" name="forward" class="forward">Forward</button>
                                <button type="submit" name="process" class="submit">Submit</button>
                            </div>
                            <!-- /bottom-wizard -->
                        </form>
                    </div>
                    <!-- /Wizard container -->
                </div>
            </div><!-- /Row -->
        </div><!-- /Form_container -->
    </main>
    
    <footer id="home" class="clearfix">
        <p>© 2018 Helseskjema</p>
    </footer>
    <!-- end footer-->
    
    <!-- Modal terms -->
    <div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn_1" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal info -->
    <div class="modal fade" id="more-info" tabindex="-1" role="dialog" aria-labelledby="more-infoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="more-infoLabel">Frequently asked questions</h4>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn_1" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- SCRIPTS -->
    <!-- Jquery-->
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/messages_no.js"></script>
    <script src="js/jquery.wizard.js"></script>

    <script src="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>
    <link href="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet">
    <link href="css/helseskjema.css" rel="stylesheet">

    <!-- Common script -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/icheck.min.js"></script>
    <script src="js/owl.carousel.js"></script>

    <!-- Theme script -->
    <script src="js/functions.js"></script>

    <script src="js/chosen.jquery.min.js"></script>
    <script src="js/helseskjema.js"></script>

    <!-- Wizard script -->
    <script src="js/questionare_wizard_func.js"></script>
</body>
</html>