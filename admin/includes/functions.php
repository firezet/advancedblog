<?php
/*function classAutoLoader($class){
    $class = strtolower($class);
    $path = "includes/{$class}.php";

    if(file_exists($path)){
        require_once($path);
    }else{
        die("{$class}.php was not found or the {$class} class does not excist");
    }
}

spl_autoload_register("classAutoLoader");
*/
function redirect($location){
  header("Location: {$location}");
}
?>
