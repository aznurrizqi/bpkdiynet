<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\AppCategory;
use app\models\TopApp;
use app\models\TopUser;
use app\models\ActiveUser;
use app\models\TopDestination;
use practically\chartjs\Chart;

/* @var $this yii\web\View */
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js");
// $this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5><?= $totalSession ?></h5>
                        <h4>Total Sesi</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5><?= $totalDataTransferred ?></h5>
                        <h4>Total Transfer Data</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5><?= $totalDataTransferred ?></h5>
                        <h4>Hari Tersibuk</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5><?= $totalUser ?></h5>
                        <h4>Total Pengguna</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h2>Pengguna Aktif</h2>

                <?=
                    Chart::widget([
                        'type' => 'line',
                        'datasets' => [
                            [
                                'query' => ActiveUser::find()
                                    ->select('on_date')
                                    ->addSelect('AVG(user_number) as data')
                                    ->groupBy('on_date')
                                    // ->limit(10)
                                    ->createCommand(),
                                'labelAttribute' => 'on_date'
                            ]
                        ],
                        'clientOptions' => [
                            // 'maintainAspectRatio' => false,
                            'legend' => ['display' => false],
                            'scales' => [
                                'yAxes' => [
                                    [
                                        'scaleLabel' => [
                                            'display' => true,
                                            'labelString' => 'Jumlah Pengguna'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h2>Top 10 Aplikasi</h2>

                <?=
                    Chart::widget([
                        'type' => 'horizontalBar',
                        'datasets' => [
                            [
                                'query' => TopApp::find()
                                    ->select('application')
                                    ->addSelect('bandwidth as data')
                                    ->limit(10)
                                    ->createCommand(),
                                'labelAttribute' => 'application'
                            ]
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'scales' => [
                                'xAxes' => [
                                    [
                                        'scaleLabel' => [
                                            'display' => true,
                                            'labelString' => 'Jumlah Data (GB)'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]);
                ?>

                <!-- <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p> -->
            </div>
            <div class="col-lg-6">
                <h2>Top 10 Kategori Aplikasi</h2>

                <?=
                    Chart::widget([
                        'type' => 'horizontalBar',
                        'datasets' => [
                            [
                                'query' => AppCategory::find()
                                    ->select('app_category')
                                    ->addSelect('bandwidth as data')
                                    ->limit(10)
                                    ->createCommand(),
                                'labelAttribute' => 'app_category'
                            ]
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'scales' => [
                                'xAxes' => [
                                    [
                                        'scaleLabel' => [
                                            'display' => true,
                                            'labelString' => 'Jumlah Data (GB)'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                    ]);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h2>Top 10 Pengguna</h2>

                <?=
                    Chart::widget([
                        'type' => 'horizontalBar',
                        'datasets' => [
                            [
                                'query' => TopUser::find()
                                    ->select('srcip')
                                    ->addSelect('bandwidth as data')
                                    ->limit(10)
                                    ->createCommand(),
                                'labelAttribute' => 'srcip'
                            ]
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'scales' => [
                                'xAxes' => [
                                    [
                                        'scaleLabel' => [
                                            'display' => true,
                                            'labelString' => 'Jumlah Data (GB)'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                    ]);
                ?>
            </div>
            <div class="col-lg-6">
                <h2>Top 10 Alamat Tujuan</h2>

                <?=
                    Chart::widget([
                        'type' => 'horizontalBar',
                        'datasets' => [
                            [
                                'query' => TopDestination::find()
                                    ->select('dstip')
                                    ->addSelect('bandwidth as data')
                                    ->limit(10)
                                    ->createCommand(),
                                'labelAttribute' => 'dstip'
                            ]
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'scales' => [
                                'xAxes' => [
                                    [
                                        'scaleLabel' => [
                                            'display' => true,
                                            'labelString' => 'Jumlah Data (GB)'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                    ]);
                ?>
            </div>
        </div>
    </div>
</div>
