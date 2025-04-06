<html>
    <head>
        <title>Form Validation</title>
    </head>
    <body>
        <h1>Form Validation</h1>
        <form onsubmit="return validation()" action="Home.html" method="post">
            Name: <input type="text" id="name" placeholder="Enter name">
            <span id="nameerror" style="color:red;"></span><br>

            Email: <input type="email" id="email" placeholder="Enter email">
            <span id="emailerror" style="color:red;"></span><br>

            Password: <input type="password" id="password" placeholder="At least 6 characters">
            <span id="passworderror" style="color:red;"></span><br>

            Age: <input type="number" id="age" placeholder="Enter age">
            <span id="ageerror" style="color:red;"></span><br>

            Date: <input type="text" id="date" placeholder="DD/MM/YYYY">
            <span id="dateerror" style="color:red;"></span><br>

            <button type="submit">Submit</button>
        </form>

        <script>
            function validation() {
                var isValid = true;
                var name = document.getElementById("name").value.trim();
                var email = document.getElementById("email").value.trim();
                var password = document.getElementById("password").value.trim();
                var age = document.getElementById("age").value.trim();
                var date = document.getElementById("date").value.trim();
                document.getElementById("nameerror").innerHTML = "";
                document.getElementById("emailerror").innerHTML = "";
                document.getElementById("passworderror").innerHTML = "";
                document.getElementById("ageerror").innerHTML = "";
                document.getElementById("dateerror").innerHTML = "";
                if (name === "") {
                    document.getElementById("nameerror").innerHTML = "Name is required";
                    isValid = false;
                }
                var emailPattern = /^[a-zA-Z][a-zA-Z0-9._%+-]*@gmail\.com$/;
                if (!email.match(emailPattern)) {
                    document.getElementById("emailerror").innerHTML = "Enter a valid Gmail address starting with a letter";
                    isValid = false;
                }
                if (password.length < 6) {
                    document.getElementById("passworderror").innerHTML = "Password must be at least 6 characters";
                    isValid = false;
                }
                if (age === "" || isNaN(age) || age < 18) {
                    document.getElementById("ageerror").innerHTML = "Must be a valid age (18+)";
                    isValid = false;
                }
                var datePattern = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;
                if (!date.match(datePattern)) {
                    document.getElementById("dateerror").innerHTML = "Enter date in DD/MM/YYYY format";
                    isValid = false;
                }
                return isValid;
            }
        </script>
    </body>
</html>
