const Insumo = (() => {

    let cache = null; // evita várias chamadas ao backend

    /* =========================================
       BUSCAR TODOS OS INSUMOS (COM CACHE)
    ========================================= */
    async function buscarTodos() {

        if (cache) {
            return cache;
        }

        const response = await Http.post(
            'controllers/controllerInsumo',
            'action=list'
        );

        if (!response.success) {
            throw new Error('Erro ao buscar insumos');
        }

        cache = response.data;
        return cache;
    }

    /* =========================================
       BUSCAR INSUMO ESPECÍFICO PELO ID
    ========================================= */
    async function buscarPorId(id) {
        const insumos = await buscarTodos();
        return insumos.find(insumo => Number(insumo.id) === Number(id)) || null;
    }

    /* =========================================
    RETORNAR CONVERSÕES DO INSUMO
    ========================================= */
    async function getConversoes(insumoId) {

        if (!insumoId) {
            return [];
        }

        const response = await Http.post(
            'controllers/controllerInsumo',`action=getConversoes&id=${insumoId}`
        );

        if (!response.success) {
            console.error('Erro ao buscar conversões do insumo');
            return [];
        }

        return response.data || [];
    }


    /* =========================================
       PREENCHER SELECT DE INSUMOS
    ========================================= */
    async function preencherSelect(
        selector,
        selectedId = null,
        placeholder = 'Selecione um insumo'
    ) {

        const select = typeof selector === 'string'
            ? document.querySelector(selector)
            : selector;

        if (!select) return;

        select.innerHTML = `<option value="">${placeholder}</option>`;

        try {
            const insumos = await buscarTodos();

            insumos.forEach(insumo => {
                const option = document.createElement('option');
                option.value = insumo.id;
                option.textContent = insumo.nome + " - " + insumo.tamanho;

                if (selectedId && Number(insumo.id) === Number(selectedId)) {
                    option.selected = true;
                }

                select.appendChild(option);
            });

        } catch (err) {
            console.error(err);
            select.innerHTML = `<option value="">Erro ao carregar insumos</option>`;
        }
    }

    /* =========================================
       LIMPAR CACHE (USAR APÓS INSERT/UPDATE)
    ========================================= */
    function limparCache() {
        cache = null;
    }

    /* =========================================
       API PÚBLICA
    ========================================= */
    return {
        preencherSelect,
        buscarTodos,
        buscarPorId,
        getConversoes,
        limparCache
    };

})();

// 👇 TORNA GLOBAL
window.Insumo = Insumo;