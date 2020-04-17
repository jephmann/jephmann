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
    
    public function readAll(
        string $table,
        string $orderBy = '',
        string $fields = ''
    ) : string
    {
        $readAll = $this->select( $table );
        if( $orderBy )
        {
            $readAll .= " ORDER BY {$orderBy}";
        }
        return $readAll;
    }
    
    public function readOne(
        string $table,
        string $orderBy = '',
        string $fields = ''
    ) : string
    {
        return $this->readAll( $table, $orderBy, $fields ) . " WHERE id = :id LIMIT 1";                
    }
    
    public function readSome(
        string $table,
        array $where,
        string $orderBy = '',
        string $fields = ''
    ) : string
    {
        $readSome = $this->select( $table, $fields )
            . $this->whereFields( $where ); 
        if( $orderBy )
        {
            $readSome .= " ORDER BY {$orderBy}";
        }
        return $readSome;
    }
    
    public function countRecords( string $table, array $where ) : string
    {
        return "SELECT COUNT(*) FROM {$table}{$this->whereFields( $where )}";
        // in your code, upon calling this method,
        // $result->fetchColumn() returns integer of records.
    }
    
    public function update( string $table, array $parameters ) : string
    {
        $fields = $this->changeFields($parameters);
        return "UPDATE {$table} SET {$fields} WHERE id = :id";
    }
    
    public function updateWhere(
        string $table,
        array $whereParameters,
        array $updateParameters
    ) : string
    {
        $fields = $this->changeFields($updateParameters);
        $where  = $this->whereFields($whereParameters);
        return "UPDATE {$table} SET {$fields}{$where}";
    }
    
    public function delete( string $table ) : string
    {
        return "DELETE FROM {$table} WHERE id = :id";
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

    // count only the records/rows of a table
    public function countTable( string $table ) : string
    {
        return "SELECT COUNT(*) from {$table}";
    }  
    
    
    /*
     * methods: query clauses
     */
    
    // for INSERT:
    // prepare a comma-delimited list of fields for INSERT
    protected function listFields(
        array $parameters
    ) : string
    {
        return join( ', ', $parameters );
    }
    
    // for parameterized INSERT:
    // prepare a comma-delimited list of value stand-ins based on field names
    protected function parameterizeFields(
        array $parameters
    ) : string
    {
        $parameterized = array();
        foreach( $parameters as $parameter )
        {
            $parameterized[] = ":{$parameter}";            
        }
        
        return join( ', ', $parameterized );                
    }
    
    // for parameterized UPDATE:
    // prepare a comma-delimed list of 'field=:value' pairings
    protected function changeFields(
        array $parameters
    ) : string
    {
        $changed = array();
        foreach( $parameters as $parameter )
        {
            $changed[] = "{$parameter} = :{$parameter}";            
        }
        
        return join( ', ', $changed );        
    }
    
    // for parameterized SELECT and UPDATE:
    // prepare a "AND"-delimed list of 'field=:value' pairings
    protected function whereFields(
        array $parameters
    ) : string
    {
        $changed = array();
        foreach( $parameters as $parameter )
        {
            $changed[] = "{$parameter} = :{$parameter}";            
        }
        
        return ' WHERE ' . join( ' AND ', $changed );        
    }
    
    // basic SELECT clause
    protected function select(
        string $table,
        string $fields = ''
    ) : string
    {
        // if no field names, all (^) fields are selected
        $selection  = $fields ?: '*';
        $select     = "SELECT {$selection} FROM {$table}";        
        return $select;
    }
    
    // for SELECT:
    // create a table-join clause based on tables and their key fields
    public function tableJoin( string $joinType,
        string $leftTable, string $leftField, string $rightTable, string $rightField
    ): string
    {
        switch ( $joinType )
        {
            case 'I':
            case 'i':
                $join = 'INNER';
                break;
            case 'L':
            case 'l':
                $join = 'LEFT';
                break;
            case 'R':
            case 'r':
                $join = 'RIGHT';
                break;
            case 'F':
            case 'f':
            case 'O':
            case 'o':
            case 'FO':
            case 'fo':
            case 'Fo':
            case 'fO':
                $join = 'FULL OUTER';
                break;
        }
        
        return " {$leftTable} {$join} JOIN {$rightTable}"
            . " ON {$leftTable}.{$leftField}"
            . " = {$rightTable}.{$rightField}";
    }
    
}
