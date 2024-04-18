let data;

function reloadData() {
	location.reload();
}

async function sendAPIRequest() {
	var url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi';

	// Example payload data to be sent in the request body
	var payload = {};

	var headers = {
		'Content-Type': 'application/json'
	};

	// Wrap the AJAX call in a promise, so that it can be awaited
	let response = await new Promise((resolve, reject) => {
		// Send the POST request
		$.ajax({
			url: url,
			type: 'POST',
			data: JSON.stringify(payload),
			headers: headers,
			success: function (response) {
				resolve(response);
			},
			error: function (error) {
				reject(error);
			}
		});
	});

	// Return the response so it can be used outside of the function
	return response;
}


// Call the API request function and log the response
(async function () {
	try {

		function generateDataNew2(data_new1) {
			// let data_new2 = [
			// 	[
			// 		"id",
			// 		"username",
			// 		"password",
			// 		"email",
			// 		"บทบาทผู้ใช้งาน",
			// 		"สถานะ",
			// 		"หน่วยงาน",
			// 		"คีย์เวิร์ด"
			// 	]
			// ];

			let data_new2 = [
				[
					"user_department",
					"user_password",
					"user_token",
					"user_email",
					"username",
					"id",
					"user_role",
					"user_status",
					"keyword"
				]
			];

			data_new1.Items.forEach(item => {
				// let newItem = [
				// 	item.id.toString(),
				// 	item.username,
				// 	item.user_password,
				// 	item.user_email,
				// 	item.user_role,
				// 	item.user_status,
				// 	item.user_department
				// ];
				let newItem = [
					item.user_department,
					item.user_password,
					item.user_token,
					item.user_email,
					item.username,
					item.id.toString(),
					item.user_role,
					item.user_status
				];

				if (item.keyword && item.keyword.length > 0) {
					newItem.push(item.keyword.join(", "));
				} else {
					newItem.push(" ");
				}

				data_new2.push(newItem);
			});

			return data_new2;
		}

		// function createTable(data) {
		// 	const table = document.createElement('table');
		// 	data.forEach((row, rowIndex) => {
		// 		const tr = document.createElement('tr');
		// 		row.forEach((cell, cellIndex) => {
		// 			const cellElem = rowIndex === 0 ? document.createElement('th') : document.createElement('td');
		// 			cellElem.textContent = cell;

		// 			if (rowIndex > 0) {
		// 				cellElem.addEventListener('click', (e) => {
		// 					e.stopPropagation();
		// 					editCell(rowIndex, cellIndex);
		// 				});
		// 			}

		// 			tr.appendChild(cellElem);
		// 		});

		// 		if (rowIndex === 0) {
		// 			const emptyCell = document.createElement('th');
		// 			tr.appendChild(emptyCell);
		// 		} else {
		// 			const deleteButton = document.createElement('button');
		// 			deleteButton.textContent = 'Delete';
		// 			deleteButton.classList.add('delete-btn');
		// 			deleteButton.addEventListener('click', () => {
		// 				deleteRow(rowIndex);
		// 			});

		// 			const addButton = document.createElement('button');
		// 			addButton.textContent = 'Add';
		// 			addButton.classList.add('add-btn');
		// 			addButton.addEventListener('click', () => {
		// 				addRow(rowIndex + 1);
		// 			});

		// 			const buttonCell = document.createElement('td');
		// 			buttonCell.appendChild(addButton);
		// 			buttonCell.appendChild(deleteButton);
		// 			tr.appendChild(buttonCell);
		// 		}

		// 		table.appendChild(tr);
		// 	});
		// 	document.getElementById('table-container').appendChild(table);
		// }

		function createTable(data) {
			const table = document.createElement('table');
			data.forEach((row, rowIndex) => {
				const tr = document.createElement('tr');
				row.forEach((cell, cellIndex) => {
					const cellElem = rowIndex === 0 ? document.createElement('th') : document.createElement('td');
					cellElem.textContent = cell;
					tr.appendChild(cellElem);
				});

				if (rowIndex === 0) {
					// Add the "Add" button only in the header row
					const addButton = document.createElement('button');
					addButton.textContent = 'แก้ไข';
					addButton.classList.add('add-btn');
					addButton.addEventListener('click', () => {
						addRow();
					});
					const buttonCell = document.createElement('th');
					buttonCell.appendChild(addButton);
					tr.appendChild(buttonCell);
				} else {
					const deleteButton = document.createElement('button');
					deleteButton.textContent = 'Delete';
					deleteButton.classList.add('delete-btn');
					deleteButton.addEventListener('click', () => {
						deleteRow(rowIndex);
					});

					const buttonCell = document.createElement('td');
					buttonCell.appendChild(deleteButton);
					tr.appendChild(buttonCell);
				}

				table.appendChild(tr);
			});
			document.getElementById('table-container').appendChild(table);
		}

		function editCell(rowIndex, cellIndex) {
			const currentValue = data[rowIndex][cellIndex];
			const newValue = prompt("แก้ไขข้อมูล: " + currentValue, currentValue);
			if (newValue !== null) {
				data[rowIndex][cellIndex] = newValue;
				console.log("Updated data:", data);
				updateTable();
			}
		}

		function deleteRow(rowIndex) {
			data.splice(rowIndex, 1);
			console.log("Deleted row:", rowIndex, "Updated data:", data);
			updateTable();
		}

		// function addRow(rowIndex) {
		// 	const newRow = [];
		// 	data[rowIndex - 1].forEach((_, index) => {
		// 		newRow.push('');
		// 	});
		// 	data.splice(rowIndex, 0, newRow);
		// 	console.log("Added row:", rowIndex, "Updated data:", data);
		// 	const tableContainer = document.getElementById('table-container');
		// 	const oldTable = document.querySelector('table');
		// 	if (oldTable) {
		// 		tableContainer.removeChild(oldTable);
		// 	}
		// 	createTable(data);
		// }

		function addRow() {
			const newRow = [];
			data[0].forEach(() => {
				newRow.push('');
			});
			data.splice(1, 0, newRow); // Add the new row as the first row after the header
			console.log("Added row at the beginning", "Updated data:", data);
			updateTable(); // Refresh the table view to show the new row
		}

		function addNewRow(rowIndex) {
			const newRow = [];
			data[rowIndex - 1].forEach((_, index) => {
				newRow.push('');
			});
			data.splice(rowIndex, 0, newRow);
			console.log("Added row:", rowIndex, "Updated data:", data);
			updateTable(); // Make sure to use updateTable function to refresh the view
		}

		// function updateTable() {
		// 	const oldTable = document.querySelector('table');
		// 	const tableContainer = document.getElementById('table-container');
		// 	tableContainer.removeChild(oldTable);

		// 	if (data.length > 0) {
		// 		const table = document.createElement('table');
		// 		data.forEach((row, rowIndex) => {
		// 			const tr = document.createElement('tr');
		// 			row.forEach((cell, cellIndex) => {
		// 				const cellElem = rowIndex === 0 ? document.createElement('th') : document.createElement('td');
		// 				cellElem.textContent = cell;

		// 				if (rowIndex > 0) {
		// 					cellElem.addEventListener('click', (e) => {
		// 						e.stopPropagation();
		// 						editCell(rowIndex, cellIndex);
		// 					});
		// 				}

		// 				tr.appendChild(cellElem);
		// 			});

		// 			if (rowIndex === 0) {
		// 				const emptyCell = document.createElement('th');
		// 				tr.appendChild(emptyCell);
		// 			} else {
		// 				const deleteButton = document.createElement('button');
		// 				deleteButton.textContent = 'Delete';
		// 				deleteButton.classList.add('delete-btn');
		// 				deleteButton.addEventListener('click', () => {
		// 					deleteRow(rowIndex);
		// 				});

		// 				const addButton = document.createElement('button');
		// 				addButton.textContent = 'Add';
		// 				addButton.classList.add('add-btn');
		// 				addButton.addEventListener('click', () => {
		// 					addRow(rowIndex + 1);
		// 				});

		// 				const buttonCell = document.createElement('td');
		// 				buttonCell.appendChild(addButton);
		// 				buttonCell.appendChild(deleteButton);
		// 				tr.appendChild(buttonCell);
		// 			}

		// 			table.appendChild(tr);
		// 		});
		// 		tableContainer.appendChild(table);
		// 	} else {
		// 		const message = document.createElement('p');
		// 		message.textContent = 'No data available';
		// 		tableContainer.appendChild(message);
		// 	}
		// }

		function updateTable() {
			const oldTable = document.querySelector('table');
			const tableContainer = document.getElementById('table-container');
			tableContainer.removeChild(oldTable);

			if (data.length > 0) {
				const table = document.createElement('table');
				data.forEach((row, rowIndex) => {
					const tr = document.createElement('tr');
					row.forEach((cell, cellIndex) => {
						const cellElem = rowIndex === 0 ? document.createElement('th') : document.createElement('td');
						cellElem.textContent = cell;

						if (rowIndex > 0) {
							cellElem.addEventListener('click', (e) => {
								e.stopPropagation();
								editCell(rowIndex, cellIndex);
							});
						}

						tr.appendChild(cellElem);
					});

					if (rowIndex === 0) {
						// Add the "Add" button only in the header row
						const addButton = document.createElement('button');
						addButton.textContent = 'แก้ไข';
						addButton.classList.add('add-btn');
						addButton.addEventListener('click', () => {
							addRow();
						});
						const buttonCell = document.createElement('th');
						buttonCell.appendChild(addButton);
						tr.appendChild(buttonCell);
					} else {
						const deleteButton = document.createElement('button');
						deleteButton.textContent = 'Delete';
						deleteButton.classList.add('delete-btn');
						deleteButton.addEventListener('click', () => {
							deleteRow(rowIndex);
						});

						const buttonCell = document.createElement('td');
						buttonCell.appendChild(deleteButton);
						tr.appendChild(buttonCell);
					}
					table.appendChild(tr);
				});
				tableContainer.appendChild(table);
			} else {
				const message = document.createElement('p');
				message.textContent = 'No data available';
				tableContainer.appendChild(message);
			}
		}



		let response = await sendAPIRequest();
		var format_response = JSON.stringify(response, null, 4);
		console.log("Response:");
		console.log(format_response);
		let data_array = JSON.parse(format_response);
		data = generateDataNew2(data_array);
		createTable(data);
	} catch (error) {
		console.error("Error:", error);
	}
})();


async function processDataAndSendSync() {
	Swal.fire({
		icon: 'info',
		title: 'กำลังบันทึกข้อมูล...กรุณารอสักครู่',
		showConfirmButton: false,
		timer: 5000
	})
	try {
		await sendAPIRequest();
		console.log(data);
		let keys = data[0];
		let outputData = [];
		var url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi';

		for (let i = 1; i < data.length; i++) {
			let item = {};

			for (let j = 0; j < data[i].length; j++) {
				if (keys[j] === 'id') {
					item[keys[j]] = parseInt(data[i][j]);
				} else if (keys[j] === 'keyword') {
					item[keys[j]] = data[i][j].split(', ');
				} else {
					item[keys[j]] = data[i][j];
				}
			}

			outputData.push(item);
		}

		for (let item of outputData) {
			var xhr = new XMLHttpRequest();
			xhr.open("PUT", url, false); // "false" makes the request synchronous
			xhr.setRequestHeader('Content-Type', 'application/json');
			xhr.send(JSON.stringify(item));

			if (xhr.status === 200) {
				console.log(JSON.parse(xhr.responseText));
				Swal.fire('บันทึกข้อมูลสำเร็จ', '', 'success');
			} else {
				// console.error('Error:', xhr.statusText);
				Swal.fire('บันทึกข้อมูลไม่สำเร็จ', '', 'error');
			}
		}

		// console.log(myVariable);
	} catch (error) {
		console.error(error);
	}
}