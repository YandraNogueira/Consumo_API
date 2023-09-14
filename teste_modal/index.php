<?php
include('funcao.php');
$pokemons = api();
// $url = "https://www.canalti.com.br/api/pokemons.json"; 
// $ch = curl_init($url); 
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
// $pokemons = json_decode(curl_exec($ch));
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../images/fav_icon.png" type="image/x-icon">
    <title>Pokemóns</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!-- Bulma Version 0.7.2-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="estilo.css">
  </head>
  <body>
    <section class="hero is-info is-small">
      <div class="hero-body">
        <div class="container has-text-centered">
          <p class="title">
            Canal TI - Listagem de Pokémons
          </p>
          <p class="subtitle">
            Consumo de API com PHP
          </p>
        </div>
      </div>
    </section>
    <br>
    <section class="container">
      <?php
      if(count($pokemons->pokemon)) {
      $i = 0;
      foreach($pokemons->pokemon as $Pokemon) {
      $i++;
      ?>
      <?php if($i % 3 == 1) { ?>
      <div class="columns features">
      <?php } ?>
        <div class="column is-4">
          <div class="card">
            <div class="card-image has-text-centered">
              <figure class="image is-128x128">
                <img id="myImg<?=$Pokemon->id?>" src="<?=$Pokemon->img?>" alt="<?=$Pokemon->name?>" class="img"  style="width:100%;max-width:300px">

                <!-- Início Modal -->
                <div id="myModal-img" class="modal-img">
                  <span class="close-img">&times;</span>
                  <img class="modal-content-img" id="img01">
                  <div id="caption"></div>
                </div>
                <!-- Fim Modal -->
            
              </figure>

              <script>
                // Get the modal
                var modal = document.getElementById("myModal-img");

                // Get the image and insert it inside the modal - use its "alt" text as a caption
                var img = document.getElementById("myImg<?=$Pokemon->id?>");
                var modalImg = document.getElementById("img01");
                var captionText = document.getElementById("caption");
                img.onclick = function(){
                  modal.style.display = "block";
                  modalImg.src = this.src;
                  captionText.innerHTML = this.alt;
                }

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close-img")[0];

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() { 
                  modal.style.display = "none";
                }
              </script>


            </div>
            <div class="card-content has-text-centered">
              <div class="content">
                <h4><?=$Pokemon->name?></h4>
                <p>
                  <ul>
                  <?php
                  if(!empty($Pokemon->next_evolution)) {
                    echo "Próximas evoluções: ";
                    foreach($Pokemon->next_evolution as $ProximaEvolucao) {
                        echo $ProximaEvolucao->name . " ";
                    }
                  } else {
                    echo "Não possui próximas evoluções ";
                  }
                ?>
                </ul>
                </p>

                <div class="middle">
                  <a class="btn btn3" data-toggle="modal" data-target="#myModal<?=$Pokemon->id?>">Detalhes</a>
                  </div>
                  <!-- Inicio Modal -->
                  <div class="modal fade" id="myModal<?=$Pokemon->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h2 class="modal-title text-center" id="myModalLabel"><?=$Pokemon->name?></h2>
                          </div>
                            <div class="modal-body">
                              <strong>Id: </strong><?=$Pokemon->id?><br>
                              <br><strong>Poderes: </strong><br> 
                              <?php
                              if(!empty($Pokemon->type)) {
                                  foreach($Pokemon->type as $Poder) {
                                    echo $Poder . "</br>";
                              }
                              } else {
                                    echo "Não possui poderes! ";
                              }
                              ?> 
                              <br><strong>Altura: </strong><?=$Pokemon->height?><br>
                              <br><strong>Largura: </strong><?=$Pokemon->weight?><br>
                              <br><strong>Candy: </strong><?=$Pokemon->candy?><br>
                              <br><strong>Ovo: </strong><?=$Pokemon->egg?><br>
                              <br><strong>Spawn_time: </strong><?=$Pokemon->spawn_time?><br>
                              <br><strong>Fraquezas: </strong><br> 
                              <?php
                              if(!empty($Pokemon->weaknesses)) {
                                  foreach($Pokemon->weaknesses as $Fraquezas) {
                                    echo $Fraquezas . "</br>";
                              }
                              } else {
                                    echo "Não possui fraquezas! ";
                              }
                              ?> 

                            </div>
                            <div class="modal-footer">
                              <h3 class="text-center">Modal Footer</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                  <!-- Fim Modal -->
                
              </div>
            </div>
          </div>
        </div>
             
      <?php if($i % 3 == 0) { ?>
      </div>
      <?php } } } else { ?>
        <strong>Nenhum pokemón retornado pela API</strong>
      <?php } ?>
    </section>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
  </body>
</html>