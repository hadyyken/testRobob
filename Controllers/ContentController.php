<?php
require_once('..\models\Database.php');
require_once('..\Config.php');
require_once('..\models\Query.php');

class ContentController  {
    private static string $pageNumber;
    private static string $switcher;

    public function __construct()
    {
        self::$pageNumber = $_POST['$pageNumber'] ?? 1;
        self::$switcher = $_POST['switcher'] ?? 'all';
    }
    private static function getTableHeader(): string
    {
        $content = "<table  class=table>";
        switch (self::$switcher) {
            case 'all':
            case 'trial':
                $content.= "<tr>
                        <th>ID</th>
                        <th>ФИО</th>
                        <th>Дата рождения</th>
                        <th>Создан</th>
                        <th>Изменение</th>
                        </tr> \n <tr> <br>\n";
                break;
            case 'fired':
            {
                $content.= "<tr>
                        <th>ID</th>
                        <th>ФИО</th>
                        <th>Дата увольнения</th>
                        <th>Причина увольнения</th>
                        </tr> \n <tr> \n";
                break;
            }
            case 'chief':
            {
                $content.= "<tr>
                        <th>ID</th>
                        <th>ФИО</th>
                        <th>Отдел</th>
                        <th>Дата приема на работу</th>
                        <th>ФИО начальника</th>
                        </tr> \n <tr> \n";
                break;
            }
        }
        return $content;
    }
    private static function getPagination ($totalPages, $pageNumber): string
    {
        $page = '';
        for ($i = 1; $i <= $totalPages; $i++)
        {
            $page .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:2px solid #ccc;";
            if ($i == $pageNumber) $page .= "background-color:  lightblue";
            $page.= "'id='".$i."'>".$i."</span>";
        }
        return $page;
    }
    public function getContent(): string
    {
        $resultQuery = new Query();
        $data = $resultQuery::getPage(self::$switcher,self::$pageNumber);
        $content = self::getTableHeader();
        while ($row = $data->fetch_assoc()  ) {
            foreach($row as $item) {
                $content.= " <td>".$item."</td> \n";
            }
            $content.= '</tr>';
        }
        $content.= '</table> <div class="container-fluid" align="center">  <br>';
        $totalPages = $resultQuery::getPageCount(self::$switcher);
        $content.= self::getPagination($totalPages , self::$pageNumber );
        $content .= "</div>";
        return $content;
    }

}

