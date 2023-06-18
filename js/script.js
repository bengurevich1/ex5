


const categoryDropDown = document.getElementById('categoryDropDown');

categoryDropDown.addEventListener('change', function () {
    const selectCategory = categoryDropDown.value;
    filterB(selectCategory);

});

function filterB(category) {
    const myBooks = document.getElementsByClassName('card');
    for (let index = 0; index < myBooks.length; index++) {
        const booki = myBooks[index];
        const bookCategory = booki.dataset.category;
        console.log(bookCategory);
        if (category == '' || bookCategory == category) {
            booki.style.display = 'block';
        } else {
            booki.style.display = 'none';
        }
    }
}
