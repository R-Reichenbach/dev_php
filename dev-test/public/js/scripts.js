document.getElementById("due_date").addEventListener("input", function () {
    let value = this.value;
    let parts = value.split("-");
    
    if (parts.length === 3 && parts[0].length > 4) {
        parts[0] = parts[0].slice(0, 4); // Limita o ano a 4 dígitos
        this.value = parts.join("-");
    }
});

function refreshCSS() {
    var links = document.getElementsByTagName("link");
    for (var i = 0; i < links.length; i++) {
        if (links[i].rel === "stylesheet") {
            var href = links[i].getAttribute("href");
            links[i].setAttribute("href", href.split("?")[0] + "?v=" + new Date().getTime());
        }
    }
}

// Chame a função após o cadastro de tasks
refreshCSS();
