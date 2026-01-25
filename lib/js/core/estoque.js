// core/estoque.js
const Estoque = (() => {

    const endpoint = 'controllers/controllerEstoque';

    /**
     * Lista todo o estoque atual
     * @returns {Promise<Array>}
     */
    async function listar() {
        const params = new URLSearchParams();
        params.append('action', 'list');

        return await Http.post(endpoint, params.toString());
    }

    /**
     * Busca estoque de um insumo específico
     * @param {number} insumoId
     * @returns {Promise<Object>}
     */
    async function buscarPorInsumo(insumoId) {
        const params = new URLSearchParams();
        params.append('action', 'get');
        params.append('insumo_id', insumoId);

        return await Http.post(endpoint, params.toString());
    }

    /**
     * Atualiza estoque (entrada ou saída)
     * @param {Object} dados
     * dados = {
     *   insumo_id,
     *   tipo: 'entrada' | 'saida' | 'ajuste',
     *   quantidade,
     *   valor_unitario (opcional)
     * }
     */
    async function atualizar(dados) {
        const params = new URLSearchParams();
        params.append('action', 'update');

        Object.keys(dados).forEach(key => {
            params.append(key, dados[key]);
        });

        return await Http.post(endpoint, params.toString());
    }

    /**
     * Ajuste manual de estoque
     * @param {number} insumoId
     * @param {number} quantidade
     * @param {string} motivo
     */
    async function ajuste(insumoId, quantidade, motivo = '') {
        const params = new URLSearchParams();
        params.append('action', 'ajuste');
        params.append('insumo_id', insumoId);
        params.append('quantidade', quantidade);
        params.append('motivo', motivo);

        return await Http.post(endpoint, params.toString());
    }

    /**
     * Remove estoque de um insumo (uso administrativo)
     * @param {number} insumoId
     */
    async function deletar(insumoId) {
        const params = new URLSearchParams();
        params.append('action', 'delete');
        params.append('insumo_id', insumoId);

        return await Http.post(endpoint, params.toString());
    }

    return {
        listar,
        buscarPorInsumo,
        atualizar,
        ajuste,
        deletar
    };

})();
