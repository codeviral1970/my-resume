window.addEventListener('load', () => {
    initFormOnSubmit();
})

function initFormOnSubmit() {
    
    const form = document.querySelector("#contactMe form");
    
    form.addEventListener('submit', (event) => {
        event.preventDefault();
    
        sendData(form);
    }) 
}

function sendData(form) {
    const xhr = new XMLHttpRequest();
    const formData = new formData(form);

    xhr.addEventListener('load', () => {
        if (xhr.status < 400){
            return;
        }

        const newHtml = xhr.response;

        const divElement = document.createElement('div');
        divElement.innerHTML = newHtml;

        const newBody = divElement.querySelector('#contactMe form');
        const oldbody = document.querySelector('#contactMe form');

        oldbody.innerHTML = newBody.innerHTML;

        initFormOnSubmit();
    })

    xhr.addEventListener('error', () => {
        document.querySelector('#contactMe form').innerHTML = 'error occured';
    })

    xhr.open('POST', form.getAttribute('action'));
    xhr.send(formData);
}