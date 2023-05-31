<div class="popup-container" id="popup-login">
    <div class="form-container">
        <h2>Login</h2>
        <p>Please enter your login details below using your existing account.</p>
        <form id="login-form" method="post">
            <div class="validation-error">
                Error Message goes here.
            </div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" class="btn" value="Login">
        </form>
        <button class="js-register-popup btn">Register</button>
        <button class="close-button btn">Close</button>
    </div>
</div>
