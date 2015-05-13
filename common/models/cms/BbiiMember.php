<?php

/**
 * This is the model class for table "bbii_member".
 *
 * The followings are the available columns in table 'bbii_member':
 * @property integer $id
 * @property string $member_name
 * @property integer $gender
 * @property string $birthdate
 * @property string $location
 * @property string $personal_text
 * @property string $signature
 * @property string $avatar
 * @property integer $show_online
 * @property integer $contact_email
 * @property integer $contact_pm
 * @property string $timezone
 * @property string $first_visit
 * @property string $last_visit
 * @property integer $warning
 * @property integer $posts
 * @property integer $group_id
 * @property integer $upvoted
 * @property string $blogger
 * @property string $facebook
 * @property string $flickr
 * @property string $google
 * @property string $linkedin
 * @property string $metacafe
 * @property string $myspace
 * @property string $orkut
 * @property string $tumblr
 * @property string $twitter
 * @property string $website
 * @property string $wordpress
 * @property string $yahoo
 * @property string $youtube
 * @property string $moderator
 */
class BbiiMember extends CActiveRecord {

    public $image;
//    public $remove_avatar;
    public $verifyCode;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return BbiiMember the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'bbii_member';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('member_name, type_business, company_name, address,username,password, phone', 'required'),
            array('posts, group_id, upvoted', 'numerical', 'integerOnly' => true),
            array('gender, show_online, contact_email, contact_pm, warning, moderator', 'numerical', 'integerOnly' => true, 'max' => 1),
            array('member_name', 'unique', 'on' => 'update'),
            array('member_name', 'length', 'max' => 45),
            array('image', 'file', 'allowEmpty' => true, 'maxSize' => 1025000, 'types' => 'gif, jpg, jpeg, png'),
            array('location, personal_text,facebook,  twitter, website', 'length', 'max' => 255),
            array('timezone', 'length', 'max' => 80),
            array('gender, location, personal_text, signature', 'default', 'value' => null),
//            array('blogger, facebook, flickr, google, linkedin, metacafe, myspace, orkut, tumblr, twitter, website, wordpress, yahoo, youtube', 'url'),
//            array('blogger, facebook, flickr, google, linkedin, metacafe, myspace, orkut, tumblr, twitter, website, wordpress, yahoo, youtube', 'default', 'value' => null),
            array('timezone', 'default', 'value' => 'Asia/Jakarta'),
//            array('signature', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
            array('signature, first_visit, last_visit', 'safe'),
             array('avatar', 'unsafe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('username, email', 'unique', 'message' => '{attribute} : {value} already exists!', 'on' => array('allow', 'register')),
//            array('email', 'email', 'on' => array('allow','register')),
//            array('username, password', 'required', 'on' => array('allow', 'register')),
            array('username', 'safe', 'message' => '{attribute} : {value} already exists!', 'on' => 'notAllow'),
            array('id, member_name, username,password,birthdate, gender, location, personal_text, signature, avatar, show_online, contact_email, contact_pm, timezone, first_visit, last_visit, warning, posts, group_id, upvoted, facebook,twitter, website,
                moderator, email, code, phone, business_id, city_id, address, type_business, company_name, pin', 'safe', 'on' => 'search'),
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'register'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'group' => array(self::BELONGS_TO, 'BbiiMembergroup', 'group_id'),
            'business' => array(self::BELONGS_TO, 'BusinessCategory', 'business_id'),
            'City' => array(self::BELONGS_TO, 'City', 'city_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
//            'image' => Yii::t('BbiiModule.bbii', 'Upload a new avatar'),
//            'remove_avatar' => Yii::t('BbiiModule.bbii', 'Remove your avatar'),
//            'member_name' => Yii::t('BbiiModule.bbii', 'Name to display'),
            'gender' => 'Jenis Kelamin',
            'city_id' => 'Kab / Kota',
            'business_id' => 'Kategori Usaha',
            'company_name' => 'Nama Usaha',
            'type_business' => 'Jenis Usaha',
            'address' => 'Alamat',
            'pin' => 'Pin BB / WA',
//            'birthdate' => Yii::t('BbiiModule.bbii', 'Birthdate'),
//            'location' => Yii::t('BbiiModule.bbii', 'Location'),
//            'personal_text' => Yii::t('BbiiModule.bbii', 'Profile text'),
//            'signature' => Yii::t('BbiiModule.bbii', 'Signature'),
            'avatar' => 'Avatar',
//            'show_online' => Yii::t('BbiiModule.bbii', 'Show when online'),
//            'contact_email' => Yii::t('BbiiModule.bbii', 'Allow members to contact you by e-mail'),
//            'contact_pm' => Yii::t('BbiiModule.bbii', 'Allow members to contact you by private messaging'),
//            'timezone' => Yii::t('BbiiModule.bbii', 'Time zone'),
            'first_visit' => 'First Visit',
            'last_visit' => 'Last Visit',
            'warning' => 'Warning',
            'posts' => 'Posts',
//            'group_id' => Yii::t('BbiiModule.bbii', 'Group'),
            'upvoted' => 'Upvoted',
//            'blogger' => Yii::t('BbiiModule.bbii', 'My Blogger blog'),
//            'facebook' => Yii::t('BbiiModule.bbii', 'My Facebook page'),
//            'flickr' => Yii::t('BbiiModule.bbii', 'My Flickr account'),
//            'google' => Yii::t('BbiiModule.bbii', 'My Google+ page'),
//            'linkedin' => Yii::t('BbiiModule.bbii', 'My Linkedin page'),
//            'metacafe' => Yii::t('BbiiModule.bbii', 'My Metacafe channel'),
//            'myspace' => Yii::t('BbiiModule.bbii', 'My Myspace page'),
//            'orkut' => Yii::t('BbiiModule.bbii', 'My Orkut page'),
//            'tumblr' => Yii::t('BbiiModule.bbii', 'My Tumblr blog'),
//            'twitter' => Yii::t('BbiiModule.bbii', 'My Twitter page'),
//            'website' => Yii::t('BbiiModule.bbii', 'My website'),
//            'wordpress' => Yii::t('BbiiModule.bbii', 'My Wordpress blog'),
//            'yahoo' => Yii::t('BbiiModule.bbii', 'Yahoo'),
//            'youtube' => Yii::t('BbiiModule.bbii', 'My Youtube channel'),
            'moderator' => 'Moderator',
//            'username' => Yii::t('BbiiModule.bbii', 'Username'),
            'password' => 'Password',
            'verifyCode' => 'Verification Code',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('business');
        $criteria->together = true;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('member_name', $this->member_name);
        $criteria->compare('gender', $this->gender);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('city_id', $this->city_id, true);
        $criteria->compare('business_id', $this->business_id, true);
        $criteria->compare('avatar', $this->avatar, true);
        $criteria->compare('show_online', $this->show_online);
        $criteria->compare('moderator', $this->moderator, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 't.id DESC')
        ));
    }

    public function scopes() {
        $recent = date('Y-m-d H:i:s', time() - 900);
        return array(
            'present' => array(
                'order' => 'last_visit DESC',
                'condition' => "last_visit > '$recent'",
            ),
            'show' => array(
                'condition' => 'show_online = 1',
            ),
            'hidden' => array(
                'condition' => 'show_online = 0',
            ),
            'newest' => array(
                'order' => 'first_visit DESC',
                'limit' => 1,
            ),
            'moderator' => array(
                'condition' => 'moderator = 1',
            ),
        );
    }

    public function getMediumImage() {
        return '<img src="' . $this->imgUrl['medium'] . '" class="img-polaroid"/><br>';
    }

    public function getSmallImage() {
        return '<img src="' . $this->imgUrl['small'] . '" class="img-polaroid"/><br>';
    }

    public function getImgUrl() {
        return landa()->urlImg('avatar/', $this->avatar, $this->id);
    }

    public function getUrl() {

        return url('user/' . $this->id);
    }

    public function getTagImg() {
        $moderator = '';
        if ($this->moderator == 1) {
            $moderator = '<span class="label label-info">Moderator</span>';
        }
        return '<img src="' . $this->imgUrl['small'] . '" class="img-polaroid img-rounded"/><br>' . $moderator;
    }

    public function getTagBiodata() {
        $city = (isset($this->City->name)) ? $this->City->name : '-';
        echo '<div class="row-fluid">
                    <div class="span3">
                        <b>Nama</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span6" style="text-align:left">
                        ' . $this->member_name . '
                    </div>
                </div>
               
                <div class="row-fluid">
                    <div class="span3">
                        <b>Kota/Kab</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span6" style="text-align:left">
                        ' . $city . '
                    </div>
                </div>
                     <div class="row-fluid">
                    <div class="span3">
                        <b>Telepon</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span6" style="text-align:left">
                        ' . landa()->hp($this->phone) . '
                    </div>
                </div>
                </div>
                     <div class="row-fluid">
                    <div class="span3">
                        <b>Alamat</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span6" style="text-align:left">
                       ' . $this->address . '
                    </div>
                </div>
                ';
    }

    public function getTagAccess() {

        $username = (!empty($this->username)) ? "
            <div class=\"row-fluid\">
                    <div class=\"span4\">
                        <b>Username</b>
                    </div>
                    <div class=\"span1\">:</div>
                    <div class=\"span7\" style=\"text-align:left\">
                         $this->username 
                    </div>
                </div>" : '';
        $email = (!empty($this->email)) ? "
            <div class=\"row-fluid\">
                    <div class=\"span4\">
                        <b>E-mail</b>
                    </div>
                    <div class=\"span1\">:</div>
                    <div class=\"span7\" style=\"text-align:left\">
                         $this->email 
                    </div>
                </div>" : "";
        $business = (isset($this->business_id)) ? $this->business->name : '-';


        return '' . $username . '
                
                ' . $email . '
                    <div class="row-fluid">
                    <div class="span4">
                        <b>Kategori Bisnis</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span7" style="text-align:left">
                        ' . $business . '
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <b>Jenis Usaha</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span7" style="text-align:left">
                        ' . $this->type_business . '
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <b>Nama Usaha</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span7" style="text-align:left">
                        ' . $this->company_name . '
                    </div>
                </div>
               ';
    }

}