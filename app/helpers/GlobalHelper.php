<?php


/***************  function to convert English numbers into Nepali **********************/
function Nepali($num)
{
    $num_nepali = array('०', '१', '२', '३', '४', '५', '६', '७', '८', '९');
    $num_eng = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $nums = str_replace($num_eng, $num_nepali, $num);
    return $nums;
}

/***************  function to convert nepali numbers into english **********************/

function English($num)
{
    $num_nepali = array('०', '१', '२', '३', '४', '५', '६', '७', '८', '९');
    $num_eng = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $nums = str_replace($num_nepali, $num_eng, $num);
    return $nums;
}
