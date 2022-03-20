<?php

namespace App\Core;
use App\Core\AppServiceProvider;

abstract class Model
{

    protected $pagination = '';

    protected $limit = 100;

    protected $url = '/';

    protected $page = 1;

    protected $offset = 0;


    abstract public function tableName(): string;

    abstract public function tableColumns(): array;


    public function all($columns = [])
    { // fetch all records

        $table = $this->tableName();

        if (count($columns) === 0) {

            $col = '*';
        } else {

            $col = implode(',', $columns);
        }

        try {
            $statement = $this->prepareQuery("select $col from $table");

            $statement->execute();

            $this->setPagination($statement->rowCount());

            $limit = " limit $this->offset, $this->limit";

            $statement = $this->prepareQuery("select $col from $table $limit");

            $statement->execute();

            return $statement->fetchAll();
        } 
        catch (\PDOException $e) 
        {
            echo 'Something went wrong';
        }
    }

    public function create()
    {
        $table = $this->tableName();

        $tbColumns = $this->tableColumns();
        $bindcol =  $this->bindParams($tbColumns);
        $sql = "insert into $table (" . implode(',', $tbColumns) . ") values (" . implode(',', $bindcol) . ")";
        
        try {
            
            $statement = $this->prepareQuery($sql);
            
            foreach ($tbColumns as $column) {

                $statement->bindParam(":$column", $this->{$column});

            }

            $statement->execute();

            return $this->getLastinsertId();

        } 

        catch (\PDOException $e) {
            echo 'Something went wrong '. $e->getMessage() ;
        }
    }

    public function update($value)
    {
        $table = $this->tableName();
        $tbColumns = $this->tableColumns();
      
        $update = "";

        foreach($tbColumns as $col){
            $update .= "`$col` = :$col, ";
        }

        $sql = "update $table set ".rtrim($update, ", ")." where $this->primaryKey=:$this->primaryKey";

        try {
            $statement = $this->prepareQuery($sql);
            $statement->bindParam(":$this->primaryKey", $value);
            foreach ($tbColumns as $column) {
                $statement->bindParam(":$column", $this->{$column});
            }

            $statement->execute();
            return $this->getLastinsertId();
        } 
        catch (\PDOException $e) {
            echo 'Something went wrong '. $e->getMessage();
        }
    }

    public function find($value)
    {

        $table = $this->tableName();

        try {

            $statement = $this->prepareQuery("select * from $table where $this->primaryKey=:$this->primaryKey");

            $statement->bindParam(":$this->primaryKey", $value);

            $statement->execute();

            if ($statement->rowCount() === 1) {

                return $statement->fetch(\PDO::FETCH_OBJ);
            } 
            else {
                return $statement->fetchAll();
            }
        } 
        catch (\PDOException $e) {
            echo 'Something went wrong' . $e->getMessage();
        }
    }


    public function delete($sql, $where = [])
    {

        try {

            $statement = $this->prepareQuery($sql);

            if (count($where) > 0) {

                $statement->execute($where);
            } else {

                $statement->execute();
            }
            return true;
        } catch (\PDOException $e) {
            echo 'Something went wrong in the query';
        }
    }

    public function setPagination($total_records)
    {
        $this->pagination = AppServiceProvider::$app->pagination->getPagination($total_records, $this->limit, $this->url, $this->page);
    }

    protected function prepareQuery($sql)
    {
        return AppServiceProvider::$app->db->prepare($sql);
    }


    public function getLastinsertId()
    {
        return AppServiceProvider::$app->db->lastInsertId();
    }

    protected function bindParams($tbColumns)
    {
        $bindcol = array_map(function ($col) {
            return ":$col";
        }, $tbColumns);

        return  $bindcol;
    }


    protected function getLimit($sql, $where = [])
    {
        try {

            $statement = $this->prepareQuery($sql);

            if (count($where) > 0) {

                $statement->execute($where);

            } 
            else {

                $statement->execute();

            }

            $this->setPagination($statement->rowCount());

            $limit = " limit $this->offset, $this->limit";
            
            return $limit;

        } 
        catch (\PDOException $e) 
        {
            echo 'Something went wrong in the query';
        }
    }

    public function initPagination($limit = 0, $url, $page = 1)
    {
        $this->limit = (int)$limit;
        $this->url = $url;
        $this->page = ((int)$page == 0) ? 1 : (int)$page;
        $this->offset = ($this->page - 1) * $this->limit;
    }
}
