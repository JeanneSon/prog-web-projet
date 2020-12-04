<script>
    function compte(name) {
        $.post("gestionUtilisateur.php", {action: name}, function(data) {
            if (data == "erreur") {
                alert("Nous sommes désolés. L'action choisie n'est pas disponible.");
                window.location.href = "index.php";
            } else if (data != "ok") {
                window.location.href = data;
            }
        });
    }
</script>

<?php
    if (isset($_SESSION["utilisateur"])) {
        ?>
        <input type="button" name="deconnexion" value="Déconnexion" onclick="compte(this.name)"/>
        <input type="button" name="modification" value="Modifier mes données" onclick="compte(this.name)"/>
        <input type="button" name="suppression" value="Supprimer mon compte" onclick="compte(this.name)"/>
        <?php
    } else{
        ?>
        <input type="button" name="connexion" value="Login" onclick="compte(this.name)"/>
        <input type="button" name="creation" value="Créer un compte" onclick="compte(this.name)"/>
        <?php
    }
?>
