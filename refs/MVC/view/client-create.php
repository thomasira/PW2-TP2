
<main>
<h3>Create</h3>
    <form action="{{ path }}client/store" method="post">
        <label>Name: 
            <input type="text" name="name" required>
        </label>
        <label>Address: 
            <input type="text" name="address">
        </label>
        <label>Zip code: 
            <input type="text" name="zipCode" placeholder="H4H 4H4">
        </label>
        <label>Phone: 
            <input type="text" name="phone" placeholder="514-555-5555">
        </label>
        <label>Email: 
            <input type="email" name="email" placeholder="email@email.com" required>
        </label>
        <label>Date of Birth: 
            <input type="date" name="dob" placeholder="1954">
        </label>
        <label>City
            <input type="text" name="city">
        </label>
        {#<select name="city_id">
            {% for city in cities %}
            <option value="{{ city.id }}">{{ city.city }}</option>
            {% endfor %}
        </select>#}
        <input type="submit" value="save">
    </form>
</main>
