<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\ItemRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
/**
 * To handle authentication of employees
 *
 * @author ChoChoTheint
 *
 * @create date 21-06-2023
 *
 */
class EmployeeController extends Controller
{
    protected $itemInterface;
    protected $categoryInterface;
    protected $employeeInterface;
         /**
     * Define Constructor
     * @author Cho Cho Theint
     * @create 23/06/2023
     * 
     */
    public function __construct(ItemRepositoryInterface $itemInterface, CategoryRepositoryInterface $categoryInterface, EmployeeRepositoryInterface $employeeInterface)
    {
        $this->itemInterface = $itemInterface;
        $this->categoryInterface = $categoryInterface;
        $this->employeeInterface = $employeeInterface;
    }
    /**
     * Handle login
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @param  Request  LoginRequest
     * @return view
     */
    public function index(LoginRequest $request)
    {
        $emp_id = $request->emp_id;
        $password = $request->password;

        $getAllItems = $this->itemInterface->getAllItems();
        $totalCount = $getAllItems->total();
        $getAllCategories = $this->categoryInterface->getAllCategory();

        $employee = $this->employeeInterface->getEmpolyee($request);
        if ($employee && Hash::check($password, $employee->password)) {
            return view('product.itemList', compact('getAllItems', 'getAllCategories','totalCount'));
        } else {
            if(!$employee)
            {
                return redirect()
                    ->back()
                    ->withErrors(['emp_id' => 'Wrong this user id not approved yet.']);
                }
                
                if (!Hash::check($password, $employee->password)) {
                return redirect()
                    ->back()
                    ->withErrors(['password' => 'Wrong password not approved yet.']);
            }
        }
    }
    /**
     * Handle logout with error message
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @return redirect
     */
    public function logout()
    {
        return redirect('login')->with('success', 'Logout Successful!');
    }
}
