var inputCounter = 1;

function addInput() {
    if (inputCounter <= 10) {
        var formContainer = document.getElementById('formContainer');
        // name
        var div_name = document.createElement('div');
        div_name.className = 'form-group col-lg-8 col-md-8 col-sm-12';
        var label_name = document.createElement('label');
        label_name.innerHTML = 'คำ หรือคีย์เวิร์ด *';
        var input_name = document.createElement('input');
        input_name.type = 'text';
        input_name.name = 'keyword';
        input_name.setAttribute('required', 'required');
        div_name.appendChild(label_name);
        div_name.appendChild(input_name);

        // email
        // var div_email = document.createElement('div');
        // div_email.className = 'form-group col-lg-5 col-md-5 col-sm-12';
        // var label_email = document.createElement('label');
        // label_email.innerHTML = 'คำ หรือคีย์เวิร์ด *';
        // var input_email = document.createElement('input');
        // input_email.type = 'text';
        // input_email.name = 'keyword';
        // input_email.setAttribute('required', 'required');
        // div_email.appendChild(label_email);
        // div_email.appendChild(input_email);

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
        // formContainer.appendChild(div_email);
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
        // formContainer.removeChild(formContainer.lastChild);
        inputCounter--;
    }
}

