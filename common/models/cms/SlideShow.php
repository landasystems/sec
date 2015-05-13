<?php

/**
 * This is the model class for table "{{slide_show}}".
 *
 * The followings are the available columns in table '{{slide_show}}':
 * @property integer $id
 * @property integer $article_id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $status
 */
class SlideShow extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{slide_show}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('article_id, status', 'numerical', 'integerOnly' => true),
            array('image', 'length', 'max' => 100),
            array('title, description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, article_id, title, description, image, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'article_id' => 'Article',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'status' => 'Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('article_id', $this->article_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'status DESC')
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SlideShow the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getImg() {
        return landa()->pathImg('slider/'.$this->image);
    }

    public function getTagImg() {

        return '<img src="' . param('urlImg'). 'slider/'.$this->image.'" class="img-polaroid img-rounded"/><br>';
    }

    public function getStatusPublish() {
        $dd='';
        if ($this->status = 1) {
            $dd= '<span class="label label-info">Active</span>';
        } else {
            $dd= '<span class="label label-danger">non-active</span>';
        }
        return $dd;
    }

}
