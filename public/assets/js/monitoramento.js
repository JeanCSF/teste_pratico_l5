const time = 10000;
let dataHora = document.getElementById('dataHora');

function getStatusClass(status) {
    if (status === 'indisponivel') {
        return 'alert alert-dark';
    } else if (status === 'chamando' || status === 'ocupado') {
        return 'alert alert-warning';
    } else if (status === 'pausado') {
        return 'alert alert-danger';
    } else if (status === 'disponivel') {
        return 'alert alert-success';
    } else {
        return '';
    }
}

function getInfo() {
    $.ajax({
        url: "ramais",
        type: "GET",
        success: function (data) {
            let postData = Object.keys(data).map(function (key) {
                return data[key];
            });

            $.ajax({
                url: "salvar-ramal",
                type: "POST",
                data: JSON.stringify(postData),
                error: function () {
                    console.log("Errouu!")
                }
            });

            $('#cartoes').empty();
            for (let i in data) {
                $('#cartoes').append(`<div class="cartao card mb-3 text-dark ${getStatusClass(data[i].status)}">
                <div class="card-body">
                    <p class="card-title font-weight-bold">Ramal: ${data[i].nome}/${data[i].ramal}</p>
                    <p class="card-text font-weight-bold">Agente: ${data[i].agente}</p>
                    <span class="${data[i].status} icone-posicao" title="${data[i].status}"></span>
                </div>
            </div>`)
            }

            dataHora.innerHTML = new Date().toLocaleString();
        },
        error: function () {
            console.log("Errouu!")
        }
    });
}

getInfo();

setInterval(getInfo, time);
