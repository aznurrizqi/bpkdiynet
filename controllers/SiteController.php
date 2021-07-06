<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ForwardTraffic;
use app\models\AppCategory;
use app\models\TopApp;
use app\models\TopUser;
use app\models\TopDestination;
use yii\web\UploadedFile;
use app\models\AppCategorySearch;
use app\models\TopAppSearch;
use app\models\TopUserSearch;
use app\models\TopDestinationSearch;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $topAppSearchModel = new TopAppSearch();
        $topAppDataProvider = $topAppSearchModel->search(Yii::$app->request->queryParams);

        $appCatSearchModel = new AppCategorySearch();
        $appCatDataProvider = $appCatSearchModel->search(Yii::$app->request->queryParams);

        $topUserSearchModel = new TopUserSearch();
        $topUserDataProvider = $topUserSearchModel->search(Yii::$app->request->queryParams);

        $topDstSearchModel = new TopDestinationSearch();
        $topDstDataProvider = $topDstSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'appCatDataProvider' => $appCatDataProvider,
            'topAppDataProvider' => $topAppDataProvider,
            'topUserDataProvider' => $topUserDataProvider,
            'topDstDataProvider' => $topDstDataProvider,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    /**
     * Upload log page.
     *
     * @return Response|string
     */
    public function actionImport()
    {
        set_time_limit(0);
        $model = new ForwardTraffic();

        if ($model->load(Yii::$app->request->post())) {
            // $logfile = UploadedFile::getInstance($model, 'logfile');
            // if(isset($logfile->name)){
            //     $saveName = ForwardTraffic::saveFiles($logfile);
            //     var_dump('localhost:8080/bpknetwork/web/uploads/'.$saveName); die;
            // }
            // var_dump('fail'); die;

            $starttime = time();

            $connection = \Yii::$app->db;
    		$transaction = $connection->beginTransaction();
    		$successFlag = true;

            // $logfile = UploadedFile::getInstance($model, 'logfile');
            $model->logfile = UploadedFile::getInstance($model, 'logfile');
            $model->logfile->saveAs('uploads/' .$model->logfile->baseName . '.' . $model->logfile->extension);
            $xmlfile = file_get_contents('uploads/' .$model->logfile->baseName . '.' . $model->logfile->extension);
            // $xmlfile = fopen($logfile->tempName, 'r');
            $xmlob = simplexml_load_string($xmlfile);
            $xmljson = json_encode($xmlob);
            $xmlarray = json_decode($xmljson, true);
            
            // get top app
            // $topappArr = $xmlarray["table"][1]["id"];
            // for ($x = 0; $x < count($topappArr); $x++) {
            //     $modelTopApp = new TopApp();
            //     $modelTopApp->application = str_replace(array('.', '_'), ' ', $topappArr[$x]["Application"]);
            //     $modelTopApp->bandwidth = floatval($topappArr[$x]["Bandwidth"]);
            //     $modelTopApp->session = $topappArr[$x]["Sessions"];

            //     if ($modelTopApp->save()) {

            //     } else {
            //         $successFlag = false;
            //     }        
            // }

            // get app category
            // $appcatArr = $xmlarray["table"][2]["id"];
            // for ($x = 0; $x < count($appcatArr); $x++) {
            //     $modelAppCat = new AppCategory();
            //     $modelAppCat->app_category = str_replace(array('.', '_'), ' ', $appcatArr[$x]["Application_Category"]);
            //     $modelAppCat->bandwidth = floatval($appcatArr[$x]["Bandwidth"]);

            //     if ($modelAppCat->save()) {

            //     } else {
            //         $successFlag = false;
            //     }        
            // }

            // get top user
            // $topuserArr = $xmlarray["table"][3]["id"];
            // for ($x = 0; $x < count($topuserArr); $x++) {
            //     $modelTopUser = new TopUser();
            //     $modelTopUser->srcip = $topuserArr[$x]["User_or_IP_"];
            //     $modelTopUser->bandwidth = floatval($topuserArr[$x]["Bandwidth"]);
            //     $modelTopUser->session = $topuserArr[$x]["Sessions"];

            //     if ($modelTopUser->save()) {

            //     } else {
            //         $successFlag = false;
            //     }        
            // }

            // get top destination
            $topdestArr = $xmlarray["table"][4]["id"];
            for ($x = 0; $x < count($topdestArr); $x++) {
                $modelTopDst = new TopDestination();
                $modelTopDst->dstip = $topdestArr[$x]["Hostname_or_IP_"];
                if (filter_var($modelTopDst->dstip, FILTER_VALIDATE_IP)) {
                    $modelTopDst->hostname = gethostbyaddr($modelTopDst->dstip);
                } else {
                    $modelTopDst->hostname = $modelTopDst->dstip;
                }                
                $modelTopDst->bandwidth = floatval($topdestArr[$x]["Bandwidth"]);
                $modelTopDst->session = $topdestArr[$x]["Sessions"];

                if ($modelTopDst->save()) {

                } else {
                    $successFlag = false;
                }        
            }
            
            
            // $testupload->attributes = $xmlarray;
            // $testupload->save(false);

            // $line = 0;
            // while ($line = fgets($fh)) {
            //     // filter by time first
            //     if (strpos($line, 'time=') !== false) {
            //         $timeraw = explode('time=', $line);
            //         $timeraw = explode(' ', $timeraw[1]);
            //         $time = $timeraw[0];
                    
            //         if ($time >= '07:30:00' && $time < '16:30:00') {
            //             $line++;
            //             $newmodel = new ForwardTraffic();
        
            //             // get date
            //             if (strpos($line, 'date=') !== false) {
            //                 $dateraw = explode('date=', $line);
            //                 $dateraw = explode(' ', $dateraw[1]);
            //                 $newmodel->date = $dateraw[0];    
            //             }
        
            //             // get time
            //             $newmodel->time = $time;
        
            //             // get srcip
            //             if (strpos($line, 'srcip=') !== false) {
            //                 $srcipraw = explode('srcip=', $line);
            //                 $srcipraw = explode(' ', $srcipraw[1]);
            //                 $newmodel->srcip = $srcipraw[0];    
            //             }
        
            //             // get dstip
            //             if (strpos($line, 'dstip=') !== false) {
            //                 $dstipraw = explode('dstip=', $line);
            //                 $dstipraw = explode(' ', $dstipraw[1]);
            //                 $newmodel->dstip = $dstipraw[0];    
            //             }
        
            //             // get hostname
            //             if (strpos($line, 'hostname=') !== false) {
            //                 $hostnameraw = explode('hostname=', $line);
            //                 $hostnameraw = explode(' ', $hostnameraw[1]);
            //                 $url = 'https://'.trim($hostnameraw[0], '"');
            //                 $newmodel->hostname = $this->getDomain($url);
            //             } else {
            //                 $hostnamelookup = gethostbyaddr($newmodel->dstip);
            //                 if ($hostnamelookup != $newmodel->dstip) {
            //                     $url = 'https://'.$hostnamelookup;
            //                     $newmodel->hostname = $this->getDomain($url);
            //                 } else {

            //                 }
            //             }
        
            //             // get app
            //             if (strpos($line, 'app=') !== false) {
            //                 $appraw = explode('app=', $line);
            //                 $appraw = explode(' ', $appraw[1]);
            //                 $appraw = trim($appraw[0], '"');
            //                 $newmodel->app = str_replace(array('.', '_'), ' ', $appraw);
            //             }
        
            //             // get app category
            //             if (strpos($line, 'appcat=') !== false) {
            //                 $appcatraw = explode('appcat=', $line);
            //                 $appcatraw = explode(' ', $appcatraw[1]);
            //                 $appcatraw = trim($appcatraw[0], '"');    
            //                 $newmodel->app = str_replace(array('.', '_'), ' ', $appcatraw);
            //             }
        
            //             if ($newmodel->save()) {
            //                 // var_dump('goal'); die;
            //             } else {
            //                 // var_dump('nope'); die;
            //                 $successFlag = false;
            //             }        
            //         }
            //     }
            // }

            // fclose($xmlfile);

            $endtime = time();
            $mins = round(($endtime - $starttime) / 60, 2);

            if($successFlag){
                $transaction->commit();
                \Yii::$app->session->setFlash('success', 'Data Berhasil Disimpan. Dieksekusi dalam '.$mins.' menit.');
            }else{
                $transaction->rollBack();
                \Yii::$app->session->setFlash('warning', 'Data Gagal Disimpan. Dieksekusi dalam '.$mins.' menit.');
            }
        }

        return $this->render('import', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    private function getDomain($url) {
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : '';

        if (strpos($url, 'bpk.go.id') !== false) {
            return $pieces['host'];
        } else if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
    }
}
