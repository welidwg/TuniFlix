<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Movie;
use \App\Models\Category;
use \App\Models\Fav;
use \App\Models\Suggestion;
use Session;

class MoviesController extends Controller
{


    public function AddMovie(Request $req)
    {
        try {
            $name = $req->input("name");
            $other = $req->input("otherName");
            $duration = $req->input("duration");
            $year = $req->input("Year");
            $director = $req->input("director");
            $language = $req->input("lang");
            $quality = $req->input("quality");
            $teaser = $req->input("teaser");
            $cat = $req->input("category");
            $link = $req->input("link");
            $subject = $req->input("subject");
            $check = Movie::where("Name", $name)->first();

            if ($check) {
                return response("It seems that this movie is already exists !", 404);
            }
            if ($req->hasFile("poster")) {
                $ctrl = new UsersController();
                $avatar = $req->file('poster');
                $file = $avatar;
                $file_name = $file->getClientOriginalName();
                $newname = $ctrl->random() . $file_name;
            }
            if (empty($cat)) {
                return response("Please select a category!", 404);
            }
            $categories = "";
            foreach ($cat as  $k => $v) {
                if ($categories == "") {
                    $categories = $cat[$k];
                } else {
                    $categories .= "," . $cat[$k];
                }
            }
            $links = "";
            foreach ($link as  $kk => $vv) {
                if ($links == "") {
                    $links = $link[$kk];
                } else {
                    $links .= "," . $link[$kk];
                }
            }

            $movie = new Movie;
            $movie->Name = $name;
            $movie->OtherName = $other;
            $movie->Duration = $duration;
            $movie->DateReleased = $year;
            $movie->Subject = $subject;
            $movie->Director = $director;
            $movie->Lang = $language;
            $movie->Quality = $quality;
            $movie->TeaserLink = $teaser;
            $movie->Poster = $newname;
            $movie->DateAdded = date("Y-m-d");
            $movie->category = $categories;
            $movie->Links = $links;
            if ($movie->save()) {
                $file->move(base_path() . '/public/assets/img/posters', $newname);
                return response("Movie added successfully !", 200);
            }
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
    public function AddCategory(Request $req)
    {
        try {

            $label = $req->input("label");
            $check = Category::where("label", "like", $label)->first();
            if ($check) {
                return response("Category already exists !", 500);
            }
            $cat = new Category;
            $cat->label = $label;
            $cat->save();
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
    public function Top3($type)
    {
        switch ($type) {
            case 'Movies':
                $media = Movie::orderBy('views', 'desc')
                    ->take(3)
                    ->get();
                break;
            case 'Series':
                break;

            default:
                # code...
                break;
        }
        return response($media, 200);
        # code...
        return $type;
    }
    public function Suggestion()
    {
        try {
            # code...
            $sugg = Movie::get();
            $indexes = [];
            foreach ($sugg as $idx) {
                array_push($indexes, $idx->idMovie);

                # code...
            }
            $it = Suggestion::where('idSuggestion', 1)->first();

            $randomElement = $indexes[array_rand($indexes, 1)];
            $randomType = "Movie";
            $it->idMedia = $randomElement;
            $it->typeMedia = $randomType;
            $it->save();
            return  response("done", 200);
        } catch (\Throwable $th) {
            return  response($th->getMessage(), 500);
        }
    }
    public function AddFavorite(Request $req)
    {
        # code...
        try {
            $idMovie = $req->input("idMovie");
            $fav = Fav::where("idMovie", "=", "$idMovie")->where("idUser", Session::get("id"))->first();


            if ($fav) {
                $fav->delete();
                return response("Removed from favorites", 200);
            } else {
                $new = new Fav;
                $new->idUser = Session::get("id");
                $new->idMovie = $idMovie;
                if ($new->save()) {
                    return response("Added to favorites", 200);
                }
            }
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
    function EditMovie(Request $req)
    {
        try {
            $name = $req->input("name");
            $idMovie = $req->input("idMovie");
            $other = $req->input("otherName");
            $duration = $req->input("duration");
            $year = $req->input("Year");
            $director = $req->input("director");
            $language = $req->input("lang");
            $quality = $req->input("quality");
            $teaser = $req->input("teaser");
            $cat = $req->input("category");
            $link = $req->input("link");
            $remCat = $req->input("remCat");
            $subject = $req->input("subject");
            $movie = Movie::where("idMovie", $idMovie)->first();
            $newCat = [];
            $newCategory = $movie->category;
            $newLinks = $movie->Links;
            if ($req->has("remCat")) {
                $newCategory = "";
                $tt = explode(",", $movie->category);
                $newCat = array_diff($tt, $remCat);
                foreach ($newCat as $k => $v) {
                    if ($newCategory == "") {
                        $newCategory = $newCat[$k];
                    } else {
                        $newCategory .= "," . $newCat[$k];
                    }
                }
            }
            if ($req->has("category")) {
                foreach ($cat as $kk => $vv) {
                    if ($newCategory == "") {
                        $newCategory = $cat[$kk];
                    } else {
                        $newCategory .= "," . $cat[$kk];
                    }
                }
            }

            if ($req->has("link")) {
                $newLinks = "";
                foreach ($link as $k1 => $v1) {
                    if ($link[$k1] != "") {
                        if ($newLinks == "") {
                            $newLinks = $link[$k1];
                        } else {
                            $newLinks .= "," . $link[$k1];
                        }
                    }
                }
            }
            if ($req->has("newLink")) {
                foreach ($req->input("newLink") as $new) {
                    if ($newLinks == "") {
                        $newLinks = $new;
                    } else {
                        $newLinks .= "," . $new;
                    }
                }
            }
            $newname = $movie->Poster;
            if ($req->hasFile("poster")) {
                $ctrl = new UsersController();
                $avatar = $req->file('poster');
                $file = $avatar;
                $file_name = $file->getClientOriginalName();
                $newname = $ctrl->random() . $file_name;
                unlink(base_path() . "/public/assets/img/posters/$movie->Poster");
                $file->move(base_path() . '/public/assets/img/posters', $newname);
            }
            $movie->Name = $name;
            $movie->OtherName = $other;
            $movie->Duration = $duration;
            $movie->DateReleased = $year;
            $movie->Subject = $subject;
            $movie->Director = $director;
            $movie->Lang = $language;
            $movie->Quality = $quality;
            $movie->TeaserLink = $teaser;
            $movie->Poster = $newname;
            $movie->category = $newCategory;
            $movie->Links = $newLinks;
            if ($movie->save()) {

                return response("Saved !", 200);
            }
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }

    function DeleteMovie($id)
    {
        try {
            $movie = Movie::where("idMovie", $id)->first();
            $favs = Fav::where("idMovie", $id)->get();
            //unlink(base_path() . "/public/assets/img/posters/$movie->Poster");

            $movie->delete();
            foreach ($favs as $fav) {
                $fav->delete();
            }
            return response("Deleted !", 200);
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
    //
}
