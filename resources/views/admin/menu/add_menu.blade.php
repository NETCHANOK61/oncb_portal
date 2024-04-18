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
                                    <form id="roleForm" action="{{ route('admin.store.menu') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="menuNameInput">Menu Name</label>
                                                        <select
                                                            class="js-example-tags form-control @error('menu_name') is-invalid @enderror"
                                                            id="menu_name" name="menu_name">
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
                                                            @foreach ([
            'typcn typcn-chart-pie-outline' => 'Chart Pie Outline',
            'typcn typcn-chart-pie' => 'Chart Pie',
            'typcn typcn-chevron-left-outline' => 'Chevron Left Outline',
            'typcn typcn-chevron-left' => 'Chevron Left',
            'typcn typcn-chevron-right-outline' => 'Chevron Right Outline',
            'typcn typcn-chevron-right' => 'Chevron Right',
            'typcn typcn-clipboard' => 'Clipboard',
            'typcn typcn-cloud-storage' => 'Cloud Storage',
            'typcn typcn-cloud-storage-outline' => 'Cloud Storage Outline',
            'typcn typcn-cog-outline' => 'Cog Outline',
            'typcn typcn-cog' => 'Cog',
            'typcn typcn-compass' => 'Compass',
            'typcn typcn-contacts' => 'Contacts',
            'typcn typcn-credit-card' => 'Credit Card',
            'typcn typcn-css3' => 'CSS3',
            'typcn typcn-database' => 'Database',
            'typcn typcn-delete-outline' => 'Delete Outline',
            'typcn typcn-delete' => 'Delete',
            'typcn typcn-device-desktop' => 'Desktop Device',
            'typcn typcn-device-laptop' => 'Laptop Device',
            'typcn typcn-device-phone' => 'Phone Device',
            'typcn typcn-device-tablet' => 'Tablet Device',
            'typcn typcn-directions' => 'Directions',
            'typcn typcn-divide-outline' => 'Divide Outline',
            'typcn typcn-divide' => 'Divide',
            'typcn typcn-document-add' => 'Document Add',
            'typcn typcn-document-delete' => 'Document Delete',
            'typcn typcn-document-text' => 'Document Text',
            'typcn typcn-document' => 'Document',
            'typcn typcn-download-outline' => 'Download Outline',
            'typcn typcn-download' => 'Download',
            'typcn typcn-dropbox' => 'Dropbox',
            'typcn typcn-edit' => 'Edit',
            'typcn typcn-eject-outline' => 'Eject Outline',
            'typcn typcn-eject' => 'Eject',
            'typcn typcn-equals-outline' => 'Equals Outline',
            'typcn typcn-equals' => 'Equals',
            'typcn typcn-export-outline' => 'Export Outline',
            'typcn typcn-export' => 'Export',
            'typcn typcn-eye-outline' => 'Eye Outline',
            'typcn typcn-eye' => 'Eye',
            'typcn typcn-feather' => 'Feather',
            'typcn typcn-film' => 'Film',
            'typcn typcn-filter' => 'Filter',
            'typcn typcn-flag-outline' => 'Flag Outline',
            'typcn typcn-flag' => 'Flag',
            'typcn typcn-flash-outline' => 'Flash Outline',
            'typcn typcn-flash' => 'Flash',
            'typcn typcn-flow-children' => 'Flow Children',
            'typcn typcn-flow-merge' => 'Flow Merge',
            'typcn typcn-flow-parallel' => 'Flow Parallel',
            'typcn typcn-flow-switch' => 'Flow Switch',
            'typcn typcn-folder-add' => 'Folder Add',
            'typcn typcn-folder-delete' => 'Folder Delete',
            'typcn typcn-folder-open' => 'Folder Open',
            'typcn typcn-folder' => 'Folder',
            'typcn typcn-gift' => 'Gift',
            'typcn typcn-globe-outline' => 'Globe Outline',
            'typcn typcn-globe' => 'Globe',
            'typcn typcn-group-outline' => 'Group Outline',
            'typcn typcn-group' => 'Group',
            'typcn typcn-headphones' => 'Headphones',
            'typcn typcn-heart-full-outline' => 'Heart Full Outline',
            'typcn typcn-heart-half-outline' => 'Heart Half Outline',
            'typcn typcn-heart-outline' => 'Heart Outline',
            'typcn typcn-heart' => 'Heart',
            'typcn typcn-home-outline' => 'Home Outline',
            'typcn typcn-home' => 'Home',
            'typcn typcn-html5' => 'HTML5',
            'typcn typcn-image-outline' => 'Image Outline',
            'typcn typcn-image' => 'Image',
            'typcn typcn-infinity-outline' => 'Infinity Outline',
            'typcn typcn-info-large-outline' => 'Info Large Outline',
            'typcn typcn-info-large' => 'Info Large',
            'typcn typcn-info-outline' => 'Info Outline',
            'typcn typcn-info' => 'Info',
            'typcn typcn-input-checked-outline' => 'Input Checked Outline',
            'typcn typcn-input-checked' => 'Input Checked',
            'typcn typcn-key-outline' => 'Key Outline',
            'typcn typcn-key' => 'Key',
            'typcn typcn-keyboard' => 'Keyboard',
            'typcn typcn-leaf' => 'Leaf',
            'typcn typcn-lightbulb' => 'Lightbulb',
            'typcn typcn-link-outline' => 'Link Outline',
            'typcn typcn-link' => 'Link',
            'typcn typcn-location-arrow-outline' => 'Location Arrow Outline',
            'typcn typcn-location-arrow' => 'Location Arrow',
            'typcn typcn-location-outline' => 'Location Outline',
            'typcn typcn-location' => 'Location',
            'typcn typcn-lock-closed-outline' => 'Lock Closed Outline',
            'typcn typcn-lock-closed' => 'Lock Closed',
            'typcn typcn-lock-open-outline' => 'Lock Open Outline',
            'typcn typcn-lock-open' => 'Lock Open',
            'typcn typcn-mail' => 'Mail',
            'typcn typcn-map' => 'Map',
            'typcn typcn-media-eject-outline' => 'Media Eject Outline',
            'typcn typcn-media-eject' => 'Media Eject',
            'typcn typcn-media-fast-forward-outline' => 'Media Fast Forward Outline',
            'typcn typcn-media-fast-forward' => 'Media Fast Forward',
            'typcn typcn-media-pause-outline' => 'Media Pause Outline',
            'typcn typcn-media-pause' => 'Media Pause',
            'typcn typcn-media-play-outline' => 'Media Play Outline',
            'typcn typcn-media-play-reverse-outline' => 'Media Play Reverse Outline',
            'typcn typcn-media-play-reverse' => 'Media Play Reverse',
            'typcn typcn-media-play' => 'Media Play',
            'typcn typcn-media-record-outline' => 'Media Record Outline',
            'typcn typcn-media-record' => 'Media Record',
            'typcn typcn-media-rewind-outline' => 'Media Rewind Outline',
            'typcn typcn-media-rewind' => 'Media Rewind',
            'typcn typcn-media-stop-outline' => 'Media Stop Outline',
            'typcn typcn-media-stop' => 'Media Stop',
            'typcn typcn-message-typing' => 'Message Typing',
            'typcn typcn-message' => 'Message',
            'typcn typcn-messages' => 'Messages',
            'typcn typcn-microphone-outline' => 'Microphone Outline',
            'typcn typcn-microphone' => 'Microphone',
            'typcn typcn-minus-outline' => 'Minus Outline',
            'typcn typcn-minus' => 'Minus',
            'typcn typcn-mortar-board' => 'Mortar Board',
            'typcn typcn-news' => 'News',
            'typcn typcn-notes-outline' => 'Notes Outline',
            'typcn typcn-notes' => 'Notes',
            'typcn typcn-pen' => 'Pen',
            'typcn typcn-pencil' => 'Pencil',
            'typcn typcn-phone-outline' => 'Phone Outline',
            'typcn typcn-phone' => 'Phone',
            'typcn typcn-pi-outline' => 'Pi Outline',
            'typcn typcn-pi' => 'Pi',
            'typcn typcn-pin-outline' => 'Pin Outline',
            'typcn typcn-pin' => 'Pin',
            'typcn typcn-pipette' => 'Pipette',
            'typcn typcn-plane-outline' => 'Plane Outline',
            'typcn typcn-plane' => 'Plane',
            'typcn typcn-plug' => 'Plug',
            'typcn typcn-plus-outline' => 'Plus Outline',
            'typcn typcn-plus' => 'Plus',
            'typcn typcn-point-of-interest-outline' => 'Point of Interest Outline',
            'typcn typcn-point-of-interest' => 'Point of Interest',
            'typcn typcn-power-outline' => 'Power Outline',
            'typcn typcn-power' => 'Power',
            'typcn typcn-printer' => 'Printer',
            'typcn typcn-puzzle-outline' => 'Puzzle Outline',
            'typcn typcn-puzzle' => 'Puzzle',
            'typcn typcn-radar-outline' => 'Radar Outline',
            'typcn typcn-radar' => 'Radar',
            'typcn typcn-refresh-outline' => 'Refresh Outline',
            'typcn typcn-refresh' => 'Refresh',
            'typcn typcn-rss-outline' => 'RSS Outline',
            'typcn typcn-rss' => 'RSS',
            'typcn typcn-scissors-outline' => 'Scissors Outline',
            'typcn typcn-scissors' => 'Scissors',
            'typcn typcn-shopping-bag' => 'Shopping Bag',
            'typcn typcn-shopping-cart' => 'Shopping Cart',
            'typcn typcn-social-at-circular' => 'Social At Circular',
            'typcn typcn-social-dribbble-circular' => 'Social Dribbble Circular',
            'typcn typcn-social-dribbble' => 'Social Dribbble',
            'typcn typcn-social-facebook-circular' => 'Social Facebook Circular',
            'typcn typcn-social-facebook' => 'Social Facebook',
            'typcn typcn-social-flickr-circular' => 'Social Flickr Circular',
            'typcn typcn-social-flickr' => 'Social Flickr',
            'typcn typcn-social-github-circular' => 'Social GitHub Circular',
            'typcn typcn-social-github' => 'Social GitHub',
            'typcn typcn-social-google-plus-circular' => 'Social Google Plus Circular',
            'typcn typcn-social-google-plus' => 'Social Google Plus',
            'typcn typcn-social-instagram-circular' => 'Social Instagram Circular',
            'typcn typcn-social-instagram' => 'Social Instagram',
            'typcn typcn-social-last-fm-circular' => 'Social Last FM Circular',
            'typcn typcn-social-last-fm' => 'Social Last FM',
            'typcn typcn-social-linkedin-circular' => 'Social LinkedIn Circular',
            'typcn typcn-social-linkedin' => 'Social LinkedIn',
            'typcn typcn-social-pinterest-circular' => 'Social Pinterest Circular',
            'typcn typcn-social-pinterest' => 'Social Pinterest',
            'typcn typcn-social-skype-outline' => 'Social Skype Outline',
            'typcn typcn-social-skype' => 'Social Skype',
            'typcn typcn-social-tumbler-circular' => 'Social Tumbler Circular',
            'typcn typcn-social-tumbler' => 'Social Tumbler',
            'typcn typcn-social-twitter-circular' => 'Social Twitter Circular',
            'typcn typcn-social-twitter' => 'Social Twitter',
            'typcn typcn-social-vimeo-circular' => 'Social Vimeo Circular',
            'typcn typcn-social-vimeo' => 'Social Vimeo',
            'typcn typcn-social-youtube-circular' => 'Social YouTube Circular',
            'typcn typcn-social-youtube' => 'Social YouTube',
            'typcn typcn-sort-alphabetically-outline' => 'Sort Alphabetically Outline',
            'typcn typcn-sort-alphabetically' => 'Sort Alphabetically',
            'typcn typcn-sort-numerically-outline' => 'Sort Numerically Outline',
            'typcn typcn-sort-numerically' => 'Sort Numerically',
            'typcn typcn-spanner-outline' => 'Spanner Outline',
            'typcn typcn-spanner' => 'Spanner',
            'typcn typcn-spiral' => 'Spiral',
            'typcn typcn-star-full-outline' => 'Star Full Outline',
            'typcn typcn-star-half-outline' => 'Star Half Outline',
            'typcn typcn-star-half' => 'Star Half',
            'typcn typcn-star-outline' => 'Star Outline',
            'typcn typcn-star' => 'Star',
            'typcn typcn-starburst-outline' => 'Starburst Outline',
            'typcn typcn-starburst' => 'Starburst',
            'typcn typcn-stopwatch' => 'Stopwatch',
            'typcn typcn-support' => 'Support',
            'typcn typcn-tabs-outline' => 'Tabs Outline',
        ] as $value => $label)
                                                                <option value="{{ $value }}"
                                                                    data-icon="{{ $value }}">
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
                                                            id="secondary_menu" name="secondary_menu">
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
                                                            id="sub_menu" name="sub_menu" placeholder="Sub Menu" />
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
                                                            id="url_menu" name="url_menu" placeholder="URL Menu" />
                                                    </div>
                                                    @error('url_menu')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <label for="subMenuNameInput">Status</label>
                                                    <div class="form-group">
                                                        <label class="switch">
                                                            <input type="checkbox" checked name="status_menu">
                                                            <span class="slider round"></span>
                                                            <span class="status-text on-text">เปิด</span>
                                                            <span class="status-text off-text">ปิด</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer" align="right">
                                                <button type="submit" class="btn btn-success-light mt-1">บันทึก</button>
                                                <a href="{{ route('admin.users.index') }}"
                                                    class="btn btn-danger-light mt-1">ยกเลิก</a>
                                            </div>
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
