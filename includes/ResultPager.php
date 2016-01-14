<?php

//include "db_inc.php";

class ResultPager
{
    private $db;
    private $query;
    private $totalQuery;

    private $start;
    private $end;
    private $prevlink;
    private $nextlink;
    private $page;


    private $total;
    private $pages;
    private $limit;
    private $offset;


    public function __construct($query, $totalQuery, $db)
    {
        $this->query = $query;
        $this->totalQuery = $totalQuery;
        $this->db = $db;
        $this->initPages();
    }

    function initPages()
    {
        $this->total = $this->db->query($this->totalQuery)->fetchColumn();

        // How many items to list per page
        $this->limit = 5;

        // How many pages will there be
        $this->pages = ceil($this->total / $this->limit);
    }

    function getPages()
    {
        return $this->pages;
    }

    public function getPager($page)
    {
        $this->page = $page;

        // Calculate the offset for the query
        $this->offset = ($this->page - 1) * $this->limit;

        // Some information to display to the user
        $this->start = $this->offset + 1;
        $this->end = min(($this->offset + $this->limit), $this->total);

        $this->buildBackLink();
        $this->buildForwardLink();

        // Build the paging information
        $result = '<div id="paging"><p>' . $this->prevlink . ' Pagina ' . $this->page . ' van ' . $this->pages;
        $result .= ' paginas, resultaat ' . $this->start . '-' . $this->end . ' van ' . $this->total . ' resultaten ';
        $result .= $this->nextlink . ' </p></div>';
        return $result;
    }

    private function buildBackLink()
    {
        // The "back" link
        if ($this->page > 1) {
            $this->prevlink = '<a href="?page=1" title="Eerste pagina"><span class="glyphicon glyphicon-fast-backward">';
            $this->prevlink .= '</span></a> <a href="?page=';
            $this->prevlink .= ($this->page - 1);
            $this->prevlink .= '" title="Vorige pagina"><span class="glyphicon glyphicon-backward"></span></a>';
        } else {
            $this->prevlink = '<span class="glyphicon glyphicon-fast-backward disabled"></span>';
            $this->prevlink .= '<span class="glyphicon glyphicon-backward disabled"></span>';
        }
    }

    private function buildForwardLink()
    {
        // The "forward" link
        if ($this->page < $this->pages) {
            $this->nextlink = '<a href="?page=' . ($this->page + 1);
            $this->nextlink .= '" title="Volgende pagina"><span class="glyphicon glyphicon-forward"></span>';
            $this->nextlink .= '</a> <a href="?page=';
            $this->nextlink .= $this->pages . '" title="Laatse pagina"><span class="glyphicon glyphicon-fast-forward"></span></a>';
        } else {
            $this->nextlink = '<span class="glyphicon glyphicon-forward disabled"></span> ';
            $this->nextlink .= '<span class="glyphicon glyphicon-fast-forward disabled"></span>';
        }
    }

    public function getresults()
    {
        $stmt = $this->db->prepare($this->query);
        // Bind the query params
        $stmt->bindParam(':limit', $this->limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $this->offset, PDO::PARAM_INT);
        $stmt->execute();

        $iterator = new IteratorIterator($stmt);

        return $iterator;
    }
}
