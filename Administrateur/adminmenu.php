
  <!--navbar-->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-secondary" data-aos="fade-down">
    <div class="container">
      <a class="navbar-brand text-start" href="#" style=" font-size:25px">Shopping-in-line</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="identite">
          <?php foreach ($identite as $profil) { ?>
            <p id="identite">Bienvenue Mr. <small><?= $profil['last_name'] ?><?= $profil['first_name'] ?> (Administrateur)</small> </p>
          <?php } ?>
        </div>
      </div>
      <form class="d-flex">
      <?php
        include('alerte.php');
        echo"<a  href='alerteproduit.php'><i class='bi bi-bell text-black'></i><span class='text-white' id='alert-count' style='font-family:monospace'>$alertCount</span></a>";
      ?>
    </form>
    </div>
  </nav>

<div class="admin_menu">
    <h2>Menu</h2>
    <ul>
      <li><a href="menuAdmin.php">Afficher produit</a></li>
      <li><a href="categorieprod.php">Categories de produit</a></li>
      <li><a href="commande.php">Liste des commandes*</a></li>
      <li><a href="traiter.php">Commande traiter*</a></li>
      <li><a href="client.php">Liste des clients</a></li>
      <li><a href="">Quantité/Produit</a></li>
      <li><a href="livreur.php">Liste des livreurs</a></li>
      <li><a href="">Livreur/Commande*</a></li>
    </ul>
  </div>