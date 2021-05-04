<?php

use Carbon\Carbon;

function checkValidity($exp_date)
{
    $cur_date = Carbon::now();
    if($cur_date > $exp_date)
    {
        return 'Expired';
    } else {
        return 'Valid';
    }

}


?>
