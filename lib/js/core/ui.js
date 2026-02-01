const UI = (() => {

    function getBox(target) {

        // Se pedir modal, tenta pegar mensagem do modal
        if (target === 'modal') {
            const modalBox = document.getElementById('appMessageModal');
            if (modalBox) return modalBox;
        }

        // Fallback SEMPRE para mensagem padrão
        return document.getElementById('appMessage');
    }

    function show(type = 'info', message = '', target = null) {
        const box = getBox(target);
        if (!box) return;

        box.className = 'alert';
        box.classList.remove('d-none');

        const classes = {
            success: 'alert-success',
            error: 'alert-danger',
            warning: 'alert-warning',
            info: 'alert-info'
        };

        box.classList.add(classes[type] || classes.info);

        box.innerHTML = Array.isArray(message)
            ? message.join('<br>')
            : message;
    }

    function clear(target = null) {
        const box = getBox(target);
        if (!box) return;

        box.innerHTML = '';
        box.classList.add('d-none');
    }

    return {
        success: (msg, target) => show('success', msg, target),
        error:   (msg, target) => show('error', msg, target),
        warning: (msg, target) => show('warning', msg, target),
        info:    (msg, target) => show('info', msg, target),
        clear
    };
})();
