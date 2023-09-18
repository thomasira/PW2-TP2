
<main>
    <header>
        <h2>Welcome Client</h2>
    </header>
    <section>
        {% for client in clients %}
        <article>
            <a href="{{ path }}client/show/{{client.id}}"><h2>{{ client.name }}</h2></a>
            <ul>
                <li>Email: <span>{{ client.email }}</span></li>
                <li>Phone: <span>{{ client.phone }}</span></li>
                <li>Address: <span>{{ client.address }}</span></li>
                <li>Zip Code: <span>{{ client.zipCode }}</span></li>
                <li>Date of Birth: <span>{{ client.dob }}</span></li>
                <li>City: <span>{{ client.city }}</span></li>
            </ul>
        </article>
        {% endfor %}
    </section>
    <section>
        <a href="{{ path }}client/create" class="btn">Create</a>
    </section>
</main>