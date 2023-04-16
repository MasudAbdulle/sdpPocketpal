const signUp = e => {
    let fname = document.getElementById('fname').value,
        lname = document.getElementById('lname').value,
        email = document.getElementById('email').value,
        pwd = document.getElementById('pwd').value;

    let formData = JSON.parse(localStorage.getItem('formData')) || [];

    let exist = formData.length && 
        JSON.parse(localStorage.getItem('formData')).some(data => 
            data.email.toLowerCase() == email.toLowerCase()
        );

    if(!exist){
        // Deactivate all other accounts
        formData.forEach(data => {
            data.active = false;
        });

        // Add new account and activate it
        formData.push({ fname, lname, email, pwd, active: true });
        localStorage.setItem('formData', JSON.stringify(formData));
        document.querySelector('form').reset();
        document.getElementById('fname').focus();
        alert("Account Created.\n\nPlease Sign In using the link below.");
    }
    else{
        alert("Ooopppssss... Duplicate found!!!\nYou have already signed up");
    }
    e.preventDefault();
}

function signIn(e) {
    let email = document.getElementById('email').value, pwd = document.getElementById('pwd').value;
    let formData = JSON.parse(localStorage.getItem('formData')) || [];
    let exist = formData.length && 
        JSON.parse(localStorage.getItem('formData')).some(data => data.email.toLowerCase() == email && data.pwd.toLowerCase() == pwd);

    if(!exist){
        alert("Incorrect login credentials");
    }
    else{
        // Deactivate all other accounts and activate the signed-in account
        formData.forEach(data => {
            data.active = (data.email.toLowerCase() == email.toLowerCase());
        });

        localStorage.setItem('formData', JSON.stringify(formData));
        location.href = "/";
    }
    e.preventDefault();
}
