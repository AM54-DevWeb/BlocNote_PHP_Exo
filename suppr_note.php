<?php 
$connexion->query("DELETE FROM notes WHERE id = ".$_GET['id']);
header('Location: index.php?page=blocnote');
?>