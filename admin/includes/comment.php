<?php

class Comment extends DbObject{

    protected static $dbTable = "comments";
    protected static $dbTableFields = array("photoId", "author", "body");
    public $id;
    public $photoId;
    public $author;
    public $body;

    public static function createComment($photoId, $author, $body){
      if(!empty($photoId) && !empty($author) && !empty($body)){
        $comment = new Comment();
        $comment->photoId = (int)$photoId;
        $comment->author = $author;
        $comment->body = $body;
        return $comment;
      }else{
        return false;
      }
    }

    public static function findComments($photoId){
      global $database;
      $sql = "SELECT * FROM comments WHERE photoId=".$database->escapeString($photoId)." ORDER BY id ASC";
      return self::findThisQuery($sql);
    }

} /// COMMENT CLASS END ///
?>
