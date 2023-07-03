<html>
<body>

<?php
//$var = '{"Files":[],"Galleries":[{"GalleryId":17641,"Files":null,"AssetsCount":0,"Name":"Ale test","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":45925,"Files":null,"AssetsCount":0,"Name":"CMYK","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":17858,"Files":null,"AssetsCount":0,"Name":"David Test","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":45977,"Files":null,"AssetsCount":0,"Name":"IngestedNew","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":34339,"Files":null,"AssetsCount":0,"Name":"Lu test","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":19511,"Files":null,"AssetsCount":0,"Name":"MT EM Update","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":17638,"Files":null,"AssetsCount":0,"Name":"MT Test","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":45926,"Files":null,"AssetsCount":0,"Name":"Shutterstock","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":17639,"Files":null,"AssetsCount":0,"Name":"Smoke Test","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":17831,"Files":null,"AssetsCount":0,"Name":"test 04-09","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":19122,"Files":null,"AssetsCount":0,"Name":"test 05-03","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":31362,"Files":null,"AssetsCount":0,"Name":"Test 09-11","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":19512,"Files":null,"AssetsCount":0,"Name":"test 21 - 05","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":34340,"Files":null,"AssetsCount":0,"Name":"test Diego","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":17857,"Files":null,"AssetsCount":0,"Name":"tests","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null},{"GalleryId":17643,"Files":null,"AssetsCount":0,"Name":"Uncategorized Media","Default":false,"GalleryTypeId":1,"AllowDeletion":true,"AllowAssetDeletion":true,"AllowEdit":true,"ErrorMessage":null,"DateModified":null}],"TotalResults":0,"AudioCount":0,"VideoCount":0,"ImageCount":0,"DocumentCount":0,"ErrorMessage":"","DateModified":null}';

if (isset($_POST['js'])) {
  $p = indentJson($_POST['js']);
  echo "<pre>$p</pre>";
}
?>
<br/>
<br/>
Enter JSON<br/>
<form name="form1" action="indentJson.php" method="POST">
<textarea name="js"></textarea>
<br/>
<input type="submit"/>
</form>
</body>
</html>
<?php
function indentJson( $json )
{
  $result = '';
  $level = 0;
  $in_quotes = false;
  $in_escape = false;
  $ends_line_level = NULL;
  $json_length = strlen( $json );

  for( $i = 0; $i < $json_length; $i++ ) {
    $char = $json[$i];
    $new_line_level = NULL;
    $post = "";
  if( $ends_line_level !== NULL ) {
    $new_line_level = $ends_line_level;
    $ends_line_level = NULL;
  }
  if ( $in_escape ) {
    $in_escape = false;
  } else if( $char === '"' ) {
    $in_quotes = !$in_quotes;
  } elseif( ! $in_quotes ) {
    switch( $char ) {
      case '}': case ']':
        $level--;
        $ends_line_level = NULL;
        $new_line_level = $level;
        break;
      case '{': case '[':
        $level++;
      case ',':
        $ends_line_level = $level;
        break;
      case ':':
        $post = " ";
        break;
      case " ": case "\t": case "\n": case "\r":
        $char = "";
        $ends_line_level = $new_line_level;
        $new_line_level = NULL;
        break;
      }
    } elseif ( $char === '\\' ) {
      $in_escape = true;
    }
    if( $new_line_level !== NULL ) {
      $result .= "\n".str_repeat( "  ", $new_line_level );
    }
    $result .= $char.$post;
  }
  return $result;
}
?>
