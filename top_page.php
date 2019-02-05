<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script> !-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<?php
// それぞれの最新記事を取ってきて返す
function divide_articles($url) {
  $results = array();
  $idx = 0;
  $xml_data = simplexml_load_file($url);
  foreach($xml_data->item as $item) {
    $result_dict = array(
      "title" => (string)$item->title,
      "link" => (string)$item->link,
      "description" => (string)$item->description,
    );
    $results[] = $result_dict;
    $idx += 1;
    if($idx == 20) {
      break;
    }
  }
  return $results;
}

$cv_url = 'http://export.arxiv.org/rss/cs.CV/rss.xml';
$cl_url = 'http://export.arxiv.org/rss/cs.CL/rss.xml';
$ml_url = 'http://export.arxiv.org/rss/cs.AI/rss.xml';

$cv_results = divide_articles($cv_url);
$cl_results = divide_articles($cl_url);
$ml_results = divide_articles($ml_url);
?>
<div class="container-fluid">
  <div class="page-header">
	  <h1>Arxiv AI Paper Searcher</h1>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
	      <div class="panel-heading">
	  	    Computer Vision
	      </div>
	      <div class="panel-body">
		      <?php
            foreach($cv_results as $cv_result) {
              $url = $cv_result["link"];
              $title = $cv_result["title"];
              $description = $cv_result["description"];
              echo '<div class="panel panel-default">';
              echo '<div class="panel-body">';
              echo '<a href="' . $url . '">' . $title . '</a>';
              echo '<p>' . $description . '</p>';
              echo '</div>';
              echo '</div>';
            }
          ?>
	      </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-default">
	      <div class="panel-heading">
          Computational Linguistics
	      </div>
	      <div class="panel-body">
          <?php
            foreach($cl_results as $cl_result) {
              $url = $cl_result["link"];
              $title = $cl_result["title"];
              $description = $cl_result["description"];
              echo '<div class="panel panel-default">';
              echo '<div class="panel-body">';
              echo '<a href="' . $url . '">' . $title . '</a>';
              echo '<p>' . $description . '</p>';
              echo '</div>';
              echo '</div>';
            }
          ?>
	      </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-default">
	        <div class="panel-heading">
            Machine Learning
	        </div>
	        <div class="panel-body">
            <?php
              foreach($ml_results as $ml_result) {
                $url = $ml_result["link"];
                $title = $ml_result["title"];
                $description = $ml_result["description"];
                echo '<div class="panel panel-default">';
                echo '<div class="panel-body">';
                echo '<a href="' . $url . '">' . $title . '</a>';
                echo '<p>' . $description . '</p>';
                echo '</div>';
                echo '</div>';
            }
          ?>
	        </div>
      </div>
    </div>
    </div>
  </div>
</div>


</body>
<script src="https://code.jquery.com/jquery.js"></script> 
</html>