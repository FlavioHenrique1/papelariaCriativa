// core/compras.js
const Compras = (() => {

    const endpoint = 'controllers/controllerCompras';

    /**
     * Busca compras e itens
     * @param {number|null} idCompra
     * @returns {Promise<Array>}
     */
    async function listar(idCompra = null) {
        const params = new URLSearchParams();
        params.append('action', 'list');

        if (idCompra) {
            params.append('id', idCompra);
        }

        return await Http.post(endpoint, params.toString());
    }

    async function deletar(id) {
        const params = new URLSearchParams();
        params.append('action', 'delete');
        params.append('id', id);

        return await Http.post(endpoint, params.toString());
    }


    return {
        listar,
        deletar
    };

})();