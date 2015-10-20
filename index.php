<?php
/**
 * Created by PhpStorm.
 * User: Marquis
 * Date: 15/10/20
 * Time: 下午5:40
 */
require_once dirname(__FILE__) . "/SearchBrain.php";
require_once dirname(__FILE__) . "/SearchSites.php";

$brain = new SearchBrain();
$sitesList = new SearchSites();
$data = $brain->searching(isset($_GET['q']) ? $_GET['q'] : '', isset($_GET['siteId']) ? $_GET['siteId'] : 0);
$sites = $sitesList->SitesList();

$q = $data['q'];
$siteId = $data['siteId'];
$url = $data['url'];
$Searching = !!$q;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="">
    <meta name="description" content="">
    <title>Uni-Search</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

    <!--[if lte IE 8]>

    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css">

    <![endif]-->
    <!--[if gt IE 8]><!-->

    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">

    <!--<![endif]-->

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="css/layouts/uni-search-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="css/layouts/uni-search.css">
    <!--<![endif]-->

</head>
<body>

<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-md-1-4">
        <div class="header">
            <h1 class="brand-title">Uni-Search</h1>

            <form class="pure-form" method="get" action="?" id="top">
                <input id="q" name="q" type="text" class="pure-input-1-1 search" value="<?php echo $q ?>">
                <select name="siteId" id="site">
                    <!-- 选项开始 -->
                    <?php
                    foreach ($sites as $key => $value) {
                        $selected = $key == $siteId ? 'selected' : '';
                        echo '<option ' . $selected . ' value="' . $key . '">' . $value['name'] . '</option>';
                    }
                    ?>
                    <!-- 选项结束 -->
                </select>
            </form>
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <button type="submit" id="go" class="pure-button">Go</button>
                    </li>
                    <li class="nav-item">
                        <a class="pure-button" href="/">Back</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="content pure-u-1 pure-u-md-3-4">
        <?php if ($Searching) { ?>
            <iframe id="frame" frameborder="0" marginheight="0" src="<?php echo $url; ?>"></iframe>
        <?php } ?>
    </div>
</div>
<script src="/js/jquery-2.1.4.min.js">
</script>
<script>
    $(document).ready(function () {
        var go = function () {
            if ($('#q').val()) {
                $('#top').submit();
            }
        }
        $('#top').submit(function () {
            if (!$('#q').val()) {
                return false;
            }
        });
        $('#go').click(go);
        $('#site').change(go);
        $(document).keyup(function (e) {
            if (e.which === 13) {
                e.preventDefault();
                go();
            }
            if (e.which === 27 && location.pathname != "/") {
                location.href = "/";
            }
        });

        var _resize = function () {
            var h = $(window).height() - 2;
            $("#frame").css({
                height: h
            });
        }
        _resize();
        $(window).resize(_resize);

    });
</script>
</body>
</html>

