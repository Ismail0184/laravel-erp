<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exceed Alert</title>
</head>
<body>
<label for="field1">Field 1:</label>
<input type="number" id="field1" name="field1">
<br>
<label for="field2">Field 2:</label>
<input type="number" readonly value="10" id="field2" name="field2">

<script>
    // Get references to the input fields
    const field1 = document.getElementById('field1');
    const field2 = document.getElementById('field2');

    // Add event listener to field1
    field1.addEventListener('input', function() {
        // Convert field values to numbers
        const value1 = parseFloat(field1.value);
        const value2 = parseFloat(field2.value);

        // Check if field1 value exceeds field2 value
        if (value1 > value2) {
            alert('Value in Field 1 exceeds value in Field 2!');
        }
    });
</script>
</body>
</html>
