@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.all.menu') }}">All menu
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    เพิ่มข้อมูล
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
                                {{-- <li>สิทธิ์การเข้าใช้งาน</li> --}}
                            </ul>

                            <div class="content_wrapper">
                                {{-- tab 1 --}}
                                <div class="tab_content">
                                    <form id="roleForm" action="{{ route('admin.update.menu', $data->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="menuNameInput">Menu Name</label>
                                                        <select
                                                            class="js-example-tags form-control @error('menu_name') is-invalid @enderror"
                                                            id="menu_name" name="menu_name" value="{{ $data->menu_name }}">
                                                            @foreach ($menu as $item)
                                                                <option value="{{ $item->menu_name }}">
                                                                    {{ $item->menu_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <input type="text"
                                                            class="form-control @error('menu_name') is-invalid @enderror" id="menu_name"
                                                            name="menu_name" placeholder="Menu Name" /> --}}
                                                    </div>
                                                    @error('menu_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="menuIconTnput">Menu Icon</label>
                                                        <select class="select2-icon" id="menu_icon" name="menu_icon">
                                                            @foreach ($icon as $value => $label)
                                                                <option value="{{ $value }}"
                                                                    data-icon="{{ $value }}"
                                                                    {{ $data->menu_icon == $value ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('menu_icon')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="secondaryMenuNameInput">Secondary Menu</label>
                                                        <select
                                                            class="js-example-tags form-control @error('secondary_menu') is-invalid @enderror"
                                                            id="secondary_menu" name="secondary_menu"
                                                            value="{{ $data->secondary_menu }}">
                                                            @foreach ($menu as $item)
                                                                <option value="{{ $item->secondary_menu }}">
                                                                    {{ $item->secondary_menu }}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <input type="text"
                                                            class="form-control @error('secondary_menu') is-invalid @enderror"
                                                            id="secondary_menu" name="secondary_menu" placeholder="Secondary Menu" /> --}}
                                                    </div>
                                                    @error('secondary_menu')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="subMenuNameInput">Sub Menu</label>
                                                        <input type="text"
                                                            class="form-control @error('sub_menu') is-invalid @enderror"
                                                            id="sub_menu" name="sub_menu" placeholder="Sub Menu"
                                                            value="{{ $data->sub_menu }}" />
                                                    </div>
                                                    @error('sub_menu')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="urlInput">URL Menu</label>
                                                        <input type="text"
                                                            class="form-control @error('url_menu') is-invalid @enderror"
                                                            id="url_menu" name="url_menu" placeholder="URL Menu"
                                                            value="{{ $data->url_menu }}" />
                                                    </div>
                                                    @error('url_menu')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <label for="subMenuNameInput">Status</label>
                                                    <div class="form-group">
                                                        <label class="switch">
                                                            <input type="checkbox" value="1"
                                                                {{ $data->status_menu ? 'checked' : '' }}
                                                                name="status_menu">
                                                            <span class="slider round"></span>
                                                            <span class="status-text on-text">เปิด</span>
                                                            <span class="status-text off-text">ปิด</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer" align="right">
                                                <button type="submit" class="btn btn-success-light mt-1">บันทึก</button>
                                                {{-- <a href="#" class="btn btn-success-light mt-1">บันทึก</a> --}}
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
@endsection
