
<main>
    <header>
        <h2>Panel</h2>
    </header>
    <section>
        <h3>Stamps</h3>
        <ul>
        {% for stamp in stamps %}
            <li><a href="{{ path }}stamp/show/{{ stamp.id }}">{{ stamp.name }}</a></li>
        {% endfor %}
        </ul>
        <a href="{{ path }}/stamp/create" class="button">create</a>
    </section>

    <section>
        <h3>Users</h3>
        <ul>
        {% for user in users %}
            <li><a href="{{ path }}user/show/{{ user.id }}">{{ user.name }}</a></li>
        {% endfor %}
        </ul>
        <a href="{{ path }}/user/create" class="button">create</a>
    </section>

    <section>
        <h3>Aspects</h3>
        <ul>
        {% for aspect in aspects %}
            <li><a href="{{ path }}aspect/show/{{ aspect.id }}">{{ aspect.aspect }}</a></li>
        {% endfor %}
        </ul>
        <a href="{{ path }}/aspect/create" class="button">create</a>
    </section>

    <section>
        <h3>Categories</h3>
        <ul>
        {% for category in categories %}
            <li><a href="{{ path }}category/show/{{ category.id }}">{{ category.category }}</a></li>
        {% endfor %}
        </ul>
        <a href="{{ path }}/category/create" class="button">create</a>
    </section>
        
        
</main>