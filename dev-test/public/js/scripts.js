document.getElementById("due_date").addEventListener("input", function () {
    let value = this.value;
    let parts = value.split("-");
    
    if (parts.length === 3 && parts[0].length > 4) {
        parts[0] = parts[0].slice(0, 4); // Limita o ano a 4 dígitos
        this.value = parts.join("-");
    }
});