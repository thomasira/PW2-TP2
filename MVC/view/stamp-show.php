
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
                    <small>aspect:</small> 
                    {% if aspect.aspect %} {{ aspect.aspect }} 
                    {% else %}Undefined {% endif %}
                </p>
            </div>
            <aside>
                <h4>Categories</h4>
                <?php foreach ($this->categories as $category) : ?>
                <p><?= $category["category"] ?></p>
                <?php endforeach ?>
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
            <form action="stamp-modify.php" method="post">
                <input type="hidden" name="id" value="<?= $this->id ?>">
                <input type="submit" value="modify" class="button">
            </form>
        </section>
    </article>
</main>