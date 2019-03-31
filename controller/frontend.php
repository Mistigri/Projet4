<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts() {
    $postManager = new \ML\Blog\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post() {
    $postManager = new \ML\Blog\Model\PostManager();
    $commentManager = new \ML\Blog\Model\CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment) {
    $commentManager = new \ML\Blog\Model\CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

//ajout modif commentaire
function selectComment($commentId) {
	$commentManager = new \ML\Blog\Model\CommentManager();
	$selectedComment = $commentManager->selectComment($commentId);

	require('view/frontend/commentView.php');
}

function modifyComment($commentId, $postId, $newAuthor, $newComment) {
	$commentManager = new \ML\Blog\Model\CommentManager();
	$selectedComment = $commentManager->modifyComment($commentId, $newAuthor, $newComment);

	if ($selectedComment === false) {
	    throw new Exception('Impossible d\'ajouter le commentaire !');
	}
	else {
	    header('Location: index.php?action=post&id=' . $postId);
	}

	require('view/frontend/commentView.php');
}