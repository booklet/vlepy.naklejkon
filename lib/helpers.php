<?php
function to_pln($liczba)
{
    return number_format($liczba, 2, ',', '&nbsp;') . '&nbsp;zł';
}
