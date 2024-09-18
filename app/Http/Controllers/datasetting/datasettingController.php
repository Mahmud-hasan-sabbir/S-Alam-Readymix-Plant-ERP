<?php

namespace App\Http\Controllers\datasetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SallerInformation;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\Designation;
use App\Models\datasetting\category;
use App\Models\datasetting\unit;
use App\Models\datasetting\materials;
use App\Models\datasetting\storeName;
use App\Models\datasetting\grade;


class datasettingController extends Controller
{
    public static $products, $product, $image, $imageName, $imageUrl, $directory;
    public function indexInformation($type)
    {

        $designation = Designation::all();
        $allInformation = SallerInformation::where('Category', $type)->where('Status','Active')->latest()->get();
        $allemployee = SallerInformation::where('Category', $type)->latest()->get();




        if ($type == 1) {
            return view('layouts.pages.datasetting.supplier.supplier_info',compact('type','allInformation'));
        } elseif ($type == 2) {
            return view('layouts.pages.datasetting.customer.customer_info',compact('type','allInformation'));
        } elseif ($type == 3) {
            return view('layouts.pages.datasetting.employee.employee_info',compact('type','designation','allemployee'));
        }
    }


    // public static function uploadImage($request, $product = null)
    // {
    //     self::$image = $request->file('image');
    //     if (self::$image) {
    //         if ($product) {
    //             if (file_exists($product->image)) {
    //                 unlink($product->image);
    //             }
    //         }
    //         self::$imageName = self::$image->getClientOriginalName();
    //         self::$directory = 'public/assets/images/upload-images/';
    //         self::$image->move(self::$directory, self::$imageName);
    //         self::$imageUrl = self::$directory . self::$imageName;
    //     } else {
    //         if ($product) {
    //             self::$imageUrl = $product->image;
    //         } else {
    //             self::$imageUrl = null;
    //         }
    //     }

    //     return self::$imageUrl;
    // }


    public static function uploadImages($request, $product = null)
    {
        // Add all the file fields you expect to handle
        $imageFields = ['security_cheque', 'bank_guaranty', 'attachment', 'work_order', 'nid','emp_image'];
        $uploadedImages = [];

        foreach ($imageFields as $field) {
            $file = $request->file($field);

            if ($file) {
                // If a file exists for this field, delete the old file
                if ($product && $product->$field) {
                    if (file_exists($product->$field)) {
                        unlink($product->$field);
                    }
                }

                // Upload new file
                $imageName = $file->getClientOriginalName();
                $directory = 'public/assets/images/upload-images/';
                $file->move($directory, $imageName);
                $imageUrl = $directory . $imageName;
            } else {
                // If no new file, keep the existing one
                if ($product) {
                    $imageUrl = $product->$field;
                } else {
                    $imageUrl = null;
                }
            }

            $uploadedImages[$field] = $imageUrl;
        }

        return $uploadedImages;
    }






    public function storeSaller(Request $request,$type)
    {
       try{

        if ($type == 1) {
            $saller = new SallerInformation();
            $saller->company_name = $request->com_name;
            $saller->contact_person = $request->contact_name;
            $saller->mobile_no = $request->mobile_no;
            $saller->Email = $request->email;
            $saller->Address = $request->address;


            $uploadedImages = self::uploadImages($request);

            $saller->security_cheque = $uploadedImages['security_cheque'];
            $saller->bank_guaranty = $uploadedImages['bank_guaranty'];
            $saller->attachment = $uploadedImages['attachment'];

            $saller->opening_date = $request->date;
            $saller->Status = $request->status;
            $saller->note = $request->note;
            $saller->Category = 1;
            $saller->user_id = Auth::user()->id;
            $saller->save();

            $notification = ['messege' => 'supplier save successfully', 'alert-type' => 'success'];
            return redirect()->route('information.index', ['cat_id' => 1])->with($notification);
        }


        if ($type == 2) {
            $saller = new SallerInformation();

            $saller->project_name = $request->project_name;
            $saller->company_name = $request->customer_name; // customer name
            $saller->contact_person = $request->contact_person;
            $saller->mobile_no = $request->mobile_no;
            $saller->Email = $request->email;
            $saller->Address = $request->site_location; 

            // Handle file uploads
            $uploadedImages = self::uploadImages($request);

            // Assign the uploaded file URLs to the model
            $saller->work_order = $uploadedImages['work_order'];
            $saller->nid = $uploadedImages['nid'];
            $saller->security_cheque = $uploadedImages['security_cheque'];
            $saller->bank_guaranty = $uploadedImages['bank_guaranty'];
            $saller->attachment = $uploadedImages['attachment'];

            // Other fields
            $saller->opening_date = $request->date;
            $saller->Status = $request->status;
            $saller->note = $request->note;
            $saller->Category = 2;
            $saller->user_id = Auth::user()->id;

            // Save the data to the database
            $saller->save();

            $notification = ['messege' => 'customer saved successfully', 'alert-type' => 'success'];
            return redirect()->route('information.index', ['cat_id' => 2])->with($notification);
        }


        if ($type == 3) {

            $saller = new SallerInformation();
            $saller->company_name = $request->name;
            $saller->mobile_no = $request->personalNumber;
            $saller->Email = $request->email;
            $saller->Address = $request->address;
            $saller->Designation = $request->employeeDesignation;

            // Handle file uploads
            $uploadedImages = self::uploadImages($request);

            // Assign the uploaded file URLs to the model
            $saller->nid = $uploadedImages['nid'];
            $saller->image = $uploadedImages['emp_image'];

            // Other fields
            $saller->Date_of_join = $request->Date_of_join;
            $saller->Status = $request->employeeStatus;
            $saller->Gender = $request->gender;
            $saller->salary = $request->salary;
            $saller->Category = 3;
            $saller->user_id = Auth::user()->id;
            $saller->save();

            $notification = ['messege' => 'employee saved successfully', 'alert-type' => 'success'];
            return redirect()->route('information.index', ['cat_id' => 3])->with($notification);
        }



       }catch(Exception $e){
        $notification = ['messege' => 'something want rong', 'alert-type' => 'error'];
        return redirect()->back()->with($notification);

       }

    }


    public function employeeDesignation()
    {
        $alldesignation = Designation::orderBy('id','DESC')->get();
        return view('layouts.pages.datasetting.designation',compact('alldesignation'));
    }

    public function storeDesignation(Request $request)
    {
        $designation = new Designation();
        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->status = $request->status;
        $designation->save();
        $notification = ['messege' => 'designation save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    public function getDesignationEdit(Request $request)
    {
        $getDesignation = Designation::where('id',$request->id)->first();
        return response()->json([
            'getDesignation' => $getDesignation,

        ]);
    }

    public function updateDesignation(Request $request)
    {
        $updateDesignation = Designation::find($request->hideId);
            $updateDesignation->update([
                'name' => $request->newName,
                'description' => $request->newRemarks,
                'status' => $request->newStatus,
            ]);

            $notification = ['messege' => 'designation update save successfully', 'alert-type' => 'success'];
            return redirect()->back()->with($notification);

    }

    public function supplierEdit($id)
    {
       $supplierEdit = SallerInformation::find($id);
       return view('layouts.pages.datasetting.supplier.edit', compact('supplierEdit'));
    }

    public function updateSupplier(Request $request, $id)
    {
        try {
            $supplierUpdate = SallerInformation::find($id);

            $supplierUpdate->company_name = $request->com_name;
            $supplierUpdate->contact_person = $request->contact_name;
            $supplierUpdate->mobile_no = $request->mobile_no;
            $supplierUpdate->Email = $request->email;
            $supplierUpdate->Address = $request->address;

            // Handle file uploads
            $uploadedImages = self::uploadImages($request, $supplierUpdate);

            $supplierUpdate->security_cheque = $uploadedImages['security_cheque'] ?? $supplierUpdate->security_cheque;
            $supplierUpdate->bank_guaranty = $uploadedImages['bank_guaranty'] ?? $supplierUpdate->bank_guaranty;
            $supplierUpdate->attachment = $uploadedImages['attachment'] ?? $supplierUpdate->attachment;

            $supplierUpdate->opening_date = $request->date;
            $supplierUpdate->Status = $request->status;
            $supplierUpdate->note = $request->note;
            $supplierUpdate->Category = 1;
            $supplierUpdate->user_id = Auth::user()->id;
            $supplierUpdate->save();

            $notification = ['messege' => 'Supplier update saved successfully', 'alert-type' => 'success'];
            return redirect()->route('information.index', ['cat_id' => 1])->with($notification);

        } catch (Exception $e) {
            $notification = ['messege' => 'Something went wrong', 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }



    public function supplierView($id)
    {
       $supplierView = SallerInformation::find($id);
       return view('layouts.pages.datasetting.supplier.view', compact('supplierView'));
    }

    public function customerEdit($id)
    {

        $customerEdit = SallerInformation::find($id);
        // return $employeeEdit;
        return view('layouts.pages.datasetting.customer.edit', compact('customerEdit'));
    }

    public function customerUpdate(Request $request , $id)
    {
        try {
            $customerUpdate = SallerInformation::find($id);

            $customerUpdate->project_name = $request->project_name;
            $customerUpdate->company_name = $request->customer_name;
            $customerUpdate->contact_person = $request->contact_person;
            $customerUpdate->mobile_no = $request->mobile_no;
            $customerUpdate->Email = $request->email;
            $customerUpdate->Address = $request->site_location;
            // Handle file uploads
            $uploadedImages = self::uploadImages($request, $customerUpdate);

            $customerUpdate->work_order = $uploadedImages['work_order'] ?? $customerUpdate->work_order;
            $customerUpdate->nid = $uploadedImages['nid'] ?? $customerUpdate->nid;
            $customerUpdate->security_cheque = $uploadedImages['security_cheque'] ?? $customerUpdate->security_cheque;
            $customerUpdate->bank_guaranty = $uploadedImages['bank_guaranty'] ?? $customerUpdate->bank_guaranty;
            $customerUpdate->attachment = $uploadedImages['attachment'] ?? $customerUpdate->attachment;


            $customerUpdate->opening_date = $request->date;
            $customerUpdate->Status = $request->status;
            $customerUpdate->note = $request->note;
            $customerUpdate->Category = 2;
            $customerUpdate->user_id = Auth::user()->id;
            $customerUpdate->save();

            $notification = ['messege' => 'customer update saved successfully', 'alert-type' => 'success'];
            return redirect()->route('information.index', ['cat_id' => 2])->with($notification);

        } catch (Exception $e) {
            $notification = ['messege' => 'Something went wrong', 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }


    public function customerView($id)
    {
        $customerView = SallerInformation::with('desig')->find($id);
        return view('layouts.pages.datasetting.customer.view', compact('customerView'));
    }

    public function employeeEdit($id)
    {
        $allDesignation = Designation::all();
        $employeeEdit = SallerInformation::find($id);
        return view('layouts.pages.datasetting.employee.edit', compact('employeeEdit','allDesignation'));
    }

    public function updateEmployee(Request $request , $id)
    { 
        try {
            $employeeupdate = SallerInformation::find($id);
            $employeeupdate->company_name = $request->name;
            $employeeupdate->mobile_no = $request->personalNumber;
            $employeeupdate->Email = $request->email;
            $employeeupdate->Address = $request->address;
            $employeeupdate->Designation = $request->employeeDesignation;

            // Handle file uploads
            $uploadedImages = self::uploadImages($request, $employeeupdate);

            // Assign the uploaded file URLs to the model
            $employeeupdate->image = $uploadedImages['emp_image'] ?? $employeeupdate->image;
            $employeeupdate->nid = $uploadedImages['nid'] ?? $employeeupdate->nid;

            // Other fields
            $employeeupdate->Date_of_join = $request->Date_of_join;
            $employeeupdate->Status = $request->employeeStatus;
            $employeeupdate->Gender = $request->gender;
            $employeeupdate->salary = $request->salary;
            $employeeupdate->Category = 3;
            $employeeupdate->user_id = Auth::user()->id;
            $employeeupdate->save();

            $notification = ['messege' => 'employee update successfully', 'alert-type' => 'success'];
            return redirect()->route('information.index', ['cat_id' => 3])->with($notification);

        } catch (Exception $e) {
            $notification = ['messege' => 'Something went wrong', 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }




           
    }


    public function employeeView($id)
    {
        $allDesignation = Designation::all();
        $employeeview = SallerInformation::find($id);

        return view('layouts.pages.datasetting.employee.view', compact('employeeview','allDesignation'));
    }


    // category function

    public function category()
    {
        $allCategory = category::orderBy('id','DESC')->get();
        return view('layouts.pages.datasetting.category.category',compact('allCategory'));
    }

    public function storeCategory(Request $request)
    {
        $designation = new category();
        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->status = $request->status;
        $designation->save();
        $notification = ['messege' => 'Category save successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    public function getCategoryEdit(Request $request)
    {
        $getcategory = category::where('id',$request->id)->first();
        return response()->json([
            'getcategory' => $getcategory,

        ]);
    }


    public function updateCategory(Request $request)
    {
        $updateDesignation = category::find($request->hideId);
            $updateDesignation->update([
                'name' => $request->newName,
                'description' => $request->newRemarks,
                'status' => $request->newStatus,
            ]);

            $notification = ['messege' => 'Category update save successfully', 'alert-type' => 'success'];
            return redirect()->back()->with($notification);

    }


     // Unit function

     public function unit()
     {
         $allunit = unit::orderBy('id','DESC')->get();
         return view('layouts.pages.datasetting.unit.unit',compact('allunit'));
     }

     public function storeUnit(Request $request)
     {
         $designation = new unit();
         $designation->name = $request->name;
         $designation->description = $request->description;
         $designation->status = $request->status;
         $designation->save();
         $notification = ['messege' => 'Unit save successfully', 'alert-type' => 'success'];
         return redirect()->back()->with($notification);

     }

     public function getUnitEdit(Request $request)
     {
         $getunit = unit::where('id',$request->id)->first();
         return response()->json([
             'getunit' => $getunit,

         ]);
     }


     public function updateUnit(Request $request)
     {
         $updateunit = unit::find($request->hideId);
             $updateunit->update([
                 'name' => $request->newName,
                 'description' => $request->newRemarks,
                 'status' => $request->newStatus,
             ]);

             $notification = ['messege' => 'Unit update save successfully', 'alert-type' => 'success'];
             return redirect()->back()->with($notification);

     }

     // Materials function

     public function materials()
     {
         $allmaterials = materials::with('categoryName')->orderBy('id','DESC')->get();
         $allcategory = category::all();
         return view('layouts.pages.datasetting.materials.materials',compact('allmaterials','allcategory'));
     }

     public function storeMaterials(Request $request)
     {
         $designation = new materials();
         $designation->category_id = $request->category_id;
         $designation->name = $request->name;
         $designation->description = $request->description;
         $designation->status = $request->status;
         $designation->save();
         $notification = ['messege' => 'Materials save successfully', 'alert-type' => 'success'];
         return redirect()->back()->with($notification);

     }

     public function getMaterialsEdit(Request $request)
     {
         $getmaterials = materials::where('id',$request->id)->first();
         return response()->json([
             'getmaterials' => $getmaterials,

         ]);
     }

     public function updateMaterials(Request $request)
     {
         $updatematerials = materials::find($request->hideId);
             $updatematerials->update([
                 'category_id' => $request->category_id,
                 'name' => $request->newName,
                 'description' => $request->newRemarks,
                 'status' => $request->newStatus,
             ]);

             $notification = ['messege' => 'Materials update save successfully', 'alert-type' => 'success'];
             return redirect()->back()->with($notification);

     }


      // store name function

      public function storeName()
      {
          $allstore = storeName::orderBy('id','DESC')->get();
          return view('layouts.pages.datasetting.store_name.store_name',compact('allstore'));
      }

      public function storeNamesave(Request $request)
      {
          $designation = new storeName();
          $designation->name = $request->name;
          $designation->description = $request->description;
          $designation->status = $request->status;
          $designation->save();
          $notification = ['messege' => 'Store Name save successfully', 'alert-type' => 'success'];
          return redirect()->back()->with($notification);

      }

      public function getStoreEdit(Request $request)
      {
          $getstore = storeName::where('id',$request->id)->first();
          return response()->json([
              'getstore' => $getstore,

          ]);
      }


      public function updateStore(Request $request)
      {
          $updateunit = storeName::find($request->hideId);
              $updateunit->update([
                  'name' => $request->newName,
                  'description' => $request->newRemarks,
                  'status' => $request->newStatus,
              ]);

              $notification = ['messege' => 'Store update save successfully', 'alert-type' => 'success'];
              return redirect()->back()->with($notification);

      }


      // grade name function

      public function gradeName()
      {
          $allgrade = grade::orderBy('id','DESC')->get();
          return view('layouts.pages.datasetting.grade_name.grade_name',compact('allgrade'));
      }

      public function gradeStoreName(Request $request)
      {
          $designation = new grade();
          $designation->name = $request->name;
          $designation->description = $request->description;
          $designation->status = $request->status;
          $designation->save();
          $notification = ['messege' => 'grade Name save successfully', 'alert-type' => 'success'];
          return redirect()->back()->with($notification);

      }

      public function getGradeEdit(Request $request)
      {
          $getgrade = grade::where('id',$request->id)->first();
          return response()->json([
              'getgrade' => $getgrade,

          ]);
      }


      public function updateGrade(Request $request)
      {
          $updateunit = grade::find($request->hideId);
              $updateunit->update([
                  'name' => $request->newName,
                  'description' => $request->newRemarks,
                  'status' => $request->newStatus,
              ]);

              $notification = ['messege' => 'grade update save successfully', 'alert-type' => 'success'];
              return redirect()->back()->with($notification);

      }


      public function inactiveSupplier()
      {
            $inactiveSupplier = SallerInformation::where('Category',1)->where('Status','Inactive')->latest()->get();
            return view('layouts.pages.datasetting.supplier.inactive_supplier',compact('inactiveSupplier'));
      }

      public function inactiveCustomer()
      {
            $inactivecustomer = SallerInformation::where('Category',2)->where('Status','Inactive')->latest()->get();
            return view('layouts.pages.datasetting.customer.inactive_customer',compact('inactivecustomer'));
      }


















}
