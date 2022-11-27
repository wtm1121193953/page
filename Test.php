<?php

class Test
{
    public function index()
    {
        $page = $_GET['page']??1;
        $pageNum = $_GET['pageNum']??10;

        $conn = mysqli_connect('localhost', 'root', 'root');
        $db = mysqli_select_db($conn, 'test');

        $sql = 'select *  from article ';
        $total = mysqli_query($conn, $sql);
        $total = mysqli_num_rows($total);

        $sql = 'select * from article limit ' . $pageNum . ' offset ' . ($page - 1) * $pageNum;
        $result = mysqli_query($conn, $sql);

        $list = [];
        while (1) {
            $row = mysqli_fetch_assoc($result);
            if (!$row) break;
            $list[] = $row;
        }


        echo json_encode(['total' => $total, 'list' => $list]);
    }


}


$obj = new Test();
$obj->index();




