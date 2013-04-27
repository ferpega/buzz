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


    /**
     * @param array $criteria WHERE fields
     * @param array $order ORDER BY field and order criteria
     * @param bool $limit if false, retrieves all the rows
     * @param int $offset
     * @return mixed
     */
    function findAll($criteria=array(), $order=array(), $limit=false, $offset=0){

        $params = $param_filters = array();

        $sql = 'SELECT * FROM post as p';

        $where = false;
        if(count($criteria)){

        }

        if(count($order)){

            foreach($order as $key => $criteria){
                $sql .= " ORDER BY {$key} {$criteria} ";
                break;
            }

        }

        if($limit){
            $sql .= ' LIMIT :offset, :limit;';
            $params["limit"]        = $limit;
            $param_filters["limit"] = \PDO::PARAM_INT;
            $params["offset"]        = $offset;
            $param_filters["offset"] = \PDO::PARAM_INT;
        }

        $stmt = $this->_conn->prepare($sql);



        foreach($params as $key=>$param){
            $stmt->bindValue($key, $param, $param_filters[$key]);
        }
        $stmt->execute();

        return $stmt->fetchAll();
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
