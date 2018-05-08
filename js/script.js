let button = document.querySelector('input[type="submit"]')

button.addEventListener('click', function(event) {

    let user = document.querySelector('#user');
    let pass = document.querySelector('#pass');

    if(user.value == "") {
        event.preventDefault();
        $('#loginMessage').modal();
    }    

    if(pass.value.length < 8) {
        event.preventDefault();
        $('#loginMessage').modal();
    }

})

