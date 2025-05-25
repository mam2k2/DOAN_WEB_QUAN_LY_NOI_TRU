<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\SearchInterface;
use backend\models\search\ThongTinHocSinhSearch;
use common\models\PhongO;
use common\models\ThongTinHocSinh;
use common\models\User;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;

class ThongTinHocSinhService extends Service implements ThongTinHocSinhServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  ThongTinHocSinhSearch();
    }

    public function getModel($id, array $options = [])
    {
        return ThongTinHocSinh::findOne($id);
    }
    public function getListChoDuyet(array $query = [], array $options=[])
    {
        $searchModel = $this->getSearchModel($options);
        if( $searchModel === null ){
            /** @var ActiveRecord $model */
            $model = $this->newModel();
            $result = [
                'dataProvider' => new ActiveDataProvider([
                    'query' => $model->find(),
                ]),
            ];
        }else if( $searchModel instanceof SearchInterface ) {
            $dataProvider = $searchModel->searchDuyet($query, $options);
            $result = [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ];
        }else{
            throw new Exception("getSearchModel must return null or backend\models\search\SearchInterface ");
        }
        return $result;
    }
    public function newModel(array $options = [])
    {
        $model = new ThongTinHocSinh($options);
        $model->loadDefaultValues();
        return $model;
    }
    public function update($id, array $postData, array $options = [])
    {
        $model = $this->getModel($id, $options);
        if( empty($model) ){
            throw new NotFoundHttpException("Record " . $id . " not exists");
        }
        if( $model->load($postData) && $model->save() ){

            $model->user->email = $model->email;
            if($model->password != ""){
                $model->user->password = $model->password;
            }
            $phuHuynh = User::findOne($model->phu_huynh_user_id);
            if($phuHuynh!= null){
                $phuHuynh->email = $model->emailPH;
                if($model->passwordPH != ""){
                    $phuHuynh->password = $model->passwordPH;
                }
                $phuHuynh->save();
            }
            if($model->user->save()){

                return true;
            }else{
                return $model;
            }

        }
        return $model;
    }

    public function create(array $postData, array $options = [])
    {
        $model = $this->newModel($options);
        $model->load($postData);
//        VarDumper::dump($model ,10,true);
//        exit();
        $db = \Yii::$app->db;
        $transaction = $db->beginTransaction();

        try
        {
            if($model->password == ""){
                $model->addError("password","Vui lòng nhập password");
            }
            if($model->passwordPH == ""){
                $model->addError("passwordPH","Vui lòng nhập password");
            }
            if( $model->load($postData) && $model->save() )
            {
//            return true;
//            /** @var LopServiceInterface $lopService */
//            /** @var User $modelUser */
//            $userSevice =  \Yii::$app->get(UserServiceInterface::ServiceName);
                $modelUser = new User();
                $modelUserPH = new User();
                if($model->username == null || $model->username == ""){
                    $model->addError('username', 'Không thể để trống username');
                    return $model;
                }
                if($model->usernamePH == null || $model->usernamePH == ""){
                    $model->addError('usernamePH', 'Không thể để trống username cu phụ huynh');
                    return $model;
                }
                if(User::findOne(['email' => $model->email]) !== null){
                    $model->addError('email', 'Email này đã tồn tại trong hệ thống.');
                    return $model;
                }
                if(User::findOne(['email' => $model->emailPH]) !== null){
                    $model->addError('email', 'Email này đã tồn tại trong hệ thống.');
                    return $model;
                }

                $modelUser->load(['User'=>[
                    'username' => str_replace('{{ID}}',$model->id, $this->generateUsername($model->ho_va_ten)),
                    'password' => $model->password,
                    'email' => $model->email,
                    'access_token'  => 'A',
                    'created_at' => time(),
                    'updated_at' => time(),
                ]]);
                $modelUserPH->load(['User'=>[
                    'username' => str_replace('{{ID}}',$model->id, "ph_".$this->generateUsername($model->ho_va_ten)),
                    'password' => $model->passwordPH,
                    'email' => $model->emailPH,
                    'access_token'  => 'A',
                    'created_at' => time(),
                    'updated_at' => time(),
                ]]);

//            $modelUser->load();
                if ($modelUser->save() && $modelUserPH->save()) {
                    $model->user_id = $modelUser->id;
                    $model->phu_huynh_user_id = $modelUserPH->id;
//                    VarDumper::dump($model,10,true);
//                    exit();
                    if ($model->save(false))
                    {
                        $transaction->commit();
                        return true;
                    }
                    else{
                        VarDumper::dump($model->getErrors());
                        exit();
                    }
                }else{
                    VarDumper::dump($modelUser->getErrors());
                    exit();
                }
                VarDumper::dump($modelUserPH->getErrors());
                exit();
                return $model;
            }


            return $model; // TODO: Change the autogenerated stub
        }catch (\Exception $e){
            $transaction->rollBack(); // ❌ Nếu có lỗi, rollback toàn bộ
            throw $e; // hoặc xử lý log lỗi tại đây
        }

    }

    public function getAllNameHocSinh(array $options=[])
    {
        $list = ArrayHelper::map(
            ThongTinHocSinh::find()
                ->select(['id', 'cccd', 'ho_va_ten'])
                ->where($options)
                ->andWhere(['trang_thai' => 1])
                ->asArray()
                ->all(),
            'id',
            function ($row) {
                return $row['cccd'] . ' - ' . $row['ho_va_ten'];
            });
        return $list;
    }
    function generateUsername($fullName) {
        // Bảng thay thế tiếng Việt
        $accents = [
            'à'=>'a','á'=>'a','ạ'=>'a','ả'=>'a','ã'=>'a',
            'â'=>'a','ầ'=>'a','ấ'=>'a','ậ'=>'a','ẩ'=>'a','ẫ'=>'a',
            'ă'=>'a','ằ'=>'a','ắ'=>'a','ặ'=>'a','ẳ'=>'a','ẵ'=>'a',
            'è'=>'e','é'=>'e','ẹ'=>'e','ẻ'=>'e','ẽ'=>'e',
            'ê'=>'e','ề'=>'e','ế'=>'e','ệ'=>'e','ể'=>'e','ễ'=>'e',
            'ì'=>'i','í'=>'i','ị'=>'i','ỉ'=>'i','ĩ'=>'i',
            'ò'=>'o','ó'=>'o','ọ'=>'o','ỏ'=>'o','õ'=>'o',
            'ô'=>'o','ồ'=>'o','ố'=>'o','ộ'=>'o','ổ'=>'o','ỗ'=>'o',
            'ơ'=>'o','ờ'=>'o','ớ'=>'o','ợ'=>'o','ở'=>'o','ỡ'=>'o',
            'ù'=>'u','ú'=>'u','ụ'=>'u','ủ'=>'u','ũ'=>'u',
            'ư'=>'u','ừ'=>'u','ứ'=>'u','ự'=>'u','ử'=>'u','ữ'=>'u',
            'ỳ'=>'y','ý'=>'y','ỵ'=>'y','ỷ'=>'y','ỹ'=>'y',
            'đ'=>'d','Đ'=>'D',
            'À'=>'A','Á'=>'A','Ạ'=>'A','Ả'=>'A','Ã'=>'A',
            'Â'=>'A','Ầ'=>'A','Ấ'=>'A','Ậ'=>'A','Ẩ'=>'A','Ẫ'=>'A',
            'Ă'=>'A','Ằ'=>'A','Ắ'=>'A','Ặ'=>'A','Ẳ'=>'A','Ẵ'=>'A',
            'È'=>'E','É'=>'E','Ẹ'=>'E','Ẻ'=>'E','Ẽ'=>'E',
            'Ê'=>'E','Ề'=>'E','Ế'=>'E','Ệ'=>'E','Ể'=>'E','Ễ'=>'E',
            'Ì'=>'I','Í'=>'I','Ị'=>'I','Ỉ'=>'I','Ĩ'=>'I',
            'Ò'=>'O','Ó'=>'O','Ọ'=>'O','Ỏ'=>'O','Õ'=>'O',
            'Ô'=>'O','Ồ'=>'O','Ố'=>'O','Ộ'=>'O','Ổ'=>'O','Ỗ'=>'O',
            'Ơ'=>'O','Ờ'=>'O','Ớ'=>'O','Ợ'=>'O','Ở'=>'O','Ỡ'=>'O',
            'Ù'=>'U','Ú'=>'U','Ụ'=>'U','Ủ'=>'U','Ũ'=>'U',
            'Ư'=>'U','Ừ'=>'U','Ứ'=>'U','Ự'=>'U','Ử'=>'U','Ữ'=>'U',
            'Ỳ'=>'Y','Ý'=>'Y','Ỵ'=>'Y','Ỷ'=>'Y','Ỹ'=>'Y',
        ];

        // 1. Bỏ dấu tiếng Việt
        $noAccent = strtr($fullName, $accents);

        // 2. Chuyển thành chữ thường
        $lower = strtolower($noAccent);

        // 3. Xóa ký tự đặc biệt, chỉ giữ chữ thường, số và khoảng trắng
        $clean = preg_replace('/[^a-z0-9 ]/', '', $lower);

        // 4. Ghép các từ lại thành username
        $parts = explode(' ', trim($clean));
        return implode('', $parts) . '_{{ID}}';
    }
    public function createPending(array $postData, array $options = [])
    {
        $model = $this->newModel($options);
        $model->load($postData);
//        VarDumper::dump($model ,10,true);
//        exit();
        $db = \Yii::$app->db;
        $transaction = $db->beginTransaction();

        try
        {
//            if($model->password == ""){
//                $model->addError("password","Vui lòng nhập password");
//            }
//            if($model->passwordPH == ""){
//                $model->addError("passwordPH","Vui lòng nhập password");
//            }
            $model->trang_thai = 3;
            if( $model->load($postData) && $model->save() )
            {
//            return true;
//            /** @var LopServiceInterface $lopService */
//            /** @var User $modelUser */
//            $userSevice =  \Yii::$app->get(UserServiceInterface::ServiceName);
                $modelUser = new User();
                $modelUserPH = new User();

                if(User::findOne(['email' => $model->email]) !== null){
                    $model->addError('email', 'Email này đã tồn tại trong hệ thống.');
                    return $model;
                }
                if(User::findOne(['email' => $model->emailPH]) !== null){
                    $model->addError('email', 'Email này đã tồn tại trong hệ thống.');
                    return $model;
                }

                $modelUser->load(['User'=>[
                    'username' => str_replace('{{ID}}',$model->id,$this->generateUsername($model->ho_va_ten) ),
                    'password' => '123456A@b',
                    'email' => $model->email,
                    'access_token'  => 'A',
                    'status' => User::STATUS_DELETED,
                    'created_at' => time(),
                    'updated_at' => time(),
                ]]);
                $modelUserPH->load(['User'=>[
                    'username' => str_replace('{{ID}}',$model->id,"ph_".$this->generateUsername($model->ho_va_ten)),
                    'password' =>'123456A@b',
                    'email' => $model->emailPH,
                    'access_token'  => 'A',
                    'status' => User::STATUS_DELETED,
                    'created_at' => time(),
                    'updated_at' => time(),
                ]]);

//            $modelUser->load();
                if ($modelUser->save() && $modelUserPH->save()) {
                    $model->user_id = $modelUser->id;
                    $model->phu_huynh_user_id = $modelUserPH->id;

                    if ($model->save(false))
                    {
                        $transaction->commit();
                        return true;
                    }
                    else{
                        VarDumper::dump($model->getErrors());
                        exit();
                    }
                }else{
                    VarDumper::dump($modelUser->getErrors());
                    exit();
                }

                return $model;
            }


            return $model; // TODO: Change the autogenerated stub
        }catch (\Exception $e){
            $transaction->rollBack(); // ❌ Nếu có lỗi, rollback toàn bộ
            throw $e; // hoặc xử lý log lỗi tại đây
        }

    }

}
