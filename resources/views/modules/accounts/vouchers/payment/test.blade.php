<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Status</title>
    <style>
        /* Styling to hide the status initially */
        #status {
            display: none;
        }
    </style>
</head>
<body>
<div id="status"></div>
<input type="number" id="totalBalances" name="ledger_balance" @if(Session::get('payment_no')>0) value="{{$masterData->ledger_balance}}" @endif class="form-control" readonly placeholder="Ledger Balance" min="1"/>


<!-- Include jQuery for AJAX -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to check status
        function checkStatus() {
            $.ajax({
                url: '/accounts/voucher/payment/find-ledger-balance/1002000100010000', // Your Laravel route to fetch status
                type: 'GET',
                success: function(response) {
                    document.getElementById("totalBalances").value = response.balance;
                    $('#status').html(response.balance);
                    $('#status').show(); // Show the status
                },
                error: function(xhr, status, error) {
                    console.error(error); // Log any errors
                }
            });
        }

        // Call the function initially
        checkStatus();

        // Set interval to periodically check status (every 5 seconds in this example)
        setInterval(checkStatus, 5000);
    });
</script>
</body>
</html>
