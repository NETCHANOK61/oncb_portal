@extends('admin.dashboard')

@section('admin')
    <div class="side-app">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.all.menu') }}">เมนูทั้งหมด</a></li>
                <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูล</li>
            </ol>
        </div>

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
                                    <form id="roleForm" action="{{ route('admin.store.menu') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label for="menuNameInput">เมนูหลัก</label>
                                                        <select
                                                            class="js-example-tags form-control @error('menu_name') is-invalid @enderror"
                                                            id="menu_name" name="menu_name">
                                                            <option value="" selected>-เลือกเมนูหลัก-</option>
                                                            @foreach ($menus as $item)
                                                                <option value="{{ $item->th_name }}"
                                                                    data-icon="{{ $item->icon }}">{{ $item->th_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('menu_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label for="menuIconTnput">Menu Icon</label>
                                                        <select
                                                            class="select2-icon form-control @error('menu_icon') is-invalid @enderror"
                                                            id="menu_icon" name="menu_icon">
                                                            <option value="" selected>-เลือกไอคอนเมนู-</option>
                                                            @foreach ($icon as $value => $label)
                                                                <option value="{{ $value }}"
                                                                    data-icon="{{ $value }}">{{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('menu_icon')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-2 d-flex align-items-end">
                                                    <div class="form-group" id="add_secondary" style="display: none">
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

                const div_btn = $('#add_secondary');
                if (selectedOption.val() !== '') {
                    div_btn.show();
                } else {
                    div_btn.hide();
                }
            });

            // Event listener for secondary menu select change
            $(document).on('change', '.js-example-tags', function() {
                const selectedOption = $(this).find('option:selected');
                const url = selectedOption.data('url');
                const urlInput = $(this).closest('.row').find(
                    '#urlText'); // Adjusted selector to match your HTML structure

                if (url) {
                    urlInput.val(url); // Set the URL value to the input field
                    urlInput.prop('readonly', true); // Make the input field read-only
                } else {
                    urlInput.val(''); // Reset the input field if no URL is available
                    urlInput.prop('readonly', false); // Allow input if no URL is available
                }
            });


            // Function to add new secondary menu with sub-menus
            document.getElementById('add-secondary-menu').addEventListener('click', function() {
                var secondaryMenuContainer = document.getElementById('dynamic-secondary-menu');
                var index = secondaryMenuContainer.children.length;

                var newSecondaryMenuGroup = document.createElement('div');
                newSecondaryMenuGroup.className = 'secondary-menu-group';
                newSecondaryMenuGroup.innerHTML = `
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="secondaryMenuNameInput">เมนูรอง</label>
                                    <select id="secondary_menu" class="js-example-tags form-control @error('secondary_menu[${index}][name]') is-invalid @enderror" name="secondary_menu[${index}][name]">
                                        <option value="">-เลือกเมนูรอง-</option>
                                        @foreach ($menus as $menu)
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
                                    <input id="urlText" type="text" class="form-control @error('secondary_menu[${index}][url]') is-invalid @enderror" name="secondary_menu[${index}][url]" placeholder="route/URL ของเมนู" />
                                    @error('secondary_menu[${index}][url]')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2 d-flex align-items-end">
                                <div class="form-group">
                                    <button type="button" class="btn btn-secondary add-sub-menu" data-index="${index}">เพิ่มเมนูย่อย</button>
                                </div>
                            </div>
                        </div>
                        <div class="sub-menu-group" data-index="${index}">
                            <!-- Sub-menu fields will be added here -->
                        </div>
                    </div>
                `;

                secondaryMenuContainer.appendChild(newSecondaryMenuGroup);
                $('.js-example-tags').select2({
                    tags: true,
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
                                <input type="text" class="form-control @error('secondary_menu[${index}][sub_menu][${subIndex}][name]') is-invalid @enderror" name="secondary_menu[${index}][sub_menu][${subIndex}][name]" placeholder="เมนูย่อย" />
                                @error('secondary_menu[${index}][sub_menu][${subIndex}][name]')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="subUrlInput">route/URL ของเมนูย่อย</label>
                                <input type="text" class="form-control @error('secondary_menu[${index}][sub_menu][${subIndex}][url]') is-invalid @enderror" name="secondary_menu[${index}][sub_menu][${subIndex}][url]" placeholder="route/URL ของเมนู" />
                                @error('secondary_menu[${index}][sub_menu][${subIndex}][url]')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    `;

                    subMenuGroup.appendChild(newSubMenu);
                }
            });
        });
    </script>
@endsection
