<?php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../Request.php';
require_once __DIR__ . '/../Router.php';

require_once __DIR__ . '/../db/Database.php';

if(!isset($_SESSION)) {
    session_start();
}
$db = new Database();

$router = new Router(new Request);

$router->get('/', 'index');
$router->get('/profile', 'profile');
$router->get('/about','about');
$router->get('/login', function() use($router){
    return $router->renderOnlyView('login',[
        'errors' => [],
        'data' =>[
            'email'=>'',
            'password'=>''
    
        ]
    ]);


});


$router->get('/logout', function(){
    session_unset();
    session_destroy();
    redirect('/');
});


$router->post('/login',function() use($router){
    $db = new Database();
$request=new Request();
$body = $request->getBody();
if($db->loginUser($body['email'], $body['password'])){
    redirect('/');
}
 else{
return $router->renderOnlyView('login',[
    'errors' =>[ 
        'erroremail'=>$db->erroremail,
        'errorpassword'=>$db->errorpassword
    ],
    'data' =>[
        'email'=>$body['email'],
        'password'=>$body['password']

    ]
]);
 }
});

$router->get('/succesfull', 'succesfull');
$router->get('/signup','signup');
$router->post('/submit-signup','submit-signup');
 if (isLoggedIn()){
$router->get('/writeblog', 'writeblog');
 }
$router->post('/writeblog', 'writeblog');
if (isLoggedIn()){
$router->get('/userdetail', 'userdetail');
}
$router->post('/userdetail', 'userdetail');
if (isLoggedIn()){
          $router->get('/editblog', function() use($router,$db){
            $blogs=$db->selectUserBlogs(currentUser()['id']);
            $t=0;
            foreach($blogs as $blog){
                if($_GET['id']==$blog['blog_id']){
                    return $router->renderOnlyView('editblog');
                    $t++;
                    break;
                }
            }
            // if($t<1){
            //    return $router->defaultRequestHandler();
            // }
          });
         
    }
  
$router->post('/blogdetails', 'blogdetails');
if (isLoggedIn()){
$router->get('/edituser', 'edituser');
}
$router->post('/edituser', 'edituser');
$router->get('/blogdetails', 'blogdetails');
$router->get('/international', 'international');
$router->get('/ToursAndTravels', 'ToursAndTravels');
$router->get('/cookingtips', 'cookingtips');
if (isLoggedIn()){
$router->get('/viewblogs', 'viewblogs');
}

$router->get('/indexsearch', 'indexsearch');

if (isLoggedIn()){
        $router->post('/editblog', 'editblog');
}

if (isLoggedIn()){
$router->get('/deleteblog', 'deleteblog');
}
$router->post('/data', function ($request) {
    return json_encode($request->getBody());
});
