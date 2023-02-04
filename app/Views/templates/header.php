<!doctype html>
<html>
<head>
    <link rel="icon" href="images/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php esc($Titolo);?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-ui.css')?>" type="text/css"> 
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css')?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/LaSecca-GestioneLezioni.css')?>" type="text/css"> 
    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
    <script type="text/javascript" src="<?php echo base_url('include/jQuery.js')?>"> </script>
    <script type="text/javascript" src="<?php echo base_url('include/jquery-ui.js')?>"> </script>
<?php //    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> //?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo base_url('include/bootstrap.js')?>"></script>

</head>
<body>
    <div class="container mx-auto">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow p-3 mb-2 bg-white rounded" aria-label="Offcanvas navbar large">
            <img src="<?php echo base_url('images/logo.png')?>" width="30" height="30" class="d-inline-block align-top" alt="">
            <span class="text-center"><?php echo DescrizioneTitolo ?></span>
            <a class="navbar-brand px-2" href="#"></a>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto px-2">
                    <li class="nav-item active">
                        &nbsp;
                    </li>
                    <li class="nav-item active px-2">
                        <a class="nav-link" href="<?php echo base_url('')?>">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item dropdown px-2">
                        <a class="nav-link dropdown-toggle" href="<?php echo base_url('')?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Presenze
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item px-2" <?php echo anchor("presenze/inseriscipresenze", "Inserimento presenze", "Titolo='Inserimento presenze'"); ?></a> 
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item px-2" ></a> 
                        </div>
                    </li>
                    
                    <li class="nav-item dropdown px-2">
                        <a class="nav-link dropdown-toggle" href="<?php echo base_url('')?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Istruttori
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item px-2" <?php echo anchor("istruttori/elencoistruttori", "Elenco istruttori", "Titolo='Elenco istruttori'"); ?></a> 
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item px-2" ></a> 
                        </div>
                    </li>
                    
                    <li class="nav-item active px-2">
                        <a class="nav-link" <?php echo anchor("admin/admin_page", "Amministrazione", "Titolo='Amministrazione'"); ?></a>
                    </li>
                    
                    <li class="nav-item active px-2">
                        <a class="nav-link" <?php echo anchor("logout", "Logout", "Titolo='Logout'"); ?></a>
                    </li>

                </ul>
            </div>
        </nav>
        
    </div>
    
    <div class="container-fluid text-center pt-3">
        <h2><?= esc($Titolo) ?></h2>
    </div>

