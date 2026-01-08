// core/ui.js
const UI = (() => {

    const messageBox = () => document.getElementById('appMessage');

    function show(type = 'info', message = []) {
        const box = messageBox();
        if (!box) return;

        box.className = 'alert'; // reseta classes
        box.classList.remove('d-none');

        const classes = {
            success: 'alert-success',
            error: 'alert-danger',
            warning: 'alert-warning',
            info: 'alert-info'
        };

        box.classList.add(classes[type] || classes.info);

        // aceita string ou array
        if (Array.isArray(message)) {
            box.innerHTML = message.map(m => `${m}<br>`).join('');
        } else {
            box.innerHTML = message;
        }
    }

    function error(message) {
        show('error', message);
    }

    function success(message) {
        show('success', message);
    }

    function warning(message) {
        show('warning', message);
    }

    function info(message) {
        show('info', message);
    }

    function clear() {
        const box = messageBox();
        if (!box) return;

        box.innerHTML = '';
        box.classList.add('d-none');
    }

    return {
        error,
        success,
        warning,
        info,
        clear
    };
})();
