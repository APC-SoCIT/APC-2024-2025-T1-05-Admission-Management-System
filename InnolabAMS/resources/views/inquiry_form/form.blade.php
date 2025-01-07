@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inquiry Form</h1>
    <form action="{{ route('leads.store') }}" method="POST">
        @csrf
        <!-- First Name -->
        <div class="form-group">
            <label for="lead_given_name">First Name</label>
            <input type="text" name="lead_given_name" class="form-control" required>
        </div>

        <!-- Last Name -->
        <div class="form-group">
            <label for="lead_surname">Last Name</label>
            <input type="text" name="lead_surname" class="form-control" required>
        </div>

        <!-- Middle Name -->
        <div class="form-group">
            <label for="lead_middle_name">Middle Name</label>
            <input type="text" name="lead_middle_name" class="form-control">
        </div>

        <!-- Extension -->
        <div class="form-group">
            <label for="lead_extension">Ext.</label>
            <input type="text" name="lead_extension" class="form-control">
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="lead_email">Email</label>
            <input type="email" name="lead_email" class="form-control" required>
        </div>

        <!-- Contact Number -->
        <div class="form-group">
            <label for="lead_mobile_number">Mobile Number</label>
            <input type="text" name="lead_mobile_number" class="form-control" maxlength="13" required>
        </div>

        <!-- City -->
        <div class="form-group">
            <label for="lead_address_city">City</label>
            <input type="text" name="lead_address_city" class="form-control">
        </div>

        <!-- Inquiry Details -->
        <div class="form-group">
            <label for="inquired_details">What details would you like to know?</label>
            <select name="inquired_details" class="form-control" required>
                <option value="Option1">Option 1</option>
                <option value="Option2">Option 2</option>
                <option value="Option3">Option 3</option>
            </select>
        </div>

        <!-- Message -->
        <div class="form-group">
            <label for="lead_message">Message</label>
            <textarea name="lead_message" class="form-control"></textarea>
        </div>

        <!-- How Did You Learn About Us -->
        <div class="form-group">
            <label>How did you learn about us?</label><br>
            <input type="checkbox" name="source[]" value="Social Media"> Social Media<br>
            <input type="checkbox" name="source[]" value="Website"> Website<br>
            <input type="checkbox" name="source[]" value="Referral"> Referral<br>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
