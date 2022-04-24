<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Fav;
use Session;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    function random($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function SignUp(Request $req)
    {
        try {
            //code...
            $email = $req->input("email");
            $username = $req->input("username");
            $password = $req->input("password");
            $confirm = $req->input("confirm");
            $user = User::where("email", $email)->first();
            if ($user) {

                // redirect()->back()->with('hhgjjjjkljj'); 
                return \response("This email is already used", 500);
            }
            $user = User::where("username", $username)->first();
            if ($user) {
                return \response("This username is already taken", 500);
            }
            if ($password != $confirm) {
                return \response("Passwords not matched ", 500);
            }
            $newPass = Hash::make($password);
            $user = new User;
            $user->username = $username;
            $user->email = $email;
            $user->password = $newPass;
            $user->role = 0;
            $user->save();
            // return redirect("/Login"),
            return \response("Account Created Successfully !", 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response($th->getMessage(), 500);
        }
        # code...

    }
    public function Login(Request $req)
    {
        try {
            $login = $req->input("login");
            $password = $req->input("password");

            if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                $user = User::where("email", $login)->first();
                //$user->nom;
                //$user=mysqli_fetch_array(mysqli_query($connect,"SELECT * from userss where email like $email"))7
                //$user["nom"]

            } else {
                $user = User::where("username", $login)->first();
            }
            if (!$user) {
                return \response("User not found", 404);
            }
            if (!Hash::check($password, $user->password)) {
                return \response("Please verify your password", 404);
            }
            Session::put("login", true);
            Session::put("role", $user->role /*$user["role"]*/);
            Session::put("id", $user->idUser);
            Session::put("email", $user->email);
            Session::put("username", $user->username);
            Session::put("avatar", $user->avatar);
            //redirect()->route("/Accueil")->with(["msg"=>"Bienvenue "]);
            return \response("Login Success", 200);
        } catch (\Throwable $th) {
            return \response($th->getMessage(), 500);
        }
        # code...
    }
    public function Logout()
    {
        # code...
        Session::flush();
        return redirect(url('/Login/?logout'));
        // return Redirect::to('/login?LoggedOut');

    }
    public function ChangeAvatar(Request $req)
    {

        try {
            
            $email = $req->input("email");
            $user = User::where("email", "=", $email)->first();

            if ($req->hasFile("avatar")) {
               // $avatar = $req->file('avatar');
                $file = $req->file('avatar');;
                $file_name = $file->getClientOriginalName();
                $newname = $this->random() . $file_name;
                if ($user->avatar != "") {
                    unlink(base_path() . "/public/assets/img/avatars/$user->avatar");
                }
                $user->avatar = $newname;
                if ($user->save()) {
                    $file->move(base_path() . '/public/assets/img/avatars', $newname);
                    Session::put("avatar", $newname);
                }
                return response("Saved !", 200);
            } else {
                return response("Please select a file first", 404);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response($th->getMessage(), 500);
        }
        # code...
    }
    public function EditProfile(Request $req)
    {
        try {
            $email = $req->input("email");
            $username = $req->input("username");
            $password = $req->input("password");
            $confirm = $req->input("confirm");
            $old = $req->input("old");
            $user = User::where("email", $email)->where("idUser", "!=", Session::get("id"))->first();
            if ($user) {
                return response("Email is already used", 500);
            }
            $user = User::where("username", $username)->where("idUser", "!=", Session::get("id"))->first();

            if ($user) {
                return response("Username already used", 500);
            }

            $user = User::where("idUser", Session::get("id"))->first();
            if (!Hash::check($old, $user->password)) {
                return response("Old password is wrong ! ", 500);
            }
            if ($password != "") {
                if ($password !== $confirm) {
                    return response("Please confirm your new password", 500);
                } else {
                    $newPass = Hash::make($password);
                }
            } else {
                $newPass = $user->password;
            }
            $user->email = $email;
            $user->username = $username;
            $user->password = $newPass;
            if ($user->save()) {
                Session::put("email", $email);
                Session::put("username", $username);
            }


            return \response("Saved !", 200);
        } catch (\Throwable $th) {
            return \response($th->getMessage(), 500);
        }
    }
    public function ContactSend(Request $req)
    {
        try {
            $email = $req->input("email");
            $subject = $req->input("title");
            $msg = $req->input("message");
            $message = new Message;
            if ($req->has("idMovie") != "") {
                $message->idMedia = $req->input("idMovie");
            }
            $message->email = $email;
            $message->Title = $subject;
            $message->Subject = $msg;
            $message->DateSent = date("Y-m-d");
            if ($message->save()) {
                return response("You Message was sent successfully! ", 200);
            }
        } catch (\Throwable $th) {
            return \response($th->getMessage(), 500);
        }
    }
    function SendCode(Request $req)
    {
        try {
            $code = $this->random();
            $email = $req->json("email");
            $user = User::where("email", $email)->first();
            if ($user) {
                $mailer = new \App\Http\Controllers\MailController();
                $title = "Password Recovery";
                $body = "
            $code is ur revovery code";


                $mailer->SendMail($email, $title, $body);
                return response(json_encode(array("code" => $code)), 200);
            } else {
                return response("User not found!", 404);
            }
        } catch (\Throwable $th) {
            return \response($th->getMessage(), 500);
        }
    }
    function ChangePass(Request $req)
    {
        try {
            $email = $req->input("email");
            $pass = Hash::make($req->input("password"));
            $user = User::where("email", $email)->first();
            $user->password = $pass;
            $user->save();
            return response("Password Recovered !", 200);
        } catch (\Throwable $th) {
            return \response($th->getMessage(), 500);
        }
    }
    function DeleteUser($id)
    { 
         
        try {
            $user = User::where("idUser", $id)->first();
            $favs = Fav::where("idUser", $id)->get();
            
            foreach ($favs as $fav) {
                $fav->delete();
            }
            $user->delete();
            return response("Deleted !", 200);
        } catch (\Throwable $th) {
            return \response($th->getMessage(), 500);
        }
    }
}
