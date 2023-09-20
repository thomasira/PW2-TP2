
<main>
    <header>
        <h2>Panel</h2>
    </header>
    <section>
        <h3><a href="{{ path }}stamp">Stamps</a></h3>
        <ul>
        {% for stamp in stamps %}
            <li><a href="{{ path }}stamp/show/{{ stamp.id }}">{{ stamp.name }}</a></li>
        {% endfor %}
        </ul>
        <a href="{{ path }}stamp/create" class="button">create</a>
    </section>

    <section>
        <h3><a href="{{ path }}user">Users</a></h3>
        <ul>
        {% for user in users %}
            <li><a href="{{ path }}user/show/{{ user.id }}">{{ user.name }}</a></li>
        {% endfor %}
        </ul>
        <a href="{{ path }}user/create" class="button">create</a>
    </section>

    <section>
        <h3><a href="{{ path }}aspect">Aspects</a></h3>
        <ul>
        {% for aspect in aspects %}
            <li>{{ aspect.aspect }}</li>
        {% endfor %}
        </ul>
        <a href="{{ path }}aspect/create" class="button">create</a>
    </section>

    <section>
        <h3><a href="{{ path }}category">Categories</a></h3>
        <ul>
        {% for category in categories %}
            <li>{{ category.category }}</li>
        {% endfor %}
        </ul>
        <a href="{{ path }}category/create" class="button">create</a>
    </section>
        
        
</main>