<?php

namespace ML\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends \ML\Blog\Model\Manager {

    public function getComments($postId) {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

//nouvelle partie modif commentaires
    public function selectComment($commentId) {
        $db = $this->dbConnect();
        $selectedComment = $db->prepare('SELECT id, post_id, author, comment FROM comments WHERE id = ?');
        $selectedComment->execute(array($commentId));
 
        return $selectedComment;
    }

    public function modifyComment($commentId, $newAuthor, $newComment) {
        $db = $this->dbConnect();
        $oldComment = $this->selectComment($commentId);
        $modifiedComment = $db->prepare('UPDATE comments SET comment = ?, author = ? WHERE id=?');
        $affectedComment = $modifiedComment->execute(array($newComment, $newAuthor,$commentId));
 
        return $affectedComment;
    }
}