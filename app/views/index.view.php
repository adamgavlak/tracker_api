<h1>Hello!</h1>

Logged in as <?= current_user()->email ?> <a href="/logout">Log out</a>

<table>
    <? foreach($users as $user) : ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= h($user->username) ?></td>
            <td><?= h($user->email) ?></td>
        </tr>
    <? endforeach; ?>
</table>

<hr>

<form action="/" method="post">
    <input type="hidden" name="_csrf_token" value="<?= csrf_token() ?>">

    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username">
    </div>

    <div class="field">
        <label for="email">Email</label>
        <input type="text" name="email">
    </div>

    <input type="submit">
</form>