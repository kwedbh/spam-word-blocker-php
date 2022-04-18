<?php 

$errors = [];

$count_errors = '';

// List of the words you want to block
$spam_words =

["http", "www", ".com", ".mx", ".org", ".net", ".co.uk", ".jp", ".ch", ".info", ".me",
        ".mobi", ".us", ".biz", ".ca", ".ws", ".ag",
		".com.co", ".net.co", ".com.ag", ".net.ag", ".it", ".fr", ".tv", ".am", ".asia", ".at", ".be", ".cc", ".de", ".es", ".com.es", ".eu",
		".fm", ".in", ".tk", ".com.mx", ".nl", ".nu", ".tw", ".vg", "sex", "porn", "fuck", "buy", "dating", "viagra", "money", "dollars",
		"payment", "website", "games", "toys", "poker", "cheap", "href","nude","cam","penis","pills","sale","cheapest", "script",'Mod', 'Owner', 'Mawd', 'M0d', '0wner','090','080','081','070','091','0-','+','80','81','70','91','dot','f*ck','bitch','ww','cum','hacker','pussy', '<','>'
];


function is_blank($value) {

    return !isset($value) || trim($value) === '';

}

if ($_SERVER['REQUEST_METHOD'] == 'POST'):

// print_r($_POST);

// die();

$comment = $_POST['comment']; // This should be coming from a post request

$comment_str = (string)$comment;

$new_input = str_replace(' ', '', strtolower($comment_str));

if(!is_blank($comment)){

foreach($spam_words as $item) {
    if (strpos($new_input, strtolower($item)) !== false) {
        $errors[] = $item;
        }
    }

}

$count_errors = count($errors);

if ($count_errors >= 1) {
    $user_spamwords = implode(",", $errors); // This are the lists of spam words inputted by the user
}else{

    //Save the post or comment to the database

    print "<script> alert('Saved') </script>";

}

endif;

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Form Validation!</title>

  </head>
  <body>

<div class="container">
    <form action="" method="post">

    <div class="card mt-5">
        <div class="card-body">
        <?php if ($count_errors >= 1): ?>
            
            <div class="alert alert-danger" role="alert">
                <small>You entered some forbidden words <?php print $user_spamwords; ?></small>
            </div>
            
        <?php endif; ?>            
            <div class="form-group">
                <div class="mb-3">
                <h5 class="text-info mb-2">Spam Word Validator.</h5>
                <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Post</button>
       </div>
    </div>

    </form>
</div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>