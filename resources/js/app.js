require('./bootstrap');
require('alpinejs');

console.log('Ready!')


document.querySelector(".st-add-input").addEventListener("click", function() {

    let name = document.querySelector("#name");
    if(!name){
        name =  document.querySelector("#sub_name");
    }
    if(name){
        name.value = "";
        // return cursor focus to the input field:
        name.focus();
    }
});


