<main>
    <article class="file-user">
        <header>
            <h2>{{ user.name }}</h2>
            <p>user id: {{ user.id }}</p>
        </header>
        <section>
            <h3>My stamps</h3>
            <ul>
            {% for stamp in stamps %}
                <li>
                    <a href="{{ path }}stamp/show/{{ stamp.id }}">{{ stamp.name }}</a>
                    <div>
                        <form action="{{ path }}stamp/edit" method="post">
                            <input type="hidden" name="id" value="{{ user.id }}">
                            <input type="submit" class="icon" value="&#9998;">
                        </form>
                        <form action="{{ path }}stamp/delete" method="post">
                            <input type="hidden" name="id" value="{{ user.id }}">
                            <input type="submit" class="icon" value="&#128465;">
                        </form>
                    </div>
                    </li>
            {% endfor %}
            </ul>
            <a href="{{ path }}stamp/create" class="button">add stamp</a>
        </section>
        <section>
            <a href="{{ path }}user/edit" class="button">modify info</a>
            <a href="{{ path }}user/delete" class="button warning">delete profile</a>
        </section>

    </article>
</main>