<?php include 'inc/header.php'; ?>

<main class="form-signin w-100 m-auto p-3">
    <form action="_register.php" method="post">
        <h1 class="h3 mb-3 fw-normal text-center">Register</h1>
        <input type="hidden" name="user_id" value="">
        <div class="form-floating mb-2">
            <input type="text" name="user_uname" class="form-control" id="floatingInput" placeholder="Username" autocomplete="off">
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" name="user_password" class="form-control" id="floatingPassword" placeholder="Password" autocomplete="off">
            <label for="floatingPassword">Password</label>
        </div>
        <button class="btn btn-secondary w-100 py-2" type="submit">Submit</button>
    </form>
</main>

<?php include 'inc/footer.php'; ?>
