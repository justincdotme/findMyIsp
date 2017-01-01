<?php include 'includes/header.php'; ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron">
                <h1>Find My ISP</h1>
                <h3>Your IP Address is: <span class="label label-info"><?php echo $data['clientIp']; ?></span></h3>
                <h3>Your ISP is: <span class="label label-info"><?php echo $data['clientIsp']; ?></span></h3>
                <hr />
                <p>
                    Here is a list of ISPs in your area.
                </p>
                <?php echo empty($data['list']) ? '<h3 class="alert alert-danger">No ISPs found!</h3>' : null; ?>
            </div>
        </div>
    </div>
    <div class="row">
    <?php
    foreach($data['list'] as $result)
    { ?>
        <div class="col-sm-6 isp-info">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h1><a href="<?php echo $result->website; ?>"><?php echo $result->name; ?></a></h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>
                                <strong>Phone: </strong><?php echo $result->phone; ?>
                            </p>
                            <p>
                                <strong>Website: </strong><a href="<?php echo $result->website; ?>"><?php echo $result->website; ?></a>
                            </p>
                            <p>
                                <?php echo $result->html_address ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>
    </div>
<?php include 'includes/footer.php'; ?>