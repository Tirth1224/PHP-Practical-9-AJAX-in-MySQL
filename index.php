<!DOCTYPE html>
<html>
<head>
    <title>Country State City Dropdown</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

    <h1>Select Country, State, and City</h1>
    
    <form id="myForm" method="post">
        <label for="country">Country:</label>
        <select id="country" name="country">
            <option value="">Select Country</option>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Pr9";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT id, name FROM countries";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            
            $conn->close();
            ?>
        </select>
        
        <label for="state">State:</label>
        <select id="state" name="state">
            <option value="">Select State</option>
        </select>
        
        <label for="city">City:</label>
        <select id="city" name="city">
            <option value="">Select City</option>
        </select>

        <button type="submit">Submit</button>
    </form>

    <br>

    <h2>Selected Data</h2>
    <table border="1" id="selectedData">
        <tr>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
        </tr>
    </table>

    <script>
    $(document).ready(function() {
        $('#country').change(function() {
            var country_id = $(this).val();
            $.ajax({
                url: 'get_states.php',
                type: 'GET',
                data: {country_id: country_id},
                dataType: 'json',
                success: function(response) {
                    $('#state').empty().append('<option value="">Select State</option>');
                    $.each(response, function(index, state) {
                        $('#state').append('<option value="' + state.id + '">' + state.name + '</option>');
                    });
                }
            });
        });

        $('#state').change(function() {
            var state_id = $(this).val();
            $.ajax({
                url: 'get_cities.php',
                type: 'GET',
                data: {state_id: state_id},
                dataType: 'json',
                success: function(response) {
                    $('#city').empty().append('<option value="">Select City</option>');
                    $.each(response, function(index, city) {
                        $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
                    });
                }
            });
        });

        $('#myForm').submit(function(e) {
            e.preventDefault();
            var country = $('#country option:selected').text();
            var state = $('#state option:selected').text();
            var city = $('#city option:selected').text();

            $('#selectedData').append('<tr><td>' + country + '</td><td>' + state + '</td><td>' + city + '</td></tr>');
        });

        // Trigger country change to fetch states if a country is pre-selected
        $('#country').trigger('change');
    });
</script>
</body>
</html>
