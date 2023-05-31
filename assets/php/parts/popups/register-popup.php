<div class="popup-container" id="popup-register">
    <div class="form-container">
        <h2>Register</h2>
        <p>Please enter your login details below using your existing account.</p>
        <form id="register-form" method="post">
            <div class="validation-error">
                Error Message goes here.
            </div>
            <label for="firstname">First Name: *</label>
            <input type="text" id="firstname" name="firstname" required>
            <label for="lastname">Last Name: *</label>
            <input type="text" id="lastname" name="lastname" required>
            <label for="email">Email: *</label>
            <input type="text" id="email" name="email" required>
            <label for="address">Address: *</label>
            <input type="text" id="address" name="address" required>
            <label for="username">Username: *</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password: *</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" class="btn" value="Register">
        </form>
        <button class="close-button btn">Close</button>
    </div>
</div>
