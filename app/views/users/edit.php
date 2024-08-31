<h1>Edit User</h1>

<form action="/users/<?= $user['id'] ?>/update" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?= $user['name'] ?>"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= $user['email'] ?>"><br><br>
    <input type="submit" value="Update">
</form>