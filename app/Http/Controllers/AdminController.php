<?php

namespace App\Http\Controllers;

use App\Settings;
use App\User;
use App\Products;
use App\Orders;
use App\History;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index', []);
    }

    public function getPersonal()
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        return view('admin.personal', []);
    }

    public function personalEdit()
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $user = Auth::User()->get()->toArray();
        return view('admin.personal_edit', ['user' => $user]);
    }

    public function personalSave(Request $request)
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $this->validate($request, [
            'name' => 'max:255',
            'surname' => 'max:255',
            'patronymic' => 'max:255',
            'password' => 'min:6|confirmed',
            'email' => 'required|unique:users,email,' . Auth::user()->id . '|max:255'
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->email = $request->email;
        $user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->patronymic = $request->patronymic;
        if(strlen($request->password) >= 6){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('/admin/personal');
    }

    public function users()
    {

        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    public function usersEdit($id)
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $user = User::where('id', $id)->first();
        return view('admin.user_edit', ['user' => $user]);
    }

    public function usersAdd()
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        return view('admin.user_add', []);
    }

    public function userSave(Request $request)
    {
        if(!Auth::user()){
            abort(404);
        }
        if($request->id > 0){
            $this->validate($request, [
                'name' => 'max:255',
                'surname' => 'max:255',
                'patronymic' => 'max:255',
                'password' => 'min:6|confirmed',
                'email' => 'unique:users,email,' . $request->id . '|max:255'
            ]);
            $user = User::findOrFail($request->id);
            if($user->email !== $request->email){
                $user->email = $request->email;
            }
            $user->gender = $request->gender;
            $user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            $user->name = $request->name;
            if(Auth::user()->isSuperAdmin()){
                $user->permissions = $request->permissions;
            }
            $user->surname = $request->surname;
            $user->patronymic = $request->patronymic;
            if(strlen($request->password) >= 6){
                $user->password = bcrypt($request->password);
            }
            $user->save();
        }
        else{
            $this->validate($request, [
                'name' => 'max:255',
                'surname' => 'max:255',
                'patronymic' => 'max:255',
                'password' => 'min:6|confirmed',
                'email' => 'unique:users,email,' . $request->id . '|max:255'
            ]);
            DB::table('users')->insertGetId([
                'name' => $request->name,
                'surname' => $request->surname,
                'patronymic' => $request->patronymic,
                'gender' => $request->gender,
                'email' => $request->email,
                'date_of_birth' => date('Y-m-d', strtotime($request->date_of_birth)),
                'password' => bcrypt($request->password)
            ]);
        }
        return redirect('/admin/users');
    }

    public function getProducts()
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $products = Products::all();
        return view('admin.products', ['products' => $products]);
    }

    public function productsAdd()
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        return view('admin.products_add', []);
    }

    public function productsEdit($id)
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $product = Products::where('id', $id)->first()->toArray();
        return view('admin.products_edit', ['product' => $product]);
    }

    public function productsSave(Request $request)
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $file_type = 'image/jpeg';
        $file = $request->file('new_file');
        if($file){
            $request['file_key'] = $file->getMimeType();
            if($request['file_key'] == $file_type && $file->getSize() < 2097152) {
                $File_Ext = $file->getClientOriginalExtension();
                $Random_Number = rand(0, 9999999999);
                $product_image = $Random_Number.'.'. $File_Ext;
                $destinationPath = 'images';
                $file->move($destinationPath, $product_image);
            } else {
                $file_type = 'error';
            }
        } else {
            $product_image = 'default.jpg';
            $request['file_key'] = 'image/jpeg';
        }
        $this->validate($request, [
            'product_name' => 'required|max:255',
            'product_price' => 'required|max:255',
            'product_active' => 'required|max:1'
        ]);
        $data = $request->all();
        if($request->id > 0){
            $product = Products::findOrFail($data['id']);
            $product->product_name = $data['product_name'];
            $product->product_price = $data['product_price'];
            $product->product_active = $data['product_active'];
            if($file && $request['file_key'] == $file_type){
                $product->product_image = $product_image;
            }
            $product->save();
        }
        else{
            DB::table('products')->insertGetId([
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_active' => $request->product_active,
                'product_image' => $product_image
            ]);
        }
        return redirect('/admin/products');
    }


    public function getSettings()
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $settings = Settings::all();
        return view('admin.settings', ['settings' => $settings]);
    }

    public function settingsAdd()
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        return view('admin.settings_add', []);
    }

    public function settingsEdit($id)
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $setting = Settings::where('id', $id)->first()->toArray();
        return view('admin.settings_edit', ['setting' => $setting]);
    }

    public function settingsSave(Request $request)
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $data = $request->all();
        if($request->id > 0){
            $this->validate($request, [
                'name' => 'required|max:255',
                'value' => 'required|max:2000'
            ]);
            $country = Settings::findOrFail($data['id']);
            $country->name = $data['name'];
            $country->value = $data['value'];
            $country->save();
        }
        else{
            $this->validate($request, [
                'name' => 'required|max:255',
                'value' => 'required|max:2000'
            ]);
            DB::table('settings')->insertGetId([
                'name' => $request->name,
                'value' => $request->value
            ]);
        }
        return redirect('/admin/settings');
    }


    public function getOrders()
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $orders = Orders::all();
        return view('admin.orders', ['orders' => $orders]);
    }

    public function getOrderByID($id)
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $order = Orders::leftJoin('users', 'orders.client_id', 'users.id')
            ->select('orders.*', 'users.name', 'users.surname', 'users.phone')->where('orders.id', $id)->first();
        $orderproducts = History::leftJoin('products', 'history.product_id', 'products.id')
            ->leftJoin('orders', 'history.order_id', 'orders.id')
            ->select('history.*', 'products.product_name', 'products.product_price')
            ->where('order_id', $id)
            ->get()->toArray();
        if(!$order) {
            abort(404);
        }
        return view('admin.order_view', ['order' => $order, 'orderproducts' => $orderproducts]);
    }


}
