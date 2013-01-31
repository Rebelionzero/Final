<?php
function miLoader($clase) {
    include_once(__DIR__.'/clases/'.$clase.'.php');
}
spl_autoload_register('miLoader');