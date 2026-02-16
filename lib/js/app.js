// ===============================
// CAPS LOCK DETECT
// ===============================
const senhaInput = document.querySelector("#senha");

if (senhaInput) {
    senhaInput.addEventListener("keypress", function (e) {
        const kc = e.keyCode || e.which;
        const sk = e.shiftKey || (kc === 16);

        const aviso = document.querySelector(".resultadoForm");

        if (
            ((kc >= 65 && kc <= 90) && !sk) ||
            ((kc >= 97 && kc <= 122) && sk)
        ) {
            aviso.innerHTML = "Caps Lock Ligado";
        } else {
            aviso.innerHTML = "";
        }
    });
}

// ===============================
// MÁSCARAS DO FORMULÁRIO
// ===============================
document.addEventListener('focusin', function (e) {
    const id = e.target.id;

    if (id === "cpf") {
        VMasker(document.querySelector("#cpf"))
            .maskPattern("999.999.999-99");
    }

    if (id === "dataNascimento") {
        VMasker(document.querySelector("#dataNascimento"))
            .maskPattern("99/99/9999");
    }

    if (id === "valor") {
        VMasker(document.querySelector("#valor"))
            .maskPattern("R$ 99,99");
    }

});

// ===============================
// FORMATAR VALORES
// ===============================

function normalizarNumero(texto) {
  texto = texto
    .replace(/\s/g, '')
    .replace('R$', '');

  // formato brasileiro: 1.234,56
  if (texto.includes(',') && texto.includes('.')) {
    texto = texto.replace(/\./g, '').replace(',', '.');
  }
  // formato brasileiro simples: 23,50
  else if (texto.includes(',')) {
    texto = texto.replace(',', '.');
  }
  // formato americano: 23.50 (mantém como está)
  // formato inteiro: 23

  const numero = parseFloat(texto);
  return isNaN(numero) ? null : numero;
}


function formatarValoresTabela(seletor = '.valor') {
  const formatter = new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  });

  document.querySelectorAll(seletor).forEach(el => {
    if (el.dataset.formatado) return;

    const numero = normalizarNumero(el.textContent);

    if (numero !== null) {
      el.textContent = formatter.format(numero);
      el.dataset.formatado = '1';
    }
  });
}

// ===============================
// ROOT DO SISTEMA
// ===============================
function getRoot() {
    return "http://" + document.location.hostname + ":8080/papelariaCriativa/";
}

// ===============================
// FUNÇÃO SERIALIZE (SUBSTITUI $(form).serialize())
// ===============================
function serializeForm(form) {
    return new URLSearchParams(new FormData(form)).toString();
}

// ===============================
// FORMULÁRIO DE CADASTRO
// ===============================
const formCadastro = document.querySelector("#formCadastro");

if (formCadastro) {
    formCadastro.addEventListener("submit", function (event) {
        event.preventDefault();

        fetch(getRoot() + "controllers/controllerCadastro", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: serializeForm(this)
        })
        .then(r => r.json())
        .then(response => {
            const retorno = document.querySelector(".retornoCad");
            retorno.innerHTML = "";

            if (response.retorno === "erro") {
                response.erros.forEach(err => {
                    retorno.innerHTML += err + "<br>";
                });
            } else {
                retorno.innerHTML = "Dados inseridos com sucesso!";
            }
        });
    });
}

// ===============================
// FORMULÁRIO DE LOGIN
// ===============================
const formLogin = document.querySelector("#formLogin");
if (formLogin) {
    formLogin.addEventListener("submit", function (event) {
        event.preventDefault();
        fetch(getRoot() + "controllers/controllerLogin", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: serializeForm(this)
        })
        .then(r => r.json())
        .then(response => {
            if (response.retorno === "success") {
                window.location.href = response.page;
            } else {
                if (response.tentativas === true) {
                    const loginForm = document.querySelector(".loginFormulario");
                    if (loginForm) loginForm.style.display = "none";
                }

                const resultado = document.querySelector(".resultadoForm");
                resultado.innerHTML = "";

                response.erros.forEach(err => {
                    resultado.innerHTML += err + "<br>";
                });
            }
        });
    });
}

// ===============================
// FORMULÁRIO DE CONFIRMAÇÃO DE SENHA
// ===============================
const formSenha = document.querySelector("#formSenha");

if (formSenha) {
    formSenha.addEventListener("submit", function (event) {
        event.preventDefault();

        fetch(getRoot() + "controllers/controllerSenha", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: serializeForm(this)
        })
        .then(r => r.json())
        .then(response => {
            const retorno = document.querySelector(".retornoSen");
            retorno.innerHTML = "";

            if (response.retorno === "success") {
                retorno.innerHTML = "Redefinição de senha enviada com sucesso!";
            } else {
                response.erros.forEach(err => {
                    retorno.innerHTML += err;
                });
            }
        });
    });
}


