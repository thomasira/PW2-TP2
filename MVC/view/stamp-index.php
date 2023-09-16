
<main>
    <header>
        <h2>Welcome Client</h2>
    </header>
    <section>
        {% for stamp in stamps %}
        <article>
            <a href="{{ path }}stamp/show/{{stamp.id}}"><h2>{{ stamp.name }}</h2></a>
            <ul>
                <li>Email: <span>{{ stamp.category_id }}</span></li>
                <li>Phone: <span>{{ stamp.description }}</span></li>
                <li>Address: <span>{{ stamp.user_id }}</span></li>
                <li>Zip Code: <span>{{ stamp.aspect_id }}</span></li>
            </ul>
        </article>
        {% endfor %}
    </section>
    <section>
        <a href="{{ path }}client/create" class="btn">Create</a>
    </section>
</main>