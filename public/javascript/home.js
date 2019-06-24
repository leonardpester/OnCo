var minAgeInput = document.getElementById("age-min-input");
var maxAgeInput = document.getElementById("age-max-input");
minAgeInput.oninput = function() {
    minAge.value = this.value;
}
maxAgeInput.oninput = function() {
    maxAge.value = this.value;
}

function showFilters() {
    var filters = document.getElementsByClassName("filter-list")[0];
    var contacts = document.getElementsByClassName("contacts-list")[0];
    filters.classList.add("filter-list-shown");
    contacts.classList.add("hide-contacts-list");
}

function closeFilters() {
    var filters = document.getElementsByClassName("filter-list")[0];
    var contacts = document.getElementsByClassName("contacts-list")[0];
    filters.classList.remove("filter-list-shown");
    contacts.classList.remove("hide-contacts-list");
}

function copyPhone(event) {
    var number = event.currentTarget.dataset.number;
    const el = document.createElement("textarea");
    el.value = number;
    document.body.appendChild(el);
    el.select();
    document.execCommand("copy");
    document.body.removeChild(el);
}