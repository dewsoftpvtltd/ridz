<?php


class Redirect{
  public static function to($page = null){
    if($page){
      if(is_numeric($page)){
        switch ($page) {
          case 404:
              header('HTTP/1.1 404 Not Found');
              include 'includes/errors/404.php';
              exit();
            break;

        }
      }
     header('Location: '.$page.'.php');
     exit();
   }
  }
}
