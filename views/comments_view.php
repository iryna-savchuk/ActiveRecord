<!DOCTYPE html>
<?php
$style = 'style="display:none;"';
if ($showmessanger) {
    $style = 'style="display:block;"';
}
?>
<html>
    <head>
        <title>Comments View</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/foundation.css">    <!-- Standard CSS of Foundation -->        
    </head>
    <body>
        <!-- The messanger will be used to display error -->
        <div class="alert-box warning radius" id="messanger" <?php echo $style; ?> >
            <h5 style="text-align: center;font-weight: bold;">* To add new comment, you need to fill both Name and Text fields.</h5>
        </div>
        <?php
        if (!empty($commentsArray)) {
            ?>
            <fieldset class="large-6 large-centered columns">
                <legend> COMMENTS LIST </legend>
                <?php foreach ($commentsArray as $comment) { ?>
                    <div class="panel">
                        <h4><?php echo $comment['author']; ?></h4>
                        <p><?php echo $comment['text']; ?></p>
                    </div>
                    <?php
                }
            }
            ?>
        </fieldset>
        <form role="form" name="addCommentForm" id="addCommentForm" action="" method="POST">
            <fieldset class="large-6 large-centered columns">

                <legend> ADD NEW COMMENT </legend>
                <div class="row">
                    <div class="large-12 large-centered columns">
                        <label>Name*:
                            <input type="text" name="author" id="author"/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 large-centered columns">
                        <label>Comment Text*:
                            <textarea name="text" rows="5" cols="40" id="text"></textarea>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 large-centered columns">
                        <button class="button expand radius" type="submit">Add new comment</button>
                    </div>
                </div> 
                <input type="hidden" name="action" value="createComment" />
            </fieldset>
        </form>
    </body>
</html>