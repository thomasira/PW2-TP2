<main>
    <article class="file-user">
        <header>
            <h2>{{ user.name }}</h2>
            <p>user id: {{ user.id }}</p>
        </header>
        <section>
            <h3>My stamps</h3>
            {% for stamp in stamps %}
                <a href="{{ path }}/stamp/show/{{ stamp.id }}">{{ stamp.name }}</a>
            {% endfor %}
        </section>
    </article>
</main>