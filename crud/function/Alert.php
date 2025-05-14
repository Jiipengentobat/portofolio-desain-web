<?php
function alert($msg, $sts){
    if($sts == 1){
        $tipe = 'success'; 
    }else{
    $tipe = 'danger';
    }
    echo '
    <div class="alert alert-'.$tipe.'" role="alert">
    '.$msg.'
    </div>
    ';
}
?>