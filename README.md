# Tiny Small Framework 
A small framework with **FileBase** configuration 

I could wrote a Router and Adding Template engine to it,
but the result not a framework . so i decided to implement a real small framework
with implementation of psr7-17-15-11 and ... (without a Middleware and Auto Wiring Capability)
this framework doesn't support REST Methods (POST, PUT, PATCH,...) and act as GET Method

#How It's Made?
at first I read a few article about implementation a Framework and then
I started to read and code review many framework like Slim, Symfony, PopPHP, and ...
after that started to implement components by following framework patterns 

**_if any code copied from other places I mentioned it in my PHPDoc blocks._**
  

this framework consist of
 - PSR-7 message(Handling requests and no responses :D )
 - router (maping requestes to functions)
 - template engine
 - support for testing wih PHPUnit


##  Start Coding
### How to Start Coding?
run  `composer install` and now framework is ready!
### Step 1. Create a Controller
Create  Blog Class in ***[app/controllers/Blog.php]*** 
extends class from **Core\Kernel\ControllerAbstract**
### Step 2. Write New Function
now add a  `public function test()` 
> also you could add arguments like test($myParam), $myParam value will be filed automatically if you defined myParam in your route config before
### Step 3. Add a View File
after that add your twig file in this address **[app\views\helloworld.html.twig]**
### Step 4. Render your data
return you data with `$this->render(file_name,$data)` function
### Step 5. Define Routes

#### your class will be something like this

    //app/controllers/Blog.php
    namespace App\controllers;  
      
    use Core\Kernel\ControllerAbstract;  
      
    class Blog extends ControllerAbstract  
    {  
      public function test($myParam)  {
	    return $this>render('helloworld.html.twig',['message'=>'HelloWorld'])
      }  
    }

your route should be like this

    #app/config/routes.yml
    routes:  
      blog:  
        path: /blog/{myParam}  
        callback: App\controllers\Blog:test  
        parameters:  
          year:  
            regex: '\d+'

## How To Run?

#### Running with PHP

    $php -S localhost:8080 -t public/
    
#### Apache
Running With Apache
	add .htaccess file to your root folder and make sure mode_rewrite is enabled


    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} -s [OR]
    RewriteCond %{REQUEST_FILENAME} -l [OR]
    RewriteCond %{REQUEST_FILENAME} -d
    RewriteRule ^.*$ - [NC,L]
    RewriteRule ^.*$ public/index.php [NC,L]
    Options -Indexes	

#### Nginx
Running With Nginx
Nginx config

    server {
        listen 80;
        server_name example.com;
        root /example.com/public;
        index index.html index.htm index.php;
        charset utf-8;
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }
    }

#### Docker
Running With Dockerfile

    tar xf dockrized.tar.xz
    cd dockerized
    docker build -t agh/lap ./
    docker run -p8080:80 agh/lap   

access app over `localhost:8080`
run this commands


---
## How To Test?
tests are in **tests** directory there are 2 directory **core** and **app**.
**core** directory consist of tests for framework
and **app** directory  should consist of tests for your app that will developed by this framework

> It means we have 2 test suits  **core** and **app**
for running core testsuit

     //running core tests 
     $phpunit  --testsuite core
     //running app tests
     $phpunit  --testsuite app
