### NOTE

Since gogoanime isn't working anymore, the api also doesn't work anymore and I'm a lil bit busy and unable to change the api and if u guys have time, yall can edit and pull request

I would be grateful 🙏



## THE SQL TABLE NEEDED

```
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    remember_token VARCHAR(100) NULL
);
```




<details>
<summary>Homepage</summary>
<p align="center">
  <img src="./readmeimage/homepage.png" alt="Homepage" width="80%">
</p>
</details>

<details>
<summary>Animelist</summary>
<p align="center">
  <img src="./readmeimage/animelist.png" alt="list" width="80%">
</p>
</details>

<details>
<summary>Season</summary>
<p align="center">
  <img src="./readmeimage/Newseason.png" alt="season" width="80%">
</p>
</details>

<details>
<summary>Movies</summary>
<p align="center">
  <img src="./readmeimage/movies.png" alt="movies" width="80%">
</p>
</details>

<details>
<summary>Popular</summary>
<p align="center">
  <img src="./readmeimage/Popular.png" alt="popular" width="80%">
</p>
</details>

<details>
<summary>Streaming</summary>
<p align="center">
  <img src="./readmeimage/streaming.png" alt="streaming" width="80%">
</p>
</details>

[![Join our Discord server!](https://invidget.switchblade.xyz/VsPXjNRcbw)](https://discord.gg/VsPXjNRcbw)
<hr/>


## Features 
--> Easy to use <br>
--> Requires no database<br>
--> Responsive<br>
--> Anime Available Based on Genres<br>
--> and many moreeee...

## Acknowledgements

[anime-api](https://github.com/KiriXen/gogo-api) The api used for the need of this website. 

## Requirements
--> Php environment (use .htaccess must be enabled in localhost) or Directly Upload the code on php supported hosting (No editing Required Just Upload and Enjoy)

php/info.php
```
<?php 
$base_url = "//{$_SERVER['SERVER_NAME']}"; // if on local then after the `}` add a slash and `/name_of_the_folder`
$website_name = "GogoAnime"; // The name u want for the website
$apiLink = ""; // api without the '/' at the end
$consumet = ""; // host ur own consumet api from here `https://github.com/consumet/api.consumet.org` and paste the api link here without the `/` at the end
if (date("d") > 15){
    $apiLink = ""; // api without the '/' at the end
}
?>
```

## Online Deployment

Or you can deploy on any php hosting such as <a href="https://www.infinityfree.net/">InfinityFree</a>

## Local Deployment

You need to have `php` installed on your pc for following the intructions

First download the repository using
```
git clone https://github.com/KiriXen/gogoanime
```

Now start the production build of the site using
```
php -S localhost:8888
```

This will start the app on http://localhost:8888 <br>
Make Sure You Edit $base_url in php/info.php before starting in localhost.. <br>
And Enable the use of .htaccess in PHP enviornment
