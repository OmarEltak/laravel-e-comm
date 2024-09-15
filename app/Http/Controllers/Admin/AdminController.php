<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin; // Import the Admin model
use Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;



class AdminController extends Controller
{
    public function dashboard()
    {
        Session::put('page','dashboard');
        return view('admin.dashbard');
    }
    
    public function logout()
    {
        Auth::guard('admin')->logout();
        return view('admin.adminlogin');
    }

    public function settings()
    {
        session::put('page','settings');

        // echo "<pre>"; print_r(Auth::guard('admin')->user());die;
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_settings')->with(compact('adminDetails'));
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' =>'required|email|max:255',
                'password' => 'required'                
            ];

            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Please enter a valid email address',
                'email.max' => 'Email should not exceed 255 characters',
                'password.required' => 'Password is required'
            ];
            
            $this->validate($request, $rules, $customMessages);
            
            // Auth::logout(); // Logout any previous session

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return view('admin.dashbard');
            } else {
                return Redirect::route('admin.login')->withErrors(['error_message' => 'Invalid Email or Password']);
                return redirect()->back();
            }
        }

        return view('admin.adminLogin');
    }
    public function chkCurrentPassword(Request $request){
        $data = $request->all();

        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
            echo "true";
        }else{
            echo "false";
        }
    }

    public function updateCurrentPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all(); 
            // current password not correct   
            if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
                // Check if new password and confirm password are matching
                if($data['new_pwd'] == $data['confirm_pwd']){
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' =>bcrypt($data['new_pwd'])]);
                    session::flash('success_message', 'Your Password has been updated successfully');
                } else{
                    session::flash('error_message', 'New Password and Confirm Password do not match');
                 }
             }else{
                session::flash('error_message', 'Your Current Password is Incorrect');
           }
        return redirect()->back();
    }
  }
  public function updateAdminDetails(Request $request){
    Session::put('page','update-admin-details');

    if($request->isMethod('POST')){
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        $rules = [
        'admin_name' =>'required|min:3|regex:/^[\pL\s\-]+$/u',
        // 'ademail' =>'required|email|unique:admins,email,'.Auth::guard('admin')->user()->id,
        'admin_mobile' =>'required|numeric',
        'admin_image' =>'image',
    ];
        $customMessages = [
            'admin_name' => 'Valid Name is required',
            'admin_image.image' => 'Valid image is required',
            'admin_name.min' => 'Name should be at least 3 characters',
            'admin_name.alpha' => 'Name should contain only alphabets',
            'admin_email.required' => 'Email is required',
            'admin_email.email' => 'Please enter a valid email address',
            'admin_email.unique' => 'Email already exists',
            'admin_mobile.required' => 'Contact Number is required',
            'admin_mobile.numeric' => 'Contact Number should only contain digits',
        ];
        
        $this->validate($request, $rules, $customMessages);

        // Upload Image
        // if($request->hasFile('admin_image')){
        //     $image_tmp = $request->file('admin_image');
        //     if($image_tmp->isValid()){
        //         // Get Image Extension
        //         $extension = $image_tmp->getClientOriginalExtension();
        //         // Generate New Image Name
        //         $imageName = rand(111,99999).'.'.$extension;
        //         $imagePath = 'images/admin_images/admin_photos/'.$imageName;
        //         // Upload the Image
        //         Image::make($image_tmp)->save($imagePath);
        //     }
        // }else if(!empty($data['current_admin_image'])){
        //     $imageName = $data['current_admin_image'];
        // }else{
        //     $imageName = "";
        // }
        if ($request->hasFile('admin_image')) {
            $image = $request->file('admin_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('admin/images/admin_photos/' . $imageName);
            
             // Resize the image
            $resizedImage = Image::make($image)->resize(300, 400);

            // Save the image to the specified path
            $image->move(public_path('admin/images/admin_photos'), $imageName);
        } else if (!empty($data['current_admin_image'])) {
            $imagePath = 'admin/images/admin_photos/' . $data['current_admin_image'];
        } else {
            $imagePath = null;
        }
        
        // Update the admin details with the image path
        Admin::where('email', Auth::guard('admin')->user()->email)
            ->update([
                'name' => $data['admin_name'],
                'mobile' => $data['admin_mobile'],
                'image' => $imagePath,
            ]);
        
        
    
        

        // update admin details
        Admin::where('email', Auth::guard('admin')->user()->email)
        ->update(['name' => $data['admin_name'],'mobile' => $data['admin_mobile'], 'image' => $imageName]);
        session::flash('success_message', 'Admin Details Updated Successfully!');
        return redirect()->back();
    }
    return view('admin.update_admin_details');
  }
};