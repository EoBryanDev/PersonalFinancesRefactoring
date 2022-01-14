<?php

namespace App\Models;

use MF\Model\Model;

class Despesa extends Model{

    private $id;
    private $id_usuario;
    private $ano;
    private $mes;
    private $dia;
    private $naturezaDespesa;
    private $naturezaGanho;
    private $descricao;
    private $valor;

    public function __get($atributo){
        return $this->$atributo;
    }
    public function __set($atributo,$valor){
        $this->$atributo = $valor;
    }

    public function cadastrarDespesas(){

        $query = "insert into tb_despesas(id_usuario,ano,mes,dia,despesa,descricao,valor)values(:id_usuario,:ano,:mes,:dia,:despesa,:descricao,:valor)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':ano', $this->__get('ano'));
        $stmt->bindValue(':mes', $this->__get('mes'));
        $stmt->bindValue(':dia', $this->__get('dia'));
        $stmt->bindValue(':despesa', $this->__get('naturezaDespesa'));
        $stmt->bindValue(':descricao', $this->__get('descricao'));
        $stmt->bindValue(':valor', $this->__get('valor'));
        $stmt->execute();

        return $this;
    }
    public function cadastrarGanhos(){

        $query = "insert into tb_ganhos(id_usuario,ano,mes,dia,ganho,descricao,valor)values(:id_usuario,:ano,:mes,:dia,:ganho,:descricao,:valor)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':ano', $this->__get('ano'));
        $stmt->bindValue(':mes', $this->__get('mes'));
        $stmt->bindValue(':dia', $this->__get('dia'));
        $stmt->bindValue(':ganho', $this->__get('naturezaGanho'));
        $stmt->bindValue(':descricao', $this->__get('descricao'));
        $stmt->bindValue(':valor', $this->__get('valor'));
        $stmt->execute();

        return $this;
    }

    public function getAll(){
        $query = "
        select
	        d.id as id_despesa,d.id_usuario,d.descricao,d.valor,d.data_registro as data,u.id,dd.descricao as descricao_despesa
        from
	        tb_despesas as d
        inner join 
            tb_descricao_despesas as dd on d.despesa = dd.id
        right join 
            tb_usuarios as u on d.id_usuario = u.id
        where
            d.id_usuario = :id_usuario
        order by 
	        d.data_registro desc;
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();

        $despesa = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $despesa;
    }


    public function totalValor(){
        $query = "
        select
	        d.id,
            d.id_usuario,
            u.id,
            (select sum(valor)) as soma
        from
	        tb_despesas as d
        inner join tb_descricao_despesas as dd on d.despesa = dd.id
        right join tb_usuarios as u on d.id_usuario = u.id
        where
            d.id_usuario = :id_usuario
        order by 
	        d.data_registro desc;
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();

        $totalDespesas = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $totalDespesas;
    }

    public function getAllGanhos(){
        $query = "
        select
	        g.id as id_ganho,g.id_usuario,g.descricao,g.valor,g.data_registrodata_registro as data,u.id,g.ganho,gg.descricao as descricao_ganho
        from
	        tb_ganhos as g
        inner join 
            tb_descricao_ganhos as gg on g.ganho = gg.id
        right join 
            tb_usuarios as u on g.id_usuario = u.id
        where
            g.id_usuario = :id_usuario
        order by 
	        g.data_registrodata_registro desc;
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();

        $ganho = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $ganho;
    }

    public function totalValorGanhos(){
        $query = "
        select
	        g.id,
            g.id_usuario,
            u.id,
            (select sum(valor)) as soma
        from
	        tb_ganhos as g
        inner join tb_descricao_ganhos as gg on g.ganho = gg.id
        right join tb_usuarios as u on g.id_usuario = u.id
        where
            g.id_usuario = :id_usuario
        order by 
            g.data_registrodata_registro desc;
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();

        $totalGanhos = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $totalGanhos;
    }

    public function deletarDespesa($id_despesa){
        $query = 'delete from tb_despesas where id_usuario = :id_usuario and id = :id';

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_usuario', $this->__get('id'));
        $stmt->bindValue(':id', $id_despesa);
        $stmt->execute();
        
        return true;
    }

    public function deletarGanho($id_ganho){
        $query = "delete from tb_ganhos where id_usuario = :id_usuario and id = :id";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_usuario', $this->__get('id'));
        $stmt->bindValue(':id', $id_ganho);
        $stmt->execute();
        
        return true;
    }

    public function totalDespesaPorCategoria(){
        $query = "  select 
                        sum(valor) as soma, dd.descricao
                    from
                        tb_despesas as d
                    left join tb_descricao_despesas as dd on d.despesa = dd.id
                    where 
                        id_usuario = :id_usuario
                    group by
                    dd.descricao";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();

        $totalGanhosPorCategoria = $stmt->fetchAll(\PDO::FETCH_ASSOC);
       
        return $totalGanhosPorCategoria;
    }
}

?>