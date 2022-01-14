<?php

namespace App\Models;

use MF\Model\Model;

class Usuario extends Model{

    private $id;
    private $nome;
    private $email;
    private $celular;
    private $senha;

    public function __get($atributo){
        return $this->$atributo;
    }
    public function __set($atributo,$valor){
        $this->$atributo = $valor;
    }

    public function inscreverse(){
        
        $query = "insert into tb_usuarios (nome, email, celular, senha)values(:nome, :email, :celular, :senha)";
        $stmt = $this->db->prepare($query); 
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':celular', $this->__get('celular'));
        $stmt->bindValue(':senha', $this->__get('senha'));

        $stmt->execute();
        return $this;


    }

    public function validaUsuario(){
        $valido = true;
        if (strlen($this->__get('nome')) < 3 || $this->__get('nome') == '' ) {
            $valido = false;
        }
        if (strlen($this->__get('email')) < 3 || $this->__get('email') == '' ) {
            $valido = false;
        }
        if (strlen($this->__get('senha')) < 3 || $this->__get('senha') == '' ) {
            $valido = false;
        }

        return true;
    }

    public function getUsuarioPorEmail(){

        $query = "select nome,email from tb_usuarios where email = :email";
        $stmt = $this->db->prepare($query); 
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        
    }

    public function autenticar(){
        
        $query = "select id,nome,email from tb_usuarios where email = :email and senha = :senha";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();

        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

        if($usuario['id'] != '' && $usuario['nome'] != ''){
            $this->__set('id', $usuario['id']);
            $this->__set('nome', $usuario['nome']);

        } 

        return $this;
    }

    public function getInfoUsuario(){

        $query = "select nome,date_format(data_registro, '%d/%m/%y') as data from tb_usuarios where id= :id_usuario";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_usuario', $this->__get('id'));
     
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }
   
}

?>