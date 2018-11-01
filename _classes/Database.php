<?php

class Database implements iDatabase
{
    
    /*
     * This property retrieves from the iDatabase interface
     * an array which contains key values
     * which enable a given database connection.
     * (GitHub viewers shall not see the iDatabase interface file.)
     */
    protected $dbKeys = iDatabase::KEYS;
    
    /*
     * This method returns a string for the Data Source Name (DSN)
     * which complies with the PHP Database Object (PDO).
     */
    protected function dsn() : string
    {
        return "mysql:"
        . "host={$this->dbKeys['host']};"
        . "dbname={$this->dbKeys['dbname']};"
        . "charset={$this->dbKeys['charset']}";
    }
    
    /*
     * This metnod returns a new PHP Database Object (PDO).
     * A PHP file in this project needs only to call this method
     * to connect to the MySQL database related to this project.
     */
    public function connect() : PDO
    {
        return new PDO(
            $this->dsn(),
            $this->dbKeys['uname'],
            $this->dbKeys['pword']
        );
    }
    
}