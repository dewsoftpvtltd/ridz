<?php
class Article{
  protected $db;

  public function __construct(Database $db){
    $this->db = $db;
  }

  public function getArticle(){
    return $this->db->query("SELECT * FROM articles");
  }
}
