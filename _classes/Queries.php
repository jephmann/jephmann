<?php

/**
 * Description of Queries
 *
 * @author Jeffrey
 */
class Queries
{
    
    /*
     * methods: basic create/read/update/delete (C*R*U*D) statements,
     * many of which are parameterized for PDO
     */
    
    public function create( string $table, array $parameters ) : string
    {
        $fields = $this->listFields( $parameters );
        $values = $this->parameterizeFields( $parameters );        
        return "INSERT INTO {$table} ({$fields}) VALUES ({$values})";
    }    
    
    public function readAll( string $table, string $orderBy = '' ) : string
    {
        $readAll = "SELECT * FROM {$table}";
        if( $orderBy )
        {
            $readAll .= " ORDER BY {$orderBy}";
        }
        return $readAll;
    }
    
    public function readOne( string $table, string $orderBy = '' ) : string
    {
        return $this->readAll( $table, $orderBy ) . " WHERE id = :id LIMIT 1";                
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
    
    // create table
    public function createTable( string $table, string $fields ) : string
    {        
        return "CREATE TABLE {$table} ( $fields )";
    }
    
    // keep table and structure; remove data
    public function clearTable( string $table ) : string
    {        
        return "TRUNCATE TABLE {$table}";
    }
    
    // remove table
    public function dropTable( string $table ) : string
    {        
        return "DROP TABLE IF EXISTS {$table}";
    }
    
    /*
     * methods: auxiliary for this class
     */
    
    // for INSERT:
    // prepare a comma-delimited list of fields for INSERT
    protected function listFields( array $parameters ) : string
    {
        return join( ',', $parameters );
    }
    
    // for parameterized INSERT:
    // prepare a comma-delimited list of value stand-ins based on field names
    protected function parameterizeFields( array $parameters ) : string
    {
        $parameterized = array();
        foreach( $parameters as $parameter )
        {
            $parameterized[] = ":{$parameter}";            
        }
        
        return join( ',', $parameterized );                
    }
    
    // for parameterized UPDATE:
    // prepare a comma-delimed list of 'field=:value' pairings
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
