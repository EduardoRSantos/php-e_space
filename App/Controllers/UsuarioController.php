<?php

namespace App\Controllers;

use Psr\Http\Message\{ResponseInterface as Response,ServerRequestInterface as Request};
use App\DAO\UsuariosDAO;
use App\Models\UsuarioModel;

final class UsuarioController{

    public function login(Request $request, Response $response, array $args): Response {
        
        $input = file_get_contents('php://input');

        $data = json_decode($input, true);

        $email = $data['email'];
        $senha = $data['senha'];
        
        $usuario_dao = new UsuariosDAO();
        $usuario = $usuario_dao->getUsuarioByEmail($email);
        if(is_null($usuario))
            return $response->withStatus(404);

        if(!password_verify($senha, $usuario->getSenha()))
            return $response->withStatus(401);

        $response = $response->withJson([
            "id" => $usuario->getId(),
            "nome" => $usuario->getNome(),
            "email" => $usuario->getEmail(),
            "senha" => $usuario->getSenha(),
            "telefone" => $usuario->getTelefone()
        ]);
        return $response;
    }

    public function allUsuarios(Request $request, Response $response, array $args): Response {
        $usuario_dao = new UsuariosDAO();
        $usuario = $usuario_dao->allUsuarios();
        $response = $response->withJson($usuario);
        return $response;    
    }

    public function inserirUsuario(Request $request, Response $response, array $args): Response {
        $input = file_get_contents('php://input');

        $data = json_decode($input, true);
  
        $usuario_dao = new UsuariosDAO();
        $usuario_model = new UsuarioModel();

        $nome = $data['nome'];
        $email = $data['email'];
        $senha = $data['senha'];
        $telefone = $data['telefone'];

        $usuario = $usuario_dao->getUsuarioByEmail($email);

        if(is_null($usuario)){
            $usuario_model
            ->setNome($nome)
            ->setemail($email)
            ->setsenha(password_hash($senha, PASSWORD_DEFAULT))
            ->setTelefone($telefone);
            $usuario_dao->inserirUsuario($usuario_model);
            $response = $response->withStatus(200);
        }else{
            $response = $response->withStatus(401);
        }
            return $response;
    }
    public function atualizarUsuario(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();

        $usuario_dao = new UsuariosDAO();
        $usuario_model = new usuarioModel();
        $usuario_model
        ->setNome($data['nome'])
        ->setEmail($data['email'])
        ->setSenha(password_hash($data['senha'], PASSWORD_DEFAULT))
        ->setId($data['id']);
        $usuario_dao->atualizarUsuario($usuario_model);

        $response = $response->withJson(['menssage' => 'atualizado com sucesso!']);
        return $response;
    }
}