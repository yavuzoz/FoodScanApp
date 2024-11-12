<?php include 'inc/header.php'; ?>

<main class="form-signin w-100 m-auto p-3">
    <form action="_login.php" method="post">
        <h1 class="h3 mb-3 fw-normal text-center">Please Sign in</h1>

        <div class="form-floating mb-2">
            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" autocomplete="off">
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" autocomplete="off">
            <label for="floatingPassword">Password</label>
        </div>

        <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Sign in</button>
        <a href="register.php" class="btn btn-secondary w-100 py-2" >Register</a>
    </form>
</main>

<?php include 'inc/footer.php'; ?>
