<!DOCTYPE html>
<html>
<?php session_start(); ?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meus Anúncios</title>
  <link rel="stylesheet" href="./pages/modal/modal_carousel.css" />
  <link rel="stylesheet" href="../css/tela_meus_anuncios.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <header>
    <h1>Meus Anúncios</h1>
  </header>

  <?php

  if (!empty($_SESSION)) {
    $id = $_SESSION['id'];

    $body = [
      'id' => $id,
    ];

    $json = json_encode($body, true);

    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => 'http://localhost/E_space/routes/index.php/anuncios/usuario',
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POSTFIELDS => $json,
      CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
      ]
    ]);

    $response = curl_exec($curl);

    $data = json_decode($response, true);

    curl_close($curl);

    if (!empty($data)) {
      foreach ($data as $anuncio) :
        $imagens = explode(';', $anuncio['imagens']); ?>
        <div class="anuncio">
          <div class="responsive">
            <div class="galeria">
              <a target="_blank" href="img_5terre.jpg">
                <img src="./img/casa.png" alt="Cinque Terre" width="800" height="600">
              </a>
              <?php if ($anuncio['autorizacao'] == 0) { ?>
                <h4>Aguarde a avaliação, logo seu anúncio sera postado</h4>
              <?php } else { ?>
                <h4>Anúncio postado</h4>
              <?php } ?>

              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar<?= $anuncio['id'] ?>">Editar</button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEcluir<?= $anuncio['id'] ?>">Excluir</button>
            </div>
          </div>

          <!-- modal de editar -->
          <div class="modal fade" id="modalEditar<?= $anuncio['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Anúncio</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post">
                  <div class="modal-body">
                    <input type="hidden" value="salvar" name="fazer">
                    <input type="hidden" value="<?= $anuncio['id'] ?>" name="id">
                    <br>
                    <p>titulo: <input type="text" name="titulo" value="<?= $anuncio['titulo'] ?>"></p>
                    <br>
                    <p>preco: <input type="number" name="preco" value="<?= $anuncio['preco'] ?>"></p>
                    <br>
                    <p>localizacao: <input type="text" name="localizacao" value="<?= $anuncio['localizacao'] ?>"></p>
                    <br>
                    <p>cep: <input type="text"name="cep" id="cep" value="<?= $anuncio['cep'] ?>" ></p>
                    <br>
                    <p>numero: <input type="number" name="numero" value="<?= $anuncio['numero'] ?>"></p>
                    <br>
                    <p>quantidade_pessoas: <input type="text" name="quantidade_pessoas" value="<?= $anuncio['quantidade_pessoas'] ?>"></p>
                    <br>
                    <p>Criado: <?= $anuncio['criado_em'] ?></p>
                    <br>
                    <p>Ultima atualização: <?= $anuncio['atualizado_em'] ?></p>
                    <br>
                    <p>descricao: <input type="text" name="descricao" value="<?= $anuncio['descricao'] ?>"></p>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- excluir -->
          <div class="modal fade" id="modalEcluir<?= $anuncio['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Anúncio</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post">
                  <div class="modal-body">
                    <input type="hidden" value="excluir" name="fazer">
                    <input type="hidden" value="<?= $anuncio['id'] ?>" name="id">
                    <p>Certeza que deseja excluir o anúncio</p>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">excluir</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        </div>
      <?php endforeach;
    } else {
      echo "Para criar anuncios "; ?> <a href="../pages/inserir_anuncio.php">Clique aqui!</a> <?php
    }
 } else { ?>
    <script type="text/javascript">
      Swal.fire({
        title: 'Ops!',
        text: 'Antes faça login',
        icon: 'error',
        confirmButtonText: 'Ok'
      }).then((result) => {
        if (result.isConfirmed) {
          location.href = "../index.php";
        }
      })
    </script>
  <?php  } ?>
  <footer>
    <p>&copy; 2023 Meus Anúncios. Todos os direitos reservados.</p>
  </footer>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="../js/mascaras.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
<?php

if (!empty($_POST['fazer'])) {

  if ($_POST['fazer'] == 'salvar') {

    $body = [
      'id' => $_POST['id'],
      'titulo' => $_POST['titulo'],
      'descricao' => $_POST['descricao'],
      'preco' => $_POST['preco'],
      'localizacao' => $_POST['localizacao'],
      'cep' => $_POST['cep'],
      'numero' => $_POST['numero'],
      'quantidade_pessoas' => $_POST['quantidade_pessoas']
    ];

    $json = json_encode($body, true);

    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => 'http://localhost/E_space/routes/index.php/anuncios/atualizar',
      CURLOPT_CUSTOMREQUEST => "PUT",
      CURLOPT_POSTFIELDS => $json,
      CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
      ]
    ]);

    curl_exec($curl);

    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    if ($http_code == 200) { ?>
      <script type="text/javascript">
        Swal.fire({
          title: 'Sucesso',
          text: 'Atualizado feita, por favor agurde uma nova avaliacao',
          icon: 'success',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = "../pages/tela_meus_anuncios.php";
          }
        })
      </script>
    <?php } else if ($http_code == 404) { ?>
      <script type="text/javascript">
        Swal.fire({
          title: 'Ops!',
          text: 'Erro ao salvar, tente novamente',
          icon: 'error',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = "../pages/tela_de_meus_anuncios.php";
          }
        })
      </script>
<?php }
  } else if ($_POST['fazer'] == 'excluir') {

    $json = json_encode(['id' => $_POST['id']], true);

    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => 'http://localhost/E_space/routes/index.php/anuncios/delete',
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $json,
      CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
      ]
    ]);
    curl_exec($curl);
    curl_close($curl); ?>
  <script type="text/javascript">
        Swal.fire({
          title: 'Sucesso',
          text: 'Anuncio apagado, va com deus',
          icon: 'success',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = "../index.php";
          }
        })
      </script>
 <?php }
}

if(empty($_SESSION)){ ?>
<script type="text/javascript">
        Swal.fire({
            title: 'Ops!',
            text: 'Antes faça login',
            icon: 'error',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "../index.php";
            }
        })
    </script>


<?php } ?>

</html>