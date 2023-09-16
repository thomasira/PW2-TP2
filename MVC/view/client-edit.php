
<main>
<h3>Edit</h3>
    <form action="{{ path }}client/update" method="post">
        <input type="hidden" name="id" value="{{ client.id }}">
        <label>Name: 
            <input type="text" name="name" value="{{ client.name }}" required>
        </label>
        <label>Address: 
            <input type="text" name="address" value="{{ client.address }}">
        </label>
        <label>Zip code: 
            <input type="text" name="zipCode" value="{{ client.zipCode }}">
        </label>
        <label>Phone: 
            <input type="text" name="phone" value="{{ client.phone }}">
        </label>
        <label>Email: 
            <input type="email" name="email" value="{{ client.email }}" required>
        </label>
        <label>Date of Birth: 
            <input type="date" name="dob" value="{{ client.dob }}">
        </label>
        <input type="submit" value="save">
    </form>
</main>
