document.addEventListener("DOMContentLoaded", function() {
  var navbarPlaceholder = document.getElementById("navbar-placeholder");

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Load the contents of the navbar.html file
  xhr.open("GET", "navbar.html", true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Insert the navbar HTML into the placeholder element
      navbarPlaceholder.innerHTML = xhr.responseText;
    }
  };
  xhr.send();
});
