<?php

namespace Pingu\User\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Pingu\Jsgrid\Http\Controllers\JsGridModelController;
use Pingu\User\Entities\Role;

class RoleJsGridController extends JsGridModelController
{
    /**
     * @inheritDoc
     */
    public function getModel()
    {
        return Role::class;
    }

    /**
     * @inheritDoc
     */
    protected function canClick()
    {
        return Auth::user()->can('edit roles');
    }

    /**
     * @inheritDoc
     */
    protected function canEdit()
    {
        return $this->canClick();
    }

    /**
     * @inheritDoc
     */
    protected function canDelete()
    {
        return Auth::user()->can('delete roles');
    }

    /**
     * @inheritDoc
     */
    public function index(Request $request)
    {
        $options['jsgrid'] = $this->buildJsGridView($request);
        $options['title'] = str_plural(Role::friendlyName());
        $options['canSeeAddLink'] = Auth::user()->can('add roles');
        $options['addLink'] = '/admin/'.Role::routeSlugs().'/create';
        
        return view('pages.listModel-jsGrid', $options);
    }
}
