<?php

class Roles {
    
    /*
     * properties
     */
    
    protected $id;
    protected $imdb_tt;
    protected $imdb_nm;
    protected $role;
    protected $uncredited;
    protected $self;
    protected $remarks;
    
    /*
     * methods
     */
    
    public function get_id() {
        return $this->id;
    }

    public function get_imdb_tt() {
        return $this->imdb_tt;
    }

    public function get_imdb_nm() {
        return $this->imdb_nm;
    }

    public function get_role() {
        return $this->role;
    }

    public function get_uncredited() {
        return $this->uncredited;
    }

    public function get_self() {
        return $this->self;
    }

    public function get_remarks() {
        return $this->remarks;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function set_imdb_tt($imdb_tt) {
        $this->imdb_tt = $imdb_tt;
    }

    public function set_imdb_nm($imdb_nm) {
        $this->imdb_nm = $imdb_nm;
    }

    public function set_role($role) {
        $this->role = $role;
    }

    public function set_uncredited($uncredited) {
        $this->uncredited = $uncredited;
    }

    public function set_self($self) {
        $this->self = $self;
    }

    public function set_remarks($remarks) {
        $this->remarks = $remarks;
    }
    
}
