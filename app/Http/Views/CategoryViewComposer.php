<?php


namespace App\Http\Views;


use App\Category;

class CategoryViewComposer
{
    private Category $category;

    /**
     * CategoryViewComposer constructor.
     * @param Category $categories
     */
    public function __construct(Category $categories)
    {
        $this->category = $categories;
    }

    /**
     * @param $view
     * @return mixed
     */
    public function compose($view)
    {
        return $view->with('categories', $this->category->all(['name', 'slug']));
    }
}
