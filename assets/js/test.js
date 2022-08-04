'use strict'

    $("#contact_form_submit").on("submit", function (e) {
        alert('toto dans');
    e.preventDefault();
    let data = {};
    $(this).serializeArray().forEach((object)=>{
        data[object.name] = object.value;
    });
    console.log(data);
    
    //TODO: ajax call here with data
    //If ajax call fails because server can't decode
    //Think of doing : data = JSON.stringify(data);
    console.log(JSON.stringify(data));
    
    })
