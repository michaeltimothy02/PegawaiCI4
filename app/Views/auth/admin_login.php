<h2>Admin Portal Login</h2>

<?php if(session()->getFlashdata('error')): ?>
    <div style="color: red;"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<form action="/admin/login" method="post">
    <input type="email" name="email" placeholder="Admin Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login sebagai Admin</button>
</form>