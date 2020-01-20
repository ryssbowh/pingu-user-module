<?php

namespace Pingu\User\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Pingu\Jsgrid\Http\Controllers\JsGridModelController;
use Pingu\User\Entities\User;

class RoleUsersJsGridController extends JsGridModelController
{
    /**
     * @inheritDoc
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * @inheritDoc
     */
    protected function canClick()
    {
        return Auth::user()->can('edit users');
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
        return Auth::user()->can('delete users');
    }

    protected function modifyJsGridDefinition(array $options)
    {
        $options['extraFilters']['roles'] = $this->request->route()->parameters['role']->id;
        foreach($options['fields'] as $index => $field){
            if($field['name'] == 'roles') {
                unset($options['fields'][$index]);
                break;
            }
        }
        return $options;
    }

    /**
     * @inheritDoc
     */
    public function index(Request $request)
    {
        $options['jsgrid'] = $this->buildJsGridView($request);
        $options['title'] = 'Role\'s '.str_plural(User::friendlyName());
        $options['canSeeAddLink'] = Auth::user()->can('add users');
        $options['addLink'] = '/admin/'.User::routeSlugs().'/create';
        
        return view('pages.listModel-jsGrid', $options);
    }
}
