function fetech_aws(source, elementID) {
    let data = {
        "source": source,
        "datetime_start": "2023-06-15T00:00",
        "datetime_end": "2023-06-18T13:55"
    }
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            let count = data.Count;
            // console.log(elementID);
            let element = document.getElementById(elementID);
            element.textContent = count;
            element.setAttribute('data-stop', count);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

function fetech_source(source) {
    let data = {
        "source": source,
        "datetime_start": "2023-06-15T00:00",
        "datetime_end": "2023-06-18T13:55"
    }
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            if (source == 'facebook') {
                renderdDataFacebook(data.Items);
            } else {
                renderData(data.Items);
            }

            // console.log(data.Items);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

function renderData(data) {
const testimonialContainer = document.getElementById('testimonial-container');

    // Render new elements using a loop
    for (let item of data) {
        console.log(item);
        const testimonialBlock = document.createElement('div');

        const innerBox = document.createElement('div');
        innerBox.classList.add('inner-box');

        innerBox.style.padding = '20px';
        innerBox.style.border = '1px solid #ccc';
        innerBox.style.height = '200px';

        const upperBox = document.createElement('div');

        const h4 = document.createElement('h4');
        h4.textContent = item.data.user;

        const dateTxt = document.createElement('div');
        dateTxt.textContent = item.data.datetime;

        const text = document.createElement('div');
        text.classList.add('text');
        text.style.overflowWrap = 'break-word';

        const view_txt = document.createElement('div');
        view_txt.classList.add('text');
        view_txt.textContent = 'จำนวนผู้เข้าถึง: ' + item.data.view + ' views';

        upperBox.appendChild(h4);
        upperBox.appendChild(dateTxt);

        innerBox.appendChild(upperBox);
        innerBox.appendChild(view_txt);

        const maxCharacters = 105; // Adjust the maximum character count as needed

        if (item.data.content.length > maxCharacters) {
            const truncatedText = item.data.content.substring(0, maxCharacters) + '...';
            text.textContent = truncatedText;

            const readMoreLink = document.createElement('a');
            readMoreLink.textContent = 'อ่านเพิ่มเติม';
            readMoreLink.style.color = 'blue';
            readMoreLink.style.cursor = 'pointer';

            const readLessLink = document.createElement('a');
            readLessLink.textContent = 'น้อยลง';
            readLessLink.style.color = 'blue';
            readLessLink.style.display = 'none';

            readMoreLink.addEventListener('click', function () {
                text.textContent = item.data.content;
                readMoreLink.style.display = 'none';
                readLessLink.style.display = 'inline';
            });

            readLessLink.addEventListener('click', function () {
                text.textContent = truncatedText;
                readLessLink.style.display = 'none';
                readMoreLink.style.display = 'inline';
            });

            innerBox.appendChild(text);
            innerBox.appendChild(readMoreLink);
            innerBox.appendChild(readLessLink);
        } else {
            text.textContent = item.data.content;
            innerBox.appendChild(text);
        }

        testimonialBlock.appendChild(innerBox);

        testimonialContainer.appendChild(testimonialBlock);
    }
}

function renderdDataFacebook(data) {

    const testimonialContainer = document.getElementById('testimonial-container');

    // Render new elements using a loop
    for (let item of data) {
        console.log(item);
        const testimonialBlock = document.createElement('div');

        const innerBox = document.createElement('div');
        innerBox.classList.add('inner-box');

        innerBox.style.padding = '20px';
        innerBox.style.border = '1px solid #ccc';

        const upperBox = document.createElement('div');

        const h4 = document.createElement('h4');
        h4.textContent = item.data.username;

        const dateTxt = document.createElement('div');
        dateTxt.textContent = item.datetime;

        const text = document.createElement('div');
        text.classList.add('text');
        text.style.overflowWrap = 'break-word';

        const view_txt = document.createElement('div');
        view_txt.classList.add('text');
        view_txt.textContent = 'จำนวนถูกใจ: ' + item.data.likes;

        upperBox.appendChild(h4);
        upperBox.appendChild(dateTxt);

        innerBox.appendChild(upperBox);
        innerBox.appendChild(view_txt);

        const maxCharacters = 105; // Adjust the maximum character count as needed

        if (item.data.text.length > maxCharacters) {
            const truncatedText = item.data.text.substring(0, maxCharacters) + '...';
            text.textContent = truncatedText;
             
            innerBox.appendChild(text);
            // innerBox.appendChild(readMoreLink);
            // innerBox.appendChild(readLessLink);
        } else {
            text.textContent = item.data.text;
            innerBox.appendChild(text);
        }

        testimonialBlock.appendChild(innerBox);

        testimonialContainer.appendChild(testimonialBlock);
    }

}