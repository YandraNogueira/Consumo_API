<?php 

function api (){
    $url = "https://www.canalti.com.br/api/pokemons.json";
    $pokemons = json_decode(file_get_contents($url));

    return $pokemons;
}

?>