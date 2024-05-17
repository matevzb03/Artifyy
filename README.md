# Artify

Artify is a website based on Spotify's API. Using users listening history it creates a playlist containing songs that have similar propereries to their favourite songs.
Website also has a Top Artists and Top Tracks section.

You will have to provide your own Client ID and Client secret, those variables are stored in /backend/getcode.php
In addition redirection URI needs to be changed at index.php and /backend/getcode.php. The address can be local as long as you add it to redirect paths on spotify developer dashboard.

Spotify has recently changed some things about thier API. Application now needs to be verified before all options are allowed for external users. On demo page below only top artist and tracks tab works for testing. Recommendations do NOT work and require spotify account that is considered as a developer for the project.

Demo website can be found at http://83.212.126.177/index.php

# Top Artists section:
![Screenshot_9](https://user-images.githubusercontent.com/67975101/152237275-a9bb9e26-b9db-4e2e-88e7-e79fdc331542.png)


# Recommendation section:
![Screenshot_10](https://user-images.githubusercontent.com/67975101/152237326-3a6580b1-3863-4d05-b29d-35b0b5fbd7e6.png)


# Adding new users to development program:
![Screenshot_8](https://user-images.githubusercontent.com/67975101/152238707-039b8a75-57f8-4dc8-afc8-aac0a3ef3bbd.png)
