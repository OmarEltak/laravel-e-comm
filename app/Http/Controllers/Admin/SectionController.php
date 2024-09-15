<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Session;

class SectionController extends Controller
{
    public function sections(){
        Session::put('page', 'sections');
        $sections = Section::get();
        return view('admin.sections.sections')->with(compact('sections'));
    
    }

    public function updateSectionStatus(Request $request){
        if ($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Section::where('id', $data['section_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
        }
    }

    public function addEditSection(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Section";
            $section = new Section;
            $section->status = 1; // Set default status
            $getSections = array(); // Initialize an empty array for Sections
        } else {
            $title = "Edit Section";
            $section = Section::find($id);
            $getSections = Section::with('subSections')->where(['parent_id' => 0, 'section_id' => $section->section_id])->get();
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'section_name' => 'required|string|max:255',
                'status' => 'nullable|integer',
                'section_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ];
            

            
            $request->validate($rules);
            
            // Upload Section Image
            if ($request->hasFile('section_image')) {
                $image_tmp = $request->file('section_image');
                if ($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin/images/section_image/' . $imageName;
                    // Upload the Image
                    $image_tmp->move(public_path('admin/images/section_image'), $imageName);
                    // Save Section image in database
                    $section->section_image = $imageName?? $section->section_image;

                }
            }
            
            $section->section_name = $data['section_name'];
            $section->status = $data['status'] ?? 1; // Set status from request or default to 1
            $section->save();
            

            // Clear old input data after successful form submission
            $request->session()->forget('_old_input');

            // Redirect to a different page after successful form submission
            return redirect()->route('sections.index')->with('success', 'section saved successfully.');
        }

        // Get all Sections
        $getSections = Section::get();

        return view('admin.Sections.add_edit_section')->with(compact('title', 'getSections', 'section', 'getSections'));
    }


}
