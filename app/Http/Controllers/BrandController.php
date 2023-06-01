<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\BrandContract;

class BrandController extends BaseController
{
    /**
     * @var BrandContract
     */
    protected $brandRepository;


    /**
     * CategoryController constructor.
     * @param BrandContract $brandRepository
     */
    public function __construct(BrandContract $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index()
    {
        $brands = $this->brandRepository->listBrands();

        $this->setPageTitle('Brands', 'List of all brnads');
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        $this->setPageTitle('Brands', 'Create Brnad');
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'mimes:jpg,jpeg,png|max:1000',
        ]);

        $params = $request->except('_token');
        $brand = $this->brandRepository->createBrand($params);

        if(!$brand)
        {
            return $this->responseRedirectBack('Error occured while creating brand.', 'error', true, true);
        }

        return $this->responseRedirect('admin.brands.index', 'Brand added successfully', 'success', false, false);
    }

    public function edit($id)
    {
        $brand = $this->brandRepository->findBrandById($id);

        $this->setPageTitle('Brnads', 'Edit Brand: ' . $brand->name);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'mimes:jpg,jpeg,png|max:1000',
        ]);

        $params = $request->except('_token');
        $brand = $this->brandRepository->updateBrand($params);

        if(!$brand)
        {
            return $this->responseRedirectBack('Error occured while upadting brand.', 'error', true, true);
        }

        return $this->responseRedirect('admin.brands.index', 'Brand updated successfully', 'success', false, false);
    }

    public function delete($id)
    {
        $brand = $this->brandRepository->findBrandById($id);

        if(!$brand)
        {
            return $this->responseRedirectBack('Error occurred while deleting brand.', 'error', true, true);
        }

        return $this->responseRedirect('admin.brands.index', 'Brand deleted successfully', 'success', false, false);
    }
}
