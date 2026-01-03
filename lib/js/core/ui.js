// core/ui.js
const UI = (() => {

    function showErrors(container, errors) {
        container.innerHTML = '';
        errors.forEach(err => {
            container.innerHTML += `${err}<br>`;
        });
    }

    function showMessage(container, msg) {
        container.innerHTML = msg;
    }

    function clear(container) {
        container.innerHTML = '';
    }

    return {
        showErrors,
        showMessage,
        clear
    };
})();
