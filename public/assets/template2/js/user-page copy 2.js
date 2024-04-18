function validateData() {
	// var department = document.getElementById('department').value;
	var department = "Default"
	var password = document.getElementById('password').value;
	// var token = document.getElementById('token').value;
	var token = "8989"
	var email = document.getElementById('email').value;
	var username = document.getElementById('username').value;
	var id = document.getElementById('id').value;
	var role = document.getElementById('role').value;
	var status = document.getElementById('status').value;
	// var keyword = document.getElementById('keyword').value;
	var keyword = ["Default"];

	if (
		department === '' ||
		password === '' ||
		token === '' ||
		email === '' ||
		username === '' ||
		id === '' ||
		role === '' ||
		status === '' ||
		keyword === ''
	) {
		alert('พบข้อผิดพลาด! กรุณากรอกข้อมูลให้ครบถ้วน');
		return false;
	}
	var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	if (!email.match(emailPattern)) {
		alert('พบข้อผิดพลาด! รูปเเบบข้อมูล Email ไม่ถูกต้อง');
		return false;
	}
	if (isNaN(id)) {
		alert('พบข้อผิดพลาด! รูปเเบบข้อมูล ID ต้องเป็นตัวเลขเท่านั้น');
		return false;
	}
	if (role !== 'Admin' && role !== 'Staff' && role !== 'User') {
		alert('พบข้อผิดพลาด! รูปเเบบข้อมูล Role ต้องเป็น Admin, Staff, หรือ User เท่านั้น');
		return false;
	}
	if (status !== 'Active' && status !== 'Inactive') {
		alert('พบข้อผิดพลาด! รูปเเบบข้อมูล Status ต้องเป็น Active หรือ Inactive เท่านั้น');
		return false;
	} return true;
}

async function checkData(keyword, inputValue) {
	let data = {};
	if (keyword == "username") {
		data = { "username": inputValue };
	} else {
		data = { "user_email": inputValue };
	}
	try {
		const response = await fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(data)
		});
		const res = await response.json();
		if (res.Count == 0) {
			return false;
		} else {
			return true;
		}
	} catch (error) {
		throw error;
	}
}

async function editData(data) {
	// console.log(data.user_department)
	Swal.fire({
		title: 'แก้ไขข้อมูล',
		html: `
		<div class="row clearfix">
			<div class="form-group col-lg-4 col-md-6 col-sm-12">
				<label for="l_role">บทบาท:</label>
			</div>
			<div class="form-group col-lg-8 col-md-6 col-sm-12">
				<input type="text" id="role_of_user" class="form-control" value="${data.user_role}" readonly>
			</div>
		
			<div class="form-group col-lg-4 col-md-6 col-sm-12">
				<label for="l_id">ID:</label>
			</div>
			<div class="form-group col-lg-8 col-md-6 col-sm-12">
				<input type="text" id="user_id" value="${data.id}" class="form-control">
			</div>

			<div class="form-group col-lg-4 col-md-6 col-sm-12">
				<label for="l_username">Username:</label>
			</div>
			<div class="form-group col-lg-8 col-md-6 col-sm-12">
				<input type="text" id="user_username" value="${data.username}" class="form-control">
			</div>

			<div class="form-group col-lg-4 col-md-6 col-sm-12">
				<label for="l_password">Password:</label>
			</div>
			<div class="form-group col-lg-8 col-md-6 col-sm-12">
				<input type="text" id="user_password" value="${data.user_password}" class="form-control">
			</div>

			<div class="form-group col-lg-4 col-md-6 col-sm-12">
				<label for="l_email">Email:</label>
			</div>
			<div class="form-group col-lg-8 col-md-6 col-sm-12">
				<input type="text" id="user_email" value="${data.user_email}" class="form-control">
			</div>

			<div class="form-group col-lg-4 col-md-6 col-sm-12">
				<label for="department" id="label_department">แผนก:</label>
			</div>
			<div class="form-group col-lg-8 col-md-6 col-sm-12">
				<select id="department_dsi" class="form-control">
				</select>
			</div>

			<div class="form-group col-lg-4 col-md-6 col-sm-12">
				<label for="l_status">สถานะ:</label>
			</div>
			<div class="form-group col-lg-8 col-md-6 col-sm-12">
				<input type="text" id="user_status" class="form-control" value="Active" readonly>
			</div>

		</div>	
		`,
		showCancelButton: true,
		confirmButtonText: 'บันทึกข้อมูล',
		cancelButtonText: 'ยกเลิก',
		customClass: {
			confirmButton: 'custom-confirm-button-class'
		},
		preConfirm: async () => {
			// Get input field values
			const roleValue = document.getElementById('role_of_user').value;
			const useridValue = document.getElementById('user_id').value;
			const userNameValue = document.getElementById('user_username').value;
			const userPasswordValue = document.getElementById('user_password').value;
			const userEmailValue = document.getElementById('user_email').value;
			const userDepartmentValue = document.getElementById('department_dsi').value;
			const userStatusValue = document.getElementById('user_status').value;

			// Add more input fields as needed...

			// Perform validation
			if (!roleValue || !useridValue || !userNameValue || !userPasswordValue || !userEmailValue || !userDepartmentValue) {
				Swal.showValidationMessage('กรุณากรอกข้อมูลให้ครบถ้วน');
			} else {
				console.log(useridValue)
				fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi', {
					method: 'POST', headers: {
						'Content-Type': 'application/json'
					},
					body: JSON.stringify({ id: useridValue })
				})
					.then(response => response.json())
					.then(data => {
						console.log(data)
						// Swal.showValidationMessage('ไม่สามารถใช้ ID นี้ซ้ำได้');
						return;
					})
					.catch(error => {
					});

				const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;
				var result = passwordPattern.test(userPasswordValue);
				if (result == false) {
					Swal.showValidationMessage('กรุณาตั้งรหัสผ่านใหม่');
				}
			}

			// Return an object with the validated values if everything is okay
			return {
				role: roleValue,
				id: useridValue,
				username: userNameValue,
				password: userPasswordValue,
				email: userEmailValue,
				department: userDepartmentValue,
				status: userStatusValue
			};
		}
	}).then(result => {
		// if (result.isConfirmed) {
		// 	var payload = { id: data.id };
		// 	const url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi/';
		// 	fetch(url, {
		// 		method: 'DELETE',
		// 		headers: { 'Content-Type': 'application/json' },
		// 		body: JSON.stringify(payload)
		// 	}).then(response => response.json())
		// 		.then(() => {
		// 			// console.log('Deleted ID:', id, 'Response:', data);
		// 			// Handle data submission here using the validated values
		// 			const validatedData = result.value;
		// 			let dataToSend = {
		// 				"keyword": [],
		// 				"id": parseInt(validatedData.id),
		// 				"username": validatedData.username,
		// 				"user_department": validatedData.role == 'user' ? 'user' : validatedData.department,
		// 				"user_email": validatedData.email,
		// 				"user_password": validatedData.password,
		// 				"user_role": validatedData.role,
		// 				"user_status": validatedData.status,
		// 				"user_token": "SomeOptionalToken"
		// 			};
		// 			// console.log(dataToSend)
		// 			// return;

		// 			fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi', {
		// 				method: 'PUT', headers: {
		// 					'Content-Type': 'application/json'
		// 				},
		// 				body: JSON.stringify(dataToSend)
		// 			})
		// 				.then(response => response.json())
		// 				.then(data => {
		// 					// location.reload();
		// 					if (data.ResponseMetadata.HTTPStatusCode == 200) {
		// 						Swal.fire({
		// 							title: 'บันทึกข้อมูลสำเร็จ',
		// 							icon: 'success',
		// 							timer: 2000,
		// 							showConfirmButton: false
		// 						}).then(function () {
		// 							location.reload();
		// 						});
		// 					} else {
		// 						Swal.fire('บันทึกข้อมูลไม่สำเร็จ', '', 'error');
		// 					}
		// 				})
		// 				.catch(error => {
		// 					console.log(error)
		// 					Swal.fire('บันทึกข้อมูลไม่สำเร็จ', '', 'error');
		// 				});
		// 		})
		// 		.catch(error => {
		// 			// console.error('Error deleting ID:', id, error); 
		// 			Swal.fire('บันทึกข้อมูลไม่สำเร็จ', '', 'error');
		// 		});
		// }
	});

	// Department options array
	const departmentOptions = [
		'สำนักงานเลขานุการกรม',
		'กองกฎหมาย',
		'กองกิจการต่างประเทศและคดีอาชญากรรมระหว่างประเทศ',
		'กองคดีทรัพยากรธรรมชาติและสิ่งแวดล้อม',
		'กองคดีการเงินการธนาคารและการฟอกเงิน',
		'กองคดีความผิดเกี่ยวกับการเสนอราคาต่อหน่วยงานของรัฐ',
		'กองคดีความมั่นคง',
		'กองคดีคุ้มครองผู้บริโภค',
		'กองคดีเทคโนโลยีและสารสนเทศ',
		'กองคดีทรัพย์สินทางปัญญา',
		'กองคดีการค้ามนุษย์',
		'กองคดีธุรกิจการเงินนอกระบบ',
		'กองคดีภาษีอากร',
		'กองเทคโนโลยีและศูนย์ข้อมูลการตรวจสอบ',
		'กองนโยบายและยุทธศาสตร์',
		'กองบริหารคดีพิเศษ',
		'กองปฏิบัติการคดีพิเศษภาค',
		'กองปฏิบัติการพิเศษ',
		'กองพัฒนาและสนับสนุนคดีพิเศษ'
	];

	// Get the department select element
	const departmentSelect = document.getElementById('department_dsi');
	const departmentLable = document.getElementById('label_department');
	if (data.user_role === 'user') {
		departmentSelect.style.display = 'none';
		departmentLable.style.display = 'none';
	}

	// Loop through the departmentOptions array and create options
	departmentOptions.forEach(department => {
		const optionElement = document.createElement('option');
		optionElement.value = department.toLowerCase().replace(/\s+/g, '');
		optionElement.textContent = department;
		departmentSelect.appendChild(optionElement);

		// Pre-select the option if it matches data.user_department
		if (data.user_department === department) {
			optionElement.selected = true;
		}
	})
}


function init() {
	const url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi';
	const payload = {};
	const headers = { 'Content-Type': 'application/json' };
	fetch(url, {
		method: 'POST',
		headers: headers,
		body: JSON.stringify(payload)
	})
		.then(response => response.json())
		.then(data => {
			// console.log("Status Code:", data.status_code);
			// console.log("Response:");
			// console.log(data);
			const responseInit = data;
			const outputArray = [];

			// for (const item of data.Items) {
			//     const itemArray = [
			//         item.user_department,
			//         item.user_password,
			//         item.user_token,
			//         item.user_email,
			//         item.username,
			//         item.id,
			//         item.user_role,
			//         item.user_status,
			//         item.keyword
			//     ]; outputArray.push(itemArray);
			// }

			for (const item of data.Items) {
				const userStatus = item.user_status === "Non" ? "Inactive" : item.user_status;
				const passwordCell = `
					<div class='password-container'>
						<input type='password' value='${item.user_password}' readonly>
						<span toggle='#password' class='fa fa-fw fa-eye toggle-password'></span>
					</div>`
				const editBtn = `<button class='btn btn-warning' onclick='editData(${JSON.stringify(item)})'>แก้ไข</button>`;
				const itemArray = [
					item.id,
					item.username,
					passwordCell,
					item.user_department,
					item.user_email,
					item.user_role.charAt(0).toUpperCase() + item.user_role.slice(1),
					userStatus,
					editBtn
				];
				outputArray.push(itemArray);
			}
			// console.log(outputArray);
			example_data = outputArray;
			var table = new DataTable('#example', {
				columnDefs: [{ orderable: false, className: 'select-checkbox', targets: 0 }],
				select: { style: 'multi', selector: 'td:first-child' }, order: [[1, 'asc']]
			});

			for (var i = 0; i < example_data.length; i++) {
				var rowData = ['', ...example_data[i]];
				table.row.add(rowData);
			}
			//for (var i = 0; i < example_data.length; i++) {
			// Construct the row data
			//    var rowData = ['', ...example_data[i]];

			// Replace the password field with the toggle structure
			//    rowData[2] = getPasswordCell(rowData[2]);  // Assuming password is in the 2nd column

			//    table.row.add(rowData);
			//}

			table.draw();

			var id_deleted = [];
			var edit_data = [];
			var response1 = null;

			document.getElementById('deleteButton').addEventListener('click', function () {
				var selectedRows = table.rows({ selected: true }).data();
				selectedRows.each(function (data) {
					var id = data[1];
					id_deleted.push(id);
					// console.log('Deleted ID:', id);
				});
				table.rows({ selected: true }).remove().draw(false);
				// console.log('All Deleted IDs:', id_deleted);

				// An array to store all the fetch promises
				var deletePromises = [];

				id_deleted.forEach(function (id) {
					var payload = { id: id };
					const url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi/';
					var deletePromise = fetch(url, {
						method: 'DELETE',
						headers: { 'Content-Type': 'application/json' },
						body: JSON.stringify(payload)
					}).then(response => response.json())
						.then(data => { console.log('Deleted ID:', id, 'Response:', data); })
						.catch(error => { console.error('Error deleting ID:', id, error); });
					deletePromises.push(deletePromise);
				});

				// Wait for all delete promises to resolve
				Promise.all(deletePromises)
					.then(() => { location.reload(); })
					.catch(err => { console.error('Error deleting items:', err); });
				id_deleted = [];
			});

			document.getElementById('addButton').addEventListener('click', function () {
				Swal.fire({
					title: 'กรุณากรอกข้อมูล',
					html: `
					<div class="row clearfix">
						<div class="form-group col-lg-4 col-md-6 col-sm-12">
							<label for="l_role">บทบาท:</label>
						</div>
						<div class="form-group col-lg-8 col-md-6 col-sm-12">
							<select id="role_of_user" class="form-control">
								<option value="admin">admin</option>
								<option value="staff">staff</option>
								<option value="user">user</option>
							</select>
						</div>
					
						<div class="form-group col-lg-4 col-md-6 col-sm-12">
							<label for="l_id">ID:</label>
						</div>
						<div class="form-group col-lg-8 col-md-6 col-sm-12">
							<input type="text" id="user_id" class="form-control">
						</div>

						<div class="form-group col-lg-4 col-md-6 col-sm-12">
							<label for="l_username">Username:</label>
						</div>
						<div class="form-group col-lg-8 col-md-6 col-sm-12">
							<input type="text" id="user_username" class="form-control">
						</div>

						<div class="form-group col-lg-4 col-md-6 col-sm-12">
							<label for="l_password">Password:</label>
						</div>
						<div class="form-group col-lg-8 col-md-6 col-sm-12">
							<input type="text" id="user_password" class="form-control">
						</div>

						<div class="form-group col-lg-4 col-md-6 col-sm-12">
							<label for="l_email">Email:</label>
						</div>
						<div class="form-group col-lg-8 col-md-6 col-sm-12">
							<input type="text" id="user_email" class="form-control">
						</div>

						<div class="form-group col-lg-4 col-md-6 col-sm-12">
							<label for="department" id="label_department">แผนก:</label>
						</div>
						<div class="form-group col-lg-8 col-md-6 col-sm-12">
							<select id="department_dsi" class="form-control">
							</select>
						</div>

						<div class="form-group col-lg-4 col-md-6 col-sm-12">
							<label for="l_status">สถานะ:</label>
						</div>
						<div class="form-group col-lg-8 col-md-6 col-sm-12">
							<input type="text" id="user_status" class="form-control" value="Active" readonly>
						</div>

					</div>	
					`,
					showCancelButton: true,
					confirmButtonText: 'บันทึกข้อมูล',
					cancelButtonText: 'ยกเลิก',
					customClass: {
						confirmButton: 'custom-confirm-button-class'
					},
					preConfirm: async () => {
						// Get input field values
						const roleValue = document.getElementById('role_of_user').value;
						const useridValue = document.getElementById('user_id').value;
						const userNameValue = document.getElementById('user_username').value;
						const userPasswordValue = document.getElementById('user_password').value;
						const userEmailValue = document.getElementById('user_email').value;
						const userDepartmentValue = document.getElementById('department_dsi').value;
						const userStatusValue = document.getElementById('user_status').value;

						// Add more input fields as needed...

						// Perform validation
						if (!roleValue || !useridValue || !userNameValue || !userPasswordValue || !userEmailValue || !userDepartmentValue) {
							Swal.showValidationMessage('กรุณากรอกข้อมูลให้ครบถ้วน');
						} else {
							const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;
							var result = passwordPattern.test(userPasswordValue);
							if (result == false) {
								Swal.showValidationMessage('กรุณาตั้งรหัสผ่านใหม่');
							} else {
								try {
									var res = await checkData("username", userNameValue);
									if (res == true) {
										Swal.showValidationMessage('ไม่สามารถใช้ username นี้ซ้ำได้');
									}
								} catch (error) {
									throw error;
								}

								try {
									var res = await checkData("email", userEmailValue);
									if (res == true) {
										Swal.showValidationMessage('ไม่สามารถใช้ email นี้ซ้ำได้');
									} else {
										var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
										if (!userEmailValue.match(emailPattern)) {
											Swal.showValidationMessage('กรุณากรอก Email ในรูปแบบให้ถูกต้อง');
										}
									}
								} catch (error) {
									throw error;
								}
							}

						}

						// Return an object with the validated values if everything is okay
						return {
							role: roleValue,
							id: useridValue,
							username: userNameValue,
							password: userPasswordValue,
							email: userEmailValue,
							department: userDepartmentValue,
							status: userStatusValue
						};
					}
				}).then(result => {
					if (result.isConfirmed) {
						// Handle data submission here using the validated values
						const validatedData = result.value;
						console.log(validatedData);
						let dataToSend = {
							"keyword": [],
							"id": parseInt(validatedData.id),
							"username": validatedData.username,
							"user_department": validatedData.department,
							"user_email": validatedData.email,
							"user_password": validatedData.password,
							"user_role": validatedData.role,
							"user_status": validatedData.status,
							"user_token": "SomeOptionalToken"
						};
						// console.log(dataToSend)

						fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi', {
							method: 'PUT', headers: {
								'Content-Type': 'application/json'
							},
							body: JSON.stringify(dataToSend)
						})
							.then(response => response.json())
							.then(data => { 
								if (data.ResponseMetadata.HTTPStatusCode == 200) {
									Swal.fire({
										title: 'บันทึกข้อมูลสำเร็จ',
										icon: 'success',
										timer: 2000,
										showConfirmButton: false
									}).then(function () {
										location.reload();
									});
								} else {
									Swal.fire('บันทึกข้อมูลไม่สำเร็จ', '', 'error');
								}
							})
							.catch(error => {
								console.log(error)
								Swal.fire('บันทึกข้อมูลไม่สำเร็จ', '', 'error');
							});
					}
				});

				// Department options array
				const departmentOptions = [
					'สำนักงานเลขานุการกรม',
					'กองกฎหมาย',
					'กองกิจการต่างประเทศและคดีอาชญากรรมระหว่างประเทศ',
					'กองคดีทรัพยากรธรรมชาติและสิ่งแวดล้อม',
					'กองคดีการเงินการธนาคารและการฟอกเงิน',
					'กองคดีความผิดเกี่ยวกับการเสนอราคาต่อหน่วยงานของรัฐ',
					'กองคดีความมั่นคง',
					'กองคดีคุ้มครองผู้บริโภค',
					'กองคดีเทคโนโลยีและสารสนเทศ',
					'กองคดีทรัพย์สินทางปัญญา',
					'กองคดีการค้ามนุษย์',
					'กองคดีธุรกิจการเงินนอกระบบ',
					'กองคดีภาษีอากร',
					'กองเทคโนโลยีและศูนย์ข้อมูลการตรวจสอบ',
					'กองนโยบายและยุทธศาสตร์',
					'กองบริหารคดีพิเศษ',
					'กองปฏิบัติการคดีพิเศษภาค',
					'กองปฏิบัติการพิเศษ',
					'กองพัฒนาและสนับสนุนคดีพิเศษ'
				];

				// Get the department select element
				const departmentSelect = document.getElementById('department_dsi');
				const departmentLable = document.getElementById('label_department');

				// Loop through the departmentOptions array and create options
				departmentOptions.forEach(department => {
					const optionElement = document.createElement('option');
					optionElement.value = department.toLowerCase().replace(/\s+/g, '');
					optionElement.textContent = department;
					departmentSelect.appendChild(optionElement);
				})
				// Get the role dropdown element
				const roleDropdown = document.getElementById('role_of_user');

				// Add event listener to role dropdown
				roleDropdown.addEventListener('change', function () {
					const selectedRole = roleDropdown.value;
					const idInput = document.getElementById('user_id');

					// If selected role is 'user', fetch data from API and fill ID field
					if (selectedRole === 'user') {
						// Simulate API call (replace with actual API call)
						fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi', {
							method: 'POST', headers: {
								'Content-Type': 'application/json'
							},
							body: JSON.stringify({
								"max_id": 1
							})
						})
							.then(response => response.json())
							.then(data => {
								console.log(data.max_id)
								// Fill the ID input with the fetched data
								let user_id = data.max_id + 1;
								idInput.value = user_id;
								idInput.readOnly = true;

								departmentSelect.style.display = 'none';
								departmentLable.style.display = 'none';
							})
							.catch(error => {
								console.error('Error fetching data from API:', error);
							});
					} else {
						// If role is not 'user', reset ID input field
						idInput.value = '';
						idInput.readOnly = false;
						departmentSelect.style.display = 'block';
					}
				});
			});

			// document.getElementById('acceptButton').addEventListener('click', function () {
			// 	if (!validateData()) { return; }
			// 	// var department = document.getElementById('department').value;
			// 	var department = "Default"
			// 	var password = document.getElementById('password').value;
			// 	// var token = document.getElementById('token').value;
			// 	var token = "8989"
			// 	var email = document.getElementById('email').value;
			// 	var username = document.getElementById('username').value;
			// 	var id = document.getElementById('id').value;
			// 	var role = document.getElementById('role').value;
			// 	var status = document.getElementById('status').value;
			// 	// var keyword = document.getElementById('keyword').value;
			// 	var keyword = ["Default"];

			// 	var add_data = [department, password, token, email, username, id, role, status, keyword];
			// 	console.log('Added Data:', add_data);
			// 	// table.row.add(['', ...add_data]).draw();
			// 	const mapping = {
			// 		"user_department": [0],
			// 		"user_password": [1],
			// 		"user_token": [2],
			// 		"user_email": [3],
			// 		"username": [4],
			// 		"id": [5],
			// 		"user_role": [6],
			// 		"user_status": [7],
			// 		"keyword": [8],
			// 	};
			// 	// test = ['department2', 'password5', 'token5', 'email5@example.com', 'User 5', 'id5', 'role2', 'inactive', 'keyword5']
			// 	const outputObject = {};
			// 	add_data.forEach((value, index) => {
			// 		for (const key in mapping) {
			// 			if (mapping[key][0] === index) {
			// 				if (key === "id") {
			// 					outputObject[key] = parseInt(value.match(/\d+/)[0]);
			// 				} else if (key === "user_status") {
			// 					if (value === "Active") { outputObject[key] = "Active"; }
			// 					else if (value === "Inactive") { outputObject[key] = "Non"; }
			// 					else { outputObject[key] = value; }
			// 				} else if (key === "user_role") {
			// 					if (value === "Admin") { outputObject[key] = "admin"; }
			// 					else if (value === "Staff") { outputObject[key] = "staff"; }
			// 					else if (value === "User") { outputObject[key] = "user"; }
			// 					else { outputObject[key] = value; }
			// 				}
			// 				else { outputObject[key] = value; } break;
			// 			}
			// 		}
			// 	});
			// 	console.log(outputObject);
			// 	const url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi';
			// 	const headers = { 'Content-Type': 'application/json' };
			// 	fetch(url, { method: 'PUT', headers: headers, body: JSON.stringify(outputObject) })
			// 		.then(response => {
			// 			console.log("Status Code:", response.status);
			// 			return response.json();
			// 		})
			// 		.then(data => {
			// 			console.log("Response:", data);
			// 			response1 = data;
			// 			console.log(response1.error);
			// 			if (response1.error !== undefined) { alert(response1.error); }
			// 			else { location.reload(); }
			// 		})
			// 		.catch(error => { console.error("Error:", error); });

			// 	document.getElementById('addPopup').style.display = 'none';
			// 	document.getElementById('popupBackdrop').style.display = 'none';
			// });

			document.getElementById('closePopup').addEventListener('click', function () {
				document.getElementById('addPopup').style.display = 'none';
				document.getElementById('popupBackdrop').style.display = 'none';
			});

			document.getElementById('popupBackdrop').addEventListener('click', function () {
				document.getElementById('addPopup').style.display = 'none';
				document.getElementById('popupBackdrop').style.display = 'none';
			});

			var matchedItem = null;

			table.on('dblclick', 'td', function () {
				var colIdx = table.cell(this).index().column;
				var rowIdx = table.cell(this).index().row;
				if (colIdx !== 1) {
					if (colIdx === 3) {
						var IdData = table.cell(rowIdx, 1).data();
						for (var i = 0; i < responseInit.Items.length; i++) {
							if (responseInit.Items[i].id === IdData) {
								matchedItem = responseInit.Items[i];
								break;
							}
						}
						if (matchedItem !== undefined) {
							var originalData = matchedItem.user_password;
						} else { console.log("No matching item found."); }
					} else { var originalData = table.cell(rowIdx, colIdx).data(); }
					var newData = prompt('แก้ไขข้อมูล:', originalData);
					if (newData !== null) {
						if ((colIdx === 2 || colIdx === 3) && newData.trim() === '') {
							alert('พบข้อผิดพลาด! ข้อมูลต้องไม่เป็นค่าว่าง');
							return;
						}
						else if (colIdx === 4) {
							if (newData.trim() === '') {
								alert('พบข้อผิดพลาด! รูปเเบบข้อมูล Email ไม่ถูกต้อง');
								return;
							}
							var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
							if (!newData.match(emailPattern)) {
								alert('พบข้อผิดพลาด! รูปเเบบข้อมูล Email ไม่ถูกต้อง');
								return;
							}
						} else if (colIdx === 5) {
							if (newData.trim() === '' || (newData !== 'Admin' && newData !== 'Staff' && newData !== 'User')) {
								alert('พบข้อผิดพลาด! รูปเเบบข้อมูล Role ต้องเป็น Admin, Staff, หรือ User เท่านั้น');
								return;
							}
						} else if (colIdx === 6) {
							if (newData.trim() === '' || (newData !== 'Active' && newData !== 'Inactive')) {
								alert('พบข้อผิดพลาด! รูปแบบข้อมูล Status ต้องเป็น Active หรือ Inactive เท่านั้น');
								return;
							}
						}

						table.cell(rowIdx, colIdx).data(newData).draw();

						var extractedValues = [];
						var rowData = table.row(rowIdx).data();
						for (var i = 0; i < rowData.length; i++) {
							extractedValues.push(rowData[i]);
						}
						const mapping = {
							"id": [1],
							"username": [2],
							"user_password": [3],
							"user_email": [4],
							"user_role": [5],
							"user_status": [6],
							"user_department": "Default",
							"user_token": "8989",
							"keyword": ["Default"],
						};
						// console.log(extractedValues)
						const outputObject = {};
						extractedValues.forEach((value, index) => {
							for (const key in mapping) {
								if (mapping[key][0] === index) {
									if (key === "user_status") {
										if (value === "Active") { outputObject[key] = "Active"; }
										else if (value === "Inactive") { outputObject[key] = "Non"; }
										else { outputObject[key] = value; }
									} else if (key === "user_role") {
										if (value === "Admin") { outputObject[key] = "admin"; }
										else if (value === "Staff") { outputObject[key] = "staff"; }
										else if (value === "User") { outputObject[key] = "user"; }
										else { outputObject[key] = value; }
									}
									else { outputObject[key] = value; } break;
								}
							}
						});
						outputObject.user_department = "Default";
						outputObject.user_token = "8989";
						outputObject.keyword = ["Default"];
						console.log(outputObject)
						const url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi';
						const headers = { 'Content-Type': 'application/json' };
						fetch(url, { method: 'PUT', headers: headers, body: JSON.stringify(outputObject) })
							.then(response => {
								console.log("Status Code:", response.status);
								return response.json();
							})
							.then(data => {
								console.log("Response:", data);
								response1 = data;
								console.log(response1.error);
								if (response1.error !== undefined) { alert(response1.error); }
								else { location.reload(); }
							})
							.catch(error => { console.error("Error:", error); });
					}
				}
			});
		})
		.catch(error => console.error('Error:', error));
}

init();

document.addEventListener('click', function (e) {
	if (e.target && e.target.classList.contains('toggle-password')) {
		const input = e.target.previousElementSibling;
		if (input.getAttribute('type') === 'password') {
			input.setAttribute('type', 'text');
			e.target.classList.remove('fa-eye');
			e.target.classList.add('fa-eye-slash');
		} else {
			input.setAttribute('type', 'password');
			e.target.classList.remove('fa-eye-slash');
			e.target.classList.add('fa-eye');
		}
	}
});

// function validateData() {
// 	var department = document.getElementById('department').value;
// 	var password = document.getElementById('password').value;
// 	var token = document.getElementById('token').value;
// 	var email = document.getElementById('email').value;
// 	var username = document.getElementById('username').value;
// 	var id = document.getElementById('id').value;
// 	var role = document.getElementById('role').value;
// 	var status = document.getElementById('status').value;
// 	var keyword = document.getElementById('keyword').value;

// 	if (
// 		department === '' ||
// 		password === '' ||
// 		token === '' ||
// 		email === '' ||
// 		username === '' ||
// 		id === '' ||
// 		role === '' ||
// 		status === '' ||
// 		keyword === ''
// 	) {
// 		alert('พบข้อผิดพลาด! กรุณากรอกข้อมูลให้ครบถ้วน');
// 		return false;
// 	}
// 	var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
// 	if (!email.match(emailPattern)) {
// 		alert('พบข้อผิดพลาด! รูปเเบบข้อมูล Email ไม่ถูกต้อง');
// 		return false;
// 	}
// 	if (isNaN(id)) {
// 		alert('พบข้อผิดพลาด! รูปเเบบข้อมูล ID ต้องเป็นตัวเลขเท่านั้น');
// 		return false;
// 	}
// 	if (role !== 'admin' && role !== 'staff' && role !== 'user') {
// 		alert('พบข้อผิดพลาด! รูปเเบบข้อมูล Role ต้องเป็น admin,  staff, หรือ user เท่านั้น');
// 		return false;
// 	}
// 	if (status !== 'active' && status !== 'none') {
// 		alert('พบข้อผิดพลาด! รูปเเบบข้อมูล status ต้องเป็น active หรือ none เท่านั้น');
// 		return false;
// 	} return true;
// }

// function init() {
// 	const url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi';
// 	const payload = {
// 	};
// 	const headers = { 'Content-Type': 'application/json' };
// 	fetch(url, {
// 		method: 'POST',
// 		headers: headers,
// 		body: JSON.stringify(payload)
// 	})
// 		.then(response => response.json())
// 		.then(data => {
// 			// console.log("Status Code:", data.status_code);
// 			// console.log("Response:");
// 			// console.log(data);
// 			const outputArray = [];
// 			for (const item of data.Items) {
// 				const itemArray = [
// 					item.user_department,
// 					item.user_password,
// 					item.user_token,
// 					item.user_email,
// 					item.username,
// 					item.id,
// 					item.user_role,
// 					item.user_status,
// 					item.keyword
// 				]; outputArray.push(itemArray);
// 			}
// 			// console.log(outputArray);
// 			example_data = outputArray;
// 			var table = new DataTable('#example', {
// 				columnDefs: [{ orderable: false, className: 'select-checkbox', targets: 0 }],
// 				select: { style: 'multi', selector: 'td:first-child' }, order: [[1, 'asc']]
// 			});

// 			for (var i = 0; i < example_data.length; i++) {
// 				var rowData = ['', ...example_data[i]];
// 				table.row.add(rowData);
// 			}

// 			table.draw();

// 			var id_deleted = [];
// 			var edit_data = [];
// 			var response1 = null;

// 			document.getElementById('deleteButton').addEventListener('click', function () {
// 				var selectedRows = table.rows({ selected: true }).data();
// 				selectedRows.each(function (data) {
// 					var id = data[6];
// 					id_deleted.push(id);
// 					console.log('Deleted ID:', id);
// 				});
// 				table.rows({ selected: true }).remove().draw(false);
// 				console.log('All Deleted IDs:', id_deleted);

// 				id_deleted.forEach(function (id) {
// 					var payload = { id: id };
// 					const url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi/';
// 					fetch(url, {
// 						method: 'DELETE',
// 						headers: { 'Content-Type': 'application/json' },
// 						body: JSON.stringify(payload)
// 					}).then(response => response.json())
// 						.then(data => {
// 							console.log('Deleted ID:', id, 'Response:', data);
// 						})
// 						.catch(error => { console.error('Error deleting ID:', id, error); });
// 				}); id_deleted = [];
// 			});

// 			document.getElementById('addButton').addEventListener('click', function () {
// 				document.getElementById('department').value = '';
// 				document.getElementById('password').value = '';
// 				document.getElementById('token').value = '';
// 				document.getElementById('email').value = '';
// 				document.getElementById('username').value = '';
// 				document.getElementById('id').value = '';
// 				document.getElementById('role').value = '';
// 				document.getElementById('status').value = '';
// 				document.getElementById('keyword').value = '';
// 				document.getElementById('addPopup').style.display = 'block';
// 				document.getElementById('popupBackdrop').style.display = 'block';
// 			});

// 			document.getElementById('acceptButton').addEventListener('click', function () {
// 				if (!validateData()) { return; }
// 				var department = document.getElementById('department').value;
// 				var password = document.getElementById('password').value;
// 				var token = document.getElementById('token').value;
// 				var email = document.getElementById('email').value;
// 				var username = document.getElementById('username').value;
// 				var id = document.getElementById('id').value;
// 				var role = document.getElementById('role').value;
// 				var status = document.getElementById('status').value;
// 				var keyword = document.getElementById('keyword').value;

// 				var add_data = [department, password, token, email, username, id, role, status, keyword];
// 				console.log('Added Data:', add_data);
// 				table.row.add(['', ...add_data]).draw();
// 				const mapping = {
// 					"user_department": [0],
// 					"user_password": [1],
// 					"user_token": [2],
// 					"user_email": [3],
// 					"username": [4],
// 					"id": [5],
// 					"user_role": [6],
// 					"user_status": [7],
// 					"keyword": [8],
// 				};
// 				// test = ['department2', 'password5', 'token5', 'email5@example.com', 'User 5', 'id5', 'role2', 'inactive', 'keyword5']
// 				const outputObject = {};
// 				add_data.forEach((value, index) => {
// 					for (const key in mapping) {
// 						if (mapping[key][0] === index) {
// 							if (key === "id") {
// 								outputObject[key] = parseInt(value.match(/\d+/)[0]);
// 							} else if (key === "user_status") {
// 								if (value === "active") { outputObject[key] = "Active"; }
// 								else if (value === "inactive") { outputObject[key] = "Non"; }
// 								else { outputObject[key] = value; }
// 							} else if (key === "user_role") {
// 								if (value === "role1") { outputObject[key] = "admin"; }
// 								else if (value === "role2") { outputObject[key] = "staff"; }
// 								else if (value === "role3") { outputObject[key] = "user"; }
// 								else { outputObject[key] = value; }
// 							}
// 							else { outputObject[key] = value; } break;
// 						}
// 					}
// 				});
// 				console.log(outputObject);
// 				const url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi';
// 				const headers = { 'Content-Type': 'application/json' };
// 				fetch(url, { method: 'PUT', headers: headers, body: JSON.stringify(outputObject) })
// 					.then(response => {
// 						console.log("Status Code:", response.status);
// 						return response.json();
// 					})
// 					.then(data => {
// 						console.log("Response:", data);
// 						response1 = data;
// 						console.log(response1.error);
// 						if (response1.error !== undefined) { alert(response1.error); }
// 					})
// 					.catch(error => { console.error("Error:", error); });

// 				document.getElementById('addPopup').style.display = 'none';
// 				document.getElementById('popupBackdrop').style.display = 'none';
// 			});

// 			document.getElementById('closePopup').addEventListener('click', function () {
// 				document.getElementById('addPopup').style.display = 'none';
// 				document.getElementById('popupBackdrop').style.display = 'none';
// 			});

// 			document.getElementById('popupBackdrop').addEventListener('click', function () {
// 				document.getElementById('addPopup').style.display = 'none';
// 				document.getElementById('popupBackdrop').style.display = 'none';
// 			});

// 			table.on('dblclick', 'td', function () {
// 				var colIdx = table.cell(this).index().column;
// 				var rowIdx = table.cell(this).index().row;

// 				if (colIdx !== 6) {
// 					var originalData = table.cell(rowIdx, colIdx).data();
// 					var newData = prompt('Edit data:', originalData);
// 					if (newData !== null) {
// 						if (colIdx === 4) {
// 							var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
// 							if (!newData.match(emailPattern)) {
// 								alert('พบข้อผิดพลาด! รูปเเบบข้อมูล Email ไม่ถูกต้อง');
// 								return;
// 							}
// 						} else if (colIdx === 7) {
// 							if (newData !== 'admin' && newData !== 'staff' && newData !== 'user') {
// 								alert('พบข้อผิดพลาด! รูปเเบบข้อมูล Role ต้องเป็น admin,  staff, หรือ user เท่านั้น');
// 								return;
// 							}
// 						} else if (colIdx === 8) {
// 							if (newData !== 'active' && newData !== 'none') {
// 								alert('พบข้อผิดพลาด! รูปเเบบข้อมูล status ต้องเป็น active หรือ none เท่านั้น');
// 								return;
// 							}
// 						}

// 						table.cell(rowIdx, colIdx).data(newData).draw();

// 						var extractedValues = [];
// 						var rowData = table.row(rowIdx).data();
// 						for (var i = 0; i < rowData.length; i++) {
// 							extractedValues.push(rowData[i]);
// 						}
// 						const mapping = {
// 							"user_department": [1],
// 							"user_password": [2],
// 							"user_token": [3],
// 							"user_email": [4],
// 							"username": [5],
// 							"id": [6],
// 							"user_role": [7],
// 							"user_status": [8],
// 							"keyword": [9],
// 						};
// 						console.log(extractedValues)
// 						const outputObject = {};
// 						extractedValues.forEach((value, index) => {
// 							for (const key in mapping) {
// 								if (mapping[key][0] === index) {
// 									if (key === "user_status") {
// 										if (value === "active") { outputObject[key] = "Active"; }
// 										else if (value === "inactive") { outputObject[key] = "Non"; }
// 										else { outputObject[key] = value; }
// 									} else if (key === "user_role") {
// 										if (value === "role1") { outputObject[key] = "admin"; }
// 										else if (value === "role2") { outputObject[key] = "staff"; }
// 										else if (value === "role3") { outputObject[key] = "user"; }
// 										else { outputObject[key] = value; }
// 									}
// 									else { outputObject[key] = value; } break;
// 								}
// 							}
// 						});
// 						console.log(outputObject)
// 						const url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi';
// 						const headers = { 'Content-Type': 'application/json' };
// 						fetch(url, { method: 'PUT', headers: headers, body: JSON.stringify(outputObject) })
// 							.then(response => {
// 								console.log("Status Code:", response.status);
// 								return response.json();
// 							})
// 							.then(data => {
// 								console.log("Response:", data);
// 								response1 = data;
// 								console.log(response1.error);
// 								if (response1.error !== undefined) { alert(response1.error); }
// 							})
// 							.catch(error => { console.error("Error:", error); });
// 					}
// 				}
// 			});
// 		})
// 		.catch(error => console.error('Error:', error));
// }

// init();