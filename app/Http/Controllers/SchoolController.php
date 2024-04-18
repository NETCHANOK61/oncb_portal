<?php

namespace App\Http\Controllers;

use App\Models\FormInput;
use App\Models\Menu;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\School48;
use App\Models\SchoolMinistry;
use App\Models\SchoolDepartment;
use App\Models\SchoolLevel;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class SchoolController extends Controller
{
    //
    public function index(Request $request)
    {
        // Retrieve provinces table data
        $provinces = Province::where('PROV_ID', '!=', '00')->pluck('PROV_NAME', 'PROV_ID')->toArray();
        $provincesTable = [];
        foreach ($provinces as $key => $value) {
            $provincesTable[strtolower($key)] = $value;
        }

        // Retrieve ministries table data
        $ministries = SchoolMinistry::where('ministry_id', '!=', '00')->get();
        $ministriesTable = [];
        foreach ($ministries as $ministry) {
            $ministriesTable[$ministry->ministry_id] = [
                'ministry_id' => $ministry->ministry_id,
                'ministry_name' => $ministry->ministry_name // Adjust the attribute names as per your database schema
            ];
        }

        // Retrieve departments table data
        $departments = SchoolDepartment::where('department_id', '!=', '00')->get();
        $departmentsTable = [];
        foreach ($departments as $department) {
            $departmentsTable[$department->department_id] = [
                'department_id' => $department->department_id,
                'department_name' => $department->department_name,
                'short_name' => $department->short_name,
                'ministry_id' => $department->ministry_id // Make sure these are your actual column names
            ];
        }

        
        // Retrieve ministries table data
        $levels = SchoolLevel::where('level_id', '!=', 'XX')->get();
        $levelsTable = [];
        foreach ($levels as $level) {
            $levelsTable[$level->level_id] = [
                'level_id' => $level->level_id,
                'level_name' => $level->level_name // Adjust the attribute names as per your database schema
            ];
        }

        $query = School48::query();
        $menu = Menu::all();
        $menuItems = MenuService::getMenuItems();

        // Existing search term filter
        if ($searchTerm = $request->input('search')) {
            $query->where('Thai_Name', 'LIKE', '%' . $searchTerm . '%');
        }

        // New Year filter
        if ($year = $request->input('year')) {
            $query->where('Years', $year);
        }

        // New Ministry_id filter, with 'other' handling
        if ($ministryId = $request->input('ministry_id')) {
            if ($ministryId == 'other') {
                $query->where(function ($q) {
                    $q->whereNull('Ministry_id')->orWhere('Ministry_id', 0);
                });
            } else {
                $query->where('Ministry_id', $ministryId);
            }
        }

        // New Department_id filter, with 'other' handling
        if ($departmentId = $request->input('department_id')) {
            if ($departmentId == 'other') {
                $query->where(function ($q) {
                    $q->whereNull('Department_id')->orWhere('Department_id', 0);
                });
            } else {
                $query->where('Department_id', $departmentId);
            }
        }

        // New Department_id filter, with 'other' handling
        if ($departmentId = $request->input('department_id')) {
            if ($departmentId == 'other') {
                $query->where(function ($q) {
                    $q->whereNull('Department_id')->orWhere('Department_id', 0);
                });
            } else {
                $query->where('Department_id', $departmentId);
            }
        }

        // New prov_id filter, with 'other' handling
        if ($departmentId = $request->input('prov_id')) {
            if ($departmentId == 'other') {
                $query->where(function ($q) {
                    $q->whereNull('prov_id')->orWhere('prov_id', 0);
                });
            } else {
                $query->where('prov_id', $departmentId);
            }
        }
                
        $query->where('ID', '!=', 0);

        // Sorting by Thai_Name
        $query->orderBy('Thai_Name', 'asc');

        // Limit to 100 records
        $schools = $query->limit(500)->get(); //DO NOT SET limit >= 1000

        return view('admin.school.main', compact('schools', 'menu', 'menuItems', 'ministriesTable', 'departmentsTable', 'provincesTable', 'levelsTable'));
    }

    // Method to toggle active status
    public function toggleActive(Request $request)
    {
        // Retrieve active status data from the request
        $activeStatusData = $request->input('active_status', '[]');
        
        // Ensure the data is a string
        if (!is_string($activeStatusData)) {
            return redirect()->back()->with('error', 'Invalid input type.');
        }

        // Decode JSON string to PHP array
        $activeStatuses = json_decode($activeStatusData, true);

    // Check if json_decode was successful and $activeStatuses is an array
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($activeStatuses)) {
        return redirect()->back()->with('error', 'Invalid data received.');
    }

    // Loop through each school ID and toggle the active status
    foreach ($activeStatuses as $schoolId) {
        $school = School48::find($schoolId); // Find the school by its ID
        if ($school) {
            // Debugging line, remove or comment out for production
            // dd($school);

            $school->active_status = $school->active_status == 1 ? 0 : 1; // Toggle the active_status

            $school->save(); // Save the changes to the database
        }
    }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Changes saved successfully.');
    }

    // Method to create a new school with auto-incremented ID
    public function create(Request $request)
    {
        // Validation rules for creating a school
        $validator = Validator::make($request->all(), [
            'Thai_Name' => 'required|string|max:255',
            // Add more validation rules for other fields as needed
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Execute the raw SQL query
        $maxIdResult = DB::select("SELECT TOP 1 ID FROM tblSchool48 ORDER BY CAST(ID AS INT) DESC;");
        $maxId = $maxIdResult[0]->ID;
        $maxId = intval($maxId);
        $nextId = $maxId + 1;
    
        // Create a new school instance
        $school = new School48();
        $school->ID = $nextId; // Assign the next ID
        $school->fill($request->all());
    
        // Save the school
        $school->save();
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'School created successfully.')
            ->with('nextId', $nextId); // Pass the next ID to the view
    }
    


    // Method to update an existing school by ID
    public function update(Request $request, $id)
    {
        // Find the school by ID
        $school = School48::findOrFail($id);

        // Validation rules for updating a school
        $validator = Validator::make($request->all(), [
            'Thai_Name' => 'required|string|max:255',
            // Add more validation rules for other fields as needed
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update school fields
        $school->fill($request->all());

        // Save the changes
        $school->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'School updated successfully.');
    }

    // Method to delete an existing school by ID
    public function destroy($id)
    {
        // Find the school by ID and delete it
        School48::findOrFail($id)->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'School deleted successfully.');
    }

    // Method to get a school by ID
    public function getById($id)
    {
        // Find the school by ID
        $school = School48::findOrFail($id);

        // Return the school data
        return response()->json($school);
    }

    public function testing()
    {
        return view('admin.school.school_testing');
    }


    
    public function inputSchool()
    {
        $menuItems = MenuService::getMenuItems();
        $province = Province::all();
        $type = "school";
        $notice = PropertyType::where('status', 1)->get();

        return view('admin.school.input_school', compact('menuItems', 'province', 'type', 'notice'));
    }

    public function editSchool(String $id)
    {
        $menuItems = MenuService::getMenuItems();
        $school = School48::findOrFail($id);

        if ($school->level_id == 0) {
            return view('admin.school.child_edit', compact('menuItems', 'school'));
        } else if (in_array($school->level_id, [1, 2, 3, 4, 5, 6, 7, 13, 14, 15])) {
            return view('admin.school.school_edit', compact('menuItems', 'school'));
        }
    }

    public function progressSchool(String $id)
    {
        $menuItems = MenuService::getMenuItems();
        $school = School48::findOrFail($id);

        $data = FormInput::where('table_name', 'tbl_Pr_school_test')->get();

        $combinedData = [];

        foreach ($data as $item) {
            $combinedData[] = [
                'label_name' => $item->label_name,
                'data_type' => $item->field_type
            ];
        }

        return view('admin.school.progress', compact('menuItems', 'school', 'combinedData'));
    }
}
