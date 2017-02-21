<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/vendor/bootstrap-combobox/css/bootstrap-combobox.css">

    <script src="/vendor/bootstrap-combobox/js/bootstrap-combobox.js"></script>

    <title>My Page2</title>
    <?php session_start() ;
    $username=$_SESSION["AdminID"]?>
    <style>
        h2 {
            color: #2b669a;
        }

        th {
            text-align: center;
        }

        tr {
            text-align: center;
        }
        .set1{
            margin-top: -5px;
            padding-top: 20px;
        }

    </style>
    <?php include_once '../Controller/AdminController.php'?>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">BOOK MY BUS</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">


            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="margin-right: 20px">
                        <?php  echo'<i class="glyphicon glyphicon-user"></i>&nbsp;'.$username.' <span class="caret"></span></a>';    ?>
                    <ul class="dropdown-menu">
                        <li><a href="AccountSet.php">Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>&nbsp;&nbsp;Log out</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index1.php"><i class="glyphicon glyphicon-arrow-left"></i>back</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container set1" id="viewIncome">
    <div class="row">
        <div class="col-sm-10">
            <div class="page-header"><h2><u>Statistics</u><br><br></h2></div>
            <h3><u>Income:</u><br><br></h3>
            <div class="row">
                <div class="col-sm-4">
                    <h4>Total Income</h4>
                </div>

                <div class="col-sm-8">
                    <div class="well">
                        Rs.<?php $income=AdminController::getIncome($mysqli); echo'<span>'.htmlspecialchars($income).'</span>'; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <h4>Last months' Income</h4>
                </div>
                <div class="col-sm-8">
                    <div class="well">
                        Rs.<?php $income=AdminController::getIncomeByMonth($mysqli); echo'<span>'.htmlspecialchars($income).'</span>'; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<style type="text/css">
    /* Adjust feedback icon position */
    #productForm .selectContainer .form-control-feedback,
    #productForm .inputGroupContainer .form-control-feedback {
        right: -15px;
    }
</style>


<script>
    $(document).ready(function() {
        $('#productForm')
                .formValidation({
                    framework: 'bootstrap',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    excluded: ':disabled',
                    fields: {
                        name: {
                            validators: {
                                notEmpty: {
                                    message: 'The name is required'
                                },
                                stringLength: {
                                    min: 6,
                                    max: 30,
                                    message: 'The name must be more than 6 and less than 30 characters long'
                                }
                            }
                        },
                        description: {
                            validators: {
                                notEmpty: {
                                    message: 'The description is required'
                                },
                                stringLength: {
                                    min: 50,
                                    max: 1000,
                                    message: 'The description must be more than 50 and less than 1000 characters'
                                }
                            }
                        },
                        price: {
                            validators: {
                                notEmpty: {
                                    message: 'The price is required'
                                },
                                numeric: {
                                    message: 'The price must be a number'
                                }
                            }
                        },
                        size: {
                            validators: {
                                notEmpty: {
                                    message: 'The size is required'
                                }
                            }
                        },
                        color: {
                            validators: {
                                notEmpty: {
                                    message: 'The color is required'
                                }
                            }
                        }
                    }
                })
                /* Using Combobox for color and size select elements */
                .find('[name="color"], [name="size"]')
                .combobox()
                .end()
    });
</script>
</body>