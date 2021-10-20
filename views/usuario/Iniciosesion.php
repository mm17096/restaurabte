<center>
    <?php if (isset($_SESSION['confirmada'])) : ?>
        <h2>! Felicidades has activado tu cuenta ¡</h2>
        <h3>Ahora puedes acceder a nuestros servicios como un usuario</h3>
        <img width="60%" src="<?= base_url ?>assets/img/cuentaactivada.png" alt="Camiseta logo" />
    <?php elseif (isset($_SESSION['noconfirmada'])) : ?>
        <h2>Disculpe pero ya ha activado su cuenta</h2>
        <h3>Su cuenta actualmente está activa y puede hacer uso de ella</h3>
        <br />
        <img width="60%" src="<?= base_url ?>assets/img/error.png" alt="Camiseta logo" />
    <?php endif; ?>
    <?php Utils::deleteSession('confirmada') ?>
    <?php Utils::deleteSession('noconfirmada') ?>
</center>