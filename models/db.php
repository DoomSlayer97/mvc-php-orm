<?php

class PDOConnection {

    protected $pdo;

    public function __construct() {
        
        $this -> pdo = new PDO('mysql:dbname=crud;host=localhost;',
            'root',
            ''
        );

    }

}

class PDOClass extends PDOConnection {

    protected $table;
    protected $columns;
    protected $id = "id";

    private $query;
    
    public function query() {
        
        if ( empty($this -> table) )
            $this -> query = new QueryBuilder($this -> pdo);
        else {

            $this -> query = new QueryBuilder($this -> pdo);

            $this -> query -> table($this -> table);

        }
        
        return $this -> query;
    }

    public function find() {

        return $this -> query()
            -> table($this -> table)
            -> getList();
    }

    public function findOne($id) {
        
        return $this -> query()
            -> where($this -> id, "=", $id)
            -> get();

    }

    public function create($data) {

        $columnsArray = [];
        $columnsString = "";

        $paramsArray = [];
        $paramsString = "";

        $executeParamArrays = [];

        foreach ($data as $key => $value) {

            if ( in_array($key, $this -> columns) ) 
                if ( !is_null($value) ) {

                    $columnTableIndex = array_search($key, $this -> columns);

                    array_push($paramsArray, "?");
                    array_push($columnsArray, $this -> columns[$columnTableIndex]);

                    array_push($executeParamArrays, $value);

                }

        }

        $paramsString = implode(",", $paramsArray);
        $columnsString = implode(",", $columnsArray);

        $query = "INSERT INTO " 
            . $this -> table 
            . " ("
            . $columnsString 
            . ") " 
            . "VALUES ("
            . $paramsString
            . ")";

        $statment = $this -> pdo
            -> prepare($query);

        return $statment -> execute($executeParamArrays);

    }

    public function update($data = [], $id) {

        $paramsArray = [];
        $paramsString = "";

        $executeParamArrays = [];

        foreach ($data as $key => $value) {

            if ( in_array($key, $this -> columns) )
                if ( !is_null($value) ) {

                    $columnTableIndex = array_search($key, $this -> columns);

                    array_push($paramsArray, $this -> columns[$columnTableIndex]. "=" . "?");

                    array_push($executeParamArrays, $value);

                }

        }

        array_push($executeParamArrays, $id);

        $paramsString = implode(", ", $paramsArray);

        $query = "UPDATE "
            . $this -> table
            . " SET "
            . $paramsString
            . " WHERE "
            . $this -> id
            . "="
            . "?";

        $statment = $this -> pdo
            -> prepare($query);

        return $statment -> execute($executeParamArrays);

    }

    public function findByQuery($columns = "*", $conditionsArray = []) {

        $queryConditions = [];

        $queryConditionsString = "";
        $queryConditionsValues = [];

        foreach ($conditionsArray as $item) {

            $queryCondition = $item[0] . " " . $item[1] . " " . "?";

            array_push($queryConditions, $queryCondition);
            array_push($queryConditionsValues, $item[2]);

        }

        $queryConditionsString = implode(" AND ", $queryConditions);

        $query = "SELECT"
            . " "
            . $columns
            . " "
            . "FROM"
            . " "
            . $this -> table;

        if ( count($conditionsArray) > 0 )
            $query .= " WHERE " . $queryConditionsString;

        $statment = $this -> pdo
            -> prepare($query);
        
        $statment -> execute($queryConditionsValues);

        return $statment -> fetchAll(PDO::FETCH_ASSOC);

    }

    public function findOneByQuery($columns = "*", $conditionsArray = []) {

        $queryConditions = [];

        $queryConditionsString = "";
        $queryConditionsValues = [];

        foreach ($conditionsArray as $item) {

            $queryCondition = $item[0] . " " . $item[1] . " " . "?";

            array_push($queryConditions, $queryCondition);
            array_push($queryConditionsValues, $item[2]);

        }

        $queryConditionsString = implode(" AND ", $queryConditions);

        $query = "SELECT"
            . " "
            . $columns
            . " "
            . "FROM"
            . " "
            . $this -> table;

        if ( count($conditionsArray) > 0 )
            $query .= " WHERE " . $queryConditionsString;

        $statment = $this -> pdo
            -> prepare($query);
        
        $statment -> execute($queryConditionsValues);

        return $statment -> fetch(PDO::FETCH_ASSOC);

    }
    
}

class QueryBuilder {

    private $tableName;
    private $columns = "*";
    private $wheres;
    private $joins;
    private $pdo;
    private $paramsArray;

    public function __construct(PDO $pdo) {

        $this -> pdo = $pdo;
        
    }
    
    public function table($tableName = "") {

        $this -> tableName = $tableName;

        return $this;

    }

    public function select($columns = "*") {

        $this -> columns = $columns;

        return $this;

    }

    public function join($type = 'left', $table, $condition = "") {

        $this -> joins[] = [$type, $table, $condition];

        return $this;

    }

    public function where($column, $operation = '=', $value) {

        $this -> wheres[] = [$column, $operation, $value];

        return $this;

    }

    public function and() {

        $this -> wheres[] = "AND";

        return $this;
        
    }

    public function or() {

        $this -> wheres[] = "OR";

        return $this;

    }

    public function buildQuery() {

        $buildedQuery = "";
    
        $buildedQuery .= " SELECT " . $this -> columns . " FROM " . $this -> tableName . " ";

        if ( !empty($this -> joins) ) {

            foreach($this -> joins as $item) {

                $buildedQuery .= "INNER " . $item[0] . " " . $item[1] . " ON " . $item[2] . " ";

            }

        }

        if ( !empty($this -> wheres) ) {

            $queryWhere = " WHERE ";

            foreach($this -> wheres as $whereCondition) {

                if ( $whereCondition === "AND" || $whereCondition === "OR" ) {

                    $queryWhere .= " " . $whereCondition . " ";

                } else {

                    $valueCondition = $whereCondition[2];
                    $valueConditionFormated = is_string($valueCondition) ? "'" . $valueCondition . "'" : $valueCondition;
                        
                    $queryWhere .= $whereCondition[0] . " " . $whereCondition[1] . " " . $valueConditionFormated . " ";

                }
                
            }
            
            $buildedQuery .= $queryWhere;
        }

        return $buildedQuery;

    }

    public function getList() {

        $buildedQuery = $this -> buildQuery();

        $statment = $this -> pdo
            -> prepare($buildedQuery);

        $statment -> execute();

        return $statment -> fetchAll(PDO::FETCH_ASSOC);

    }

    public function get() {

        $buildedQuery = $this -> buildQuery();

        $statment = $this -> pdo
            -> prepare($buildedQuery);

        $statment -> execute();

        return $statment -> fetch(PDO::FETCH_ASSOC);
        
    }

}