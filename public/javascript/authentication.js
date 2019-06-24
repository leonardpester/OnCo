function login() {
    var x1 = document.getElementById("js1");
    var x2 = document.getElementById("js2");
    if (x1.style.display === "none" & x2.style.display === "block") {
        x1.style.display = "block";
        x2.style.display = "none";
    } else {
        x1.style.display = "none";
        x2.style.display = "block";
    }
}

function checkEmail(str) {
    if (str.length == 0) {
        document.getElementById("validare").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("validare").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "/public/authentication/?checkEmail=" + str, true);
        xmlhttp.send();
    }
}