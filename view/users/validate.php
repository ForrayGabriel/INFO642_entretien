<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<div class="container">
    <?php var_dump($data); ?>

    <p>Etes-vous sur vouloir le supprimer ?</p>

    <form action="?r=users/delete" method="post">
        <input type="text" name="id" value="<?php print($data->idinternaluser) ?>" hidden>
        <input type="submit">
    </form>
</div>
