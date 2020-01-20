<?php

namespace Pingu\User\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Pingu\Jsgrid\Http\Controllers\JsGridModelController;
use Pingu\User\Entities\User;

class UserJsGridController extends JsGridModelController
{
    /**
     * @inheritDoc
     */
    public function getModel(): string
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

    /**
     * @inheritDoc
     */
    public function index(Request $request)
    {
        $options['jsgrid'] = $this->buildJsGridView($request);
        $options['title'] = str_plural(User::friendlyName());
        $options['canSeeAddLink'] = Auth::user()->can('add roles');
        $options['addLink'] = '/admin/'.User::routeSlugs().'/create';
        
        return view('pages.listModel-jsGrid', $options);
    }
}
