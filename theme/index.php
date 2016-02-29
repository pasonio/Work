<html>
<head>
    <meta charset="utf-8">
    <title>Rental Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset_styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <nav id="navbar" class="navbar navbar-collapse navbar-inverse navbar-static-top" role="navigation">
        <div class="navbar-header" id="logo_block">
            <img class="logo" src="img/logo.png">
            <h3 class="signature">home<span class="custom-color">61</span><small class="small-signature">beta</small></h3>
        </div>
        <div class="navbar-header" id="phone_block">
            <img class="phone" src="img/phone-logo.png">
            <p class="number">+1(844)843-6161</p>
        </div>
        <ul id="profile-settings" class="nav navbar-nav navbar-right">
            <li><img class="avatar" src="img/avatar.png"></li>
            <li><a id="dropdown-link" type="button" data-toggle="dropdown" class="dropdown-toggle">My Profile<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile Settings</a></li>
                    <li><a href="#">Change Avatar</a></li>
                    <li><a href="#">Options</a></li>
                    <li><a href="#">Exit</a></li>
                </ul>
            </li>
            <li><a id="post" href="#">Post your listings</a></li>
        </ul>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse" id="trigger_dropdown">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul id="utilits_list" class="nav navbar-nav navbar-right">
                <li class="dropdown"><a id="utility" class="dropdown-toggle" data-toggle="dropdown" target="_blank" href="#">Rentals</a>
                    <ul class="dropdown-menu">
                        <li class="option"><a href="#" target="_blank">Sample text</a></li>
                        <li class="option"><a href="#" target="_blank">Sample text</a></li>
                        <li class="option"><a href="#" target="_blank">Sample text</a></li>
                        <li class="option"><a href="#" target="_blank">Sample text</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a id="utility" class="dropdown-toggle" data-toggle="dropdown" target="_blank" href="#">Sales</a>
                    <ul class="dropdown-menu">
                        <li class="option"><a href="#" target="_blank">Samples</a></li>
                        <li class="option"><a href="#" target="_blank">Samples</a></li>
                        <li class="option"><a href="#" target="_blank">Samples</a></li>
                        <li class="option"><a href="#" target="_blank">Samples</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a id="utility" class="dropdown-toggle" data-toggle="dropdown" target="_blank" href="#">My Homes</a>
                    <ul class="dropdown-menu">
                        <li class="option"><a href="#" target="_blank">Sampling</a></li>
                        <li class="option"><a href="#" target="_blank">Sampling</a></li>
                        <li class="option"><a href="#" target="_blank">Sampling</a></li>
                        <li class="option"><a href="#" target="_blank">Sampling</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a id="utility" class="dropdown-toggle" data-toggle="dropdown" target="_blank" href="#">My Calendar</a>
                    <ul class="dropdown-menu">
                        <li class="option"><a href="#" target="_blank">Sampler</a></li>
                        <li class="option"><a href="#" target="_blank">Sampler</a></li>
                        <li class="option"><a href="#" target="_blank">Sampler</a></li>
                        <li class="option"><a href="#" target="_blank">Sampler</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a id="utility" class="dropdown-toggle" data-toggle="dropdown" target="_blank" href="#">Neighborhoods</a>
                    <ul class="dropdown-menu">
                        <li class="option"><a href="#" target="_blank">Samplio</a></li>
                        <li class="option"><a href="#" target="_blank">Samplio</a></li>
                        <li class="option"><a href="#" target="_blank">Samplio</a></li>
                        <li class="option"><a href="#" target="_blank">Samplio</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container" id="content_area">
        <div class="row">
            <div class="col-xs-12" id="content_header">
                <ul class="breadcrumb">
                    <li><a href="#">home</a></li>
                    <li><a href="#">rentalapllication</a></li>
                </ul>
                <h2 id="page_name">Rental Application</h2>
            </div>
        </div>
        <form action="#" id="rental_form" method="post">
            <div class="row" id="content">
                <h3>Personal Information</h3>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="firstName">first name</label><br/>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter first name" />
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="lastName">last name</label><br/>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter last name" />
                    </div>
                </div>
                <div class="col-xs-4">
                    <label for="dateOfBirth">date of birth</label><br/>
                    <select name="dateOfBirth" class="day">
                        <option disabled selected="selected">Day</option>
                    </select>
                    <select name="dateOfBirth" class="month">
                        <option disabled selected="selected">Month</option>
                    </select>
                    <select name="dateOfBirth" class="year">
                        <option disabled selected="selected">Year</option>
                    </select>
                </div>
            </div>
            <div class="row" id="content">
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="cellPhone">cell phone</label><br/>
                        <input type="text" class="form-control" name="cellPhone" id="cellPhone" placeholder="ex: 123-567-8999"/>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="workPhone">work phone</label><br/>
                        <input type="text" class="form-control" name="workPhone" id="workPhone" placeholder="ex: 123-567-8999"/>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="gross">gross income</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="gross" placeholder="ex. 20 000">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="gross_btn">Month<span id="month_caret"></span></button>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#">January</a></li>
                                    <li><a href="#">February</a></li>
                                    <li><a href="#">March</a></li>
                                    <li><a href="#">April</a></li>
                                    <li><a href="#">May</a></li>
                                    <li><a href="#">June</a></li>
                                    <li><a href="#">July</a></li>
                                    <li><a href="#">August</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="content">
                <h5 id="form-subject"><strong>Other Proposed Occupation</strong></h5>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="secondary_first_name">first name</label><br/>
                        <input type="text" class="form-control" id="secondary_first_name" placeholder="Enter first name"/>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="secondary_last_name">last name</label><br/>
                        <input type="text" class="form-control" id="secondary_last_name" placeholder="Enter last name"/>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="gross">gross income</label><br/>
                        <div class="input-group">
                            <input type="text" class="form-control" id="gross" placeholder="ex. 20 000">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="gross_btn">Month<span id="month_caret"></span></button>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="">January</a></li>
                                    <li><a href="">February</a></li>
                                    <li><a href="">March</a></li>
                                    <li><a href="">April</a></li>
                                    <li><a href="">May</a></li>
                                    <li><a href="">June</a></li>
                                    <li><a href="">July</a></li>
                                    <li><a href="">August</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="content">
                <label for="relation">relation</label><br/>
                <div class="col-xs-4">
                    <div class="form-group">
                        <select name="relation" id="relation_btn">
                            <option disabled selected="selected">Spouse</option>
                            <option>Married</option>
                            <option>Not married</option>
                            <option>In relationship</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <input type="text" name="spouse_name" class="form-control" id="relation" value="Irina Marin |" />
                    </div>
                </div>
            </div>
            <div class="row" id="content">
                <h3>Rental History</h3>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="address">previuos address</label><br/>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter address" />
                    </div>
                </div>
            </div>
            <div class="row" id="content">
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="city">city</label><br/>
                        <input type="text" name="city" class="form-control" id="city" placeholder="ex: Miami"/>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="phone">phone</label><br/>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="ex: 123-567-8999"/>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="state">state</label><br/>
                        <input type="text" name="state" class="form-control" id="state" placeholder="ex: MI"/>
                    </div>
                </div>
            </div>
            <div class="row" id="content">
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="zip_code">zip code</label><br/>
                        <input type="text" name="zip_code" class="form-control" id="zip_code" placeholder="ex: 11111"/>
                    </div>
                </div>
                <div class="col-xs-4">
                    <label for="dateIn">date in</label><br/>
                    <select name="dateIn" class="day">
                        <option disabled selected="selected">Day</option>
                    </select>
                    <select name="dateIn" class="month">
                        <option disabled selected="selected">Month</option>
                    </select>
                    <select name="dateIn" class="year">
                        <option disabled selected="selected">Year</option>
                    </select>
                </div>
                <div class="col-xs-4">
                    <label for="dateOut">date out</label><br/>
                    <select name="dateOut" class="day">
                        <option disabled selected="selected">Day</option>
                    </select>
                    <select name="dateOut" class="month">
                        <option disabled selected="selected">Month</option>
                    </select>
                    <select name="dateOut" class="year">
                        <option disabled selected="selected">Year</option>
                    </select>
                </div>
            </div>
            <div class="row" id="content">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="movingReason">reason for moving</label><br/>
                        <textarea name="movingReason" class="form-control" id="movingReason"></textarea>
                    </div>
                </div>
            </div>
            <div class="row" id="content">
                <h3>Employment information</h3>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="jobAddress">present occupation or source of income</label><br/>
                        <input type="text" name="jobAddress" class="form-control" id="jobAddress" placeholder="Enter address"/>
                    </div>
                </div>
            </div>
            <div class="row" id="content">
                <div class="col-xs-4">
                    <label for="startDate">start date</label><br/>
                    <select name="startDate" class="day">
                        <option disabled selected="selected">Day</option>
                    </select>
                    <select name="startDate" class="month">
                        <option disabled selected="selected">Month</option>
                    </select>
                    <select name="startDate" class="year">
                        <option disabled selected="selected">Year</option>
                    </select>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="employerName">employer name</label><br/>
                        <input type="text" name="employerName" class="form-control" id="employerName" placeholder="ex: John Doe"/>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="employerPhone">employer phone</label><br/>
                        <input type="text" name="employerPhone" class="form-control" id="employerPhone" placeholder="ex: MI"/>
                    </div>
                </div>
            </div>
            <div class="row" id="content">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="employerAddress">employer address</label><br/>
                        <input type="text" name="employerAddress" class="form-control" id="employerAddress" placeholder="Enter address"/>
                    </div>
                </div>
            </div>
            <div class="row" id="content">
                <div class="col-xs-12">
                    <div class="btn-group" id="submitBtn">
                        <button type="submit" name="formSubmit" class="btn btn-success" id="formSubmit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="footer">
        <div class="container">
            <div class="row">
                <div id="footer_article" class="col-xs-4">
                    <h5 id="footer_title">south beach condo and apartments</h5>
                    <p id="footer_content">114 east 98th street, unit 4w<br/>900 byscayne, bricklell<br/> 1220 dixie highway, coral gables</p>
                </div>
                <div id="footer_article" class="col-xs-4">
                    <h5 id="footer_title">north miami condo and apartments</h5>
                    <p id="footer_content">114 east 98th street, unit 4w<br/>900 byscrayne, brickell<br/>1220 dixie highway, coral gables</p>
                </div>
                <div id="footer_article" class="col-xs-4">
                    <h5 id="footer_title">downtown miami condo and apartments</h5>
                    <p id="footer_content">114 east 98th street, unit 4w<br/>900 byscrayne, brickell<br/>1220 dixie highway, coral gables</p>
                </div>
            </div>
        </div>
    </div>
    <div id="footer_links">
        <div class="container">
            <div class="row">
                <div id="footer_list" class="col-xs-7">
                    <ul id="foo_links_list" class="list-inline">
                        <li><a id="foo_link" href="#">Team</a></li>
                        <li><a id="foo_link" href="#">How it works</a></li>
                        <li><a id="foo_link" href="#">Partner</a></li>
                        <li><a id="foo_link" href="#">FAQ</a></li>
                        <li><a id="foo_link" href="#">Terms & Services</a></li>
                        <li><a id="foo_link" href="#">Contact</a></li><br/>
                        <p id="copyrights">2014 &copy;  <span id="foo_sign"></span>HOME<span id="foo_custom_color">61. </span>All Rights Reserved.</p>
                    </ul>
                </div>
                <div id="footer_social" class="col-xs-5">
                    <ul id="foo_social_link" class="list-inline">
                        <li><a href="#"><img src="img/linkedin.png"></a></li>
                        <li><a href="#"><img src="img/googleplus.png"></a></li>
                        <li><a href="#"><img src="img/twitter.png"></a></li>
                        <li><a href="#"><img src="img/facebook.png"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-10" id="foo_info">
                    <p><img id="houseIcon" src="img/fairhousing.png">Fair Housing & Equal Opportunity</p>
                    <p>Information deemed reliable but not guaranteed to be accurate.</p>
                    <p>The real estate listing marked with icon IDX comes from SouthEast-Florida Regional Multiple Listing Service system.</p>
                </div>
                <div class="col-xs-1"></div>
            </div>
        </div>
    </div>
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
