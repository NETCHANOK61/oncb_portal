@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">รายงาน ผลการดำเนินงานในสถานศึกษา</li>
            </ol>
        </div>

        <!-- COL END -->

        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">รายงานผลการดำเนินงานในสถานศึกษา : {{ $school->Thai_Name }}</div>
                </div>
                <div class="card-body p-6">
                    <div class="panel panel-primary">
                        <div class="tab_wrapper first_tab">
                            <ul class="tab_list">
                                <li class="active">ข้อ 1-7</li>
                                <li class="">ข้อ 8-10</li>
                                <li class="">ข้อ 11-13</li>
                                <li class="">ข้อ 14</li>
                                <li class="">ข้อ 15</li>
                                <li class="">ข้อ 16-27</li>
                                <li class="">ข้อ 28</li>
                            </ul>

                            <div class="content_wrapper">
                                {{-- tab 1 --}}
                                <div class="tab_content">
                                    <br>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>1. การสำรวจค้นหาคัดกรองนักเรียน</h4>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="survey_student" value="1"> มี
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="survey_student" value="0"> ไม่มี
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8" style="padding-bottom: 1%">
                                            <h4>2. การให้คำปรึกษา</h4>
                                            <div style="padding-left: 5%">
                                                <input type="checkbox" name="advice_student" value="1"> นักเรียน <br>
                                                <input type="checkbox" name="advice_parent" value="1"> ผู้ปกครอง <br>
                                                <input type="checkbox" name="advice_other" value="1"> อื่น ๆ <br>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="advice_ck" value="1"> มี
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="advice_ck" value="0"> ไม่มี
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>3. จัดค่ายปรับเปลี่ยนพฤติกรรมกลุ่ม<b>เสี่ยง</b></h4>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="risk_camp_ck" value="1"> มี
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="risk_camp_ck" value="0"> ไม่มี
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>4. จัดค่ายปรับเปลี่ยนพฤติกรรมกลุ่ม<b>เสพ</b></h4>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="addict_camp_ck" value="1"> มี
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="addict_camp_ck" value="0"> ไม่มี
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>5. จิตสังคมบำบัดในโรงเรียน<b> (เฉพาะกลุ่มเสพ)</b></h4>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="addict_mindck" value="1"> มี
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="addict_mindck" value="0"> ไม่มี
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>6. ส่งต่อผู้เสพ/ผู้ติด เข้ารับการบำบัดที่อื่น</h4>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="send_addictck" value="1"> มี
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="send_addictck" value="0"> ไม่มี
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>7. ดำเนินคดีตามกฏหมาย <b>(กรณีผู้ค้า)</b></h4>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="lawck" value="1"> มี
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="lawck" value="0"> ไม่มี
                                        </div>
                                    </div>

                                    {{-- dynamic form --}}
                                    <hr>
                                    <div class="row">
                                        @foreach ($combinedData as $columnInfo)
                                            <div class="col-12">
                                                <div class="form-group">
                                                    @if ($columnInfo['display_type'] == 'fillable')
                                                        <label
                                                            for="{{ $columnInfo['label_name'] }}">{{ $columnInfo['label_name'] }}</label>
                                                        <input class="form-control" id="{{ $columnInfo['field_name'] }}"
                                                            name="{{ $columnInfo['field_name'] }}">
                                                    @elseif ($columnInfo['display_type'] == 'choosable')
                                                        {{-- <input type="text" class="form-control"
                                                            id="{{ $columnInfo['label_name'] }}"
                                                            name="{{ $columnInfo['label_name'] }}"> --}}
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <h4>{{ $columnInfo['label_name'] }}</h4>
                                                            </div>
                                                            <div class="col-2">
                                                                <input type="radio"
                                                                    name="{{ $columnInfo['field_name'] }}" value="1">
                                                                มี
                                                            </div>
                                                            <div class="col-2">
                                                                <input type="radio"
                                                                    name="{{ $columnInfo['field_name'] }}" value="0">
                                                                ไม่มี
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- tab 2 --}}
                                <div class="tab_content">
                                    <br>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>8. สำรวจพื้นที่เสี่ยง/ปัจจัยเสี่ยงรอบสถานศึกษา</h4>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="survey_student" value="1"> มี
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="survey_student" value="0"> ไม่มี
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8" style="padding-bottom: 1%">
                                            <h4>9. ตรวจเยี่ยม/ตรวจตราพื้นที่เสี่ยงรอบๆ สถานศึกษา</h4>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="advice_ck" value="1"> มี
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="advice_ck" value="0"> ไม่มี
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>10. กิจกรรมเพื่อป้องกันและเฝ้าระวังปัญหายาเสพติดร่วมกับผู้ประกอบการหอพัก
                                                ร้านเกมส์ <br>รอบสถานศึกษา</h4>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="risk_camp_ck" value="1"> มี
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="risk_camp_ck" value="0"> ไม่มี
                                        </div>
                                    </div>
                                </div>

                                {{-- tab 3 --}}
                                <div class="tab_content">
                                    <br>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>11. ตำรวจประสานงานประจำโรงเรียน</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>12. นักเรียนแกนนำ</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>13. ครูแกนนำ</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- tab 4 --}}
                                <div class="tab_content">
                                    <br>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>14. เครือข่ายผู้ปกครองในสถานศึกษาและชุมชน</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- tab 5 --}}
                                <div class="tab_content">
                                    <br>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>15. การสอนยาเสพติดในโรงเรียน</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- tab 6 --}}
                                <div class="tab_content">
                                    <br>
                                    <table class="table table-bordered text-nowrap w-100">
                                        <tr>
                                            <th>
                                                <h4>
                                                    18.
                                                    การรณรงค์ประชาสัมพันธ์และการให้ความรู้เกี่ยวกับยาเสพติดผ่านรูปแบบต่างๆ
                                                </h4>
                                            </th>
                                            <th colspan="4" style="text-align: center">ช่วงเวลากิจกรรม</th>
                                        </tr>
                                        <tr align="center">
                                            <td></td>
                                            <td>ระหว่างเรียน</td>
                                            <td>หลังเรียน</td>
                                            <td>ปิดภาคเรียน</td>
                                            <td>อื่น ๆ</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h4>18.1 ผ่านการอบรม/กิจกรรมค่ายต่างๆ ฯลฯ</h4>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" name="PR181_ck" value="1"> มี
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" name="PR181_ck" value="0"> ไม่มี
                                                    </div>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PR181_be_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PR181_af_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PR181_close_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PR181_other_class" value="1">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h4>18.2 ผ่านช่องทางสื่อออนไลน์</h4>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" name="PR182_ck" value="1"> มี
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" name="PR182_ck" value="0"> ไม่มี
                                                    </div>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PR182_be_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PR182_af_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PR182_close_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PR182_other_class" value="1">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h4>18.3 ผ่านสื่อทั่วไป</h4>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" name="PR183_ck" value="1"> มี
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" name="PR183_ck" value="0"> ไม่มี
                                                    </div>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PR183_be_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PR183_af_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PR183_close_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PR183_other_class" value="1">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h4>19. ศูนย์เพื่อนใจ TO BE NUMBER ONE</h4>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" name="ToBeNo_1_ck" value="1"> มี
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" name="ToBeNo_1_ck" value="0"> ไม่มี
                                                    </div>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="ToBeNo_1_be_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="ToBeNo_1_af_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="ToBeNo_1_close_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="ToBeNo_1_other_class" value="1">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h4>20. กลุ่มเพื่อนที่ปรึกษาเพื่อน(Youth Consuler)</h4>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" name="friend_ck" value="1"> มี
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" name="friend_ck" value="0"> ไม่มี
                                                    </div>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="friend_be_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="friend_af_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="friend_close_class" value="1">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="friend_other_class" value="1">
                                            </td>
                                        </tr>
                                    </table>

                                </div>

                                {{-- tab 7 --}}
                                <div class="tab_content">
                                    <br>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>28. นักศึกษาวิชาทหารมีการทำกิจกรรมด้านการป้องกันและแก้ไขปัญหายาเสพติด</h4>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="survey_student" value="1"> มี
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="survey_student" value="0"> ไม่มี
                                        </div>
                                    </div>
                                    <div class="card-footer" align="right">
                                        <button type="submit" class="btn btn-success-light mt-1">บันทึก</button>
                                        <a href="{{ route('admin.input.school') }}"
                                            class="btn btn-danger-light mt-1">ยกเลิก</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-1 CLOSED -->

    </div>
@endsection
