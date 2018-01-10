<?php

Router::Route('{id}', 'HomeController@Index', 'GET')->middleware('Auth');

?>