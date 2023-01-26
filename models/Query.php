<?php
class Query extends Database
{
   public static function getQuery($switcher)
   {
       switch ($switcher) {
           case 'all':
               return "SELECT id, concat(last_name, ' ',first_name, ' ', middle_name) AS 'ФИО', data_of_birth, created_at, update_at 
                        FROM user";
           case 'trial':
               return "SELECT  id,  
                        concat(last_name, ' ',first_name, ' ', middle_name) AS 'ФИО', 
                        data_of_birth, 
                        created_at,
                        update_at  
                        FROM user
                        WHERE    created_at >=  ( CURRENT_DATE - INTERVAL 23 MONTH )
                        ORDER BY  last_name
                        ";
           case 'fired':
               return "SELECT user.id, concat(user.last_name, ' ', user.first_name, ' ', user.middle_name) AS 'ФИО', dismiss.created_at AS 'Дата увольнения' , reason.description 
                        FROM user 
                        JOIN user_dismission AS dismiss ON user.id = dismiss.user_id
                        JOIN dismission_reason AS reason ON dismiss.reason_id = reason.id";
           case 'chief':
               return "
                        SELECT
                        user.id ,
                        concat(user.last_name, ' ', user.first_name, ' ', user.middle_name) AS 'ФИО',
                        department.description AS  'Описание', 
                        position.created_at AS 'Дата приема на работу',
                        concat(leader.last_name, ' ', leader.first_name, ' ', leader.middle_name) AS 'ФИО начальника'
                        
						FROM user_position AS position
                        JOIN (SELECT position.department_id,  MAX(position.user_id) AS last_user
                                    FROM user_position AS position
                                    GROUP BY  position.department_id
                            ) 
                            AS last ON position.user_id = last.last_user
                        JOIN user ON user.id = position.user_id
                        JOIN department ON department.id = last.department_id
                        JOIN user AS leader ON department.leader_id = leader.id";
           default:
               return false;
       }
   }
    public static function getPageCount($switcher, $limit = 20)
    {
        $query = self::getQuery($switcher);
        $resultCount = mysqli_query(self::getConnection(), $query);
        $totalPages = mysqli_num_rows($resultCount);
        return ceil($totalPages / $limit);
    }
    public static function getPage($switcher, $page_number, $limit = 20)
    {
        $query = self::getQuery($switcher);
        $offset = ($page_number-1) * $limit;
        $query .= " LIMIT  $limit";
        $query .= " OFFSET $offset";
        return mysqli_query(self::getConnection(), $query);
    }
    public static function getResult($switcher)
    {
       return mysqli_query(self::getConnection(), self::getQuery($switcher));
    }

}