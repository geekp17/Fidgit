<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
Use App\Button;

class ButtonController extends Controller
{
    public function add(Request $request) {
      $user_id = $request->json('user_id');
      $mac = $request->json('mac');

      $user = new User();
      $user = $user->find($user_id);

      $button = new Button();
      $button->mac = $mac;

      $user->button()->save($button);
    }
}
