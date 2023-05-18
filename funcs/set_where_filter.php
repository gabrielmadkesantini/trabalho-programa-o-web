<?php

function set_where_filter($data)
{
  $where_formater = [];

  foreach ($data as $key => $val) {

    switch ($key) {
      case 'name':
        $where_formater[] = "users.name like :name";
        break;
      case 'file':
        $where_formater[] = "documents.path like :file";
        break;
      case 'date':
        $where_formater[] = "DATE(documents.data_criacao)=:date";
        break;
      default:
        $where_formater[] = "permissions.user_id=:id";
        break;
    }
  }
  if (count($where_formater) > 1) {
    foreach ($where_formater as $key => $val) {
      if ($key < count($where_formater) - 1) {
        $where_formater[$key] .= " and ";
      }
    }
  }

  $where_string = implode($where_formater);
  return $where_string;
}
