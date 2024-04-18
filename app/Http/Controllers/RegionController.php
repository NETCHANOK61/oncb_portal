<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Ampher;
use App\Models\EduArea;
use App\Models\PropertyType;
use App\Models\School48;
use App\Services\MenuService;

class RegionController extends Controller
{
    //
    public function getProvinces($region)
    {
        $provinces = Province::where('REG_ONCB', $region)->get();
        return response()->json($provinces);
    }

    public function getAmpher($province)
    {
        $amphers = Ampher::where('PROV_ID', $province)->get();
        return response()->json($amphers);
    }

    public function getSchool(Request $request)
    {
        $sch_level = [];
        if ($request->type == "school") {
            $sch_level = [1, 2, 3, 4, 5, 6, 7, 13, 14, 15];
        } else {
            $sch_level = [0];
        }

        // query data from School48 table 
        $schools = School48::where('prov_id', $request->provinceSelect)
            ->where('amp_id', $request->ampherSelect)
            ->where('checklist_edu', 1)
            ->where('Department_id', 9)
            ->whereIn('level_id', $sch_level)
            ->get();

        $menuItems = MenuService::getMenuItems();
        $province = Province::all();
        $amphers = Ampher::where('PROV_ID', $request->provinceSelect)->get();
        $type = $request->type;
        $notice = PropertyType::where('status', 1)->get();

        // return response()->json($schools);
        return view('admin.school.input_school', compact('menuItems', 'schools', 'province', 'amphers', 'type', 'notice'));
    }

    public function getEduArea($province)
    {
        $edu_area = EduArea::where('prov_id', $province)->get();
        return response()->json($edu_area);
    }

    public function getSchoolEdu($province, $edu_area)
    {
        $schools = School48::where('prov_id', $province)
            ->where('edu_area_id_new', $edu_area)
            ->get();
        return response()->json($schools);
    }
}
