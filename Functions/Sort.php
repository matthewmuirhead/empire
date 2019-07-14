<?php
function sortASC($sortList, $field) {
  $sortKey = array();
  foreach ($sortList as $key => $row) {
    $sortKey[$key] = $row[$field];
  }
  array_multisort($sortKey, SORT_ASC, $sortList);
  return $sortList;
}

function sortDESC($sortList, $field) {
  $sortKey = array();
  foreach ($sortList as $key => $row) {
    $sortKey[$key] = $row[$field];
  }
  array_multisort($sortKey, SORT_DESC, $sortList);
  return $sortList;
}
