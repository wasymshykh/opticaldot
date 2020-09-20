<?php

function redirect($url)
{
	header("Location: " . $url);
	exit;
}

function br2nl($str)
{
	$str = preg_replace("/(\r\n|\n|\r)/", "", $str);
	return preg_replace("=&lt;br */?&gt;=i", "\n", $str);
}

function getConfig()
{
	global $PDO;
	$sam = $PDO->query("SELECT * FROM `config`");
	if ($sam != FALSE) {
		while ($row = $sam->fetch()) {
			$config[$row['name']] = $row['value'];
		}
		return $config;
	}
	return FALSE;
}

$config = getConfig();

function iif($condition, $true, $false = '')
{
	if ($condition) {
		return $true;
	} else {
		return $false;
	}
}

function paginationBar($totalRows, $currentPage, $rowsLimit, $url)
{
	$pages = ceil($totalRows / $rowsLimit);
	if ($pages > 1) { // Enables Pagination only when there are more than 1 pages

		if ($currentPage > 1) {
			$previous = '<li class="page-item"><a class="page-link" href="' . $url . '&page=' . ($currentPage - 1) . '&limit=' . ($rowsLimit) . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
		} else {
			$previous = '';
		}
		if ($currentPage < $pages) {
			$next = '<li class="page-item"><a class="page-link" href="' . $url . '&page=' . ($currentPage + 1) . '&limit=' . ($rowsLimit) . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
		} else {
			$next = '';
		}

		$y = 0;
		$list = "";
		for ($x = 1; $x <= $pages; $x++) {

			if ($pages > 20) {
				if (abs($x - $currentPage) < 5) { } elseif ($x < 6) { } elseif (($pages - $x) < 5) { } else {
					continue;
				}
			}

			if ($x != ($y + 1)) {
				$list .= '<li class="page-item"><a class="page-link" href="#">.....</a></li>';
			}
			if ($currentPage != $x) {
				$list .= '<li class="page-item"><a class="page-link" href="' . $url . '&page=' . ($x) . '&limit=' . ($rowsLimit) . '">' . $x . '</a></li>';
			} else {
				$list .= '<li class="page-item active"><a class="page-link" href="' . $url . '&page=' . ($x) . '&limit=' . ($rowsLimit) . '">' . $x . ' <span class="sr-only">(current)</span></a></li>';
			}
			$y = $x;
		}

		return '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">' . $previous . $list . $next . '</ul></nav>';
	}
}

function paginationBarUI($totalRows, $currentPage, $rowsLimit, $url)
{

	/*
	<div class="portBoxPagi">
		<a href="#" class="portPagiBtn"><i class="material-icons">arrow_left</i></a>
		<a href="#" class="portPagiNum pagiActive">1</a>
		<a href="#" class="portPagiNum">2</a>
		<a href="#" class="portPagiNum">3</a>
		<span class="portPagiSpace">...</span>
		<a href="#" class="portPagiNum">19</a>
		<a href="#" class="portPagiNum">20</a>
		<a href="#" class="portPagiBtn"><i class="material-icons">arrow_right</i></a>
	</div>
	*/

	$pages = ceil($totalRows / $rowsLimit);
	if ($pages > 1) { // Enables Pagination only when there are more than 1 pages

		if ($currentPage > 1) {
			$previous = '<a href="' . $url . '/' . ($currentPage - 1) . '" class="portPagiBtn"><i class="material-icons">arrow_left</i></a>';
		} else {
			$previous = '';
		}
		if ($currentPage < $pages) {
			$next = '<a href="' . $url . '/' . ($currentPage + 1) . '" class="portPagiBtn">Next <i class="material-icons">arrow_right</i></a>';
		} else {
			$next = '';
		}

		// $y = 0;
		// for ($x = 1; $x <= $pages; $x++) {

		// 	if ($pages > 20) {
		// 		if (abs($x - $currentPage) < 5) { } elseif ($x < 6) { } elseif (($pages - $x) < 5) { } else {
		// 			continue;
		// 		}
		// 	}

		// 	if ($x != ($y + 1)) {
		// 		$list .= '<span class="portPagiSpace">...</span>';
		// 	}
		// 	if ($currentPage != $x) {
		// 		$list .= '<a class="portPagiNum" href="' . $url . '&page=' . ($x) . '&limit=' . ($rowsLimit) . '">' . $x . '</a>';
		// 	} else {
		// 		$list .= '<a class="portPagiNum pagiActive" href="' . $url . '&page=' . ($x) . '&limit=' . ($rowsLimit) . '">' . $x . ' </a>';
		// 	}
		// 	$y = $x;
		// }

		return '<div class="portBoxPagi">' . $previous . $next . '</div>';
	}
}

function pageRequiresAuthentication()
{
	if (!checkLoginStatusUser()) {
		redirect('login.php');
	}
}

function checkCredentialsUser($userId, $password)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT `id`,`permission` FROM `user` WHERE `id`=:userId AND `password`=:password");
	$sam->execute(array(':userId' => $userId, ':password' => $password));
	if ($sam->rowCount() == 1) {
		$row = $sam->fetch();
		return $row['permission'];
	}
	return FALSE;
}

function feasible_param($parameter)
{
	return ucfirst(str_replace(array('R', 'Y', 'B'), array('Red', 'Yellow', 'Blue'), implode(' ', preg_split('/(?=[A-Z])/', $parameter))));
}


function checkLoginStatusUser()
{

	global $_SESSION, $_COOKIE;

	$status = FALSE;

	if (!isset($_SESSION['user']) || !isset($_SESSION['key'])) {
		if (isset($_COOKIE['user']) && isset($_COOKIE['key'])) {
			$_SESSION['user'] = $_COOKIE['user'];
			$_SESSION['key'] = $_COOKIE['key'];
		}
	}

	if (isset($_SESSION['user']) && isset($_SESSION['key'])) {
		$userId = $_SESSION['user'];
		$password = $_SESSION['key'];

		$status = checkCredentialsUser($userId, $password);
	}

	if ($status !== FALSE) {
		return $status;
	} else {
		logoutUser();
		return FALSE;
	}
}

function logoutUser()
{

	global $_SESSION, $_COOKIE;

	$_SESSION['user'] = false;
	$_SESSION['key'] = false;
	setcookie('user', null, -1);
	setcookie('key', null, -1);

	unset($_SESSION['user']);
	unset($_SESSION['key']);
	unset($_COOKIE['user']);
	unset($_COOKIE['key']);

	if (session_status() === PHP_SESSION_ACTIVE) {
		session_destroy();
	}
}


function get_project_types()
{
	global $PDO;
	$sam = $PDO->query("SELECT * FROM `project_types`");
	if ($sam->rowCount() > 0) {
		return $sam->fetchAll();
	}
	return FALSE;
}
function get_features()
{
	global $PDO;
	$sam = $PDO->query("SELECT * FROM `features`");
	if ($sam->rowCount() > 0) {
		return $sam->fetchAll();
	}
	return FALSE;
}
function get_feature($id)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT * FROM `features` WHERE `id`=:id");
	$sam->execute(array(':id' => $id));
	if ($sam->rowCount() == 1) {
		return $sam->fetch();
	}
	return FALSE;
}
function get_technologies()
{
	global $PDO;
	$sam = $PDO->query("SELECT * FROM `technologies`");
	if ($sam->rowCount() > 0) {
		return $sam->fetchAll();
	}
	return FALSE;
}
function get_technology($id)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT * FROM `technologies` WHERE `id`=:id");
	$sam->execute(array(':id' => $id));
	if ($sam->rowCount() == 1) {
		return $sam->fetch();
	}
	return FALSE;
}

function display_alert($alertMessage, $alertType = 'warning')
{
	return '
	<div class="alert alert-' . $alertType . ' alert-dismissible fade show" role="alert">
	' . $alertMessage . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
	</div>';
}

function display_media($media_id)
{
	global $config;
	return $config['website_url'] . '/image.php?id=' . $media_id;
}

function insert_portfolio($title, $slug, $description, $externalLink, $cover, $thumbnail, $listOrder, $date_completed, $themeColor)
{
	global $PDO;
	$sam = $PDO->prepare("INSERT INTO `portfolio` SET
	`title`=:title,
	`slug`=:slug,
	`description`=:description,
	`externalLink`=:externalLink,
	`cover`=:cover,
	`thumbnail`=:thumbnail,
	`listOrder`=:listOrder,
	`date_completed`=:date_completed,
	`themeColor`=:themeColor,
	`datetime_added`=NOW()
	");
	$sam->execute(
		array(
			'title' => $title,
			'slug' => $slug,
			'description' => $description,
			'externalLink' => $externalLink,
			'cover' => $cover,
			'thumbnail' => $thumbnail,
			'listOrder' => $listOrder,
			'date_completed' => $date_completed,
			'themeColor' => $themeColor
		)
	);
	return $PDO->lastInsertId();
}

function search_portfolio($title, $description, $externalLink, $cover, $thumbnail, $listOrder, $date_completed, $themeColor)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT `id` FROM `portfolio` WHERE
	`title`=:title AND
	`description`=:description AND
	`externalLink`=:externalLink AND
	`cover`=:cover AND
	`thumbnail`=:thumbnail AND
	`listOrder`=:listOrder AND
	`date_completed`=:date_completed AND
	`themeColor`=:themeColor
	");
	$sam->execute(
		array(
			'title' => $title,
			'description' => $description,
			'externalLink' => $externalLink,
			'cover' => $cover,
			'thumbnail' => $thumbnail,
			'listOrder' => $listOrder,
			'date_completed' => $date_completed,
			'themeColor' => $themeColor
		)
	);
	if ($sam->rowCount() > 0) {
		$row = $sam->fetch();
		return $row['id'];
	}
	return FALSE;
}

function update_portfolio($portfolio_id, $title, $slug, $description, $externalLink, $cover, $thumbnail, $listOrder, $date_completed, $themeColor)
{
	global $PDO;
	$sam = $PDO->prepare("UPDATE `portfolio` SET
	`title`=:title,
	`slug`=:slug,
	`description`=:description,
	`externalLink`=:externalLink,
	`cover`=:cover,
	`thumbnail`=:thumbnail,
	`listOrder`=:listOrder,
	`date_completed`=:date_completed,
	`themeColor`=:themeColor,
	`datetime_added`=NOW()
	WHERE `id`=:portfolio_id
	");
	$sam->execute(
		array(
			'title' => $title,
			'slug' => $slug,
			'description' => $description,
			'externalLink' => $externalLink,
			'cover' => $cover,
			'thumbnail' => $thumbnail,
			'listOrder' => $listOrder,
			'date_completed' => $date_completed,
			'themeColor' => $themeColor,
			':portfolio_id' => $portfolio_id
		)
	);
	return $sam->rowCount();
}

function insert_portfolio_pictures($portfolio_id, $media_id)
{
	global $PDO;
	$sam = $PDO->prepare("INSERT INTO `portfolio_pictures` SET
	`portfolio_id`=:portfolio_id,
	`media_id`=:media_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id,
			':media_id' => $media_id
		)
	);
}

function delete_portfolio_pictures($portfolio_id)
{
	global $PDO;
	$sam = $PDO->prepare("DELETE FROM `portfolio_pictures` WHERE
	`portfolio_id`=:portfolio_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id
		)
	);
}
function delete_portfolio_pictures_specific($portfolio_id, $media_id)
{
	global $PDO;
	$sam = $PDO->prepare("DELETE FROM `portfolio_pictures` WHERE
	`portfolio_id`=:portfolio_id and
	`media_id`=:media_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id,
			':media_id' => $media_id
		)
	);
}

function get_portfolio_pictures($portfolio_id)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT * FROM `portfolio_pictures` WHERE 
	`portfolio_id`=:portfolio_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id
		)
	);
	if ($sam->rowCount() > 0) {
		return $sam->fetchAll();
	}
	return FALSE;
}

function insert_portfolio_features($portfolio_id, $features_id)
{
	global $PDO;
	if (search_portfolio_features($portfolio_id, $features_id) < 1) {
		$sam = $PDO->prepare("INSERT INTO `portfolio_features` SET
	`portfolio_id`=:portfolio_id,
	`features_id`=:features_id
	");
		$sam->execute(
			array(
				':portfolio_id' => $portfolio_id,
				':features_id' => $features_id
			)
		);
	}
}

function search_portfolio_features($portfolio_id, $features_id)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT * FROM `portfolio_features` WHERE
	`portfolio_id`=:portfolio_id AND
	`features_id`=:features_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id,
			':features_id' => $features_id
		)
	);
	return $sam->rowCount();
}

function delete_portfolio_features($portfolio_id)
{
	global $PDO;
	$sam = $PDO->prepare("DELETE FROM `portfolio_features` WHERE
	`portfolio_id`=:portfolio_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id
		)
	);
}

function get_portfolio_features($portfolio_id)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT * FROM `portfolio_features` WHERE
	`portfolio_id`=:portfolio_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id
		)
	);
	return $sam->fetchAll();
}

function get_portfolio_features_joined($portfolio_id)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT * FROM `portfolio_features` p
	LEFT JOIN `features` f ON (p.features_id=f.id)
	WHERE p.`portfolio_id`=:portfolio_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id
		)
	);
	return $sam->fetchAll();
}

function insert_portfolio_technologies($portfolio_id, $technologies_id)
{
	global $PDO;
	if (search_portfolio_technologies($portfolio_id, $technologies_id) < 1) {
		$sam = $PDO->prepare("INSERT INTO `portfolio_technologies` SET
	`portfolio_id`=:portfolio_id,
	`technologies_id`=:technologies_id
	");
		$sam->execute(
			array(
				':portfolio_id' => $portfolio_id,
				':technologies_id' => $technologies_id
			)
		);
	}
}

function search_portfolio_technologies($portfolio_id, $technologies_id)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT * FROM `portfolio_technologies` WHERE
	`portfolio_id`=:portfolio_id AND
	`technologies_id`=:technologies_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id,
			':technologies_id' => $technologies_id
		)
	);
	return $sam->rowCount();
}

function delete_portfolio_technologies($portfolio_id)
{
	global $PDO;
	$sam = $PDO->prepare("DELETE FROM `portfolio_technologies` WHERE
	`portfolio_id`=:portfolio_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id
		)
	);
}

function get_portfolio_technologies($portfolio_id)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT * FROM `portfolio_technologies` WHERE
	`portfolio_id`=:portfolio_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id
		)
	);
	return $sam->fetchAll();
}

function get_portfolio_technologies_joined($portfolio_id)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT * FROM `portfolio_technologies` p
	LEFT JOIN `technologies` f ON (p.technologies_id=f.id)
	WHERE p.`portfolio_id`=:portfolio_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id
		)
	);
	return $sam->fetchAll();
}

function insert_portfolio_project_types($portfolio_id, $type_id)
{
	global $PDO;
	if (search_portfolio_project_types($portfolio_id, $type_id) < 1) {
		$sam = $PDO->prepare("INSERT INTO `portfolio_project_types` SET
	`portfolio_id`=:portfolio_id,
	`type_id`=:type_id
	");
		$sam->execute(
			array(
				':portfolio_id' => $portfolio_id,
				':type_id' => $type_id
			)
		);
	}
}

function search_portfolio_project_types($portfolio_id, $type_id)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT * FROM `portfolio_project_types` WHERE
	`portfolio_id`=:portfolio_id AND
	`type_id`=:type_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id,
			':type_id' => $type_id
		)
	);
	return $sam->rowCount();
}

function delete_portfolio_project_types($portfolio_id)
{
	global $PDO;
	$sam = $PDO->prepare("DELETE FROM `portfolio_project_types` WHERE
	`portfolio_id`=:portfolio_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id
		)
	);
}

function get_portfolio_project_types($portfolio_id)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT * FROM `portfolio_project_types` WHERE
	`portfolio_id`=:portfolio_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id
		)
	);
	return $sam->fetchAll();
}

function get_portfolio_project_types_joined($portfolio_id)
{
	global $PDO;
	$sam = $PDO->prepare("SELECT * FROM `portfolio_project_types` ppt
	LEFT JOIN `project_types` pt ON (pt.id=ppt.type_id)
	WHERE
	`portfolio_id`=:portfolio_id
	");
	$sam->execute(
		array(
			':portfolio_id' => $portfolio_id
		)
	);
	return $sam->fetchAll();
}



function timeSince($time)
{

	$time = time() - strtotime($time) + HOUR_DIFFERENCE_DB * 3600; // to get the time since that moment

	$tokens = array(
		31536000 => 'year',
		2592000 => 'month',
		604800 => 'week',
		86400 => 'day',
		3600 => 'hour',
		60 => 'minute',
		1 => 'second'
	);

	foreach ($tokens as $unit => $text) {
		if ($time < $unit) continue;
		$numberOfUnits = floor($time / $unit);
		return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
	}
}

function modal_delete($modalId, $thing, $buttonLink)
{

	$title = 'Delete this ' . $thing . '?';
	$description = 'Are you sure you want to delete this ' . $thing . '?';
	$buttonTitle = 'Delete';
	$buttonAlert = 'danger';
	$buttonIcon = 'trash';

	return modal_simple($modalId, $title, $description, $buttonTitle, $buttonLink, $buttonAlert, $buttonIcon);
}

function modal_simple($modalId, $title, $description, $buttonTitle = '', $buttonLink = '', $buttonAlert = 'warning', $buttonIcon = 'check')
{
	return '
	<div class="modal fade" id="' . $modalId . '" tabindex="-1" role="dialog" aria-labelledby="' . $modalId . 'Label" aria-hidden="true">
		<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="' . $modalId . 'Label">' . $title . '</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">
			' . $description . '
			</div>
			' . iif((!empty($buttonTitle) && !empty($buttonLink)), '<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<a type="button" class="btn btn-' . $buttonAlert . '" href="' . $buttonLink . '"><i class="fa fa-' . $buttonIcon . '"></i> ' . $buttonTitle . '</a>
			</div>') . '
		</div>
		</div>
	</div>
	';
}

function serialize_array($array, $delimiter = ',', $parameter = '')
{
	$return = '';
	$size = sizeof($array);
	for ($i = 0; $i < $size; $i++) {
		if (!empty($parameter)) {
			$return .= $array[$i][$parameter];
		} else {
			$return .= $array[$i];
		}

		if ($i < ($size - 1)) {
			$return .= $delimiter . ' ';
		}
	}
	return $return;
}
