<?php

namespace App\Core;

class Pagination
{

    public function getPagination($total_records = 0, $limit = 10, $url = '/', $page = 1)
    {
        if ($total_records > 0) {
            $total_pages = ceil($total_records / $limit);
            $pagLink = '<nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="' . $url . '?page=1" tabindex="-1">First</a>
                            </li>';
            for ($i = 1; $i <= $total_pages; $i++) {
                $class = ($i == $page) ? 'active' : '';
                $pagLink .=  '<li class="page-item ' . $class . '"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>';
            }
            $pagLink .= ' <li class="page-item">
                            <a class="page-link" href="' . $url . '?page=' . $total_pages . '">Last</a>
                            </li>
                            </ul>
                            </nav>';
            return $pagLink;
        }
    }
}
