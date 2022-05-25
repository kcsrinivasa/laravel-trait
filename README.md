![Laravel](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)


# Laravel Trait

Hi All!

Here is the example focused on laravel `trait` application to create trait and use it.

Traits allow us to develop a reusable piece of code and inject it in controller and modal in a Laravel application.

In this example we have focused on upload file to different directory from two different controller using same file upload function which known as trait function.

### Preview
home
![home](https://github.com/kcsrinivasa/laravel-trait/blob/main/output/home.png?raw=true)
user section
![user](https://github.com/kcsrinivasa/laravel-trait/blob/main/output/user.png?raw=true)
post section
![post](https://github.com/kcsrinivasa/laravel-trait/blob/main/output/post.png?raw=true)

Here are the following steps to achive simple trait application for upload file. 

### Step 1: Install Laravel
```bash
composer create-project laravel/laravel trait
```

### Step 2: Create controller and model
```bash
php artisan make:controller UserController -mUser
php artisan make:model Post -mc
```
### Step 3: Create request for validation
```bash
php artisan make:request UserRequest
php artisan make:request PostRequest
```

### Step 4: Add Routes
```bash
Route::get('/', function () {  return view('welcome'); });
Route::get('/user','App\Http\Controllers\UserController@index')->name('user.index');
Route::post('/user','App\Http\Controllers\UserController@store')->name('user.store');

Route::get('/post','App\Http\Controllers\PostController@index')->name('post.index');
Route::post('/post','App\Http\Controllers\PostController@store')->name('post.store');
```

### Step 5: Create trait
Create trait directory and trail file in app directory.(app/Traits/ImageTrait.php) 

```bash
<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageTrait {

    /**
     * @param Request $request
     * @param fieldname
     * @param directory
     * @return $this|false|string
     */
    public function uploadFile(Request $request, $fieldname = 'image', $directory = 'images' ) {

        if( $request->hasFile( $fieldname ) ) {

            $file = $request[$fieldname];
            $fileOriginalName = $file->getClientOriginalName(); 
            $extension = $file->extension(); 
            $size = $file->getSize(); 
            $fileName = \Str::slug(substr($fileOriginalName,0,200)).time().'.'.$extension; 
            $filePath = 'uploads/'.$directory.'/'; 
            $file->move(public_path($filePath), $fileName); 
            $filePath = $filePath.$fileName;

            return $filePath;

        }
        return null;
    }

}
```

### Step 6: Use trait in Controller
Add below functions in app/Http/Controllers/PostController.php
```bash
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Traits\ImageTrait;

class PostController extends Controller
{
    use ImageTrait;

    public function index()
    {
        return view('post')->withPosts(Post::get());
    }
    
    public function store(PostRequest $request)
    {
        /* use trait file upload function  **/
        $image = $this->uploadFile($request, 'image', 'posts');;

        Post::create([
            'name' => $request->name,
            'image' => $image,
        ]);
        session()->flash('success','Successfully added the post');
        return redirect(route('post.index'));
    }

}
```
Add below functions in app/Http/Controllers/UserController.php
```bash
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

use App\Traits\ImageTrait;
use Hash;

class UserController extends Controller
{
     use ImageTrait;

    public function index()
    {
        return view('user')->withUsers(User::get());
    }

    public function store(UserRequest $request)
    {
        /* use trait file upload function  **/
        $image = $this->uploadFile($request, 'image', 'images');

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $image,
            'password' => Hash::make($request->email),
        ]);
        session()->flash('success','Successfully added the user');
        return redirect(route('user.index'));
    }
}
```
### Step 7: Update request validation class
Goto "app/Http/Requests/UserRequest.php" to grab the user request class validation

Goto "app/Http/Requests/PostRequest.php" to grab the post request class validation

### Step 8: Update user migration
Goto "database/migrations/..create_users_table.php" to grab the user table schema

Goto "database/migrations/..create_posts_table.php" to grab the post table schema

### Step 9: Create Blade file

Goto "resources/views/user.blade.php" to grab the user html code

Goto "resources/views/post.blade.php" to grab the post html code

### Step 10: Update database credentials
```bash
DB_DATABASE=laravel_trait
DB_USERNAME=root
DB_PASSWORD=db_password
```

### Step 11: Final run and check in browser
```bash
php artisan migrate

mkdir public/uploads
mkdir public/uploads/images
mkdir public/uploads/posts

php artisan serve
```
open http://localhost:8000