<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
   /**
    * User: mfcoderx_flipmart
    *Database: mfcoderx_flipmart
    * pwd=pDTnGM[Ychj)
    */
  public function facebookRedirect()
  {
    return Socialite::driver('facebook')->redirect();
  }
  public function loginWithFacebook()
  {
    $user = Socialite::driver('facebook')->stateless()->user();
    $findUser=User::where('facebook_id',$user->id)->first();
    if($findUser){
      // dd( 'hi');
        Auth::login($findUser);
        return redirect('/author/dashboard');
    }else{
       // dd('bye');
        $new_user= new User();
        $new_user->name = $user->name;
        $new_user->email = $user->email;
        $new_user->facebook_id = $user->id;
        $new_user->password = bcrypt('123456');
        $new_user->save();
        Auth::login($new_user);
        // return redirect('/');
        return redirect('/author/dashboard');
    }
  }
// google login success
  public function googleRedirect()
  {
    return Socialite::driver('google')->redirect();
  }
  public function loginWithGoogle()
  {
    $user = Socialite::driver('google')->stateless()->user();
    $findUser=User::where('google_id',$user->id)->first();
    if($findUser){
        // dd( 'hi');
        Auth::login($findUser);
        return redirect('/author/dashboard');
    }else{
    // dd('bye');
        $new_user= new User();
        $new_user->name = $user->name;
        $new_user->email = $user->email;
        $new_user->google_id = $user->id;
        $new_user->password = bcrypt('123456');
        $new_user->save();
        Auth::login($new_user);
        return redirect('/author/dashboard');
    }
  }

}
