<?php
  class Person
  {
    /* Properties */
    private $first_name;
    private $last_name;
    private $dob;
    private $gross_income;
    private $net_income;

    /* Constructor */
    public function __construct ( $first_name, $last_name, $dob, $gross_income ) {
      $this->set_first_name( $first_name );
      $this->set_last_name( $last_name );
      $this->set_dob( $dob );
      $this->set_gross_income( $gross_income );
      $this->net_income = ($this->gross_income*0.75);
    }

    /* Setters */
    public function set_first_name ( $first_name ) {
      $this->first_name = $first_name;
    }
    public function set_last_name ( $last_name ) {
      $this->last_name = $last_name;
    }
    public function set_dob ( $dob ) {
      $this->dob = $dob;
    }
    public function set_gross_income ( $gross_income ) {
      $this->gross_income = $gross_income;
      $this->net_income = ($this->gross_income*0.75);
    }


    /* Getters */
    public function get_first_name () {
      return $this->first_name;
    }
    public function get_last_name () {
      return $this->last_name;
    }
    public function get_full_name () {
      return $this->first_name . ' ' . $this->last_name;
    }
    public function get_dob () {
      return $this->dob;
    }
    public function get_gross_income(){
      return $this->gross_income;
    }
    public function get_net_income(){
      $net_income = ($this->gross_income*0.75);
      return $this->net_income;
    }
    public function get_age($date = null){
      $dob = new DateTime( $this->dob );
      $current = is_null( $date ) ? new DateTime : new DateTime( $date );
      $diff = $dob->diff( $current );
      return $diff->format( '%Y' );
    }
    public function get_person_info () {
      return [
        'first_name' => $this->get_first_name(),
        'last_name' => $this->get_last_name(),
        'full_name' => $this->get_full_name(),
        'dob' => $this->get_dob(),
        'net_income' => $this->get_net_income(),
        'age' => $this->get_age()
      ];
    }
  }
