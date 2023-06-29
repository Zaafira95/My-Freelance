<!DOCTYPE html>
<html>
<head>
    <title>Mot de passe oublié</title>
</head>
<body>
    <h1>Mot de passe oublié</h1>
    
    <?php if ($this->session->flashdata('message')) : ?>
        <div><?php echo $this->session->flashdata('message'); ?></div>
    <?php endif; ?>

    <?php echo validation_errors(); ?>

    <?php echo form_open('login/forgot_password'); ?>
        <label for="email">Adresse e-mail :</label>
        <input type="email" name="email" required>

        <button type="submit">Réinitialiser le mot de passe</button>
    <?php echo form_close(); ?>
</body>
</html>
