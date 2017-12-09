<h2>Login</h2>

<form action="/login" method="post">
    <input type="hidden" name="_csrf_token" value="<?= csrf_token() ?>">

    <div class="field">
        <label for="email">Email</label>
        <input type="text" name="email">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>
    
    <div class="field">
        <input type="submit">
    </div>
</form>