<?php

Router::Route('', 'HomeController@Index', 'GET')->middleware('test');

?>