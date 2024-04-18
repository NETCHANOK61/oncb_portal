async function fetchBy_keymap(key, source, option) {
  const responseData_obj = {};
  const responseData_arr = [];
  const filteredKey = key.filter(item => item !== '');
  const fetchPromises = filteredKey.map((async key_item => {
    let data = {
      "data": key_item,
      // "last": 30
    };

    if (source != 'all') {
      data = {
        ...data,
        "source": source
      }
    }
    try {
      const response = await fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });
      const res = await response.json();
      responseData_obj[key_item] = res.Items;
      responseData_arr.push(...res.Items);
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }));

  await Promise.all(fetchPromises);
  renderBox(filteredKey, responseData_obj, responseData_arr);
  // console.log(responseData_obj);
}

function fetch_advanced(key, source) {
  let data = {
    "data_box": key,
    "source": source,
    "last": 100
  }
  fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
    method: 'POST', headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
    .then(response => response.json())
    .then(data => {
      renderBox2(data, key)
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
}

function renderBox2(data, key) {
  const container = document.getElementById('result-word');
  container.innerHTML = '';
  var dataList = data.Items;

  key.forEach((key_search, i) => {
    // console.log(key)
    var number = 'keyword' + (parseInt(i) + 1);
    const li = document.getElementById(number);
    li.textContent = key_search;
    dataList.forEach(project => {
      if (project.source == 'twitter') {
        imagePath = '/images/twitter-icons.png';
        errImg = '/images/twitter-icons.png';
        nextPage = 'twitter-detail.html?uuid=' + encodeURIComponent(project.uuid);
      } else if (project.source == 'facebook') {
        imagePath = '/images/facebook-icons.png';
        errImg = '/images/facebook-icons.png';
        nextPage = 'facebook-detail.html?uuid=' + encodeURIComponent(project.uuid);
      } else if (project.source == 'tiktok') {
        imagePath = '/images/tiktok-icons.png';
        errImg = '/images/tiktok-icons.png';
        nextPage = 'tiktok-detail.html?uuid=' + encodeURIComponent(project.uuid);
      } else {
        imagePath = '/images/blog-icons.png';
        errImg = '/images/blog-icons.png';
        nextPage = 'pantip-detail.html?uuid=' + encodeURIComponent(project.uuid);
      }
      // console.log(project.source)
      const html = `
      <div class="case-block mix ${number} col-lg-3 col-md-3 col-sm-12" onclick="goToPage('${nextPage}')">
                      <div class="inner-box">
                        <div class="image">
                          <img src="${imagePath}" alt="" onerror="this.src='${errImg}';" />
                          <div class="overlay-box">
                            <div class="content">
                              <h6><a href="${nextPage}"' style='color:#DAA520'>${(project.head.slice(0, 20))}...>>อ่านต่อ </a></h6>
                              <div class="category">${project.source}</div>
                            </div>
                          </div>
                        </div>
                      </div>
      </div>
    `;
      container.insertAdjacentHTML('beforeend', html);
    })
  })


}

function renderBox(key, dataObj, dataArr) {
  var a = dataObj;
  var b = dataArr;
  var checked = '';
  const container = document.getElementById('result-word');

  const services = ['TWITTER', 'FACEBOOK', 'TIKTOK', 'WEB BOARD'];

  const serviceList = document.createElement('ul');
  serviceList.className = 'service-list';

  services.forEach(service => {
    const listItem = document.createElement('li');
    const link = document.createElement('a');
    const arrow = document.createElement('span');

    listItem.id = `filter-${service.toLowerCase()}`;
    listItem.addEventListener('click', () => {
      if (service === 'TWITTER') {
        b = dataArr.filter(item => item.source === 'twitter');
        checked = "twitter";
      } else if (service === 'FACEBOOK') {
        b = dataArr.filter(item => item.source === 'facebook');
        checked = "facebook";
      } else if (service === 'TIKTOK') {
        b = dataArr.filter(item => item.source === 'tiktok');
        checked = "tiktok";
      } else if (service === 'WEB BOARD') {
        b = dataArr.filter(item => item.source === 'pantip');
        checked = "pantip";
      }
      renderAll_list(b);
      renderSub_list(key, a, checked);
    });

    listItem.appendChild(link);
    link.appendChild(arrow);
    link.appendChild(document.createTextNode(service));
    arrow.className = 'arrow fa fa-angle-double-right';

    serviceList.appendChild(listItem);
  });

  const rightBar = document.getElementById('rightBar');
  rightBar.innerHTML = ''; // Clear previous service list
  rightBar.appendChild(serviceList);

  renderAll_list(b);
  renderSub_list(key, a, checked);

  function renderAll_list(projects) {
    container.innerHTML = ''; // Clear previous projects

    projects.forEach(project => {
      const html = `
          <div class="case-block mix all col-lg-3 col-md-3 col-sm-12">
            <div class="inner-box">
              <div class="image">
                <img src="images/gallery/11.jpg" alt="" />
                <div class="overlay-box">
                  <div class="content">
                    <h6><a href="projects-detail.html">${project.head}</a></h6>
                    <div class="category">${project.source}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `;
      container.insertAdjacentHTML('beforeend', html);
    });
  }

  function renderSub_list(key, dataObj, checkedService) {
    // console.log(dataObj)
    const container = document.getElementById('result-word');
    container.innerHTML = ''; // Clear previous projects

    key.forEach((key_search, i) => {
      const object = dataObj[key_search];
      if (object) {
        var number = 'keyword' + (parseInt(i) + 1);
        const li = document.getElementById(number);
        li.textContent = key_search;
        const sliceData = object;

        let filteredData = sliceData;
        if (checkedService !== '') {
          filteredData = sliceData.filter(item => item.source === checkedService);
        }

        if (filteredData.length > 0) {
          // document.getElementById('keyword1').click();
          filteredData.forEach(project => {
            // console.log(project)
            // const hasImage_fb = 'image_lowquality' in project.data;
            var imagePath = '';
            var errImg = '';
            var nextPage = '';
            if (project.source == 'twitter') {
              imagePath = '/images/twitter-icons.png';
              errImg = '/images/twitter-icons.png';
              nextPage = 'twitter-detail.html?uuid=' + encodeURIComponent(project.uuid);
            } else if (project.source == 'facebook') {
              imagePath = '/images/facebook-icons.png';
              errImg = '/images/facebook-icons.png';
              nextPage = 'facebook-detail.html?uuid=' + encodeURIComponent(project.uuid);
            } else if (project.source == 'tiktok') {
              imagePath = '/images/tiktok-icons.png';
              errImg = '/images/tiktok-icons.png';
              nextPage = 'tiktok-detail.html?uuid=' + encodeURIComponent(project.uuid);
            } else {
              imagePath = '/images/blog-icons.png';
              errImg = '/images/blog-icons.png';
              nextPage = 'pantip-detail.html?uuid=' + encodeURIComponent(project.uuid);
            }
            // if (hasImage_fb) {
            //   imagePath = project.data.image_lowquality;
            //   errImg = '/images/Facebook-icons.png';
            //   nextPage = 'facebook-detail.html?uuid=' + encodeURIComponent(project.uuid);
            // } else {
            //   if (project.source == 'twitter') {
            //     imagePath = '/images/twitter-icons.png';
            //     errImg = '/images/twitter-icons.png';
            //     nextPage = 'twitter-detail.html?uuid=' + encodeURIComponent(project.uuid);
            //   } else if (project.source == 'tiktok') {
            //     imagePath = '/images/tiktok-icons.png';
            //     errImg = '/images/tiktok-icons.png';
            //     nextPage = 'tiktok-detail.html?uuid=' + encodeURIComponent(project.uuid);
            //   } else {
            //     imagePath = '/images/blog-icons.png';
            //     errImg = '/images/blog-icons.png';
            //     nextPage = 'pantip-detail.html?uuid=' + encodeURIComponent(project.uuid);
            //   }
            // }

            // const imagePath = hasImage ? project.data.image_lowquality : 'images/gallery/11.jpg';
            const html = `
                  <div class="case-block mix ${number} col-lg-3 col-md-3 col-sm-12" onclick="goToPage('${nextPage}')">
                    <div class="inner-box">
                      <div class="image">
                        <img src="${imagePath}" alt="" onerror="this.src='${errImg}';" />
                        <div class="overlay-box">
                          <div class="content">
                            <h4><a href="${nextPage}"' style='color:#DAA520'>${(project.head.slice(0, 20))}...>>อ่านต่อ </a></h4>
                            <div class="category">${project.source}</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                `;
            container.insertAdjacentHTML('beforeend', html);
          });
          document.getElementById('keyword1').click();
        } else {
          // const html = `
          //       <div class="case-block mix ${number}" style=" text-align: center; margin: auto; width: 60%; padding: 10px;">
          //         <div>
          //           <h4>ไม่พบข้อมูล</h4>
          //         </div>
          //       </div>
          //     `;
          // container.insertAdjacentHTML('beforeend', html);
        }
      }
    });
  }
}
function goToPage(url) {
  window.location.href = url;
}

