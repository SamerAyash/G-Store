<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\SubCategory;
class CategoriesAndSubcategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
            'Food Market'=>[],
            'Mobiles & Tablets'=>['Mobiles','Tablets','Accessories'],
            'Electronics'=>['Screens & Audio','Computers & Laptops','Household Devices','Musical instruments','Cameras'],
            'Beauty & Health'=>['Perfumes','Make-up','Body care devices','Creams'],
            'Sport & Games'=>[],
            'Home'=>['Kitchen & Dining','Equipment and tools','Furniture and Decoration','Cleaning materials'],
        ];
        foreach ($categories as $category=>$subCategories){
            $cate=new Category();
            $cate->name= $category;
            $cate->save();
            if($subCategories != null){
                foreach ($subCategories as $subCategory){
                    $subCate= new SubCategory();
                    $subCate->name= $subCategory;
                    $subCate->category_id= $cate->id;
                    $subCate->save();
                }
            }
        }
    }
}
