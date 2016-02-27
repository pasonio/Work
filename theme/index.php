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
    <nav id="navbar" class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="row" id="header" >
            <div class="col-xs-6">
                <div class="logo-sign">
                    <img class="logo" src="img/logo.png">
                    <h3 class="signature">home<span class="custom-color">61</span><small class="small-signature">beta</small></h3>
                </div>
                <div class="contact">
                    <img class="phone" src="img/phone-logo.png">
                    <p class="number">+1(844)843-6161</p>
                </div>
            </div>
            <div class="col-xs-6">
                <div id="user-utilits" class="col-md-7">
                    <ul id="utilits-list" class="list-inline">
                        <li><a id="utility" href="#">Rentals</a></li>
                        <li><a id="utility" href="#">Sales</a></li>
                        <li><a id="utility" href="#">My Homes</a></li>
                        <li><a id="utility" href="#">My Calendar</a></li>
                        <li><a id="utility" href="#">Neighborhoods</a></li>
                    </ul>
                </div>
                <div id="profile-settings" class="col-xs-5">
                    <img class="avatar" src="img/avatar.png">
                    <a id="dropdown-link" type="button" data-toggle="dropdown" class="dropdown-toggle">My Profile<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Profile Settings</a></li>
                        <li><a href="#">Change Avatar</a></li>
                        <li><a href="#">Options</a></li>
                        <li><a href="#">Exit</a></li>
                    </ul>
                    <a id="post" href="#">Post your listings</a>
                </div>
            </div>
        </div>
        <div class="container">
            <form action="#" method="post">
                <div class="row">
                    <div class="col-xs-12" id="content_header">
                        <ul class="breadcrumb">
                            <li><a href="#">home</a></li>
                            <li><a href="#">rentalapllication</a></li>
                        </ul>
                        <h3 id="page_name">Rental Application</h3>
                    </div>
                </div>
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
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="dateOfBirth" id="day">Day<span class="caret" id="day_caret"></span></button>
                            <ul id="date_list" class="dropdown-menu">
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                                <li>4</li>
                                <li>5</li>
                                <li>6</li>
                                <li>7</li>
                                <li>8</li>
                                <li>9</li>
                                <li>10</li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="dateOfBirth" id="month">Month<span class="caret" id="month_caret"></span></button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="dateOfBirth" id="year">Year<span class="caret" id="year_caret"></span></button>
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
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="gross_btn">Month<span class="caret" id="month_caret"></span></button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">January</a></li>
                                        <li><a href="#">February</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="content">
                    <label for="relation">relation</label><br/>
                    <div class="col-xs-4">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="relation" id="relation">Spouse<span class="caret"></span></button>
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
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="dayIn" id="dateIn">Day<span class="caret" id="day_caret"></span></button>
                            <ul id="date_list" class="dropdown-menu">
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                                <li>4</li>
                                <li>5</li>
                                <li>6</li>
                                <li>7</li>
                                <li>8</li>
                                <li>9</li>
                                <li>10</li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="monthIn" id="datehIn">Month<span class="caret" id="month_caret"></span></button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="yearIn" id="dateIn">Year<span class="caret" id="year_caret"></span></button>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <label for="dateOut">date out</label><br/>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="dateOut" id="dayOut">Day<span class="caret" id="day_caret"></span></button>
                            <ul id="date_list" class="dropdown-menu">
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                                <li>4</li>
                                <li>5</li>
                                <li>6</li>
                                <li>7</li>
                                <li>8</li>
                                <li>9</li>
                                <li>10</li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="dateOut" id="monthOut">Month<span class="caret" id="month_caret"></span></button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="dateOut" id="yearOut">Year<span class="caret" id="year_caret"></span></button>
                        </div>
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
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="startDate" id="dayStartt">Day<span class="caret" id="day_caret"></span></button>
                            <ul id="date_list" class="dropdown-menu">
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                                <li>4</li>
                                <li>5</li>
                                <li>6</li>
                                <li>7</li>
                                <li>8</li>
                                <li>9</li>
                                <li>10</li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="startDate" id="monthStart">Month<span class="caret" id="month_caret"></span></button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="startDate" id="yearStart">Year<span class="caret" id="year_caret"></span></button>
                        </div>
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
                            <button type="submit" name="formSubmit" class="btn btn-success" id="formSubmit">Success</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </nav>
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
