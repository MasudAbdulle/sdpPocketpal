<html>
<head>
    <style>
        #container1{
            width:400px;
            height: 400px;
        }
    </style>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script>
    var country = 'Great Britain'
    $.ajax({
    method: 'GET',
    url: 'https://api.api-ninjas.com/v1/inflation?country=' + country,
    headers: { 'X-Api-Key': 'UAsZ1KG3XMyWZfyWsmTe1A==xVVVPZqVQII6JaXH'},
    contentType: 'application/json',
    success: function(result) {
    console.log(result);
    var resultDiv = document.createElement("div");
    resultDiv.innerHTML = result[0].country + ' ' + result[0].period + ' ' + result[0].yearly_rate_pct;
    document.body.appendChild(resultDiv);
}
,
    error: function ajaxError(jqXHR) {
        console.error('Error: ', jqXHR.responseText);
    }
});




</script>

<div class  = "container1" >
    <h2> normal container </h2>
    <p>What is Lorem Ipsum?
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
</p>


</div>

</body>
</html>