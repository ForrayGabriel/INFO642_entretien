<img class="background-image" src="https://www.polytech.univ-smb.fr/fileadmin/_processed_/d/b/csm_Polytech_site_Annecy_vu_du_ciel_db27e8c54f.jpg">

<div class="login-container">
  <h2 id="connexion">Connexion</h2>
  <div class="login-form">
    <form action=".?r=login " method="post">
      <div class="form-group">
        <label for="uname">Identifiant</label>
        <input type="text" name="uname" id="uname" required>
      </div>
      <div class="form-group">
        <label for="psw">Mot de passe</label>
        <input type="password" name="psw" id="psw" required>
      </div>
      <div class="login-bttm">
        <button type="submit">Connexion</button>
        <div class="error">
          <?php if ($data == 'error') print("Identifiant ou mot de passe invalide"); ?>
        </div>
      </div>
    </form>
  </div>
</div>
