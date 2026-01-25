const Insumo = (() => {

    let cache = null; // evita várias chamadas ao backend

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

    async function preencherSelect(selector, selectedId = null, placeholder = 'Selecione um insumo') {

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
                option.textContent = insumo.nome;

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

    function limparCache() {
        cache = null;
    }

    return {
        preencherSelect,
        limparCache
    };

})();
