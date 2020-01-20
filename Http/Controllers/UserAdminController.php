<?php

namespace Pingu\User\Http\Controllers;

use Illuminate\Http\Request;
use Pingu\Entity\Http\Controllers\AdminEntityController;
use Pingu\Forms\Support\ModelForm;
use Pingu\User\Entities\User;
use Pingu\User\Forms\EditPasswordForm;

class UserAdminController extends AdminEntityController
{
    public function editPassword(User $user)
    {
        $url = ['url' => $user->uris()->make('savePassword', $user, adminPrefix())];
        $form = new EditPasswordForm($url, $user);
        \ContextualLinks::addFromObject($user);
        return view('user::edit-password')->with(['form' => $form]);
    }

    public function savePassword(User $user)
    {
        $validated = $user->validator()->validateUpdateRequest($this->request);
        $user->password = $validated['password'];
        $user->save();
        \Notify::put('success', 'Password updated');
        
        return back();
    }
}
