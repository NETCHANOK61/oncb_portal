@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.all.menu') }}">เมนูทั้งหมด
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    เพิ่มเมนูรองหรือเมนูย่อย
                </li>
            </ol>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="card">
                <div class="card-body p-6">
                    <div class="panel panel-primary">
                        <div class="tab_wrapper first_tab">
                            <ul class="tab_list">
                                <li class="active">ข้อมูลทั่วไป</li>
                            </ul>

                            <div class="content_wrapper">
                                <div class="tab_content">
                                    <form id="roleForm" action="{{ route('admin.store.child', $data->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label for="menuNameInput">ชื่อเมนูหลัก</label>
                                                        <input type="text"
                                                            class="form-control @error('th_name') is-invalid @enderror"
                                                            id="th_name" name="th_name" value="{{ $data->th_name }}" />
                                                    </div>
                                                    @error('th_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label for="menuIconTnput">ไอคอนของเมนู</label>
                                                        <select class="select2-icon" id="menu_icon" name="menu_icon">
                                                            @foreach ($icon as $value => $label)
                                                                <option value="{{ $value }}"
                                                                    data-icon="{{ $value }}"
                                                                    {{ $data->icon == $value ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('menu_icon')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-2 d-flex align-items-end">
                                                    <div class="form-group" id="add_secondary">
                                                        <button type="button" class="btn btn-primary"
                                                            id="add-secondary-menu">เพิ่มเมนูรอง</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="dynamic-secondary-menu">
                                                <!-- Secondary menu and sub-menu fields will be added here -->
                                            </div>
                                        </div>

                                        <div class="card-footer" align="right">
                                            <button type="submit" class="btn btn-success-light mt-1">บันทึก</button>
                                            <a href="{{ route('admin.all.menu') }}"
                                                class="btn btn-danger-light mt-1">ยกเลิก</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Function to set selected main menu icon to menu icon dropdown
            function setMainMenuIconToMenuIcon(icon) {
                const menuIconSelect = document.getElementById('menu_icon');
                if (icon) {
                    menuIconSelect.value = icon;
                    $(menuIconSelect).trigger('change');
                    menuIconSelect.disabled = true;
                } else {
                    menuIconSelect.selectedIndex = 0; // Reset to the default option
                    $(menuIconSelect).trigger('change'); // Trigger change event if necessary
                    menuIconSelect.disabled = false;
                }
            }

            $('#menu_name').on('change', function() {
                const selectedOption = $(this).find('option:selected');
                const icon = selectedOption.data('icon');
                setMainMenuIconToMenuIcon(icon);
            });

            // Function to add new secondary menu with sub-menus
            document.getElementById('add-secondary-menu').addEventListener('click', function() {
                var secondaryMenuContainer = document.getElementById('dynamic-secondary-menu');
                var index = secondaryMenuContainer.children.length;

                var newSecondaryMenuGroup = document.createElement('div');
                newSecondaryMenuGroup.className = 'secondary-menu-group';
                newSecondaryMenuGroup.setAttribute('data-index', index);
                newSecondaryMenuGroup.innerHTML = `
                    <div class="">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="secondaryMenuNameInput">เมนูรอง</label>
                                    <select class="secondary_menu_${index} form-control secondary-menu" data-index="${index}"
                                            name="secondary_menu[${index}][name]">
                                        <option value="">-เลือกเมนูรอง-</option>
                                        @foreach ($childMenus as $menu)
                                            @foreach ($menu->children as $child)
                                                <option value="{{ $child->th_name }}" data-url="{{ $child->route }}">{{ $child->th_name }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('secondary_menu[${index}][name]')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="urlSecondaryInput">route/URL ของเมนูรอง</label>
                                    <input id="urlText_${index}" type="text"
                                            class="form-control @error('secondary_menu[${index}][url]') is-invalid @enderror"
                                            name="secondary_menu[${index}][url]" placeholder="route/URL ของเมนู" />
                                    @error('secondary_menu[${index}][url]')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2 d-flex align-items-end">
                                <div class="form-group" id="add_sub_${index}" style="display: none">
                                    <button type="button" class="btn btn-secondary add-sub-menu"
                                            data-index="${index}">เพิ่มเมนูย่อย</button>
                                </div>
                            </div>
                        </div>
                        <div class="sub-menu-group" data-index="${index}">
                            <!-- Sub-menu fields will be added here -->
                        </div>
                    </div>
                `;

                secondaryMenuContainer.appendChild(newSecondaryMenuGroup);

                // Initialize Select2 for the newly added secondary menu dropdown
                $(`.secondary_menu_${index}`).select2({
                    tags: true,
                    width: "100%",
                });

                // Event listener for secondary menu select change
                $(document).on('change', `.secondary_menu_${index}`, function() {
                    const selectedOption = $(this).find('option:selected');
                    const url = selectedOption.data('url');
                    const urlInput = $(this).closest('.row').find(`#urlText_${index}`);

                    if (url) {
                        urlInput.val(url);
                        urlInput.prop('readonly', true);
                    } else {
                        urlInput.val('');
                        urlInput.prop('readonly', false);
                    }

                    const div_btn = $(`#add_sub_${index}`);
                    if (selectedOption.val() !== '') {
                        div_btn.show();
                    } else {
                        div_btn.hide();
                    }

                    // Disable this selected option in other secondary menu dropdowns
                    const selectedValue = selectedOption.val();
                    $('.secondary-menu').not(this).find(`option[value="${selectedValue}"]`).prop(
                        'disabled', true);
                });
            });

            // Event delegation to handle sub-menu addition
            document.getElementById('dynamic-secondary-menu').addEventListener('click', function(e) {
                if (e.target.classList.contains('add-sub-menu')) {
                    var index = e.target.dataset.index;
                    var subMenuGroup = document.querySelector(`.sub-menu-group[data-index="${index}"]`);
                    var subIndex = subMenuGroup.children.length;

                    var newSubMenu = document.createElement('div');
                    newSubMenu.className = 'row';
                    newSubMenu.innerHTML = `
                        <div class="col-5">
                            <div class="form-group">
                                <label for="subMenuNameInput">เมนูย่อย</label>
                                <input type="text" class="form-control @error('secondary_menu[${index}][sub_menu][${subIndex}][name]') is-invalid @enderror"
                                        name="secondary_menu[${index}][sub_menu][${subIndex}][name]" placeholder="เมนูย่อย" />
                                @error('secondary_menu[${index}][sub_menu][${subIndex}][name]')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="subUrlInput">route/URL ของเมนูย่อย</label>
                                <input type="text" class="form-control @error('secondary_menu[${index}][sub_menu][${subIndex}][url]') is-invalid @enderror"
                                        name="secondary_menu[${index}][sub_menu][${subIndex}][url]" placeholder="route/URL ของเมนู" />
                                @error('secondary_menu[${index}][sub_menu][${subIndex}][url]')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-2 d-flex align-items-end">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger cancel-menu">X</button>
                            </div>
                        </div>
                    `;

                    subMenuGroup.appendChild(newSubMenu);
                }
            });

            // Event delegation to handle sub-menu deletion
            document.getElementById('dynamic-secondary-menu').addEventListener('click', function(e) {
                if (e.target.classList.contains('cancel-menu')) {
                    e.target.closest('.row').remove();

                    // Re-enable the corresponding option in the secondary menu dropdown
                    const index = e.target.closest('.secondary-menu-group').getAttribute('data-index');
                    const deletedSubIndex = e.target.closest('.row').querySelector('input[type="text"]')
                        .getAttribute('name').match(/\d+/g)[1];
                    const deletedSubMenuName =
                        `secondary_menu[${index}][sub_menu][${deletedSubIndex}][name]`;
                    $(`.secondary_menu_${index} option[value="${deletedSubMenuName}"]`).prop('disabled',
                        false);
                }
            });
        });
    </script>
@endsection
