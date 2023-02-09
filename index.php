<html>
<head>
  <style>
    .h2 {
  text-align: center;
  border: 3px solid green;
}
label {
    display: inline-block;
    width: 7em; /* adjust to taste */
}
  </style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<h1>
      <a class="navbar-brand" href="#">POCKETPAL</a></h1>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Make a budget</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Scan bank statement</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-4">
          
        </div>
        <div class="col-4">
          <br><br><br><br>
          <h2>POCKETPAL</h2>
          
          <form>
  <label for="username">Username:</label>
  <input type="text" id="username" name="username">
<br>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password">
  <br>
  <input type="submit" class="btn btn-primary" value="Login" onclick="return checkLogin()">
</form>
        </div>
        <div class="col-4">
         
        </div>
      </div>
    </div>
 




<script>
function checkLogin() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  if (username == "admin" && password == "password") {
    window.location = "welcome.html";
    return false;
  } else {
    alert("Invalid username or password. Please try again.");
    return false;
  }
}
</script>


</body>
</html>
