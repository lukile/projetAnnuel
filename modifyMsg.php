<?php

	require"displayMsg.php";

    if(isset($_GET['id'])){

    $fetch_id = connect()->prepare("UPDATE messages SET statut = 1 WHERE id = :id");
    $fetch_id->execute([':id'=>$_GET['id']]);
    $_POST = $fetch_id->fetch();
    }
?>
<script>
	setTimeout("location.href='displayMsg.php';", 500);
</script>
