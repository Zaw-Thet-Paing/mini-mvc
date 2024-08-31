<h1>Users</h1>

<ul>
    <?php foreach ($users as $user) : ?>
        <li>
            <?= $user['name'] ?> (<?= $user['email'] ?>) 
            <a href="/users/<?= $user['id'] ?>">Edit</a> | <a href="/users/<?= $user['id'] ?>/delete" onclick="return confirm('Are you sure?')">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>