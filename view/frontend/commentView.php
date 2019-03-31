<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<h2>Modifier le commentaire</h2>

<?php 
$selectComment=$selectedComment->fetch();
?>

<form action="index.php?action=updateComment&amp;id=<?= $selectComment['id']?>&amp;_toto=<?=$selectComment['post_id']?>" method="post">

<?php
//var_dump($selectComment['id']);
//var_dump($selectComment['post_id']);
?>
<div>
    <label for="newAuthor">Auteur</label><br />
    <input type="text" id="newAuthor" name="newAuthor" value="<?php echo htmlspecialchars($selectComment['author']); ?>" >
</div>
<div>
    <label for="newComment">Commentaire</label><br />
    <textarea id="newComment" name="newComment"><?php echo nl2br(htmlspecialchars($selectComment['comment'])); ?></textarea>
</div>
<div>
    <input type="submit" />
</div>
</form>

<?php
$content = ob_get_clean(); ?>
 
<?php require('template.php'); ?>