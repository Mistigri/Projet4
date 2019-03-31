<?php

require('controller/frontend.php');

try {
	if (isset($_GET['action'])) {
	    if ($_GET['action'] == 'listPosts') {
	        listPosts();
	    }
	    elseif ($_GET['action'] == 'post') {
	        if (isset($_GET['id']) && $_GET['id'] > 0) {
	            post();
	        }
	        else {
	            echo 'Erreur : aucun identifiant de billet envoyé';
	        }
	    }
	    elseif ($_GET['action'] == 'addComment') {
		    if (isset($_GET['id']) && $_GET['id'] > 0) {
		        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
		            addComment($_GET['id'], $_POST['author'], $_POST['comment']);
		        }
		        else {
		            echo 'Erreur : tous les champs ne sont pas remplis !';
		        }
		    }
		    else {
		        echo 'Erreur : aucun identifiant de billet envoyé';
		    }
	    }
		//partie modif commentaire
	    elseif ($_GET['action'] == 'modifyComment') {
	    	if (isset($_GET['id']) && $_GET['id'] > 0) {
	    		selectComment($_GET['id']);
        	}
        	else {
        		echo 'Erreur : aucun identifiant de commentaire envoyé';
        	}	
	    }

	    elseif ($_GET['action'] == 'updateComment') {
	    	if (isset($_GET['id']) && $_GET['id'] > 0) {
				if (!empty($_POST['newAuthor']) && !empty($_POST['newComment'])) {
	            	modifyComment($_GET['id'], $_GET['postid'], $_POST['newAuthor'], $_POST['newComment']);
	        	}
	        	else {
	            	echo 'Erreur : tous les champs ne sont pas remplis !';
	        	}
	    	}
	    }

	}

	else {
	    listPosts();
	}	
}

catch(Exception $e) { 

    echo 'Erreur : ' . $e->getMessage();

}

