
    ///Ajax
    
$(document).ready(function() {
    $('#loginForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        var fname = $('#fname').val();
        var password = $('#password').val();

        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: {
                fname: fname,
                password: password,
                login: true
            },
            success: function(response) {
                if (response === "success") {
                    window.location.href = 'home.php'; // Redirect on success
                } else {
                    $('#error-message').text(response); // Display error message
                }
            }
        });
    });
});
</script>
</body>
</html></div>
</body>
</html>