// Honeycomb img position handle
window.onresize = moveHoneycombOnTop;
window.onload = moveHoneycombOnTop;

// Form Handle
var form = document.getElementById('contact-form');
form.onsubmit = function(event) {
    // Prevent default
    event.preventDefault();

    // Validate form
    var messageParent = document.getElementById('form-messages');
    var validation = validateForm(this, messageParent);

    // If valid submit
    if(validation[0] === true) {
        // Take care of button content
        var button = document.getElementById('form-submit');
        button.disabled = true;
        button.textContent='.';
        var loadingInterval = window.setInterval(loadingAnimation, 1000)

        // Ajax request and response treatment
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.response;
                if(response == 1) {
                    // Add a success message
                    formSubmitResponseHandle(
                        messageParent, 
                        'Le message a bien été envoyé. Vous allez recevoir un mail de confirmation', 'success', 
                        button, 'Message envoyé !',
                        loadingInterval)

                    // Reset values except email if sender want to check
                    validation[2].value = '';
                    validation[4].value = '';

                    // Button still disabled
                    button.disabled = true;
                } else {
                    // Add error message
                    formSubmitResponseHandle(
                        messageParent, 
                        response, 'error', 
                        button, 'ENVOYER',
                        loadingInterval)
                    button.disabled = false;
                }
            }
        };

        // Send AJAX request
        var request = '?name=' + validation[2].value + '&mail=' + validation[3].value  + '&content=' + validation[4].value;
        xhttp.open('GET', 'backend/sendMail.php' + request, true);
        xhttp.send(request);
    }

}

function formSubmitResponseHandle(messageParent, messageContent, messageType, button, buttonContent, loadingInterval) {
    messageParent.innerHTML = "";
    appendFormMessage(messageParent, messageContent, messageType);
    button.textContent= buttonContent;
    clearInterval(loadingInterval);
}

function loadingAnimation() {
    var button = document.getElementById('form-submit');
    if(button.textContent.length < 5 ) {
        button.textContent += '.';
    } else if(button.textContent.length >= 5) {
        button.textContent = '.';
    }
}

function validateForm(form, messageParent){
    // Clear form-messages
    messageParent.innerHTML = "";

    // Success 
    var success = true;

    // Check all fields
    // name field
    var name = document.getElementById('name-input');
    if(name.value.length === 0) {
        appendFormMessage(messageParent, 'Veuillez renseigner un nom', 'error');
        success = false;
    }

    // email field
    var mail = document.getElementById('email-input');
    if(mail.value.length === 0) {
        appendFormMessage(messageParent, 'Veuillez renseigner un mail', 'error');
        success = false;
    } else if(!validateEmail(mail.value)) {
        appendFormMessage(messageParent, 'Veuillez renseigner un mail valide', 'error');
        success = false;
    }

    // content field
    var content = document.getElementById('content-input');
    if(content.value.length === 0) {
        appendFormMessage(messageParent, 'Veuillez ajouter un message', 'error');
        success = false;
    }

    return [success, messageParent, name, mail, content];
}

function appendFormMessage(parent, content, type) {
    var div = document.createElement('DIV');
    div.textContent = content;
    div.className = "form-message " + type;
    parent.append(div)
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function moveHoneycombOnTop() {
    var honeycomb = document.getElementById("honeycomb");
    var section = document.getElementById("honeycomb-display")
    if(window.outerWidth <= 900) {
        section.prepend(honeycomb)
    } else {
        section.append(honeycomb)
    }
}