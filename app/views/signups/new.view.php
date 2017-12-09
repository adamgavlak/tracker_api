<h2>Sign up</h2>

<form action="/sign-up" method="post">
    <input type="hidden" name="_csrf_token" value="<?= csrf_token() ?>">
    <div class="field">
        <label for="email">Email</label>
        <input type="text" name="email">
    </div>

    <div class="field">
        <label for="usernsme">Username</label>
        <input type="text" name="username">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>

    <div class="field">
        <input type="submit">
    </div>
</form>