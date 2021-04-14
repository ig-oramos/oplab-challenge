<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Tweets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Search a tweet using the Twitter API v1.1</h1>
            <div class="card-text">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="input-group">
                        <label for="search_word" class="input-group-text">Search</label>
                        <input type="text" name="search_word" id="search_word"
                            class="form-control" required maxlength="30"
                            placeholder="Word (e.g.: Science)" value="<?php 
                                echo isset($_GET['search_word'])?$_GET['search_word']:'';
                            ?>">
                        <button name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
    <?php
    if (isset($_GET['submit'])) {
        // Simple search word verification
        if (is_null($_GET['search_word']) || empty($_GET['search_word']))
            echo '<div class="alert alert-danger w-50" role="alert">'.
                'Invalid search term.</div></div></div>';
        else {
            require_once 'twitter-api-exchange/TwitterAPIExchange.php';
            require_once 'keys.php'; // Twitter keys for authentication with the API
            // Setting the access tokens
            $settings = [
                'oauth_access_token' => OAUTH_ACCESS_TOKEN,
                'oauth_access_token_secret' => OAUTH_ACCESS_TOKEN_SECRET,
                'consumer_key' => CONSUMER_KEY,
                'consumer_secret' => CONSUMER_SECRET
            ];
            // The resource URL
            $url = 'https://api.twitter.com/1.1/search/tweets.json';
            $requestMethod = 'GET';
            $searchWord = $_GET['search_word']; // The search term
            $getField = '?q='. $searchWord. '&count=10&result_type=recent';
            $twitter = new TwitterAPIExchange($settings); // The Twitter wrapper
            // Treats the JSON response
            $string = json_decode($twitter->setGetField($getField)->buildOauth($url,
                $requestMethod)->performRequest(), $assoc = true);
            $item = $string['statuses'];
            // Shows the last ten tweets based on the word stored in $searchWord
            echo '</div></div><div class="mt-3"><table class="table table-primary table-striped '.
                'table-hover"><thead><tr><th>User</th><th>Text</th></tr></thead>';
            for($i = 0; $i < 10; ++$i) {
                echo '<tr><td>'. $item[$i]['user']['name']. '</td>'.
                    '<td>'. $item[$i]['text']. '</td></tr>';
            }
            echo '</table></div>';
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>