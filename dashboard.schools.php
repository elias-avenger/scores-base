<?php
    session_start(); //seesion_start() function has to always be the firt line to ensure that everything is protected
    if(!isset($_SESSION['email'])){ // checking if there is a set session with an email value
        header("Location: index.php");
    }
    else{
        include "connect.php";
        $e = $_SESSION['email'];
        $q = mysqli_query($con, 
            "SELECT fname, lname FROM admin WHERE email = '$e'"
        ) or die("Failed to fetch user data: ".mysqli_error($con)); // the or die() method is executed in case of an error
        $a = mysqli_fetch_array($q);
        $fn = $a['fname'];
        $ln = $a['lname'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!--introduction-->
    <header class="sticky top-0 z-30 bg-white w-full h-24 flex  justify-between p-6 border-b-4 border-greener ">
        <img src="images/logo-girls.png" alt="technovation girls">
        <h1 class="text-3xl text-greener font-bold">Technovation pitch Event 2023</h1>
        
        <!--profile dropdown-->
        <div class="relative inline-block group">
            <div class="flex items-center gap-2">
                <img src="images/Assets/account icon.png" class="w-12" alt="icon">
                <h1 class="text-xl cursor-pointer"><?php print $fn." ".$ln;?></h1> 
                <img src="images/Assets/expand more.png" class="w-12" alt="icon">
            </div>

            <!--dropdown content-->
            <div class="hidden absolute group-hover:block p-4 bg-lightBlue border-2 border-blue rounded w-full">
                <div class="flex flex-col gap-4">
                    <h1 class="text-xl">Do you want to Logout?</h1>
                    <a href="logout.php" class="w-full"><button class="bg-greener px-8 py-2 text-white font-bold w-full border-2 border-greener rounded">Logout</button></a>
                </div>
            </div>
        </div>
    </header>
    <main class="flex">
        <!--side bar-->
        <div class="fixed left-0 top-0 flex flex-col justify-between w-96 border-grayish pt-12 h-screen bg-greener">
            <h1 class="text-2xl font-black text-white p-2">Admin Dashboard</h1>
            <!--buttons container-->
            <nav class="flex flex-col w-full ">
                <hr class="bg-white">
                <a href="dashboard.php" class="flex gap-4 text-center w-full text-xl font-black text-white p-3 hover:bg-blue">
                    <img src="images/Assets/dashborad.png" class="w-8" alt=""> Dashboard
                </a>
                <hr class="bg-white">
                <a href="dashboard.teams.php" class="flex gap-4 w-full text-white  text-xl font-black bg-greener p-3 hover:bg-blue">
                    <img src="images/Assets/teams.png" class="w-8"  alt=""> Teams
                </a>
                <hr class="bg-white">
                <a href="#" class="flex gap-4 w-full text-white  text-xl font-black p-3 bg-blue">
                    <img src="images/Assets/schools.png" class="w-8" alt=""> Schools
                </a>
                <hr class="bg-white">
                <a href="dashboard.judges.php" class="flex gap-4 w-full text-white text-xl font-black bg-greener p-3 hover:bg-blue">
                    <img src="images/Assets/judges.png" class="w-8" alt=""> Judges
                </a>
                <hr class="bg-white">
                <a href="dashboard.rubrics.php" class="flex gap-4 w-full text-white text-xl font-black bg-greener p-3 hover:bg-blue">
                    <img src="images/Assets/outline.png" class="w-8" alt=""> Rubrics
                </a>
                <hr class="bg-white">
            </nav>
            
            <img src="images/op.png" alt="">
            <p class="text-lg font-bold">Copyrights &copy;Oysters and pearls</p>
        </div>

        <!--main content-->
        <div class="flex justify-between w-full h-screen ml-96 p-6 bg-grayish">
            <!--teams and judges tables -->
            <div class="flex flex-col gap-4">
                <!--Teams container(table)-->
                <table class="table-auto border-2 border-grayish bg-white rounded-2xl">
                    <tr class="bg-blue p-2 w-full rounded">
                        <th class="text-xl font-bold">ID</th>
                        <th class="text-xl font-bold">Scool Name</th>
                        <th class="text-xl font-bold">District</th>
                        <th class="text-xl font-bold">Region</th>
                    <tr>
                    <tbody>
                        <?php
                            $s_qry = mysqli_query($con, "SELECT * FROM school") or die("failed to fetch teams: ".mysqli_error($con));
                            while($s_ary = mysqli_fetch_array($s_qry)){
                                $id = $s_ary['id'];
                                $sn = $s_ary['name'];
                                $sd = $s_ary['district'];
                                $sr = $s_ary['region'];
                                ?>
                                <tr>
                                    <td class="text-lg"><?php print $id;?></td>
                                    <td class="text-lg"><?php print $sn;?></td>
                                    <td class="text-lg"><?php print $sd;?></td>
                                    <td class="text-lg"><?php print $sr;?></td>
                                </tr>
                                <?php
                            }
                        ?>  
                    </tbody>
                    
                </table>

            </div>
            <!--Team auto score positioning-->
            <div class="flex flex-col">
                <label for="">Add School</label>
                <form method="post" action="addSchool.php">
                    <input type="text" name="sname" placeholder="School Name" required>
                    <input type="text" name="district" placeholder="District" required>
                    <select name="region" id="" required>
                        <option value="Central Region">Central Region</option>
                        <option value="Western Region">Western Region</option>
                        <option value="Northern Region">Northern Region</option>
                        <option value="Eastern Region">Eastern Region</option>
                    </select>
                    <input type="submit" value="Add School">
                </form>
                
            </div>
        </div>
    </main>
</body>
</html>