var inputCounter = 1;

function addInput() {
    if (inputCounter <= 10) {
        var formContainer = document.getElementById('formContainer');
        // name
        var div_name = document.createElement('div');
        div_name.className = 'form-group col-lg-5 col-md-6 col-sm-12';
        var label_name = document.createElement('label');
        label_name.innerHTML = 'ชื่อกลุ่ม *';
        var input_name = document.createElement('input');
        input_name.type = 'text';
        input_name.name = 'groupName';
        input_name.setAttribute('required', 'required');
        div_name.appendChild(label_name);
        div_name.appendChild(input_name);

        // id
        var div_id = document.createElement('div');
        div_id.className = 'form-group col-lg-5 col-md-6 col-sm-12';
        var label_id = document.createElement('label');
        label_id.innerHTML = 'หมายเลขประจำกลุ่ม *';
        var input_id = document.createElement('input');
        input_id.type = 'text';
        input_id.name = 'groupID';
        input_id.setAttribute('required', 'required');
        div_id.appendChild(label_id);
        div_id.appendChild(input_id);

        var btn_container = document.createElement('div');
        btn_container.className = 'button-container';

        var btn_group1 = document.createElement('div');
        btn_group1.className = 'button-group';
        var newAddButton = document.createElement('button');
        newAddButton.type = 'button';
        newAddButton.className = 'btn btn-warning';
        newAddButton.innerHTML = '<i class="fa fa-plus"></i> เพิ่ม';
        newAddButton.onclick = addInput;
        btn_group1.appendChild(newAddButton);

        var btn_group2 = document.createElement('div');
        btn_group2.className = 'button-group';
        var newRemoveButton = document.createElement('button');
        newRemoveButton.type = 'button';
        newRemoveButton.className = 'btn btn-danger';
        newRemoveButton.innerHTML = '<i class="fa fa-trash"></i> ลบ';
        newRemoveButton.onclick = removeInput;
        btn_group2.appendChild(newRemoveButton);

        btn_container.appendChild(btn_group1);
        btn_container.appendChild(btn_group2);

        formContainer.appendChild(div_name);
        formContainer.appendChild(div_id);
        formContainer.appendChild(btn_container);

        inputCounter++;
    }
    else {
        Swal.fire('ไม่สามารถสร้างอีกได้', 'คุณสามารถเพิ่มข้อมูลได้ครั้งละ 10 ข้อมูล', 'error');
    }
}

function removeInput() {
    if (inputCounter > 1) {
        var formContainer = document.getElementById('formContainer');
        formContainer.removeChild(formContainer.lastChild);
        formContainer.removeChild(formContainer.lastChild);
        formContainer.removeChild(formContainer.lastChild);
        inputCounter--;
    }
}

