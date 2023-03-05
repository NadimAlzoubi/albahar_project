<!DOCTYPE html>
<html>
<body>
<form method="POST" enctype="multipart/form-data">
<input type="file" name="file">
<input type="submit" name="send_auth">
</form>
<?php
      $send_auth = $_POST['send_auth'];

if(isset($send_auth)){

    $ex = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    echo strlen($ex);
}
?>

</body>
</html>


            
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Today Expenses </div>
                                    <div class="stat-digit"> <i class="fa fa-usd"></i>8500
                                </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Income Detail</div>
                                    <div class="stat-digit"> <i class="fa fa-usd"></i>7800</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Task Completed</div>
                                    <div class="stat-digit"> <i class="fa fa-usd"></i> 500</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Task Completed</div>
                                    <div class="stat-digit"> <i class="fa fa-usd"></i>650</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger w-65" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <i class="ti-money text-success border-success"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Profit</div>
                                    <div class="stat-digit">1,012</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <i class="ti-user text-primary border-primary"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Customer</div>
                                    <div class="stat-digit">961</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <i class="ti-layout-grid2 text-pink border-pink"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Projects</div>
                                    <div class="stat-digit">770</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <i class="ti-link text-danger border-danger"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Referral</div>
                                    <div class="stat-digit">2,781</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Exam Result</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table student-data-table m-t-20" style="color: #000000;" id="auth_data_table">
                                    <tr>
                                       <th>1</th>
                                       <th>2</th>
                                       <th>3</th>
                                       <th>4</th>
                                       <th>5</th>
                                       <th>6</th>
                                       <th>7</th>
                                       <th>8</th>
                                    </tr>
                                        <!-- <script>
                                            var table = document.getElementById("auth_data_table");
                                            var table_td = document.getElementById("auth_td");
                                        // Import the Fetch API 
                                        // import fetch from 'isomorphic-fetch';

                                        // Define the endpoint where the data is located 
                                        const url = './load_data.php';

                                        // Fetch the data 
                                        fetch(url)
                                            .then(response => response.json())
                                            .then(data => {
                                                data.forEach(item => {
                                                    let row = document.createElement('tr');
                                                    // for (let i = 1; i <= 8; i++) {
                                                        for (let key in item) {
                                                            let cell = document.createElement('td');
                                                            if(key == "ID"){
                                                                continue;
                                                            }else{
                                                                cell.innerHTML = item[key];
                                                            }
                                                            // (item[key]);
                                                            // console.log(item.AR_NAME);
                                                            row.appendChild(cell);
                                                        }
                                                    // }
                                                    table.appendChild(row);
                                                });
                                            })
                                            .catch(error => console.error(error));
                                        </script> -->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Sales Overview</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-8">
                                        <div id="morris-bar-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="m-t-10">
                                    <h4 class="card-title">Customer Feedback</h4>
                                    <h2 class="mt-3">385749</h2>
                                </div>
                                <div class="widget-card-circle mt-5 mb-5" id="info-circle-card">
                                    <i class="ti-control-shuffle pa"></i>
                                </div>
                                <ul class="widget-line-list m-b-15">
                                    <li class="border-right">92% <br><span class="text-success"><i
                                                class="ti-hand-point-up"></i> Positive</span></li>
                                    <li>8% <br><span class="text-danger"><i
                                                class="ti-hand-point-down"></i>Negative</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Project</h4>
                            </div>
                            <div class="card-body">
                                <div class="current-progress">
                                    <div class="progress-content py-2">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="progress-text">Website</div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="current-progressbar">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-primary w-40" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                            40%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-content py-2">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="progress-text">Android</div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="current-progressbar">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-primary w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                            60%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-content py-2">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="progress-text">Ios</div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="current-progressbar">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-primary w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                                            70%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-content py-2">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="progress-text">Mobile</div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="current-progressbar">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-primary w-90" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                                            90%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="testimonial-widget-one p-17">
                                    <div class="testimonial-widget-one owl-carousel owl-theme">
                                        <div class="item">
                                            <div class="testimonial-content">
                                                <div class="testimonial-text">
                                                    <i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                                                    consectetur adipisicing elit.
                                                    <i class="fa fa-quote-right"></i>
                                                </div>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div class="testimonial-author">TYRION LANNISTER</div>
                                                        <div class="testimonial-author-position">Founder-Ceo. Dell Corp
                                                        </div>
                                                    </div>
                                                    <img class="testimonial-author-img ml-3" src="./images/avatar/1.png" alt="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="testimonial-content">
                                                <div class="testimonial-text">
                                                    <i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                                                    consectetur adipisicing elit.
                                                    <i class="fa fa-quote-right"></i>
                                                </div>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div class="testimonial-author">TYRION LANNISTER</div>
                                                        <div class="testimonial-author-position">Founder-Ceo. Dell Corp
                                                        </div>
                                                    </div>
                                                    <img class="testimonial-author-img ml-3" src="./images/avatar/1.png" alt="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="testimonial-content">
                                                <div class="testimonial-text">
                                                    <i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                                                    consectetur adipisicing elit.
                                                    <i class="fa fa-quote-right"></i>
                                                </div>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div class="testimonial-author">TYRION LANNISTER</div>
                                                        <div class="testimonial-author-position">Founder-Ceo. Dell Corp
                                                        </div>
                                                    </div>
                                                    <img class="testimonial-author-img ml-3" src="./images/avatar/1.png" alt="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Web Server</h4>
                            </div>
                            <div class="card-body">
                                <div class="cpu-load-chart">
                                    <div id="cpu-load" class="cpu-load"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Country</h4>
                            </div>
                            <div class="card-body">
                                <div id="vmap13" class="vmap"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">New Orders</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Product</th>
                                                <th>quantity</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="round-img">
                                                        <a href=""><img width="35" src="./images/avatar/1.png" alt=""></a>
                                                    </div>
                                                </td>
                                                <td>Lew Shawon</td>
                                                <td><span>Dell-985</span></td>
                                                <td><span>456 pcs</span></td>
                                                <td><span class="badge badge-success">Done</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="round-img">
                                                        <a href=""><img width="35" src="./images/avatar/1.png" alt=""></a>
                                                    </div>
                                                </td>
                                                <td>Lew Shawon</td>
                                                <td><span>Asus-565</span></td>
                                                <td><span>456 pcs</span></td>
                                                <td><span class="badge badge-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="round-img">
                                                        <a href=""><img width="35" src="./images/avatar/1.png" alt=""></a>
                                                    </div>
                                                </td>
                                                <td>lew Shawon</td>
                                                <td><span>Dell-985</span></td>
                                                <td><span>456 pcs</span></td>
                                                <td><span class="badge badge-success">Done</span></td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="round-img">
                                                        <a href=""><img width="35" src="./images/avatar/1.png" alt=""></a>
                                                    </div>
                                                </td>
                                                <td>Lew Shawon</td>
                                                <td><span>Asus-565</span></td>
                                                <td><span>456 pcs</span></td>
                                                <td><span class="badge badge-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="round-img">
                                                        <a href=""><img width="35" src="./images/avatar/1.png" alt=""></a>
                                                    </div>
                                                </td>
                                                <td>lew Shawon</td>
                                                <td><span>Dell-985</span></td>
                                                <td><span>456 pcs</span></td>
                                                <td><span class="badge badge-success">Done</span></td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="round-img">
                                                        <a href=""><img width="35" src="./images/avatar/1.png" alt=""></a>
                                                    </div>
                                                </td>
                                                <td>Lew Shawon</td>
                                                <td><span>Asus-565</span></td>
                                                <td><span>456 pcs</span></td>
                                                <td><span class="badge badge-warning">Pending</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xl-4 col-xxl-6 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Timeline</h4>
                            </div>
                            <div class="card-body">
                                <div class="widget-timeline">
                                    <ul class="timeline">
                                        <li>
                                            <div class="timeline-badge primary"></div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>10 minutes ago</span>
                                                <h6 class="m-t-5">Youtube, a video-sharing website, goes live.</h6>
                                            </a>
                                        </li>

                                        <li>
                                            <div class="timeline-badge warning">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>20 minutes ago</span>
                                                <h6 class="m-t-5">Mashable, a news website and blog, goes live.</h6>
                                            </a>
                                        </li>

                                        <li>
                                            <div class="timeline-badge danger">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>30 minutes ago</span>
                                                <h6 class="m-t-5">Google acquires Youtube.</h6>
                                            </a>
                                        </li>

                                        <li>
                                            <div class="timeline-badge success">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>15 minutes ago</span>
                                                <h6 class="m-t-5">StumbleUpon is acquired by eBay. </h6>
                                            </a>
                                        </li>

                                        <li>
                                            <div class="timeline-badge warning">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>20 minutes ago</span>
                                                <h6 class="m-t-5">Mashable, a news website and blog, goes live.</h6>
                                            </a>
                                        </li>

                                        <li>
                                            <div class="timeline-badge dark">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>20 minutes ago</span>
                                                <h6 class="m-t-5">Mashable, a news website and blog, goes live.</h6>
                                            </a>
                                        </li>

                                        <li>
                                            <div class="timeline-badge info">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>30 minutes ago</span>
                                                <h6 class="m-t-5">Google acquires Youtube.</h6>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-xxl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Todo</h4>
                            </div>
                            <div class="card-body px-0">
                                <div class="todo-list">
                                    <div class="tdl-holder">
                                        <div class="tdl-content widget-todo mr-4">
                                            <ul id="todo_list">
                                                <li><label><input type="checkbox"><i></i><span>Get up</span><a href='#'
                                                            class="ti-trash"></a></label></li>
                                                <li><label><input type="checkbox" checked><i></i><span>Stand up</span><a
                                                            href='#' class="ti-trash"></a></label></li>
                                                <li><label><input type="checkbox"><i></i><span>Don't give up the
                                                            fight.</span><a href='#' class="ti-trash"></a></label></li>
                                                <li><label><input type="checkbox" checked><i></i><span>Do something
                                                            else</span><a href='#' class="ti-trash"></a></label></li>
                                                <li><label><input type="checkbox" checked><i></i><span>Stand up</span><a
                                                            href='#' class="ti-trash"></a></label></li>
                                                <li><label><input type="checkbox"><i></i><span>Don't give up the
                                                            fight.</span><a href='#' class="ti-trash"></a></label></li>
                                            </ul>
                                        </div>
                                        <div class="px-4">
                                            <input type="text" class="tdl-new form-control" placeholder="Write new item and hit 'Enter'...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xxl-6 col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Product Sold</h4>
                                <div class="card-action">
                                    <div class="dropdown custom-dropdown">
                                        <div data-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Option 1</a>
                                            <a class="dropdown-item" href="#">Option 2</a>
                                            <a class="dropdown-item" href="#">Option 3</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart py-4">
                                    <canvas id="sold-product"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-xxl-6 col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6 col-md-6">
                                <div class="card">
                                    <div class="social-graph-wrapper widget-facebook">
                                        <span class="s-icon"><i class="fa fa-facebook"></i></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 border-right">
                                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                                <h4 class="m-1"><span class="counter">89</span> k</h4>
                                                <p class="m-0">Friends</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                                <h4 class="m-1"><span class="counter">119</span> k</h4>
                                                <p class="m-0">Followers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6 col-md-6">
                                <div class="card">
                                    <div class="social-graph-wrapper widget-linkedin">
                                        <span class="s-icon"><i class="fa fa-linkedin"></i></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 border-right">
                                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                                <h4 class="m-1"><span class="counter">89</span> k</h4>
                                                <p class="m-0">Friends</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                                <h4 class="m-1"><span class="counter">119</span> k</h4>
                                                <p class="m-0">Followers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6 col-md-6">
                                <div class="card">
                                    <div class="social-graph-wrapper widget-googleplus">
                                        <span class="s-icon"><i class="fa fa-google-plus"></i></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 border-right">
                                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                                <h4 class="m-1"><span class="counter">89</span> k</h4>
                                                <p class="m-0">Friends</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                                <h4 class="m-1"><span class="counter">119</span> k</h4>
                                                <p class="m-0">Followers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6 col-md-6">
                                <div class="card">
                                    <div class="social-graph-wrapper widget-twitter">
                                        <span class="s-icon"><i class="fa fa-twitter"></i></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 border-right">
                                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                                <h4 class="m-1"><span class="counter">89</span> k</h4>
                                                <p class="m-0">Friends</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                                <h4 class="m-1"><span class="counter">119</span> k</h4>
                                                <p class="m-0">Followers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


