<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="./lib/js/jquery-3.1.1.min.js"></script>
</head>
<body>

<div class="row"></div>

<div class="row">
    <div class="col-sm-2">
        <table class="table table-condensed">
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getDetailCategoryList</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getDetailModelList</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getProductCategoryList</button>
                </td>
            </tr>

            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">updateDetailCategoryList</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">updateDetailModelList</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">updateProductCategoryList</button>
                </td>
            </tr>

            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getMisc</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">updateMisc</button>
                </td>
            </tr>

            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getAllMaterial</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getMaterialList</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getMaterial</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">updateMaterial</button>
                </td>
            </tr>

            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getAllDetail</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getDetailList</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getDetail</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">updateDetail</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">updateDetailCount</button>
                </td>
            </tr>

            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getAllProduct</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getProductList</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">getProduct</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">updateProduct</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary btn-block btn-query">calculateProductParam</button>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-sm-2"></div>
    <div class="col-sm-4" id="content">
        <?php

        $controller = new Controller();
        $controller->handle();

        ?>
    </div>
    <div class="col-sm-4">

    </div>
</div>

<script src="./lib/js/script.js"></script>

</body>
</html>