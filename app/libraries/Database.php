<?php

/**
 * PDO Database Class
 * Connect to Database
 * Create Prepared Statement
 * Bind Values
 * Return rows and result
 */
class Database
{
    private $host = DB_HOST;
    private $user = DB_Usser;
    private $password = DB_PASSWORD;
    private $dbName = DB_NAME;

    private $dbh;
    private $statement;
    private $error;

    public function __construct()
    {
        //set DSN
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        
        //Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * Prepare statement with query
     *
     * @param [type] $query
     * @return void
     */
    public function query($query)
    {
        $this->statement = $this->dbh->prepare($query);
    }

    /**
     * Bind the param
     *
     * @param [type] $param
     * @param [type] $value
     * @param [type] $type
     * @return void
     */
    public function bind($param, $value, $type = null)
    {
        if(is_null($type)){
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param,$value,$type);
    }

    /**
     * Execute Prepare statement
     *
     * @return void
     */
    public function execute()
    {
        return $this->statement->execute();
    }

    /**
     * Get Result set as array of objects
     *
     * @return void
     */
    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get single record as object
     *
     * @return void
     */
    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Return total number of rows
     *
     * @return void
     */
    public function rowCount()
    {
        return $this->statement->rowCount();
    }

    
}