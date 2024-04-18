@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.all.type') }}">จัดการป้ายประกาศ
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    แก้ไขข้อมูล
                </li>
            </ol>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 OPEN -->
        <div class="row">

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="col-md-12">
                        <form id="roleForm" action="{{ route('admin.update.type', $data->id) }}" method="POST">
                            @csrf
                            <div class="card-body p-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">หัวข้อ</label>
                                            <input type="text"
                                                class="form-control @error('type_name') is-invalid @enderror" id="type_name"
                                                name="type_name" placeholder="หัวข้อ" value="{{ $data->type_name }}" />
                                        </div>
                                        @error('type_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ประเภทของประกาศ</label>
                                            {{-- <i class="ion-document" data-toggle="tooltip" title="ion-document"></i> --}}
                                            <select class="js-example-tags" id="typeInput" name="typeInput">
                                                @foreach (['danger' => 'เรื่องสำคัญ', 'info' => 'คำแนะนำ', 'success' => 'เรื่องทั่วไป'] as $class => $label)
                                                    <option value="{{ $class }}"
                                                        {{ $data->type == $class ? 'selected' : '' }}>{{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ไอคอน</label>
                                            <select class="select2-ionic" id="type_icon" name="type_icon">
                                                @foreach ([
            'ion-ionic' => 'ion-ionic',
            'ion-arrow-up-a' => 'ion-arrow-up-a',
            'ion-arrow-right-a' => 'ion-arrow-right-a',
            'ion-arrow-down-a' => 'ion-arrow-down-a',
            'ion-arrow-left-a' => 'ion-arrow-left-a',
            'ion-arrow-up-b' => 'ion-arrow-up-b',
            'ion-arrow-right-b' => 'ion-arrow-right-b',
            'ion-arrow-down-b' => 'ion-arrow-down-b',
            'ion-arrow-left-b' => 'ion-arrow-left-b',
            'ion-arrow-up-c' => 'ion-arrow-up-c',
            'ion-arrow-right-c' => 'ion-arrow-right-c',
            'ion-arrow-down-c' => 'ion-arrow-down-c',
            'ion-arrow-left-c' => 'ion-arrow-left-c',
            'ion-arrow-return-right' => 'ion-arrow-return-right',
            'ion-arrow-return-left' => 'ion-arrow-return-left',
            'ion-arrow-swap' => 'ion-arrow-swap',
            'ion-arrow-shrink' => 'ion-arrow-shrink',
            'ion-arrow-expand' => 'ion-arrow-expand',
            'ion-arrow-move' => 'ion-arrow-move',
            'ion-arrow-resize' => 'ion-arrow-resize',
            'ion-chevron-up' => 'ion-chevron-up',
            'ion-chevron-right' => 'ion-chevron-right',
            'ion-chevron-down' => 'ion-chevron-down',
            'ion-chevron-left' => 'ion-chevron-left',
            'ion-navicon-round' => 'ion-navicon-round',
            'ion-navicon' => 'ion-navicon',
            'ion-drag' => 'ion-drag',
            'ion-log-in' => 'ion-log-in',
            'ion-log-out' => 'ion-log-out',
            'ion-checkmark-round' => 'ion-checkmark-round',
            'ion-checkmark' => 'ion-checkmark',
            'ion-checkmark-circled' => 'ion-checkmark-circled',
            'ion-close-round' => 'ion-close-round',
            'ion-close' => 'ion-close',
            'ion-close-circled' => 'ion-close-circled',
            'ion-plus-round' => 'ion-plus-round',
            'ion-plus' => 'ion-plus',
            'ion-plus-circled' => 'ion-plus-circled',
            'ion-minus-round' => 'ion-minus-round',
            'ion-minus' => 'ion-minus',
            'ion-minus-circled' => 'ion-minus-circled',
            'ion-information' => 'ion-information',
            'ion-information-circled' => 'ion-information-circled',
            'ion-help' => 'ion-help',
            'ion-help-circled' => 'ion-help-circled',
            'ion-help-buoy' => 'ion-help-buoy',
            'ion-asterisk' => 'ion-asterisk',
            'ion-alert' => 'ion-alert',
            'ion-alert-circled' => 'ion-alert-circled',
            'ion-refresh' => 'ion-refresh',
            'ion-loop' => 'ion-loop',
            'ion-shuffle' => 'ion-shuffle',
            'ion-home' => 'ion-home',
            'ion-search' => 'ion-search',
            'ion-flag' => 'ion-flag',
            'ion-star' => 'ion-star',
            'ion-heart' => 'ion-heart',
            'ion-heart-broken' => 'ion-heart-broken',
            'ion-gear-a' => 'ion-gear-a',
            'ion-gear-b' => 'ion-gear-b',
            'ion-toggle-filled' => 'ion-toggle-filled',
            'ion-toggle' => 'ion-toggle',
            'ion-settings' => 'ion-settings',
            'ion-wrench' => 'ion-wrench',
            'ion-folder' => 'ion-folder',
            'ion-hammer' => 'ion-hammer',
            'ion-edit' => 'ion-edit',
            'ion-trash-a' => 'ion-trash-a',
            'ion-trash-b' => 'ion-trash-b',
            'ion-document' => 'ion-document',
            'ion-document-text' => 'ion-document-text',
            'ion-clipboard' => 'ion-clFipboard',
            'ion-scissors' => 'ion-scissors',
            'ion-funnel' => 'ion-funnel',
            'ion-bookmark' => 'ion-bookmark',
            'ion-email' => 'ion-email',
            'ion-folder' => 'ion-folder',
            'ion-filing' => 'ion-filing',
            'ion-archive' => 'ion-archive',
            'ion-reply' => 'ion-reply',
            'ion-reply-all' => 'ion-reply-all',
            'ion-forward' => 'ion-forward',
            'ion-share' => 'ion-share',
            'ion-paper-airplane' => 'ion-paper-airplane',
            'ion-link' => 'ion-link',
            'ion-paperclip' => 'ion-paperclip',
            'ion-compose' => 'ion-compose',
            'ion-briefcase' => 'ion-briefcase',
            'ion-medkit' => 'ion-medkit',
            'ion-at' => 'ion-at',
            'ion-pound' => 'ion-pound',
            'ion-quote' => 'ion-quote',
            'ion-cloud' => 'ion-cloud',
            'ion-upload' => 'ion-upload',
            'ion-more' => 'ion-more',
            'ion-grid' => 'ion-grid',
            'ion-calendar' => 'ion-calendar',
            'ion-clock' => 'ion-clock',
            'ion-compass' => 'ion-compass',
            'ion-pinpoint' => 'ion-pinpoint',
            'ion-pin' => 'ion-pin',
            'ion-navigate' => 'ion-navigate',
            'ion-location' => 'ion-location',
            'ion-map' => 'ion-map',
            'ion-model-s' => 'ion-model-s',
            'ion-locked' => 'ion-locked',
            'ion-unlocked' => 'ion-unlocked',
            'ion-key' => 'ion-key',
            'ion-arrow-graph-up-right' => 'ion-arrow-graph-up-right',
            'ion-arrow-graph-down-right' => 'ion-arrow-graph-down-right',
            'ion-arrow-graph-down-left' => 'ion-arrow-graph-down-left',
            'ion-stats-bars' => 'ion-stats-bars',
            'ion-connection-bars' => 'ion-connection-bars',
            'ion-pie-graph' => 'ion-pie-graph',
            'ion-chatbubble' => 'ion-chatbubble',
            'ion-chatbubble-working' => 'ion-chatbubble-working',
            'ion-chatbubbles' => 'ion-chatbubbles',
            'ion-chatbox' => 'ion-chatbox',
            'ion-chatbox-working' => 'ion-chatbox-working',
            'ion-chatboxes' => 'ion-chatboxes',
            'ion-person' => 'ion-person',
            'ion-person-add' => 'ion-person-add',
            'ion-person-stalker' => 'ion-person-stalker',
            'ion-woman' => 'ion-woman',
            'ion-man' => 'ion-man',
            'ion-female' => 'ion-female',
            'ion-male' => 'ion-male',
            'ion-fork' => 'ion-fork',
            'ion-knife' => 'ion-knife',
            'ion-spoon' => 'ion-spoon',
            'ion-beer' => 'ion-beer',
            'ion-wineglass' => 'ion-wineglass',
            'ion-coffee' => 'ion-coffee',
            'ion-icecream' => 'ion-icecream',
            'ion-pizza' => 'ion-pizza',
            'ion-power' => 'ion-power',
            'ion-mouse' => 'ion-mouse',
            'ion-battery-full' => 'ion-battery-full',
            'ion-battery-half' => 'ion-battery-half',
            'ion-battery-low' => 'ion-battery-low',
            'ion-battery-empty' => 'ion-battery-empty',
            'ion-battery-charging' => 'ion-battery-charging',
            'ion-bluetooth' => 'ion-bluetooth',
            'ion-calculator' => 'ion-calculator',
            'ion-camera' => 'ion-camera',
            'ion-eye' => 'ion-eye',
            'ion-eye-disabled' => 'ion-eye-disabled',
            'ion-flash' => 'ion-flash',
            'ion-flash-off' => 'ion-flash-off',
            'ion-qr-scanner' => 'ion-qr-scanner',
            'ion-image' => 'ion-image',
            'ion-images' => 'ion-images',
            'ion-contrast' => 'ion-contrast',
            'ion-wand' => 'ion-wand',
            'ion-aperture' => 'ion-aperture',
            'ion-monitor' => 'ion-monitor',
            'ion-laptop' => 'ion-laptop',
            'ion-ipad' => 'ion-ipad',
            'ion-iphone' => 'ion-iphone',
            'ion-ipod' => 'ion-ipod',
            'ion-printer' => 'ion-printer',
            'ion-usb' => 'ion-usb',
            'ion-outlet' => 'ion-outlet',
            'ion-bug' => 'ion-bug',
            'ion-code' => 'ion-code',
            'ion-code-working' => 'ion-code-working',
            'ion-code-download' => 'ion-code-download',
            'ion-fork-repo' => 'ion-fork-repo',
            'ion-network' => 'ion-network',
            'ion-pull-request' => 'ion-pull-request',
            'ion-merge' => 'ion-merge',
            'ion-game-controller-a' => 'ion-game-controller-a',
            'ion-game-controller-b' => 'ion-game-controller-b',
            'ion-xbox' => 'ion-xbox',
            'ion-playstation' => 'ion-playstation',
            'ion-steam' => 'ion-steam',
            'ion-closed-captioning' => 'ion-closed-captioning',
            'ion-videocamera' => 'ion-videocamera',
            'ion-film-marker' => 'ion-film-marker',
            'ion-disc' => 'ion-disc',
            'ion-headphone' => 'ion-headphone',
            'ion-music-note' => 'ion-music-note',
            'ion-radio-waves' => 'ion-radio-waves',
            'ion-speakerphone' => 'ion-speakerphone',
            'ion-mic-a' => 'ion-mic-a',
            'ion-mic-b' => 'ion-mic-b',
            'ion-mic-c' => 'ion-mic-c',
            'ion-volume-high' => 'ion-volume-high',
            'ion-volume-medium' => 'ion-volume-medium',
            'ion-volume-low' => 'ion-volume-low',
            'ion-volume-mute' => 'ion-volume-mute',
            'ion-levels' => 'ion-levels',
            'ion-play' => 'ion-play',
            'ion-pause' => 'ion-pause',
            'ion-stop' => 'ion-stop',
            'ion-record' => 'ion-record',
            'ion-skip-forward' => 'ion-skip-forward',
            'ion-skip-backward' => 'ion-skip-backward',
            'ion-eject' => 'ion-eject',
            'ion-bag' => 'ion-bag',
            'ion-card' => 'ion-card',
            'ion-cash' => 'ion-cash',
            'ion-pricetag' => 'ion-pricetag',
            'ion-pricetags' => 'ion-pricetags',
            'ion-thumbsup' => 'ion-thumbsup',
            'ion-thumbsdown' => 'ion-thumbsdown',
            'ion-happy' => 'ion-happy',
            'ion-sad' => 'ion-sad',
            'ion-trophy' => 'ion-trophy',
            'ion-podium' => 'ion-podium',
            'ion-ribbon-a' => 'ion-ribbon-a',
            'ion-ribbon-b' => 'ion-ribbon-b',
            'ion-university' => 'ion-university',
            'ion-magnet' => 'ion-magnet',
            'ion-beaker' => 'ion-beaker',
            'ion-flask' => 'ion-flask',
            'ion-egg' => 'ion-egg',
            'ion-earth' => 'ion-earth',
            'ion-planet' => 'ion-planet',
            'ion-lightbulb' => 'ion-lightbulb',
            'ion-cube' => 'ion-cube',
            'ion-leaf' => 'ion-leaf',
            'ion-waterdrop' => 'ion-waterdrop',
            'ion-flame' => 'ion-flame',
            'ion-fireball' => 'ion-fireball',
            'ion-bonfire' => 'ion-bonfire',
            'ion-umbrella' => 'ion-umbrella',
            'ion-nuclear' => 'ion-nuclear',
            'ion-no-smoking' => 'ion-no-smoking',
            'ion-thermometer' => 'ion-thermometer',
            'ion-speedometer' => 'ion-speedometer',
            'ion-plane' => 'ion-plane',
            'ion-jet' => 'ion-jet',
            'ion-load-a' => 'ion-load-a',
            'ion-load-b' => 'ion-load-b',
            'ion-load-c' => 'ion-load-c',
            'ion-load-d' => 'ion-load-d',
            'ion-ios7-ionic-outline' => 'ion-ios7-ionic-outline',
            'ion-ios7-arrow-back' => 'ion-ios7-arrow-back',
            'ion-ios7-arrow-forward' => 'ion-ios7-arrow-forward',
            'ion-ios7-arrow-up' => 'ion-ios7-arrow-up',
            'ion-ios7-arrow-right' => 'ion-ios7-arrow-right',
            'ion-ios7-arrow-down' => 'ion-ios7-arrow-down',
            'ion-ios7-arrow-left' => 'ion-ios7-arrow-left',
            'ion-ios7-arrow-thin-up' => 'ion-ios7-arrow-thin-up',
            'ion-ios7-arrow-thin-right' => 'ion-ios7-arrow-thin-right',
            'ion-ios7-arrow-thin-down' => 'ion-ios7-arrow-thin-down',
            'ion-ios7-arrow-thin-left' => 'ion-ios7-arrow-thin-left',
            'ion-ios7-circle-filled' => 'ion-ios7-circle-filled',
            'ion-ios7-circle-outline' => 'ion-ios7-circle-outline',
            'ion-ios7-checkmark-empty' => 'ion-ios7-checkmark-empty',
            'ion-ios7-checkmark-outline' => 'ion-ios7-checkmark-outline',
            'ion-ios7-checkmark' => 'ion-ios7-checkmark',
            'ion-ios7-plus-empty' => 'ion-ios7-plus-empty',
            'ion-ios7-plus-outline' => 'ion-ios7-plus-outline',
            'ion-ios7-plus' => 'ion-ios7-plus',
            'ion-ios7-close-empty' => 'ion-ios7-close-empty',
            'ion-ios7-close-outline' => 'ion-ios7-close-outline',
            'ion-ios7-close' => 'ion-ios7-close',
            'ion-ios7-minus-empty' => 'ion-ios7-minus-empty',
            'ion-ios7-minus-outline' => 'ion-ios7-minus-outline',
            'ion-ios7-minus' => 'ion-ios7-minus',
            'ion-ios7-information-empty' => 'ion-ios7-information-empty',
            'ion-ios7-information-outline' => 'ion-ios7-information-outline',
            'ion-ios7-information' => 'ion-ios7-information',
            'ion-ios7-help-empty' => 'ion-ios7-help-empty',
            'ion-ios7-help-outline' => 'ion-ios7-help-outline',
            'ion-ios7-help' => 'ion-ios7-help',
            'ion-ios7-search' => 'ion-ios7-search',
            'ion-ios7-search-strong' => 'ion-ios7-search-strong',
            'ion-ios7-star' => 'ion-ios7-star',
            'ion-ios7-star-half' => 'ion-ios7-star-half',
            'ion-ios7-star-outline' => 'ion-ios7-star-outline',
            'ion-ios7-heart' => 'ion-ios7-heart',
            'ion-ios7-heart-outline' => 'ion-ios7-heart-outline',
            'ion-ios7-more' => 'ion-ios7-more',
            'ion-ios7-more-outline' => 'ion-ios7-more-outline',
            'ion-ios7-home' => 'ion-ios7-home',
            'ion-ios7-home-outline' => 'ion-ios7-home-outline',
            'ion-ios7-cloud' => 'ion-ios7-cloud',
            'ion-ios7-cloud-outline' => 'ion-ios7-cloud-outline',
            'ion-ios7-cloud-upload' => 'ion-ios7-cloud-upload',
            'ion-ios7-cloud-upload-outline' => 'ion-ios7-cloud-upload-outline',
            'ion-ios7-cloud-download' => 'ion-ios7-cloud-download',
            'ion-ios7-cloud-download-outline' => 'ion-ios7-cloud-download-outline',
            'ion-ios7-upload' => 'ion-ios7-upload',
            'ion-ios7-upload-outline' => 'ion-ios7-upload-outline',
            'ion-ios7-download' => 'ion-ios7-download',
            'ion-ios7-refresh' => 'ion-ios7-refresh',
            'ion-ios7-refresh-outline' => 'ion-ios7-refresh-outline',
            'ion-ios7-refresh-empty' => 'ion-ios7-refresh-empty',
            'ion-ios7-reload' => 'ion-ios7-reload',
            'ion-ios7-loop-strong' => 'ion-ios7-loop-strong',
            'ion-ios7-loop' => 'ion-ios7-loop',
            'ion-ios7-bookmarks' => 'ion-ios7-bookmarks',
            'ion-ios7-bookmarks-outline' => 'ion-ios7-bookmarks-outline',
        ] as $class => $label)
                                                    <option value="{{ $class }}" data-icon="{{ $class }}"
                                                        {{ $data->type_icon == $class ? 'selected' : '' }}>{{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type_icon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">คำอธิบาย</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="คำอธิบายเพิ่มเติม">{{ $data->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer" align="right">
                                    <button type="submit" class="btn btn-success-light mt-1">บันทึก</button>
                                    {{-- <a href="#" class="btn btn-success-light mt-1">บันทึก</a> --}}
                                    <a href="{{ route('admin.all.type') }}" class="btn btn-danger-light mt-1">ยกเลิก</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
