<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class CategoriaDAO extends Conexao { 

    public function CadrastarCategoria($nomeCat)
    {

        if (trim($nomeCat) == '') {
            return 0;
        } else {
           // return 1;
           // 1° Vamos criar a chamada dos recursos da classe Conexão (herança).
           $conexao = parent::retornarConexao();

           // 2º Vamos criar o Injet script SQL, que o PDO vai executar no banco de dados.
           $comando_slq = 'INSERT INTO tb_categoria(nome_categoria, id_usuario) VALUE(?, ?);';

           // 3º Vamos criar um objeto com os recursos da função nativa do php PDO.
           $sql = new PDOStatement();

           // 4º Vamos preparar a execução do Script SQL via PDO.
           $sql = $conexao->prepare($comando_slq);

           // 5º Vamos realizar a validação dos dados que serão inseridas na tabela do banco de dados.
           $sql->bindValue(1, $nomeCat);
           $sql->bindValue(2, UtilDAO::UsuarioLogado());

           // 6º Realiza a tentativa de execução dos processos desenvolvidos ou realiza a tratação de possiveis bugs.
           try{
            $sql->execute();
            return 1;
           }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
           }
        }
    }

    public function ConsultarCategoria() {
        
        $conexao = parent::retornarConexao();

        $comando_sql = 'SELECT id_categoria, nome_categoria FROM tb_categoria WHERE id_usuario = ? ORDER BY nome_categoria ASC;';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLogado());

        // Essa linha de comando, realiza uma consulta no Banco de Dados via PDO, retornando um Array com tudo que foi encontrado!
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharCategoria($idCategoria) {
        if($idCategoria == ''){
          return 0;
        }else{
            $conexao = parent::retornarConexao();

            $comando_slq = 'SELECT id_categoria, nome_categoria FROM tb_categoria WHERE id_categoria = ? AND id_usuario = ?';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_slq);

            $sql->bindValue(1, $idCategoria);
            $sql->bindValue(2, UtilDAO::UsuarioLogado());

            $sql-> setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            return $sql->fetchAll();
        }
         
    }

    public function AlterarCategoria($nomeCat, $idCategoria)
    {
        if ($nomeCat == '') {
            return 0;
        } else {
          //  return 1;
          $conexao = parent::retornarConexao();

          $comando_slq = 'UPDATE tb_categoria SET nome_categoria = ? WHERE id_categoria = ? AND id_usuario = ?';

          $sql = new PDOStatement();

          $sql = $conexao->prepare($comando_slq);

          $i = 1;

          $sql->bindValue($i++, $nomeCat);
          $sql->bindValue($i++, $idCategoria);
          $sql->bindValue($i++, UtilDAO::UsuarioLogado());
          
          try{
            $sql->execute();
            return 1;
           }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
           } 
  
        }
    }

    public function ExcluirCategoria($idCategoria) {
      if($idCategoria == ''){
        return 0;
      }
      else{
        $conexao = parent::retornarConexao();

        $comando_slq = 'DELETE FROM tb_categoria WHERE id_categoria = ? AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_slq);
       
        $sql->bindValue(1, $idCategoria);
        $sql->bindValue(2, UtilDAO::UsuarioLogado());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -4;
        }
      }
    }
}
