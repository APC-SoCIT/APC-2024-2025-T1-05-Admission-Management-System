<form action="{{ route('applicants.updateProfile') }}" method="POST">
    @csrf
    <div>
        <label for="birthday">Birthday:</label>
        <input type="date" name="birthday" id="birthday" required>
    </div>
    <div>
        <label for="age">Age:</label>
        <input type="number" name="age" id="age" required>
    </div>
    <button type="submit">Submit</button>
</form>