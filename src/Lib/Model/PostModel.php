<?php
/**
 * Created by Asier Marqués.
 * User: Asier
 * Date: 27/04/13
 * Time: 12:37
 */

namespace Lib\Model;

class PostModel{

    private $_conn;
    const TABLE = "post";

    function __construct(\Doctrine\DBAL\Connection $conn){
        $this->_conn = $conn;
    }

    function find($id){
        return $this->_conn->fetchAssoc('SELECT * FROM post WHERE id = ?', array($id), array(\PDO::PARAM_INT));
    }

    function findAll(){
        return $this->_conn->fetchAssoc('SELECT * FROM post as p ORDER BY p.created_at DESC');
    }


    function create($data){
        if($this->_conn->insert(static::TABLE, $data)){
            return $this->find($this->_conn->lastInsertId());
        }
        return null;
    }

    function update($data, $id){
        if($this->_conn->update(static::TABLE, $data, array("id"=>$id))){
            return $this->find($id);
        }
        return null;
    }

    function delete($id){
        if($this->_conn->delete(static::TABLE, array("id"=>$id))){
            return true;
        }
        return null;
    }
}
