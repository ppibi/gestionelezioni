<!doctype html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php esc($Titolo);?></title>
    <link rel="icon" href="<?php echo base_url('assets/img/favicon.png')?>" > 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css')?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/lineicons.css')?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/materialdesignicons.min.css')?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/fullcalendar.css')?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css')?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/LaSecca-GestioneLezioni.css')?>" type="text/css">

    <link rel="dns-prefetch" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" /> 
    
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.bundle.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/Chart.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/apexcharts.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/dynamic-pie-chart.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/moment.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/fullcalendar.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jsvectormap.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/world-merc.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/polyfill.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/main.js')?>"></script>
    
</head>

<?php 
    $ModelloUtenti = new \App\Models\Admin\ADmin_Utenti(); 
    $NumeroMenu = 0;
?>

<body class="g-sidenav-show bg-gray-100">
    
    <!-- ======== Menu Verticale =========== -->
        <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <img src="<?php echo base_url('assets/img/logo.png')?>" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold"><?php echo DescrizioneTitolo ?></span>
        </div>

        <!-- Menu Verticale -->
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item">
                    <?php $NumeroMenu++;?>
                    <span class="text">
                        <?php 
                            $TitoloMenu = TitoloMenuAmministrazione;
                            $InfoAggiuntiveMenu = "";
                            if ($Titolo == $TitoloMenu) :
                                $InfoAggiuntiveMenu = "class='active'";
                            endif;
                        echo anchor("admin/admin_page", $TitoloMenu, $InfoAggiuntiveMenu); ?>
                    </span>
                </li>
                <li class="nav-item nav-item-has-children">
                    <?php 
                    $ClasseMenu = "";
                    if (strpos($Titolo, "presen")) :
                        $ClasseMenu = "show";
                    endif;
                    $NumeroMenu++;?>
                    <a
                        href="#0"
                            data-bs-toggle="collapse"
                            data-bs-target="#ddmenu_<?php echo $NumeroMenu;?>"
                            aria-controls="ddmenu_<?php echo $NumeroMenu;?>"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                    >
<?php /*                        <span class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22">
                                <path
                                    d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                                />
                            </svg>
                        </span>
*/?>
                        <span class="text"><?php echo GruppoMenuPresenze;?></span>
                    </a>
                    <ul id="ddmenu_<?php echo $NumeroMenu;?>" class="collapse dropdown-nav <?php echo $ClasseMenu;?>">
                        <li>
                            <?php 
                            $TitoloMenu = TitoloMenuGestionePresenze;
                            $InfoAggiuntiveMenu = "";
                            if ($Titolo == $TitoloMenu) :
                                $InfoAggiuntiveMenu = "class='active'";
                            endif;
                            echo anchor("admin/presenze/gestionepresenze", $TitoloMenu, $InfoAggiuntiveMenu); ?>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-children">
                    <?php 
                    $ClasseMenu = "";
                    if (strpos($Titolo, "lezion")) :
                        $ClasseMenu = "show";
                    endif;
                    $NumeroMenu++;?>
                    <a
                        href="#0"
                            data-bs-toggle="collapse"
                            data-bs-target="#ddmenu_<?php echo $NumeroMenu;?>"
                            aria-controls="ddmenu_<?php echo $NumeroMenu;?>"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                    >
<?php /*                        <span class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22">
                                <path
                                    d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                                />
                            </svg>
                        </span> 
*/?>
                        <span class="text"><?php echo GruppoMenuLezioni;?></span>
                    </a>
                    <ul id="ddmenu_<?php echo $NumeroMenu;?>" class="collapse dropdown-nav <?php echo $ClasseMenu;?>">
                        <li>
                            <?php 
                            $TitoloMenu = TitoloMenuElencoLezioni;
                            $InfoAggiuntiveMenu = "";
                            if ($Titolo == $TitoloMenu) :
                                $InfoAggiuntiveMenu = "class='active'";
                            endif;
                            echo anchor("admin/lezioni/elencolezioni", $TitoloMenu, $InfoAggiuntiveMenu); ?> 
                        </li>
                    </ul>
                    <ul id="ddmenu_<?php echo $NumeroMenu;?>" class="collapse dropdown-nav <?php echo $ClasseMenu;?>">
                        <li>
                            <?php 
                            $TitoloMenu = TitoloMenuNuovaLezione;
                            $InfoAggiuntiveMenu = "";
                            if ($Titolo == $TitoloMenu) :
                                $InfoAggiuntiveMenu = "class='active'";
                            endif;
                            echo anchor("admin/lezioni/nuovalezione", $TitoloMenu, $InfoAggiuntiveMenu); ?> 
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-children">
                    <?php 
                    $ClasseMenu = "";
                    if (strpos($Titolo, "istrutt")) :
                        $ClasseMenu = "show";
                    endif;
                    $NumeroMenu++;?>
                    <a
                        href="#0"
                            data-bs-toggle="collapse"
                            data-bs-target="#ddmenu_<?php echo $NumeroMenu;?>"
                            aria-controls="ddmenu_<?php echo $NumeroMenu;?>"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                    >
<?php /*                        <span class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22">
                                <path
                                    d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                                />
                            </svg>
                        </span>
*/?>
                        <span class="text"><?php echo GruppoMenuIstruttori;?></span>
                    </a>
                    <ul id="ddmenu_<?php echo $NumeroMenu;?>" class="collapse dropdown-nav <?php echo $ClasseMenu;?>">
                        <li>
                            <?php 
                            $TitoloMenu = TitoloMenuElencoIstruttori;
                            $InfoAggiuntiveMenu = "";
                            if ($Titolo == $TitoloMenu) :
                                $InfoAggiuntiveMenu = "class='active'";
                            endif;
                            echo anchor("admin/istruttori/elencoistruttori", $TitoloMenu, $InfoAggiuntiveMenu); ?> 
                        </li>
                    </ul>
                    <ul id="ddmenu_<?php echo $NumeroMenu;?>" class="collapse dropdown-nav <?php echo $ClasseMenu;?>">
                        <li>
                            <?php 
                            $TitoloMenu = TitoloMenuNuovoIstruttore;
                            $InfoAggiuntiveMenu = "";
                            if ($Titolo == $TitoloMenu) :
                                $InfoAggiuntiveMenu = "class='active'";
                            endif;
                            echo anchor("admin/istruttori/nuovoistruttore", $TitoloMenu, $InfoAggiuntiveMenu); ?> 
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-children">
                    <?php 
                    $ClasseMenu = "";
                    if (strpos($Titolo, "discipl")) :
                        $ClasseMenu = "show";
                    endif;
                    $NumeroMenu++;?>
                    <a
                        href="#0"
                            data-bs-toggle="collapse"
                            data-bs-target="#ddmenu_<?php echo $NumeroMenu;?>"
                            aria-controls="ddmenu_<?php echo $NumeroMenu;?>"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                    >
<?php /*                        <span class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22">
                                <path
                                    d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                                />
                            </svg>
                        </span>
*/?>
                        <span class="text"><?php echo GruppoMenuDiscipline;?></span>
                    </a>
                    <ul id="ddmenu_<?php echo $NumeroMenu;?>" class="collapse dropdown-nav <?php echo $ClasseMenu;?>">
                        <li>
                            <?php 
                            $TitoloMenu = TitoloMenuElencoDiscipline;
                            $InfoAggiuntiveMenu = "";
                            if ($Titolo == $TitoloMenu) :
                                $InfoAggiuntiveMenu = "class='active'";
                            endif;
                            echo anchor("admin/discipline/elencodiscipline", $TitoloMenu, $InfoAggiuntiveMenu); ?>
                        </li>
                    </ul>
                    <ul id="ddmenu_<?php echo $NumeroMenu;?>" class="collapse dropdown-nav <?php echo $ClasseMenu;?>">
                        <li>
                            <?php 
                            $TitoloMenu = TitoloMenuNuovaDisciplina;
                            $InfoAggiuntiveMenu = "";
                            if ($Titolo == $TitoloMenu) :
                                $InfoAggiuntiveMenu = "class='active'";
                            endif;
                            echo anchor("admin/discipline/nuovadisciplina", $TitoloMenu, $InfoAggiuntiveMenu); ?> 
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-children">
                    <?php 
                    $ClasseMenu = "";
                    if (strpos($Titolo, "utent")) :
                        $ClasseMenu = "show";
                    endif;
                    $NumeroMenu++;?>
                    <a
                        href="#0"
                            data-bs-toggle="collapse"
                            data-bs-target="#ddmenu_<?php echo $NumeroMenu;?>"
                            aria-controls="ddmenu_<?php echo $NumeroMenu;?>"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                    >
<?php /*                        <span class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22">
                                <path
                                    d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                                />
                            </svg>
                        </span>
*/?>
                        <span class="text"><?php echo GruppoMenuUtenti;?></span>
                    </a>
                    <ul id="ddmenu_<?php echo $NumeroMenu;?>" class="collapse dropdown-nav <?php echo $ClasseMenu;?>">
                        <li>
                            <?php 
                            $TitoloMenu = TitoloMenuElencoUtenti;
                            $InfoAggiuntiveMenu = "";
                            if ($Titolo == $TitoloMenu) :
                                $InfoAggiuntiveMenu = "class='active'";
                            endif;
                            echo anchor("admin/utenti/elencoutenti", $TitoloMenu, $InfoAggiuntiveMenu); ?> 
                        </li>
                    </ul>
                    <ul id="ddmenu_<?php echo $NumeroMenu;?>" class="collapse dropdown-nav <?php echo $ClasseMenu;?>">
                        <li>
                            <?php 
                            $TitoloMenu = TitoloMenuNuovoUtente;
                            $InfoAggiuntiveMenu = "";
                            if ($Titolo == $TitoloMenu) :
                                $InfoAggiuntiveMenu = "class='active'";
                            endif;
                            echo anchor("admin/utenti/nuovoutente", $TitoloMenu, $InfoAggiuntiveMenu); ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="overlay"></div>
     <!-- ======== Menu Verticale Fine =========== -->
 
    <!-- ======== Main =========== -->
    <main class="main-wrapper">
        <!-- ========== Header ========== -->
        <header class="header">
            <div class="container-fluid  align-middle">
                <div class="row  align-middle">
                    <div class="col-lg-3 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-20">
                                <button
                                    id="menu-toggle"
                                    class="main-btn primary-btn btn-hover"
                                >
                                    <i class="lni lni-chevron-left me-2"></i> Menu
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7 col-6">
                        <div class="header-center text-center">
                            <h3 class="px-2 py-2 primary-bg text-white rounded"><?php echo esc($Titolo);?></h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7 col-6">
                        <div class="header-right">
                            <!-- Profilo -->
                            <div class="profile-box ml-15">
                                <button
                                    class="dropdown-toggle bg-transparent border-0"
                                    type="button"
                                    id="profile"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <div class="profile-info">
                                        <div class="info">
                                            <h6>
                                            <?php
                                                $DatiUtenteConnesso = $ModelloUtenti->ritornaUtenteConnesso(); 
                                                echo $DatiUtenteConnesso["username"]; ?>
                                            </h6>
                                        </div>
                                    </div>
                                        <i class="lni lni-chevron-down"></i>
                                </button>
                                <ul
                                    class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="profile"
                                >
                                    <li>        
                                        <?php echo anchor("logout", "Logout", "Titolo='Logout'"); ?>
                                    </li>
                                </ul>
                            </div>
                    <!-- Fine Profilo -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
      <!-- ========== Fine Header ========== -->

    
<?php /*OLD    


    <div class="container-fluid text-center">
        <h2><?= esc($Titolo) ?></h2>
    </div>
*/?>
