<h2>Login</h2>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color:red;">
        <?= session()->getFlashdata('error') ?>
    </p>
<?php endif; ?>

<form action="/login" method="post">
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>