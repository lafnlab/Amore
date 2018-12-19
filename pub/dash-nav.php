  <nav class="dashnav">
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Mentions</a></li>
      <li><a href="#">Messages</a></li>
      <li><a href="#">Friends</a></li>
      <li><a href="#">Following</a></li>
      <li><a href="#">Followers</a></li>
      <li><a href="#">Lists</a></li>
    </ul>
  </nav>
  <main>
<?php

// messages should appear in <main> only, not in <nav>
if ($message != '' || NULL) {
echo header_message($message);
}
?>
