

<main>
    <header>
        <h2>Edit Stamp</h2>
    </header>
    <form action="{{ path }}stamp/update" method="post">
        <label>Name:
            <input type="text" name="name" value="{{ stamp.name }}"required>
        </label>
        <label>Origin:
            <input type="text" name="origin" value="{{ stamp.origin }}">
        </label>
        <label>Year:
            <input type="year" name="year" value="{{ stamp.year }}">
        </label>
        <section>
            <div>
                <h4>choose from our categories</h4>
                {% for category in categories %}
                <label>{{ category.category }}
                    <input type="checkbox" name="category_id[{{ category.id }}]" value="1"
                    {% if category.checked %} {{ checked }}
                    {% endif %}>
                </label>
                {% endfor %}
            </div>
            <div>
                <h4>And/Or add your own categories(separated with a comma and space)</h4>
                <label>
                    <textarea name="categories" cols="30" rows="10"></textarea>
                </label>
            </div>
        </section>

        </label>
        <label>Aspect:
            <select name="aspect_id">
                {% for aspect in aspects %}
                <option value="{{ aspect.id }}">{{ aspect.aspect }}</option>
                {% endfor %}
            </select>
        </label>
        <label>description:
            <textarea name="description" cols="30" rows="10"></textarea>
        </label>

        {% if session_user == 'root' %}
        <label>User
            <select name="user_id">
            {% for user in users %}
                    <option value="{{ user.id }}">{{ user.name }}</option>
            {% endfor %}
            </select>
        </label>
        {% else %} 
        <input type="hidden" name="user_id" value="{{ user.id }}">
        {% endif %}

        <input type="submit" value="create" class="button">
    </form>
        

</main>
