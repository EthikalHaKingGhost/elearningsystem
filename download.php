
<?php




if (isset($_GET["id"])){

  $id = $_GET["id"];

  require 'include/connection.php';
  
        $query = "SELECT assignment_path FROM assignments WHERE assignment_id = '$id'";  

        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($result);

        $FilePaths = $row["assignment_path"];

        }


if (isset($_GET["lid"])){

  $lid = $_GET["lid"];

  require 'include/connection.php';
  
        $query = "SELECT lesson_source FROM lessons WHERE lesson_id = '$lid'";  

        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($result);

        $FilePaths = $row["lesson_source"];

        $update = "UPDATE `lessons` SET downloads = downloads + 1 WHERE `lessons`.`lesson_id` = '$lid'";

            $query = mysqli_query($conn, $update);


        }
        

if (isset($_GET["bid"])){

  $bid = $_GET["bid"];

  require 'include/connection.php';
  
        $query = "SELECT book_path FROM library WHERE book_id = '$bid'";  

        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($result);

        $FilePaths = $row["book_path"];


        }



download_file($FilePaths);

function download_file( $fullPath )
{
  if( headers_sent() )
    die('Headers Sent');


  if(ini_get('zlib.output_compression'))
    ini_set('zlib.output_compression', 'Off');


  if( file_exists($fullPath) )
  {

    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);

    switch ($ext) 
    {
      case "pdf": $ctype="application/pdf"; break;
      case "exe": $ctype="application/octet-stream"; break;
      case "zip": $ctype="application/zip"; break;
      case "doc": $ctype="application/msword"; break;
      case "xls": $ctype="application/vnd.ms-excel"; break;
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
      case "jpeg":
      case "jpg": $ctype="image/jpg"; break;
      default: $ctype="application/force-download";
    }

    header("Pragma: public"); 
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 
    header("Content-Type: $ctype");
    header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$fsize);
    ob_clean();
    flush();
    readfile( $fullPath );
    mysqli_close($conn);
  } 
  else

    echo '<section class="slice sct-color-1">
                        <div class="container pb-5">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <div class="text-center">
                                        <div class="d-block p-2">
                                            <i class="fab fa-shopify  fa-5x"></i>
                                        </div>
                                        <h2 class="heading heading-3 strong-600">OOPS!</h2>
                                        <p class="mt-5 px-5">
                                            Failed to download!
                                        </p>
                                        <button onclick="history.go(-1)" class="btn btn-grad btn-lg mt-4">
                                            Go Back
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>' ;
    die();
  mysqli_close($conn);

}