
<main>
    <header>
        <h2>Welcome to the stamp database</h2>
        <p>This is catalog of all users and stamps entry</p>
    </header>
    <main>
        {% for stamp in stamps %}
            <p>{{ stamp.name }}</p>
        {% endfor %}
    </main>
</main>
