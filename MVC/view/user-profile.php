<main>
    <article class="file-user">
        <header>
            <h2>{{ user.name }}</h2>
            <p>user id: {{ user.id }}</p>
        </header>
        <section>
            <h3>My stamps</h3>
            {% for stamp in stamps %}
                <div>
                    <a href="{{ path }}stamp/show/{{ stamp.id }}">{{ stamp.name }}</a>
                    <form action="{{ path }}stamp/edit" method="post">
                        <input type="hidden" name="id" value="{{ stamp.id }}">
                        <input type="submit" class="button" value="modify">
                    </form>
                    <form action="{{ path }}stamp/delete" method="post">
                        <input type="hidden" name="id" value="{{ stamp.id }}">
                        <input type="submit" class="button" value="delete">
                    </form>
                </div>
            {% endfor %}
        </section>
        <section>
            <h4>Edit Profile</h4>

        </section>
        <a href="{{ path }}stamp/create">add stamp</a>
    </article>
</main>