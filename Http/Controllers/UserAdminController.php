<?php

namespace Pingu\User\Http\Controllers;

use Illuminate\Http\Request;
use Pingu\Entity\Http\Controllers\AdminEntityController;
use Pingu\Forms\Support\ModelForm;
use Pingu\User\Entities\User;
use Pingu\User\Forms\EditPasswordForm;
use Pingu\User\Http\Requests\SavePasswordRequest;

class UserAdminController extends AdminEntityController
{
    public function editPassword(User $user)
    {
        $url = ['url' => $user->uris()->make('savePassword', $user, adminPrefix())];
        $form = new EditPasswordForm($url, $user);
        \ContextualLinks::addFromObject($user);
        return view()->first($this->getEditViewNames($user), [
            'form' => $form,
            'title' => 'Change password',
            'entity' => $user
        ]);
    }

    public function savePassword(SavePasswordRequest $request, User $user)
    {
        $validated = $request->validated();
        $user->password = $validated['password'];
        $user->save();
        \Notify::put('success', 'Password updated');
        
        return back();
    }
}
