<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash; // For password hashing
use Illuminate\Support\Str; // For generating unique file names
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\File; // For file operations (delete)

use App\Exports\CustomerExport; 
class CustomerController extends Controller
{
      function __construct()
    {
         $this->middleware('permission:customerView|customerAdd|customerUpdate|customerDelete', ['only' => ['index','store','destroy','update']]);
         $this->middleware('permission:customerAdd', ['only' => ['create','store']]);
         $this->middleware('permission:customerUpdate', ['only' => ['edit','update']]);
         $this->middleware('permission:customerDelete', ['only' => ['destroy']]);
    }

    public function create(){
 return view('admin.customer.create');
    }

      public function index(Request $request)
    {
        // Check if the request is an AJAX request for data
        if ($request->ajax()) {
            if(Auth::user()->id == 1){
            $query = Customer::query();
            }else{
              $query = Customer::query()->where('admin_id',Auth::user()->id);  
            }

            // Apply search filter
            if ($request->has('search') && $request->input('search') != '') {
                $searchTerm = $request->input('search');
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $searchTerm . '%')
                      ->orWhere('phone', 'like', '%' . $searchTerm . '%');
            }

            // Apply sorting (if implemented in frontend and passed as params)
            // Example: ?sort_by=name&sort_order=asc
            if ($request->has('sort_by') && $request->has('sort_order')) {
                $sortBy = $request->input('sort_by');
                $sortOrder = $request->input('sort_order');
                $query->orderBy($sortBy, $sortOrder);
            } else {
                $query->orderBy('id', 'desc'); // Default sort
            }


            // Apply pagination
            $perPage = $request->input('per_page', 10); // Default to 10 rows per page
            $customers = $query->paginate($perPage);

            // Return paginated data as JSON
            return response()->json([
                'data' => $customers->items(), // Actual customer data for current page
                'current_page' => $customers->currentPage(),
                'last_page' => $customers->lastPage(),
                'total' => $customers->total(),
                'per_page' => $customers->perPage(),
            ]);
        }

        // If it's not an AJAX request, return the Blade view for the initial page load.
        return view('admin.customer.index');
    }



    public function edit($id)
{
    // This will return the view for editing the customer
    // Laravel's Route Model Binding injects the $customer automatically
 if(Auth::user()->id == 1){
                $customer = Customer::where('id',$id)->first();
               }else{
    $customer = Customer::where('admin_id',Auth::user()->id)->where('id',$id)->first();
               }
    return view('admin.customer.edit', compact('customer'));
}

public function show($id)
{
    // This will return the view for displaying customer details
    // Laravel's Route Model Binding injects the $customer automatically
               if(Auth::user()->id == 1){
                $customer = Customer::where('id',$id)->first();
               }else{
    $customer = Customer::where('admin_id',Auth::user()->id)->where('id',$id)->first();
               }
    return view('admin.customer.show', compact('customer'));
}


    public function store(Request $request)
    {
        // 1. Validate the incoming request data for Customer
        $validatedCustomerData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('customers', 'email'), // Ensure email is unique in customers table
                Rule::unique('users', 'email'),     // Ensure email is also unique in users table
            ],
            'status' => 'nullable|string|in:active,inactive', // Assuming these are your valid statuses
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB Max
            'nid_front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nid_back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Handle image uploads directly to the public folder using Intervention Image
        $customerImagePath = null;
        $customerImageDir = 'uploads/customer_images/'; // Directory inside public folder
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_customer_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = public_path($customerImageDir . $fileName);

            // Ensure the directory exists
            if (!File::isDirectory(public_path($customerImageDir))) { // Use File facade
                File::makeDirectory(public_path($customerImageDir), 0777, true, true);
            }

            Image::read($image)->save($path);
            $customerImagePath = $customerImageDir . $fileName; // Store relative path in DB
        }

        $nidFrontImagePath = null;
        $nidImageDir = 'uploads/nid_images/'; // Directory inside public folder for NID images
        if ($request->hasFile('nid_front_image')) {
            $image = $request->file('nid_front_image');
            $fileName = time() . '_nid_front_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = public_path($nidImageDir . $fileName);

            // Ensure the directory exists
            if (!File::isDirectory(public_path($nidImageDir))) { // Use File facade
                File::makeDirectory(public_path($nidImageDir), 0777, true, true);
            }

            Image::read($image)->save($path);
            $nidFrontImagePath = $nidImageDir . $fileName; // Store relative path in DB
        }

        $nidBackImagePath = null;
        if ($request->hasFile('nid_back_image')) {
            $image = $request->file('nid_back_image');
            $fileName = time() . '_nid_back_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = public_path($nidImageDir . $fileName);

            // Ensure the directory exists
            if (!File::isDirectory(public_path($nidImageDir))) { // Use File facade
                File::makeDirectory(public_path($nidImageDir), 0777, true, true);
            }

            Image::read($image)->save($path);
            $nidBackImagePath = $nidImageDir . $fileName; // Store relative path in DB
        }

        // 3. Create a new Customer record
        $customer = Customer::create([
            'name' => $validatedCustomerData['name'],
            'address' => $validatedCustomerData['address'] ?? null, // Use null for nullable fields if not present
            'phone' => $validatedCustomerData['phone'] ?? null,
            'email' => $validatedCustomerData['email'],
            'status' => $validatedCustomerData['status'] ?? 'inactive', // Default status if not provided
            'image' => $customerImagePath,
            'admin_id' => Auth::user()->id,
            'nid_front_image' => $nidFrontImagePath,
            'nid_back_image' => $nidBackImagePath,
        ]);

        // 4. Create a new User record associated with the customer
        $defaultPassword = '12345678';
        User::create([
            'name' => $validatedCustomerData['name'],
            'phone' => $validatedCustomerData['phone'] ?? null,
            'email' => $validatedCustomerData['email'],
            'password' => Hash::make($defaultPassword), // Always hash the password
            'viewpassword' => $defaultPassword,          // Store plain text for viewpassword as per request
            'customer_id' => $customer->id,              // Link to the newly created customer
            'user_type' => 2,                             // As specified, user_type will always be 2
        ]);

        // 5. Redirect back with a success message
        return redirect()->back()->with('success', 'Customer and associated user added successfully!');
    }

    public function update(Request $request,$id)
    {

        //dd($request->all());
        // 1. Validate the incoming request data for Customer update
        // The email validation needs to ignore the current customer's and user's email
        $validatedCustomerData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'status' => 'nullable|string|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nid_front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nid_back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
$customer= Customer::find($id);
        // 2. Handle image updates
        $customerImagePath = $customer->image; // Keep existing path by default
        $customerImageDir = 'uploads/customer_images/';
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($customer->image && File::exists(public_path($customer->image))) {
                File::delete(public_path($customer->image));
            }

            $image = $request->file('image');
            $fileName = time() . '_customer_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = public_path($customerImageDir . $fileName);

            if (!File::isDirectory(public_path($customerImageDir))) {
                File::makeDirectory(public_path($customerImageDir), 0777, true, true);
            }

            Image::read($image)->save($path);
            $customerImagePath = $customerImageDir . $fileName;
        }

        $nidFrontImagePath = $customer->nid_front_image;
        $nidImageDir = 'uploads/nid_images/';
        if ($request->hasFile('nid_front_image')) {
            if ($customer->nid_front_image && File::exists(public_path($customer->nid_front_image))) {
                File::delete(public_path($customer->nid_front_image));
            }

            $image = $request->file('nid_front_image');
            $fileName = time() . '_nid_front_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = public_path($nidImageDir . $fileName);

            if (!File::isDirectory(public_path($nidImageDir))) {
                File::makeDirectory(public_path($nidImageDir), 0777, true, true);
            }

            Image::read($image)->save($path);
            $nidFrontImagePath = $nidImageDir . $fileName;
        }

        $nidBackImagePath = $customer->nid_back_image;
        if ($request->hasFile('nid_back_image')) {
            if ($customer->nid_back_image && File::exists(public_path($customer->nid_back_image))) {
                File::delete(public_path($customer->nid_back_image));
            }

            $image = $request->file('nid_back_image');
            $fileName = time() . '_nid_back_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = public_path($nidImageDir . $fileName);

            if (!File::isDirectory(public_path($nidImageDir))) {
                File::makeDirectory(public_path($nidImageDir), 0777, true, true);
            }

            Image::read($image)->save($path);
            $nidBackImagePath = $nidImageDir . $fileName;
        }

        // 3. Update the Customer record
        
        $customer->update([
            'name' => $validatedCustomerData['name'],
            'address' => $validatedCustomerData['address'] ?? null,
            'phone' => $validatedCustomerData['phone'] ?? null,
            'email' => $validatedCustomerData['email'],
            'status' => $validatedCustomerData['status'] ?? 'inactive',
            'image' => $customerImagePath,
            'nid_front_image' => $nidFrontImagePath,
            'nid_back_image' => $nidBackImagePath,
        ]);



        $user = User::where('customer_id',$id)->first();

      

        if ($user) {
            $user->update([
                'name' => $validatedCustomerData['name'],
                'phone' => $validatedCustomerData['phone'] ?? null,
                'email' => $validatedCustomerData['email'],
                // Password and user_type are kept constant as per previous request,
                // but you might want to add options to update them if needed.
            ]);
        }

        // 5. Redirect back with a success message
        return redirect()->route('customer.index')->with('success', 'Customer and associated user updated successfully!');
    }

    public function destroy(Customer $customer)
    {
        // 1. Delete associated images from the public folder
        if ($customer->image && File::exists(public_path($customer->image))) {
            File::delete(public_path($customer->image));
        }
        if ($customer->nid_front_image && File::exists(public_path($customer->nid_front_image))) {
            File::delete(public_path($customer->nid_front_image));
        }
        if ($customer->nid_back_image && File::exists(public_path($customer->nid_back_image))) {
            File::delete(public_path($customer->nid_back_image));
        }

        // 2. Delete the associated User record
        if ($customer->user) {
            $customer->user->delete();
        }

        // 3. Delete the Customer record
        $customer->delete();

        // 4. Redirect back with a success message
        return redirect()->back()->with('success', 'Customer and associated user deleted successfully!');
    }

     public function checkEmailUniqueness(Request $request)
    {
        $email = $request->query('email'); // For GET request

        // Basic email validation
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['unique' => false, 'message' => 'Invalid email format.'], 422);
        }

        // Check uniqueness in both customers and users table
        $isCustomerEmailUnique = !Customer::where('email', $email)->exists();
        $isUserEmailUnique = !User::where('email', $email)->exists();

        // Email is unique if it doesn't exist in EITHER table
        $isUnique = $isCustomerEmailUnique && $isUserEmailUnique;

        return response()->json(['unique' => $isUnique]);
    }


     public function exportCustomers(Request $request)
    {
        $type = $request->query('type'); // Get the export type from query string

        if ($type === 'excel') {
            return Excel::download(new CustomerExport, 'customers.xlsx');
        } elseif ($type === 'pdf') {


     
      $customers = Customer::all();

      $data = view('admin.customer._partial.pdfSheet', ['customers' => $customers])->render();

      $file_Name_Custome = 'customerList';
      $pdfFilePath =$file_Name_Custome.'.pdf';


       $mpdf = new Mpdf([ 'default_font_size' => 14,'default_font' => 'nikosh']);
       $mpdf->WriteHTML($data);
       $mpdf->Output($pdfFilePath, "D");
       die();



        }

        // If no valid type is provided, redirect back or show an error
        return redirect()->back()->with('error', 'Invalid export type selected.');
    }
}
