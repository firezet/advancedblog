<?php
class paginate{
  public $currentPage;
  public $itemsPerPage;
  public $itemCount;

  public function __construct($page=1, $itemsPerPage=4, $itemCount=0){
    $this->currentPage = (int)$page;
    $this->itemsPerPage = (int)$itemsPerPage;
    $this->itemCount = (int)$itemCount;
  }

  public function next(){
    return $this->currentPage + 1;
  }

  public function previous(){
    return $this->currentPage - 1;
  }

  public function pageTotal(){
    return ceil($this->itemCount/$this->itemsPerPage);
  }

  public function hasPrevious(){
    return $this->previous() >= 1 ? true : false;
  }

  public function hasNext(){
    return $this->next() <= $this->pageTotal() ? true : false;
  }

  public function offset(){
    return ($this->currentPage - 1) * $this->itemsPerPage;
  }
}
 ?>
