<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script 
        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
        crossorigin="anonymous"></script>
    <title><?=(isset($title)?$title:"My Blog")?></title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/?m=post&a=posts_page">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/?m=post&a=show_posts">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/?m=user&a=show_users">Users</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" >
            <a href="/?m=auth&a=register_page" class="btn btn-outline-success my-2 my-sm-0" type="submit" <?=(!isset($_SESSION['user'])?'':'hidden')?>>Subscribe</a>
        </form>
        <form class="form-inline my-2 my-lg-0">
            <a href="/?m=auth&a=login_page" class="btn btn-outline-success my-2 my-sm-0" type="submit" <?=(!isset($_SESSION['user'])?'':'hidden')?>>Login</a>
        </form>
        <form class="form-inline my-2 my-lg-0">
            <a href="/?m=auth&a=do_logout" class="btn btn-outline-success my-2 my-sm-0" type="submit" <?=(isset($_SESSION['user'])?'':'hidden')?>>Logout</a>
        </form>
    </div>
    </nav>
<div class="container">