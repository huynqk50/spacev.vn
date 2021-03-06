<?php

namespace backend\models;

use common\utils\FileUtils;
use common\utils\Dump;
use Yii;
use frontend\models\UrlParam;

/**
 * This is the model class for table "article_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $label
 * @property string $slug
 * @property string $old_slugs
 * @property integer $parent_id
 * @property string $description
 * @property string $long_description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $h1
 * @property string $page_title
 * @property string $image
 * @property string $banner
 * @property string $image_path
 * @property integer $status
 * @property integer $is_hot
 * @property integer $sort_order
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property integer $is_active
 * @property integer $type
 *
 * @property Article[] $articles
 * @property ArticleCategory $parent
 * @property ArticleCategory[] $articleCategories
 */
class ArticleCategory extends \common\models\ArticleCategory
{
    
    /**
    * function ->getLink ()
    */
//    public $_link;
//    public function getLink ()
//    {
//        if ($this->_link === null) {
//            $this->_link = Yii::$app->params['frontend_url']
//                . Yii::$app->frontendUrlManager->createUrl(['article-category/index', 'slug' => $this->slug]);
//        }
//        return $this->_link;
//    }

    public $_link;
    public function getLink()
    {
        if ($this->_link == null) {
            if ($parent = $this->parent) {
                $this->_link = Yii::$app->params['frontend_url'] .
                    Yii::$app->frontendUrlManager->createUrl([
                    'article/category',
                    UrlParam::SLUG => $this->slug,
                    UrlParam::PARENT_SLUG => $parent->slug
                ], true);
            } else {
                $this->_link = Yii::$app->params['frontend_url'] .
                    Yii::$app->frontendUrlManager->createUrl([
                    'article/category',
                    UrlParam::SLUG => $this->slug
                ], true);
            }
        }

        return $this->_link;
    }

    /**
    * function ::create ($data)
    */
    public static function create ($data)
    {
        $now = strtotime('now');
        $username = Yii::$app->user->identity->username;  
        $model = new ArticleCategory();
        if($model->load($data)) {
            if ($log = new UserLog()) {
                $log->username = $username;
                $log->action = 'Create';
                $log->object_class = 'ArticleCategory';
                $log->created_at = $now;
                $log->is_success = 0;
                $log->save();
            }
            
            $model->created_at = $now;
            $model->created_by = $username;
                

            $model->image_path = FileUtils::generatePath($now, Yii::$app->params['images_folder']);

            $targetFolder = Yii::$app->params['images_folder'] . $model->image_path;
            $targetUrl = Yii::$app->params['images_url'] . $model->image_path;
            
            if (!empty($data['articlecategory-image'])) {
                $copyResult = FileUtils::copyImage([
                    'imageName' => $model->image,
                    'fromFolder' => Yii::$app->params['uploads_folder'],
                    'toFolder' => $targetFolder,
                    'resize' => array_values(self::$image_resizes),
                    'removeInputImage' => true,
                ]);
                if ($copyResult['success']) {
                    $model->image = $copyResult['imageName'];
                }
            }
            if (!empty($data['articlecategory-banner'])) {
                $copyResult = FileUtils::copyImage([
                    'imageName' => $model->banner,
                    'fromFolder' => Yii::$app->params['uploads_folder'],
                    'toFolder' => $targetFolder,
                    'resize' => array_values(self::$banner_resizes),
                    'removeInputImage' => true,
                ]);
                if ($copyResult['success']) {
                    $model->banner = $copyResult['imageName'];
                }
            }
                    
            $model->long_description = FileUtils::copyContentImages([
                'content' => $model->long_description,
                'defaultFromFolder' => Yii::$app->params['uploads_folder'],
                'toFolder' => $targetFolder,
                'toUrl' => $targetUrl,
                'removeInputImage' => true,
            ]);
            if ($model->save()) {
                if ($log) {
                    $log->object_pk = $model->id;
                    $log->is_success = 1;
                    $log->save();
                }
                return $model;
            }
            Dump::errors($model->errors);
            return;
        }
        return false;
    }
    
    /**
    * function ->update2 ($data)
    */
    public function update2 ($data)
    {
        $now = strtotime('now');
        $username = Yii::$app->user->identity->username;   
        if ($this->load($data)) {
            if ($log = new UserLog()) {
                $log->username = $username;
                $log->action = 'Update';
                $log->object_class = 'ArticleCategory';
                $log->object_pk = $this->id;
                $log->created_at = $now;
                $log->is_success = 0;
                $log->save();
            }
            
            $this->updated_at = $now;
            $this->updated_by = $username;
            if ($this->slug != $this->getOldAttribute('slug')) {
                $old_slugs_arr = json_decode($this->old_slugs, true);
                is_array($old_slugs_arr) or $old_slugs_arr = array();
                $old_slugs_arr[$now] = $this->getOldAttribute('slug');
                $this->old_slugs = json_encode($old_slugs_arr);
            }
                  
            if ($this->image_path == null || trim($this->image_path) == '' || !is_dir(Yii::$app->params['images_folder'] . $this->image_path)) {
                $this->image_path = FileUtils::generatePath($now, Yii::$app->params['images_folder']);
            }
            
            $targetFolder = Yii::$app->params['images_folder'] . $this->image_path;
            $targetUrl = Yii::$app->params['images_url'] . $this->image_path;
            
            if (!empty($data['articlecategory-image'])) {
                $copyResult = FileUtils::updateImage([
                    'imageName' => $this->image,
                    'oldImageName' => $this->getOldAttribute('image'),
                    'fromFolder' => Yii::$app->params['uploads_folder'],
                    'toFolder' => $targetFolder,
                    'resize' => array_values(self::$image_resizes),
                    'removeInputImage' => true,
                ]);
                if ($copyResult['success']) {
                    $this->image = $copyResult['imageName'];
                }
            }
            if (!empty($data['articlecategory-banner'])) {
                $copyResult = FileUtils::updateImage([
                    'imageName' => $this->banner,
                    'oldImageName' => $this->getOldAttribute('banner'),
                    'fromFolder' => Yii::$app->params['uploads_folder'],
                    'toFolder' => $targetFolder,
                    'resize' => array_values(self::$banner_resizes),
                    'removeInputImage' => true,
                ]);
                if ($copyResult['success']) {
                    $this->banner = $copyResult['imageName'];
                }
            }
            $this->long_description = FileUtils::updateContentImages([
                'content' => $this->long_description,
                'oldContent' => $this->getOldAttribute('long_description'),
                'defaultFromFolder' => Yii::$app->params['uploads_folder'],
                'toFolder' => $targetFolder,
                'toUrl' => $targetUrl,
                'removeInputImage' => true,
            ]);
            
            if ($this->save()) {
                if ($log) {
                    $log->is_success = 1;
                    $log->save();
                }
                return true;
            }
        }
        return false;
    }
    
    /**
    * function ->delete ()
    */
    public function delete ()
    {
        $now = strtotime('now');
        $username = Yii::$app->user->identity->username;    
        if ($log = new UserLog()) {
            $log->username = $username;
            $log->action = 'Delete';
            $log->object_class = 'ArticleCategory';
            $log->object_pk = $this->id;
            $log->created_at = $now;
            $log->is_success = 0;
            $log->save();
        }
        if(parent::delete()) {
            if ($log) {
                $log->is_success = 1;
                $log->save();
            }
            if ($this->image_path != '') {
                $targetFolder = Yii::$app->params['images_folder'] . $this->image_path;
                $targetUrl = Yii::$app->params['images_url'] . $this->image_path;
            
                FileUtils::updateImage([
                    'imageName' => '',
                    'oldImageName' => $this->image,
                    'fromFolder' => Yii::$app->params['uploads_folder'],
                    'toFolder' => $targetFolder,
                    'resize' => array_values(self::$image_resizes),
                ]);
                
                FileUtils::updateImage([
                    'imageName' => '',
                    'oldImageName' => $this->banner,
                    'fromFolder' => Yii::$app->params['uploads_folder'],
                    'toFolder' => $targetFolder,
                    'resize' => array_values(self::$banner_resizes),
                ]);
                
                FileUtils::updateContentImages([
                    'content' => '',
                    'oldContent' => $this->long_description,
                    'defaultFromFolder' => Yii::$app->params['uploads_folder'],
                    'toFolder' => $targetFolder,
                    'toUrl' => $targetUrl,
                ]);
                
            }
            
            return true;
        }
        return false;
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'status', 'is_hot', 'sort_order', 'is_active', 'type'], 'integer'],
            [['long_description'], 'string'],
            [['created_at', 'created_by'], 'required'],
            [['name', 'slug', 'page_title', 'meta_title', 'h1', 'meta_keywords', 'meta_description'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'label', 'slug', 'created_by', 'updated_by'], 'string', 'max' => 255],
            [['old_slugs'], 'string', 'max' => 2000],
            [['description', 'meta_title', 'meta_description', 'meta_keywords', 'h1', 'page_title', 'image', 'banner', 'image_path'], 'string', 'max' => 511],
            [['slug', 'parent_id'], 'unique', 'targetAttribute' => ['slug', 'parent_id'], 'message' => 'The combination of Slug and Parent ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'label' => 'Nhãn',
            'slug' => 'Slug',
            'old_slugs' => 'Old Slugs',
            'parent_id' => 'Danh mục cha',
            'description' => 'Mô tả',
            'long_description' => 'Mô tả chi tiết',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'h1' => 'H1',
            'page_title' => 'Tiêu đề trang',
            'image' => 'Ảnh đại diện',
            'banner' => 'Banner',
            'image_path' => 'Image Path',
            'status' => 'Trạng thái',
            'is_hot' => 'Mục HOT',
            'sort_order' => 'Thứ tự sắp xếp',
            'created_at' => 'Thêm mới lúc',
            'updated_at' => 'Cập nhật lúc',
            'created_by' => 'Thêm mới bởi',
            'updated_by' => 'Cập nhật bởi',
            'is_active' => 'Kích hoạt',
            'type' => 'Phân loại',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleCategories()
    {
        return $this->hasMany(ArticleCategory::className(), ['parent_id' => 'id']);
    }

    /**
     * @return array of self
     */
    public static function listNoArticle()
    {
        $result = [];
        $article_categories = ArticleCategory::find()->allActive();
        foreach ($article_categories as $item) {
//            if (!$item->getArticles()->oneActive()) {
                if ($item->parent !== null) {
                    $result[$item->parent->name][$item->id] = $item->name;
                } else {
                    $result[$item->id] = $item->name;
                }
//            }
        }
        return $result;
    }

    public static function listNoChild()
    {
        $result = [];
        $article_categories = ArticleCategory::find()->allActive();
        foreach ($article_categories as $item) {
            if (!ArticleCategory::find()->where(['parent_id' => $item->id])->oneActive()) {
                if ($item->parent !== null) {
                    $result[$item->parent->name][$item->id] = $item->name;
                } else {
                    $result[$item->id] = $item->name;
                }
            }
        }
        return $result;
    }

    public static function listAll()
    {
        $items = ArticleCategory::find()->allActive();
        $result = ArrayHelper::map($items, 'id', 'name');
        return $result;
    }
}
