function fetch_by_key() {
    var data_all = [];

    var promises = [];

    for (let index = 1; index < 5; index++) {
        const w = "key" + index;
        var keyValue = document.getElementById(w).value;

        let data = {
            "key_map": keyValue,
        };

        var promise = fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(responseData => {
                if (responseData.Items.length !== 0) {
                    data_all = data_all.concat(responseData.Items);
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });

        promises.push(promise);
    }

    Promise.all(promises)
        .then(() => {
            render_data(data_all);
        });
}

function render_data(data) {

    const container = document.getElementById('result-a');

    const p = document.createElement('p');

    data.forEach(element => {
        console.log(element);
        const uuid = element.content;
        p.textContent += uuid + ' ';
    });
    container.appendChild(p);
}