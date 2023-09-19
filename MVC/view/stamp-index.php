
<main>
    <header>
        <h2>All stamps</h2>
    </header>
    <section>
        {% for stamp in stamps %}
        <a href="{{ path }}stamp/show/{{ stamp.id }}">
        <article class="card-stamp">
                <header>
                    <h3>{{ stamp.name }}</h3>
                </header>
                <div>
                    <p>{% if stamp.origin %} {{ stamp.origin }} {% else %} Origin Undefined {% endif %}</p>
                    <p>{% if stamp.year %} {{ stamp.year }} {% else %} Year Undefined {% endif %}</p>
                </div>
        </article>
        </a>
        {% endfor %}
    </section>
    <section>
        <a href="{{ path }}stamp/create" class="btn">Create</a>
    </section>
</main>