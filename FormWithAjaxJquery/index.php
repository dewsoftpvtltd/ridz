<?php

 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Form with Ajax</title>
   </head>
   <body>
      <h2>Sending Messages</h2>
      <form action="contact.php" method="post" class="ajax">
        <input type="text" name="name" value="" placeholder="Name"> </br>
        <input type="text" name="email" value="" placeholder="Email"></br>
        <textarea type="text" name="message" value="" placeholder="Some Message"></textarea></br>
        <input type="submit" value="Send Message">
      </form>
   </body>
   <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
   <script src="global.js"></script>
 </html>
