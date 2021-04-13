<script src="js/presentation.js"></script>


<div id="presentation-container">

<?php include_once "presentation-container.php"; ?>
</div>
<?php if (isset($_SESSION['user']) && $_SESSION['user']['idrole'] == 3){?>

<input id="btn-change" class="btn"
       type="button"
       value="Modifier">

<input id="btn-validate" class="btn"
       type="button"
       value="Valider"
       hidden>
<?php } ?>
