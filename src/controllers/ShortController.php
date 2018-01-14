<?php

namespace kirnet\shortlinks\controllers;

use kirnet\shortlinks\models\ShortLinks;
use kirnet\shortlinks\models\ShortLinksInfo;
use yii\web\Controller;
use yii\helpers\Json;
use yii\filters\VerbFilter;
use kirnet\shortlinks\models\ShortLinksSearch;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * Class ShortController
 * @package kirnet\shortlinks\controllers
 */
class ShortController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @param $action
     *
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction( $action ) {
        \kirnet\shortlinks\ShortAssetsBundle::register($this->view);
        return parent::beforeAction( $action );
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $shortLinks = new ShortLinks();
        return $this->render('index',[
            'shortLinks' => $shortLinks
        ]);
    }

    /**
     * @param int $id
     */
    public function actionEdit($id = 0)
    {
        if (Yii::$app->request->post('ShortLinks')) {
            $shortLinks = new ShortLinks();
            if ($shortLinks->load(Yii::$app->request->post())) {
                if (!$shortLinks->date_expire) {
                    $shortLinks->date_expire = '0000-00-00';
                }
                if ($shortLinks->save()) {
                    $this->redirect(Url::to('/shortlinks/view'));
                }
                else {
                    var_dump($shortLinks->getErrors()); die();
                }
            }
        }
    }

    /**
     * @return string
     */
    public function actionView()
    {
        $searchModel = new ShortLinksSearch();
        $query = ShortLinks::find()->with('shortLinksInfos');
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return bool|string|\yii\web\Response
     */
    public function actionRedirect()
    {
        $slug = Url::base(true) . '/' . Yii::$app->request->get('slug');
        if (!$slug) {
            return false;
        }
        $shortLink = ShortLinks::findOne(['short_url' => $slug]);
        if (($shortLink && strtotime($shortLink->date_expire) >= time()) || $shortLink->date_expire == '0000-00-00') {
            $shortLinksInfo = new ShortLinksInfo();
            $info = new \stdClass();
            $info->userAgent = $_SERVER['HTTP_USER_AGENT'];
            $info->ip = $_SERVER['REMOTE_ADDR'];
            $shortLinksInfo->info = Json::encode($info);
            $shortLinksInfo->link_id = $shortLink->id;
            $shortLinksInfo->save();
            return $this->redirect(Url::to($shortLink->url));
        }
        return $this->render('redirect', []);
    }
}
