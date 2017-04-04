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
            switch (strtolower($_GET["q"])) {
                case "getdetailcategorylist": {
                    $this->getDetailCategoryList();
                    break;
                }
                case "getdetailmodellist": {
                    $this->getDetailModelList();
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
            }
        }

    }

    public function getDetailCategoryList()
    {
        $this->viewHelper->assign("output_data", $this->model->getDetailCategoryList());
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
    }

    public function getDetailModelList()
    {
        $this->viewHelper->assign("output_data", $this->model->getDetailModelList());
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
    }

    public function getProductCategoryList()
    {
        $this->viewHelper->assign("output_data", $this->model->getProductCategoryList());
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
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

    }

    public function updateDetailModelList()
    {
        $data['dmid'] = -1;

        $params = array('time2m', 'btime', 'amortization2m', 'spending', 'dmarticul', 'dmname', 'dcatalog');

        if (isset($_GET["dmid"])) {
            $data['dmid'] = intval($_GET["dmid"]);
        }
        foreach ($params as $param) {
            if (isset($_GET[$param])) {
                $data[$param] = $_GET[$param];
            }
        }
        $this->model->updateDetailModelList($data);
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
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
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

    public function getAllMaterial()
    {
        $this->viewHelper->assign("output_data", $this->model->getAllMaterial());
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
    }

    public function getMaterialList()
    {
        $this->viewHelper->assign("output_data", $this->model->getMaterialList());
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
    }

    public function getMaterial()
    {
        if (!isset($_GET["mid"]))
            return;
        $mid = intval($_GET["mid"]);
        $this->viewHelper->assign("output_data", $this->model->getMaterial($mid));
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
    }

    public function updateMaterial()
    {
        if (count($_GET) < 2)
            return;

        $data['mid'] = -1;

        $params = array('mname', 'marticul', 'price', 'inkconsumption');

        if (isset($_GET["mid"])) {
            $data['mid'] = intval($_GET["mid"]);
        }
        foreach ($params as $param) {
            if (isset($_GET[$param])) {
                $data[$param] = $_GET[$param];
            }
        }
        $this->model->updateMaterial($data);
    }

    public function getAllDetail()
    {
        $this->viewHelper->assign("output_data", $this->model->getAllDetail());
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
    }

    public function getDetailList()
    {
        if (!isset($_GET["model"]))
            return;

        $this->viewHelper->assign("output_data", $this->model->getDetailList(intval($_GET["model"])));
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
    }

    public function getDetail()
    {
        if (!isset($_GET["did"]))
            return;

        $this->viewHelper->assign("output_data", $this->model->getDetail(intval($_GET["did"])));
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
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
        $this->model->updateDetail($data);
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
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
    }

    public function getProductList()
    {
        $this->viewHelper->assign("output_data", $this->model->getProductList());
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
    }

    public function getProduct()
    {
        if (!isset($_GET["pid"]))
            return;

        $this->viewHelper->assign("output_data", $this->model->getProduct(intval($_GET["pid"])));
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
    }

    public function updateProduct()
    {
        if (count($_GET) < 2)
            return;

        $data['gid'] = -1;

        $params = array('details', 'width', 'height', 'garticul', 'gname', 'gpoints',
            'gamortization', 'gcatalog');

        if (isset($_GET["gid"])) {
            $data['gid'] = intval($_GET["gid"]);
        }
        foreach ($params as $param) {
            if (isset($_GET[$param])) {
                $data[$param] = $_GET[$param];
            }
        }
        $this->model->updateDetail($data);
    }

    public function calculateProductParam()
    {
        if (!isset($_GET["pid"]) || !isset($_GET["mid"]))
            return;

        $productParam = $this->model->calculateProductParam(intval($_GET["pid"]), intval($_GET["mid"]));
        $this->viewHelper->assign("output_data", $productParam);
        $this->viewHelper->display("./lib/php/pages/temp_out.php");
    }

}
