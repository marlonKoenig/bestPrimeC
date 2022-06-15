
<?php
$vorschauBild = explode('.', $_SESSION['marketing_scool_video'][1]['videoName']);
?>
<div class="videoplayer">
    <div class="videocontainer">
        <video controls poster="<?php echo $image_path; ?>images/<?php echo $vorschauBild[0]; ?>.jpeg" class="videoTarget" src="<?php echo $image_path . 'videos/' . $_SESSION['marketing_scool_video'][1]['videoName']; ?>" type="video/mp4">
            Ihr Browser kann das angeforderte Video leider nicht anzeigen<br>
            Sie können das Video aber <a href="<?php echo $_SESSION['domain']; ?>media/webseite/videos/<?php echo $_SESSION['marketing_scool_video'][1]['videoName']; ?>"><b>hier</b></a> abrufen.
        </video>
    </div>
</div>