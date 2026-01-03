// core/http.js
const Http = (() => {

    const baseURL = `${location.protocol}//${location.host}/papelariaCriativa/`;

    async function request(method, url, data = null) {
        const options = {
            method,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };

        if (data) {
            options.body = data;
        }

        const response = await fetch(baseURL + url, options);

        if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`);
        }

        return response.json();
    }

    return {
        get: (url) => request('GET', url),
        post: (url, data) => request('POST', url, data),
        put: (url, data) => request('PUT', url, data),
        delete: (url, data = null) => request('DELETE', url, data)
    };
})();
