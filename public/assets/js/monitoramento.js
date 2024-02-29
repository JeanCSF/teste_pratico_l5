let dataHora = document.getElementById('dataHora');
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
                success: function (data) {
                },
                error: function () {
                    console.log("Errouu!")
                }
            });

            $('#cartoes').empty();
            for (let i in data) {
                $('#cartoes').append(`<div class="cartao card ${data[i].status === 'indisponivel' ? 'bg-secondary text-white' : 'bg-light'} mb-3">
                <div class="card-body">
                    <h5 class="card-title">${data[i].nome}</h5>
                    <p class="card-text font-weight-bold">${data[i].agente}</p>
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

setInterval(getInfo, 10000);
