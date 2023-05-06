<div class="responsive">
      <div class="galeria">
        <a target="_blank" href="img_5terre.jpg">
          <img src="./img/casa.png" alt="Cinque Terre" width="800" height="600">
        </a>
        <h4> <?= $anuncio['titulo'] ?></h4>
        <h4><strong>R$ </strong><?= $anuncio['preco'] ?></h4>
        <h4><strong>CEP </strong><?= $anuncio['cep'] ?></h4>
        <h4><?= $anuncio['criado_em'] ?></h4>
        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInfo<?= $anuncio['id'] ?>">ALUGAR</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal<?= $anuncio['id'] ?>">IMAGENS</button>
      </div>
     
    </div>

    <div class="modal fade" id="modalInfo<?= $anuncio['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4><?= $anuncio['nome'] ?></h4>
            <h4><?= $anuncio['telefone'] ?></h4>
            <h4><?= $anuncio['descricao'] ?></h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="modal<?= $anuncio['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body">

            <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
              <ol class='carousel-indicators'>
                <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
                <?php 
                $imagens = explode(';', $anuncio['imagens']);
                for($i=0; $i < count($imagens); $i++) : ?>
                <li data-target='#carouselExampleIndicators' data-slide-to='<?= $i; ?>'></li>
                <?php endfor; ?>
              </ol>
              <!-- <div class='carousel-item active'>
                  <img class='img-size' src='' alt='First slide' />
                </div> -->
                <?php foreach ($imagens as $imagem) : ?>
                  <img class='img-size' src='<?= $imagem ?>' alt='Second slide' />
                <?php endforeach; ?>
              </div>
              <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                <span class='sr-only'>Previous</span>
              </a>
              <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                <span class='sr-only'>Next</span>
              </a>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>