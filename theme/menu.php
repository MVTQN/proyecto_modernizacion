<?php
$permissionMenu = array("",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$mydbMenu = new DatabaseN();
$mydbMenu->setQuery("SELECT MTXLEVEL, MTXS1, MTXS2, MTXS3, MTXS4, MTXS5, MTXS6, MTXS7, MTXS8, MTXS9, MTXS10, MTXS11, MTXS12, MTXS13, MTXS14, MTXS15, MTXS16, MTXS17, MTXS18, MTXS19 FROM tblusermatrix WHERE MTXUSRNAME='".$_SESSION['EMPPOSITION']."'");
 $resultMenu = $mydbMenu->executeQuery();
    if ($resultMenu->num_rows > 0) {
        while($rowMenu = $resultMenu->fetch_array()) {
            for($i=0;$i<=19;$i++){
                $permissionMenu[$i] = $rowMenu[$i];
            }
        }
    }
    $_SESSION['EMPPMXLEV'] = $permissionMenu[0];
    $filterLevelsName = "(";
    $mydbMenu->setQuery("SELECT MTXUSRNAME, MTXLEVEL FROM tblusermatrix WHERE MTXLEVEL<".$_SESSION['EMPPMXLEV']);
    $resultProfiles = $mydbMenu->executeQuery();
    if ($resultProfiles->num_rows > 0) {
        while($rowProfiles = $resultProfiles->fetch_array()) {
            $filterLevelsName .= "'".$rowProfiles[0]."', ";
        }
    }
    $filterLevelsName .= ")";
    $filterLevelsName = str_replace(", )", ")", $filterLevelsName);
    $_SESSION['MATRIX_LEVELNAME'] = $filterLevelsName;
    
    $matrixQuery = "SELECT priv_country, priv_city, priv_account, priv_department, priv_lob FROM tbluprivmatrix WHERE priv_user_id=".$_SESSION['EMPLOYID']."";
    $mydbMenu->setQuery("SELECT priv_country, priv_city, priv_account, priv_department, priv_lob FROM tbluprivmatrix WHERE priv_user_id=".$_SESSION['EMPLOYID']."");
    $matrixFilter ="";
    $tempCountry = "";
    $tempCountryCity = "";
    $matrix_country = "";
    $matrix_countryCity = "";
    $tempCompany = "";
    $matrix_company = "";
    $tempCompany1 = "";
    $matrix_company1 = "";
    $resultMatrix = $mydbMenu->executeQuery();
    if ($resultMatrix->num_rows > 0) {
        while($rowMatrix = $resultMatrix->fetch_array()) {
            //only country
            $tempCountry = "(COUNTRY='".$rowMatrix[0]."') or ";
            if(strpos($matrix_country, $tempCountry)===false){
                $matrix_country .= $tempCountry;
            }
            //end only country
            //country and city
            $tempCountryCity = "(COUNTRY='".$rowMatrix[0]."' AND CITY='".$rowMatrix[1]."') or ";
            if(strpos($matrix_countryCity, $tempCountryCity)===false){
                $matrix_countryCity .= $tempCountryCity;
            }
            //end only country and city
            //only company/account
            $tempCompany = "(COMPANY='".$rowMatrix[2]."') or ";
            if(strpos($matrix_company, $tempCompany)===false){
                $matrix_company .= $tempCompany;
            }

            $tempCompany1 = "'".$rowMatrix[2]."', ";
            if(strpos($matrix_company1, $tempCompany1)===false){
                $matrix_company1 .= $tempCompany1;
            }
            //end only company/account
            //pending country-city-company and only department combitations 

            $matrixFilter .= "(COUNTRY='".$rowMatrix[0]."' AND CITY='".$rowMatrix[1]."' AND COMPANY='".$rowMatrix[2]."' AND DEPARTMENT='".$rowMatrix[3]."' AND LOB='".$rowMatrix[4]."') or ";
        }
        if(strlen($matrix_country)>0){$matrix_country = substr($matrix_country, 0, -3);}
        if(strlen($matrix_countryCity)>0){$matrix_countryCity = substr($matrix_countryCity, 0, -3);}
        if(strlen($matrix_company)>0){$matrix_company = substr($matrix_company, 0, -3);}
        if(strlen($matrix_company1)>0){$matrix_company1 = substr($matrix_company1, 0, -2);}
        if(strlen($matrixFilter)>0){$matrixFilter = substr($matrixFilter, 0, -3);}
        
        $_SESSION['MATRIX_COUNTRY'] = $matrix_country;
        $_SESSION['MATRIX_COUNTRY-CITY'] = $matrix_countryCity;
        $_SESSION['MATRIX_COMPANY'] = $matrix_company;
        $_SESSION['MATRIX_COMPANY-STRING'] = $matrix_company1;
        $_SESSION['MATRIX_FULL-FILTER'] = $matrixFilter;
        //echo $_SESSION['MATRIX_FULL-FILTER'];
        //echo $_SESSION['MATRIX_COMPANY-STRING'];
    }

$mydbMenu->close_connection();
$companiesE = (2+2);
?>

<div class="app-sidebar__inner">
    <br><br>
    <ul class="vertical-nav-menu"> 
        <li>
            <a  href="<?php echo WEB_ROOT; ?>index.php" class="mm-active">               
                HOME
            </a>
        </li>
        <?php
            $ManageCompanies = ($permissionMenu[7] + $permissionMenu[8] + $permissionMenu[13] + $permissionMenu[16]);
            $Companies = ($permissionMenu[17] + $permissionMenu[1] + $permissionMenu[14] + $ManageCompanies);
            if($Companies>0){
        ?>
        <li>
            <a href="#">Companies<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
            <ul class="mm-collapse">
                <?php if($permissionMenu[17]>=1){ ?>
                <li><a href="<?php echo WEB_ROOT; ?>module/shift"><i class="pe-7s-keypad"></i>&nbsp;Shifts</a></li>
                <?php }
                if($permissionMenu[1]>=1){ ?>
                <li><a href="<?php echo WEB_ROOT; ?>module/attendance"><i class="pe-7s-keypad"></i>&nbsp;Attendance</a></li>
                
                     <?php } ?>
            </ul>
        </li>
        <?php } 
             $Attritions = ($permissionMenu[3] + $permissionMenu[2]);
             $Employees = ($permissionMenu[10] + $permissionMenu[15] + $permissionMenu[18]) + $Attritions;
             //echo $permissionMenu[19];
        if($Employees>0){
        ?>
        <li>
            <a href="#">Employees<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
            <ul class="mm-collapse">
                <?php if($permissionMenu[10]>=1){ ?>
                <li><a  href="<?php echo WEB_ROOT; ?>module/employee/"><i class="pe-7s-keypad"></i>&nbsp;Employees</a></li>
                <?php } if($permissionMenu[19]>=1){ ?>
                
                <?php } if($Attritions>0){ ?>
                <li>
                    <a href="#">&nbsp;Attrition<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                    <ul class="mm-collapse">
                        <?php if($permissionMenu[3]>=1){ ?>
                            <li><a  href="<?php echo WEB_ROOT; ?>module/attrition_r/"><i class="pe-7s-keypad"></i>&nbsp;Add reason</a></li>
                        <?php } if($permissionMenu[2]>=1){ ?>
                            <li><a  href="<?php echo WEB_ROOT; ?>module/attrition/"><i class="pe-7s-keypad"></i>&nbsp;Add Attrition</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </li>
        <?php } 
            $Leaves = ($permissionMenu[12] + $permissionMenu[11]);
        if($Leaves>0){
        ?>
        <li>
            <a href="#">Leaves<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
            <ul class="mm-collapse">
            <?php if($permissionMenu[12]>=1){ ?>
                <li><a  href="<?php echo WEB_ROOT; ?>module/leavetype/"><i class="pe-7s-keypad"></i>&nbsp;Leave Types</a></li>
            <?php } if($permissionMenu[11]>=1){ ?>
                <li>
                    <a href="#"><i class="pe-7s-keypad"></i>&nbsp;Manage Leaves<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                    <ul class="mm-collapse">
                        <li><a  href="<?php echo WEB_ROOT; ?>module/leave/"><i class="pe-7s-keypad"></i>&nbsp;Leaves List</a></li>
                        <li><a  href="<?php echo WEB_ROOT; ?>module/leave/index.php?vw=1"><i class="pe-7s-keypad"></i>&nbsp;Apply Leave</a></li>
                    </ul>
                </li>
            <?php } ?>
            </ul>
        </li>
       
        <?php } ?>
</ul>
</div>
