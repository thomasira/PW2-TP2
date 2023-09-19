
<main>
    <article class="file-stamp">
        <header>
            <h2>{{ stamp.name }}</h2>
            <p>user id: {{ stamp.user_id }}</p>
        </header>
        <section>
            <div>
                <h4>Details</h4>
                <p>
                    <small>origin:</small> 
                    {% if stamp.origin %} {{ stamp.origin }} 
                    {% else %}Undefined {% endif %}
                </p>
                <p>
                    <small>year:</small> 
                    {% if stamp.year %} {{ stamp.year }} 
                    {% else %}Undefined {% endif %}
                </p>
                <p>
                    <small>aspect:</small> {{ aspect.aspect }}
                </p>
            </div>
            <aside>
                <h4>Categories</h4>
                {% if categories is iterable %}
                    {% for category in categories %}
                    <p>{{ category.category }}</p>
                    {% endfor %}
                {% else %}
                    <p>no categories</p>
                {% endif %}
            </aside>
        </section>
        <section>
            <h4>Description</h4>
            <p>
                {% if stamp.description %} {{ stamp.description }} 
                {% else %}No description {% endif %}
            </p>
        </section>
        <section>
            <form action="{{ path }}stamp/update" method="post">
                <input type="hidden" name="id" value="<?= $this->id ?>">
                <input type="submit" value="modify" class="button">
            </form>
        </section>
    </article>
</main>