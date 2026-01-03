// core/form.js
const Form = (() => {

    function serialize(form) {
        return new URLSearchParams(new FormData(form)).toString();
    }

    function submit(form, url, onSuccess, onError) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            try {
                const data = serialize(form);
                const response = await Http.post(url, data);
                onSuccess(response);
            } catch (err) {
                if (onError) onError(err);
            }
        });
    }

    return {
        serialize,
        submit
    };
})();
