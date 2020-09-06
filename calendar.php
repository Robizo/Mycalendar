<?php
    include_once 'dbh.inc.php';

    
?>


<!DOCTYPE html> 
<html>
    <head>
        <title> MY calendar </title>
        
        <style type="text/css">
        div#head{
            margin: 0 auto;
            width: 265px;
            height: auto;
            background-color: cornflowerblue;
            border: 5px solid coral;
            border-radius: 20%;
            box-shadow: 0 0px 0 rgba(0,0,0,0.3), 0 7px 21px rgba(0,0,0,0.2);
        }
        p{
            color: darkslategray;
            display: inline;
            font-size: 50px;
            
        }
        table, td,td{
            border: 2px solid black;
            text-align:center;
            
        }
        td{
            width: 100px;
            height: 100px;
            font-size: large;
            background-color: rgba(106,50,200,0.3);
            
        }
        table{
            
            
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0px 0 rgba(0,0,0,0.3), 0 7px 21px rgba(0,0,0,0.2);
           

        }
        thead th{
            height: 60px;
            background-color: rgba(58, 121, 0, 0.61);
        }
        
        form{
            float: left;
        }
        input[type=text]{
            padding: 5px 10px;
            width: 250px;
            
        }
        input[type=datetime-local]{
            padding: 5px 10px;
            width: 250px;
            
        }
        #curentdate{
            text-align: center;
            font-size: 30px;
            color: Darkblue;
        }
        #list{
         
          float: left;
          
          text-align: center;
          border: 2px solid black;
          width: 200px;
          height: 300px;
          background-color: lightgray;
          box-shadow: 0 0px 0 rgba(0,0,0,0.3), 0 7px 21px rgba(0,0,0,0.2);
        }
        #forms{
            float: left;
        }
    
        </style>
    </head>
    <body>
        <div id="head">
            <p>My Calendar</p>
        </div>
        
        <div>
        <div id="froms"> 
        <form action="add.inc.php" method="POST">
            <input type="datetime-local" name="time" placeholder="pick the date">
        </br>
            <input type="text" name="note" placeholder="type something...">
        </br>
        <button type="submit" name="submit"> Add </button>
    </br>
    <div id="list">
        <?php
            if(isset($_GET['id']))
            {
                $now = new \DateTime('now');
                
                $sql = "SELECT * FROM notes ORDER BY data ASC";
                $result = $conn->query($sql);
                $noww = $now->format('Y').$now->format('m').$_GET['id'];
            $locals= new datetime($noww);
            if ($result->num_rows > 0) 
            {
                Echo "<h1> To do list </h1> </br>";
                while($row = $result->fetch_assoc()) 
                {
                    $aux = explode(' ',$row['data']);
                    
                    if($aux[0] == $locals->format('Y-m-d') )
                    {
                        echo "<p style='font-size: large'>AT:".$aux[1]." - ".$row['text']."</p>";
                    }
                    
                }
            }
              }
            
            
            ?>
        
        </div>
        </form>
    

    </div>
        
        <?php

         $now = new \DateTime('now');
         $month = $now->format('F');
        $year = $now->format('Y');

        $noww = $now->format('Y').$now->format('m').'01';
        $local= new datetime($noww);
        
        $daycount= 01;
        $count=1;
       

       function myfunction($locals)
       { 
           GLOBAL $daycount;
           GLOBAL $conn;
           GLOBAL $count;
        $sql = "SELECT * FROM notes";
        $result = $conn->query($sql);
           
           $itemcount=0;
          
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $aux = explode(' ',$row['data']);
                
                if($aux[0] == $locals->format('Y-m-d')){
                
                    $itemcount++;
                }
                
            }
            if($itemcount != 0)
            echo "<a href='calendar.php?id=".$daycount."' style='font-size: smaller;'> You have ".$itemcount." elements</a>";
            else 
            echo "</br> </br>";

            $count++;
            if($count < 10)
                $daycount= "0".$count;
            else
            $daycount = $count;
        } 
       }
        ?>

        <table>
            <thead> <tr> <th colspan="7">  <?php echo "<p id='curentdate' >".$month." ".$year."</p>" ?> </th></tr></thead>
            <tbody>
                <tr>
                    <td>01 <?php echo $local->format('D');  ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>02  <?php echo $local->format('D');  ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>03  <?php echo $local->format('D');  ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>04  <?php echo $local->format('D');  ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>05  <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td> 
                    <td>06  <?php echo $local->format('D');  ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>07 <?php echo $local->format('D');  ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?>  </td>
                </tr>
                <tr>
                    <td>08 <?php echo $local->format('D');  ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?>  </td>
                    <td>09 <?php echo $local->format('D'); ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?>  </td>
                    <td>10 <?php echo $local->format('D');  ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?>  </td>
                    <td>11 <?php echo $local->format('D'); ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?>  </td>
                    <td>12 <?php echo $local->format('D');  ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?>  </td>
                    <td>13 <?php echo $local->format('D');  ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?>  </td>
                    <td>14 <?php echo $local->format('D');  ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?>  </td>
                </tr>
                <tr>
                    
                    <td>15 <?php echo $local->format('D'); ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?>  </td>
                    <td>16 <?php echo $local->format('D');  ?></br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?>  </td>
                    <td>17 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>18 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>19 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>20 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>21 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                </tr>
                <tr>
                    <td>22 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>23 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>24 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>25 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>26 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>27 <?php echo $local->format('D'); ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td>28 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    
                </tr>
                <tr>

                <?php 
                $month= $now->format('m');
                switch($month)
                    {
                        
                        case "02":
                            if($year % 4 == 0)
                            {
                                echo '<style type="text/css">
                    #last {
                     display: none;
                     }
                     #secunde{
                         display: none;
                     }
                     #first{
                         display: none;
                     }
                     </style>';
                            }
                            else{
                                echo '<style type="text/css">
                     #secunde{
                         display: none;
                     }
                     #first{
                         display: none;
                     }
                     </style>';
                            }
                        break;
                        case "04":
                            echo '<style type="text/css">
                     #first{
                         display: none;
                     }
                     </style>';
                        break;
                        case "06":
                            echo '<style type="text/css">
                     #first{
                         display: none;
                     }
                     </style>';
                        break;
                        case "09":
                            echo '<style type="text/css">
                     #first{
                         display: none;
                     }
                     </style>';
                        break;
                        case "11":
                            echo '<style type="text/css">
                     #first{
                         display: none;
                     }
                     </style>';
                        break;
                    }

                    ?>
                    <td id="last">29 <?php echo $local->format('D');  ?> </br> </br><?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td id="secunde">30 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                    <td id="first">31 <?php echo $local->format('D');  ?> </br> </br> <?php myfunction($local);  $local->modify('+1 day'); ?> </td>
                </tr>
            </tbody>
        </table>
         </div>
        
         


 
    </body>
</html>