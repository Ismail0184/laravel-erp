<script>
    function getLedgerBalance() {
        const selectedLedgerId = document.getElementById("selectedLedgerId").value;
        var inputFieldValue = document.getElementById('inputField').value;
        var liveTotalBalance = document.getElementById('totalBalances').value;
        $.ajax({
            url: `/accounts/voucher/payment/find-ledger-balance/${selectedLedgerId}`,
            method: 'GET',
            success: function(response) {
                document.getElementById("totalBalances").value = response.balance;
                var getBalance = response.balance;

                if (getBalance === 0) {
                    document.getElementById('initiateButton').disabled = true;
                    document.getElementById('inputField').disabled = true;
                    document.getElementById('inputField').value = '';
                    inputFieldValue = '';
                } else {
                    document.getElementById('initiateButton').disabled = false;
                    document.getElementById('inputField').disabled = false;
                }
                document.getElementById('inputField').value = '';
                document.getElementById('inputField').value = inputFieldValue;
            },
            error: function(error) {
                console.error("Error fetching category balance:", error);
            }
        });
    }
    getLedgerBalance();
    setInterval(getLedgerBalance, 1000);
</script>
