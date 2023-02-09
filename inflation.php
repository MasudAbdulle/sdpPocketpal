<html>

<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var country = 'United States'
$.ajax({
    method: 'GET',
    url: 'https://api.api-ninjas.com/v1/inflation?country=' + country,
    headers: { 'X-Api-Key': 'UAsZ1KG3XMyWZfyWsmTe1A==xVVVPZqVQII6JaXH'},
    contentType: 'application/json',
    success: function(result) {
        console.log(result);
    },
    error: function ajaxError(jqXHR) {
        console.error('Error: ', jqXHR.responseText);
    }
});

</script>

<div id = "inflation result">hrnotrngeroingerndo</div>
</body>
</html>