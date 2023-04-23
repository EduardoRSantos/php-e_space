<div class="responsive">
      <div class="galeria">
        <a target="_blank" href="img_5terre.jpg">
          <img src="./img/casa.png" alt="Cinque Terre" width="800" height="600">
        </a>
        <h4><?= $key['titulo'] ?></h4>
        <h4><?= $key['preco'] ?></h4>
        <h4><?= $key['cep'] ?></h4>
        <h4><?= $key['criado_em'] ?></h4>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInfo<?= $key['id'] ?>">ALUGAR</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal<?= $key['id'] ?>">imagens</button>
      </div>
    </div>

    <div class="modal fade" id="modalInfo<?= $key['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4><?= $key['nome'] ?></h4>
            <h4><?= $key['telefone'] ?></h4>
            <h4><?= $key['descricao'] ?></h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="modal<?= $key['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body">
            <!-- carousel -->
            <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
              <ol class='carousel-indicators'>
                <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
                <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
                <li data-target='#carouselExampleIndicators' data-slide-to='2'></li>
              </ol>
              <div class='carousel-inner'>
                <div class='carousel-item active'>
                  <img class='img-size' src='https://images.unsplash.com/photo-1485470733090-0aae1788d5af?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1391&q=80' alt='First slide' />
                </div>
                <div class='carousel-item'>
                  <img class='img-size' src='https://images.unsplash.com/photo-1491555103944-7c647fd857e6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80' alt='Second slide' />
                </div>
                <div class='carousel-item'>
                  <img class='img-size' src='https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80' alt='Second slide' />
                </div>
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