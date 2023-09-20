

<main>
    <section>
        <h2>Login</h2>
        <form action="{{ path }}login/auth" method="post">
            <label>Email
                <input type="email" name="email" required>
            </label>
            <label>Password:
                <input type="password" name="password" required>
            </label>
            <input type="submit" value="login" class="button">
        </form>
    </section>

    <section>
        <h2>Create account</h2>
        <form action="{{ path }}user/store">
            <label>Name:
                <input type="text" name="name">
            </label>
            <label>Email:
                <input type="text" name="email" placeholder="valid email address">
            </label>
            <label>Password:
                <input type="password" name="password" placeholder="6-20 char.(A-z AND 0-9)">
            </label>
            <input type="submit" value="create" class="button">
        </form>
    </section>
</main>
    