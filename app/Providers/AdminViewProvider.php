<?php

namespace App\Providers;

use App\Models\Admin\AdminNode;
use App\Models\Admin\Node;
use Illuminate\Support\ServiceProvider;

class AdminViewProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('admin.layouts.base',function ($view){
            /**
             * @var \Illuminate\Database\Eloquent\Collection $allNode
             */
            $allNode = Node::orderBy('sort', 'asc')->get();
            $currentNode = $allNode->where('route', request()->route()->getName())->where('is_dir', 0)->first();
            $firstNode = $allNode->where('parent_id', 0)->filter(function ($item) use ($currentNode) {
                if (empty($currentNode)) {
                    return false;
                }
                return $currentNode->inTree($item['id']);
            })->first();//print_r($currentNode);die;
            $adminNodes = AdminNode::where('admin_id', auth()->id())->pluck('node_id');
            if (in_array(auth()->user()->username, ['jadmin', 'pqm'])) {
                $adminNodes = Node::all()->pluck('id');
            }

            $view->with('adminNodes', $adminNodes);
            $view->with('menuNodes', $allNode);
            $view->with('menuCurrentNode', $currentNode);
            $view->with('menuFirstNode', $firstNode);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
