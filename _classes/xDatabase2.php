<?php

class Database2 implements DatabaseInterface
{
     
    /*
     * properties
     */
    
    protected $host       = 'custsqlmoo8';
    protected $dbname     = 'jephmann';
    protected $charset    = 'utf8';
    protected $uname      = 'ripemango';
    protected $pword      = '';
    
    /*
     * methods: database connection
     */
    
    protected function dsn() : string
    {
        return "mysql:"
        . "host={$this->host};"
        . "dbname={$this->dbname};"
        . "charset={$this->charset}";
    }
    
    public function connect()
    {
        return new PDO( $this->dsn(), $this->uname, $this->pword );
    }
    
    /*
     * methods: C*R*U*D
     */
    
    public function create( string $table, array $parameters ) : string
    {
        $fields = $this->listFields( $parameters );
        $values = $this->parameterizeFields( $parameters );
        
        return "INSERT INTO {$table} ({$fields}) VALUES ({$values})";
    }    
    
    public function readAll( string $table ) : string
    {
        return "SELECT * FROM {$table}";
    }
    
    public function readAllById( string $table ) : string
    {
        return "{$this->readAll( $table )} WHERE id = :id";                
    }
    
    public function update( string $table, array $parameters ) : string
    {
        $fields = $this->changeFields($parameters);
        return "UPDATE {$table} SET {$fields} WHERE id = :id";
    }
    
    public function delete( string $table ) : string
    {
        return "DELETE FROM {$table} WHERE id=:id";
    }
    
    /*
     * methods: additional database functions
     */
    
    public function clearTable( string $table ) : string
    {
        return "TRUNCATE TABLE {$table}";
    }
    
    /*
     * methods: auxiliary for this class
     */
    
    protected function listFields( array $parameters ) : string
    {
        return join( ',', $parameters );
    }
    
    protected function parameterizeFields( array $parameters ) : string
    {
        $parameterized = array();
        foreach( $parameters as $parameter )
        {
            $parameterized[] = ":{$parameter}";            
        }
        
        return join( ',', $parameterized );                
    }
    
    protected function changeFields( array $parameters ) : string
    {
        $changed = array();
        foreach( $parameters as $parameter )
        {
            $changed[] = "{$parameter}=:{$parameter}";            
        }
        
        return join( ',', $changed );        
    }    
    
}