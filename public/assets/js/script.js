let inputValues = null
let searchValue = null
let valueExists = false
document.addEventListener('DOMContentLoaded', () => {
    let searchValueInput = document.getElementById('search_value')
    let inputValuesInput = document.getElementById('input_values')
    let submitButton = document.getElementById('submit_btn')

    submitButton.addEventListener('click', event => {
        searchValue = Number(searchValueInput.value)
        // inputValues = inputValuesInput.value.split(',').map(Number)
        inputValues = inputValuesInput.value.split(",").filter(function (x) { return x !== "" && !isNaN(Number(x)); }).map(Number);
        console.log("New Boss: ", inputValues)
        // console.log("Before: ", inputValues)
        // newInputValues = inputValues.filter(el => Number.isInteger(el))
        // console.log("After: ", newInputValues)

        handleSubmitButtonClick()
    })
})

function handleSubmitButtonClick() {
    sortInputValues()
    removeAlert()
    // valueExists = isExists(inputValues, searchValue)
    axios({
        method: 'POST',
        url: routes['web.khoj_the_search.store'],
        data: {
            input_values:inputValues.join(',')
        }
    })
        .then(res => res.data)
        .then(res => {
            if (res.success) {
                document.querySelector('.container').insertAdjacentHTML('beforeend', `<div class="alert alert-success">${res.message}</div>`)
                setTimeout(() => {
                    removeAlert()
                }, 1500)
                let resultDom = document.getElementById('result_dom')
                let result = document.getElementById('result')
                result.innerHTML = String(valueExists).charAt(0).toUpperCase() + String(valueExists).slice(1);
                resultDom.classList.remove('d-none')
            }
        })
        .catch(e => {
            console.log(e)
        })
    valueExists = isExists()
    console.log("HOla: ", valueExists)
}

function isExists () {
    console.log(typeof(inputValues), typeof(searchValue))

    let start = 0;
    let end = inputValues.length - 1;

    // Iterate while start not meets end
    while (start <= end){

        // Find the mid index
        let mid= Math.floor((start + end)/2);
        if (inputValues[mid] === searchValue) return true;

        // Else look in left if searchValue is greater than mid
        else if (inputValues[mid] < searchValue)
            end = mid - 1;
        else
            start = mid + 1;
    }
    console.log('HOLA', start, end)
    return false;
    // return inputValues.includes(searchValue)
}

function sortInputValues() {
    inputValues.sort((a, b) => b - a)
}

function removeAlert() {
    let alerts = document.querySelectorAll('.alert')
    for(let i=0; i<alerts.length; i++) {
        alerts[i].remove()
    }
}
