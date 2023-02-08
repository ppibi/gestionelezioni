<?php

function ritornaNumerodiVersione () {
    return "1.0";
}

function ritornaDateGiornoSettimanadaOggi ($GiornoSettimana, $NumeroDateDaRitornare) {
    $ElencoDateDaRitornare = array();
    $GiornoSettimanaOggi = date("w");
    if ($GiornoSettimanaOggi >= $GiornoSettimana) :
        $GiorniDifferenza = $GiornoSettimanaOggi - $GiornoSettimana;
    else:
        $GiorniDifferenza = 7 + $GiornoSettimanaOggi - $GiornoSettimana;
    endif;
    
    $ElencoDateDaRitornare[0] = date ("d-m-Y", strtotime("-" . $GiorniDifferenza . " day"));
    for ($i=1; $i<$NumeroDateDaRitornare; $i++) :
        $ElencoDateDaRitornare[$i] = date ("d-m-Y", strtotime($ElencoDateDaRitornare[$i-1] . "-7 day"));
    endfor;        
    return $ElencoDateDaRitornare;
}

?>
