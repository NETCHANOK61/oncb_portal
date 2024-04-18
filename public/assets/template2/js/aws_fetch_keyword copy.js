async function fetchBy_keymap(key, source) {
    // key = ['key1', 'key2', 'key3', 'key4']
    const responseData_obj = {};
    const responseData_arr = [];
    const filteredKey = key.filter(item => item !== '');
    const fetchPromises = filteredKey.map((async key_item => {
        let data = {
            "key_map": key_item
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
    console.log(responseData_obj);
}

// async function fetchBy_source(source) {
//     const fetchPromises = filteredKey.map((async key_item => {
//         let data = {
//             "source": source
//         };

//         try {
//             const response = await fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json'
//                 },
//                 body: JSON.stringify(data)
//             });
//             const res = await response.json();
//             responseData_obj[key_item] = res.Items;
//             responseData_arr.push(...res.Items);
//         } catch (error) {
//             console.error('Error fetching data:', error);
//         }
//     }));

//     await Promise.all(fetchPromises);
//     renderBox(filteredKey, responseData_obj, responseData_arr);
//     // console.log(responseData_all);
// }

// function renderBox(key, dataObj, dataArr) {
//     var a = dataObj;
//     var b = dataArr.slice(-20);
//     // console.log(b);
//     const container = document.getElementById('result-word');

//     const services = ['TWITTER', 'FACEBOOK', 'TIKTOK', 'WEB BOARD'];

//     const serviceList = document.createElement('ul');
//     serviceList.className = 'service-list';

//     services.forEach(service => {
//         const listItem = document.createElement('li');
//         const link = document.createElement('a');
//         const arrow = document.createElement('span');

//         listItem.id = `filter-${service.toLowerCase()}`;
//         listItem.addEventListener('click', () => {
//             b = b.filter(item => item.source === 'twitter');
//         });

//         listItem.appendChild(link);
//         link.appendChild(arrow);
//         link.appendChild(document.createTextNode(service));
//         arrow.className = 'arrow fa fa-angle-double-right';

//         serviceList.appendChild(listItem);
//     });

//     const rightBar = document.getElementById('rightBar');
//     rightBar.appendChild(serviceList);

//     b.forEach(project => {
//         const html = `
//         <div class="case-block mix all col-lg-4 col-md-6 col-sm-12">
//                 <div class="inner-box">
//                     <div class="image">
//                         <img src="images/gallery/11.jpg" alt="" />
//                         <div class="overlay-box">
//                             <a href="images/gallery/11.jpg" data-fancybox="gallery" data-caption="" class="search-icon"><span class="icon flaticon-search"></span></a>
//                             <div class="content">
//                                 <h4><a href="projects-detail.html">${project.head}</a></h4>
//                                 <div class="category">${project.source}</div>
//                             </div>
//                             <a href="projects-detail.html" class="arrow flaticon-long-arrow-pointing-to-the-right"></a>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         `;
//         container.insertAdjacentHTML('beforebegin', html);
//     });

//     key.forEach((key_search, i) => {
//         const object = a[key_search];
//         if (object) {
//             var number = 'keyword' + (parseInt(i) + 1);
//             const li = document.getElementById(number);
//             li.textContent = key_search;
//             const sliceData = object.slice(-10);
//             if (sliceData.length > 0) {
//                 sliceData.forEach(project => {
//                     const html = `
//                 <div class="case-block mix ${number} col-lg-4 col-md-6 col-sm-12">
// 						<div class="inner-box">
// 							<div class="image">
// 								<img src="images/gallery/11.jpg" alt="" />
// 								<div class="overlay-box">
// 									<a href="images/gallery/11.jpg" data-fancybox="gallery" data-caption="" class="search-icon"><span class="icon flaticon-search"></span></a>
// 									<div class="content">
// 										<h4><a href="projects-detail.html">${project.head}</a></h4>
// 										<div class="category">${project.source}</div>
// 									</div>
// 									<a href="projects-detail.html" class="arrow flaticon-long-arrow-pointing-to-the-right"></a>
// 								</div>
// 							</div>
// 						</div>
// 					</div>
//                 `;
//                     container.insertAdjacentHTML('beforeend', html);
//                 });
//             } else {
//                 const html = `
//                 <div class="case-block mix ${number}" style=" text-align: center; margin: auto; width: 60%; padding: 10px;">
//                     <div>
//                         <h4>ไม่พบข้อมูล</h4>
//                     </div>
//                 </div>
//                 `;
//                 container.insertAdjacentHTML('beforeend', html);
//             }
//         }
//     });
// }

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
            renderProjects(b);
            updateProjects(key, a, checked);
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

    renderProjects(b);
    updateProjects(key, a, checked);

    function renderProjects(projects) {
        container.innerHTML = ''; // Clear previous projects

        projects.forEach(project => {
            const html = `
          <div class="case-block mix all col-lg-2 col-md-6 col-sm-12">
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

    function updateProjects(key, dataObj, checkedService) {
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
                    filteredData.forEach(project => {
                        const html = `
                  <div class="case-block mix ${number} col-lg-2 col-md-6 col-sm-12">
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
                } else {
                    const html = `
                <div class="case-block mix ${number}" style=" text-align: center; margin: auto; width: 60%; padding: 10px;">
                  <div>
                    <h4>ไม่พบข้อมูล</h4>
                  </div>
                </div>
              `;
                    container.insertAdjacentHTML('beforeend', html);
                }
            }
        });
    }


    // key.forEach((key_search, i) => {
    //     const object = a[key_search];
    //     if (object) {
    //         var number = 'keyword' + (parseInt(i) + 1);
    //         const li = document.getElementById(number);
    //         li.textContent = key_search;
    //         const sliceData = object;

    //         let filteredData = sliceData;
    //         if (checked != "") {
    //             filteredData = sliceData.filter(item => item.source === checked);
    //         }

    //         if (filteredData.length > 0) {
    //             filteredData.forEach(project => {
    //                 const html = `
    //           <div class="case-block mix ${number} col-lg-2 col-md-6 col-sm-12">
    //             <div class="inner-box">
    //               <div class="image">
    //                 <img src="images/gallery/11.jpg" alt="" />
    //                 <div class="overlay-box">
    //                   <div class="content">
    //                     <h6><a href="projects-detail.html">${project.head}</a></h6>
    //                     <div class="category">${project.source}</div>
    //                   </div>
    //                 </div>
    //               </div>
    //             </div>
    //           </div>
    //         `;
    //                 container.insertAdjacentHTML('beforeend', html);
    //             });
    //         } else {
    //             const html = `
    //         <div class="case-block mix ${number}" style=" text-align: center; margin: auto; width: 60%; padding: 10px;">
    //           <div>
    //             <h4>ไม่พบข้อมูล</h4>
    //           </div>
    //         </div>
    //       `;
    //             container.insertAdjacentHTML('beforeend', html);
    //         }
    //     }
    // });
}


