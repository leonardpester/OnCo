function checkMark() {
    var contacts = document.getElementsByClassName("contact");
    for (var index = 0; index < contacts.length; index++) {
        if (contacts[index].classList[1] === "contact-selected") {
            alert("Poti selecta doar un singur contact");
            return false;
        }
    }
    return true;
}

function mark(event) {
    if (event.currentTarget.classList[1] === "contact-selected")
        event.currentTarget.classList.remove("contact-selected");
    else if (checkMark())
        event.currentTarget.classList.add("contact-selected");
}

function inputGrup() {
    var groupName = prompt("Numele noului grup:", "");
    if (groupName.trim() == "") {
        alert("Nume invalid");
    } else if (groupName === null) {
        return;
    } else {
        window.location.assign("/public/groups/newgroup=" + groupName.trim());
    }
}
var left = document.getElementById("left");
left.addEventListener("click", () => {
    var contactId = document.getElementsByClassName("contact-selected")[0];
    if (typeof contactId === "undefined")
        alert("Trebuie sa alegi un contact!");
    else {
        var groupId = document.getElementById("available-groups");
        contactId = contactId.dataset.id;
        groupId = groupId.options[groupId.selectedIndex].value;
        window.location.assign("/public/groups/move=" + contactId + "/to=" + groupId);
    }
});

right.addEventListener("click", () => {
    var contactId = document.getElementsByClassName("contact-selected")[0];
    if (typeof contactId === "undefined")
        alert("Trebuie sa alegi un contact!");
    else {
        contactId = contactId.dataset.id;
        window.location.assign("/public/groups/move=" + contactId + "/to=0");
    }
});