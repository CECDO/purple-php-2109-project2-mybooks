<?php

namespace App\Model;

class FormProcessing
{


    /**
     * ! VERIFY IF $_POST IS EMPTY
     */
    public function verifyEmptyPost(): array
    {
        $errors = [];
        foreach ($_POST as $value) {
            if (empty($value)) {
                $errors[] = 'Merci de remplir tous les champs';
            }
        }
        return $errors;
    }

    public function verifyGetToFilter(): array
    {

        $errors = [];
        if (!empty($_GET)) {
            $items = [
                'author_id' => $_GET['author_id'] ?? "",
                'editor_id' => $_GET['editor_id'] ?? "",
                'category_id' => $_GET['category_id'] ?? "",
                'format_id' => $_GET['format_id'] ?? "",
                'location_id' => $_GET['location_id'] ?? "",
                'status_id' => $_GET['status_id'] ?? "",
            ];

            $errors = [];
            foreach ($items as $key => $item) {
                if (empty($items[$key])) {
                    $errors[] = "Champ de sélection vide";
                    $items[$key] = ">=0";
                } else {
                    $items[$key] = "=$item";
                }
            }
            return $items;
        } else {
            return $errors;
        }
    }

    public function verifyGetToSort(): array
    {
        if (!empty($_GET['sort'])) {
            if ($_GET['sort'] === 'title-az') {
                $sort = [
                    'field' =>  'title',
                    'direction' => 'ASC',
                ];
                return $sort;
            } elseif ($_GET['sort'] === 'title-za') {
                $sort = [
                    'field' =>  'title',
                    'direction' => 'DESC',
                ];
                return $sort;
            } elseif ($_GET['sort'] === 'author-az') {
                $sort = [
                    'field' =>  'author_name',
                    'direction' => 'ASC',
                ];
                return $sort;
            } elseif ($_GET['sort'] === 'author-az') {
                $sort = [
                    'field' =>  'author_name',
                    'direction' => 'DESC',
                ];
                return $sort;
            } elseif ($_GET['sort'] === 'first-added') {
                $sort = [
                    'field' =>  'added_date',
                    'direction' => 'ASC',
                ];
                return $sort;
            
            } else {
                $sort = [
                    'field' =>  'added_date',
                    'direction' => 'DESC',
                ];
                return $sort;
            }
        } else {
            $sort = [
                'field' =>  'added_date',
                'direction' => 'DESC',
            ];
            return $sort;
        }
       
    }
}
