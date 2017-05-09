<?php

//declare(strict_types = 1);

if (!isset($kspuEnterprise)) {
    echo "controller";
    die();
}


class Controller
{

    //put your code here
    public $viewHelper;
    private $model;

    public function __construct()
    {
        $this->model = new ProductModel();
        $this->viewHelper = new ViewHelper();
    }

    public function handle()
    {
        if (isset($_GET["q"])) {
            $q = $_GET["q"];
        } else if (isset($_POST["q"])) {
            $q = $_POST["q"];
        } else {
            return;
        }
        switch (strtolower($q)) {
            case "getdetailcategorylist": {
                $this->getDetailCategoryList();
                break;
            }
            case "getdetailmodellist": {
                $this->getDetailModelList();
                break;
            }
            case "getmodel": {
                $this->getModel();
                break;
            }
            case "getproductcategorylist": {
                $this->getProductCategoryList();
                break;
            }
            case "updatedetailcategorylist": {
                $this->updateDetailCategoryList();
                break;
            }
            case "updatedetailmodellist": {
                $this->updateDetailModelList();
                break;
            }
            case "updateproductcategorylist": {
                $this->updateProductCategoryList();
                break;
            }
            case "getmisc": {
                $this->getMisc();
                break;
            }
            case "updatemisc": {
                $this->updateMisc();
                break;
            }
            case "getallmaterial": {
                $this->getAllMaterial();
                break;
            }
            case "getmateriallist": {
                $this->getMaterialList();
                break;
            }
            case "getmaterial": {
                $this->getMaterial();
                break;
            }
            case "updatematerial": {
                $this->updateMaterial();
                break;
            }
            case "getalldetail": {
                $this->getAllDetail();
                break;
            }
            case "getdetaillist": {
                $this->getDetailList();
                break;
            }
            case "getdetail": {
                $this->getDetail();
                break;
            }
            case "updatedetail": {
                $this->updateDetail();
                break;
            }
            case "updatedetailcount": {
                $this->updateDetailCount();
                break;
            }
            case "getallproduct": {
                $this->getAllProduct();
                break;
            }
            case "getallproductfull": {
                $this->getAllProductFull();
                break;
            }
            case "getproductlist": {
                $this->getProductList();
                break;
            }
            case "getproduct": {
                $this->getProduct();
                break;
            }
            case "updateproduct": {
                $this->updateProduct();
                break;
            }
            case "calculateproductparam": {
                $this->calculateProductParam();
                break;
            }
            case "getsimpledetails": {
                $this->getSimpleDetails();
                break;
            }
        }


    }

    public function getDetailCategoryList()
    {
        $this->viewHelper->assign("output_data", $this->model->getDetailCategoryList());
        $this->viewHelper->display("./lib/php/pages/add_s_d.php");
    }

    public function getDetailModelList()
    {
        $this->viewHelper->assign("output_data", $this->model->getDetailModelList(true));
        $this->viewHelper->display("./lib/php/pages/add_c_d.php");
    }

    public function getSimpleDetails()
    {
        $this->viewHelper->assign("output_data", $this->model->getSimpleDetails(true));
        $this->viewHelper->display("./lib/php/pages/simple_detail.php");
    }

    public function getComplexProducts()
    {
        $this->viewHelper->assign("output_data", $this->model->getComplexProducts(true));
        $this->viewHelper->display("./lib/php/pages/complex_detail.php");
    }

    public function getModel()
    {
        if (!isset($_GET["cat"]))
            return;
        $this->viewHelper->assign("output_data", $this->model->getModel($_GET["cat"]));
        $this->viewHelper->display("./list_output.php");
    }

    public function getProductCategoryList()
    {
        $this->viewHelper->assign("output_data", $this->model->getProductCategoryList());
        $this->viewHelper->display("./list_output.php");
    }

    public function updateDetailCategoryList()
    {
        $data["dcid"] = -1;
        $data["dcname"] = "";

        if (!isset($_GET["dcid"]) && !isset($_GET["dcname"])) {
            return;
        }
        if (isset($_GET["dcid"])) {
            $data["dcid"] = $_GET["dcid"];
            if (!isset($_GET["dcname"])) {
                return;
            } else {
                $data["dcname"] = $_GET["dcname"];
            }
        }
        if (isset($_GET["dcname"])) {
            $data["dcname"] = $_GET["dcname"];
        }
        $this->model->updateDetailCategoryList($data);
        $this->viewHelper->assign("output_data", $this->model->getDetailCategoryList());
        $this->viewHelper->display("./list_output.php");
    }

    public function updateDetailModelList()
    {
        $data['dmid'] = -1;

        $params = array('time2m', 'btime', 'amortization2m', 'spending', 'dmarticul', 'dmname', 'dcatalog', 'base64img');

        if (isset($_POST["dmid"])) {
            $data['dmid'] = intval($_POST["dmid"]);
        }
        foreach ($params as $param) {
            if (isset($_POST[$param])) {
                $data[$param] = $_POST[$param];
            }
        }
        $this->model->updateDetailModelList($data);
        $this->viewHelper->assign("output_data", $this->model->getModel($_POST["dcatalog"]));
        $this->viewHelper->display("./list_output.php");
    }

    public function updateProductCategoryList()
    {
        $data["gcid"] = -1;
        $data["gcname"] = "";

        if ((!isset($_GET["gcid"]) && !isset($_GET["gcname"])) ||
            (isset($_GET["gcid"]) && !isset($_GET["gcname"]))
        ) {
            return;
        } else if (!isset($_GET["gcid"]) && isset($_GET["gcname"])) {
            $data["gcname"] = $_GET["gcname"];
        } else {
            $data["gcid"] = $_GET["gcid"];
            $data["gcname"] = $_GET["gcname"];
        }
        $this->model->updateProductCategoryList($data);
    }

    public function getMisc()
    {
        $this->viewHelper->assign("output_data", $this->model->getMisc());
        $this->viewHelper->display("./lib/php/pages/settings.php");
    }

    public function updateMisc()
    {
        if (count($_GET) < 2)
            return;

        $data = $this->model->getMisc(true);

        $params = array('weldorSalary', 'operatorSalary', 'painterSalary', 'electrodeCost',
            'electrodeSpending', 'inkCost', 'primerCost', 'coloringDuration', 'weldTime');

        foreach ($params as $param) {
            if (isset($_GET[$param])) {
                $data[$param] = $_GET[$param];
            }
        }
        $this->model->updateMisc($data);
    }

    public function getAllMaterial($calc = "")
    {
        $this->viewHelper->assign("output_data", $this->model->getAllMaterial(true));

        if ($calc != "") {
            $this->viewHelper->display("./lib/php/pages/calc.php");
        }
        else
            $this->viewHelper->display("./lib/php/pages/material.php");
    }

    public function getMaterialList()
    {
        $this->viewHelper->assign("output_data", $this->model->getMaterialList());
        $this->viewHelper->display("./list_output.php");
    }

    public function getMaterial()
    {
        if (!isset($_GET["mid"]))
            return;
        $mid = intval($_GET["mid"]);
        $this->viewHelper->assign("output_data", $this->model->getMaterial($mid));
        $this->viewHelper->display("./list_output.php");
    }

    public function updateMaterial()
    {
        /*if (count($_GET) < 2)
            return;*/

        $data['mid'] = -1;

        $params = array('mname', 'marticul', 'price', 'inkconsumption', 'base64img');

        if (isset($_POST["mid"])) {
            $data['mid'] = intval($_POST["mid"]);
        }
        foreach ($params as $param) {
            if (isset($_POST[$param])) {
                $data[$param] = $_POST[$param];
            } else {
                echo "Не задан " . $param;
                return;
            }
        }
        $this->model->updateMaterial($data);
    }

    public function getAllDetail()
    {
        $this->viewHelper->assign("output_data", $this->model->getAllDetail());
        $this->viewHelper->display("./lib/php/pages/stock.php");
    }

    public function getDetailList()
    {
        if (!isset($_GET["model"]))
            return;

        $this->viewHelper->assign("output_data", $this->model->getDetailList(intval($_GET["model"])));
        $this->viewHelper->display("./list_output.php");
    }

    public function getDetail()
    {
        if (!isset($_GET["did"]))
            return;

        $this->viewHelper->assign("output_data", $this->model->getDetail(intval($_GET["did"])));
        $this->viewHelper->display("./list_output.php");
    }

    public function updateDetail()
    {
        if (count($_GET) < 2)
            return;

        $data['did'] = -1;

        $params = array('dlength', 'material', 'darticul', 'dmodel', 'count');

        if (isset($_GET["did"])) {
            $data['did'] = intval($_GET["did"]);
        }
        foreach ($params as $param) {
            if (isset($_GET[$param])) {
                $data[$param] = $_GET[$param];
            }
        }
        //print_r($data);
        $this->model->updateDetail($data);
        $this->viewHelper->assign("output_data", $this->model->getDetailList(intval($_GET["dmodel"])));
        $this->viewHelper->display("./list_output.php");
    }

    public function updateDetailCount()
    {
        if (!isset($_GET["did"]) || !isset($_GET["count"]))
            return;

        $data["did"] = $_GET["did"];
        $data["count"] = $_GET["count"];

        $this->model->updateDetailCount($data);
    }

    public function getAllProduct()
    {
        $this->viewHelper->assign("output_data", $this->model->getAllProduct());
        $this->viewHelper->display("./list_output.php");
    }

    public function getProductList()
    {
        $this->viewHelper->assign("output_data", $this->model->getProductList());
        $this->viewHelper->display("./list_output.php");
    }

    public function getProduct()
    {
        if (!isset($_GET["pid"]))
            return;

        $this->viewHelper->assign("output_data", $this->model->getProduct(intval($_GET["pid"])));
        $this->viewHelper->display("./list_output.php");
    }

    public function updateProduct()
    {
        if (count($_POST) < 2)
            return;

        $data['gid'] = -1;

        $params = array('details_count', 'details', 'width', 'height', 'garticul', 'gname', 'gpoints',
            'gamortization', 'gcatalog', 'base64img');

        if (isset($_POST["gid"])) {
            $data['gid'] = intval($_POST["gid"]);
        }
        foreach ($params as $param) {
            if (isset($_POST[$param])) {
                $data[$param] = $_POST[$param];
            }
        }
        $this->model->updateProduct($data);
    }

    public function calculateProductParam()
    {
        if (!isset($_GET["pid"]) || !isset($_GET["mid"]))
            return;

        $pid = $_GET["pid"];
        $mid = $_GET["mid"];

        /*if ($pid == 0 && $mid == 0)
            return;*/

        $productParam = $this->model->calculateProductParam(intval($pid), intval($mid));
        $this->viewHelper->assign("output_data", $productParam);
        $this->viewHelper->display("./list_output.php");
    }

}
