require('./bootstrap');
require('alpinejs');

console.log('Ready!')


document.querySelector("#st-create-classroom").addEventListener("click", function() {
    const name = document.querySelector("#name");
    name.value = "";
    // return cursor focus to the input field:
    name.focus();
});
