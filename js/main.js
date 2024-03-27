window.addEventListener('load', init);

const apiUrl = 'actions.php';


function init(){

}
function fetchAPI(myUrl) {
    fetch(myUrl)
        .then(response => response.data())
        .then((data => {
            return data;
        }))
}

