{{ $teacher }}
<form method="POST">
    <label for="first_name">Voornaam:</label><br>
    <input type="text" value="{{ $teacher->first_name }}" id="first_name" name="first_name"><br>
    <label for="last_name">Achternaam:</label><br>
    <input type="text" value="{{ $teacher->last_name }}" id="last_name" name="last_name"><br>
    <label for="email">Email:</label><br>
    <input type="email" value="{{ $teacher->email }}" id="email" name="email"><br>
    <label for="abbreviation">Afkorting:</label><br>
    <input type="text" value="{{ $teacher->abbreviation }}" id="abbreviation" name="abbreviation">
</form>
