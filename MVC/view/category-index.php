<main>
    <header>
        <h2>All categories</h2>
    </header>
    <section>
        {% for category in categories %}
        <article>
            <p>{{ category.category }}</p>
            <a href="{{ path }}/category/modify" class="button">modify</a>
            <a href="{{ path }}/category/delete" class="button">delete</a>
        </article>
        {% endfor %}
    </section>
    <section>
        <a href="{{ path }}category/create" class="button">Create</a>
    </section>
</main>