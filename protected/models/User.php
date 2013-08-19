<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $birthday
 * @property string $gender
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $district_id
 * @property string $address
 * @property string $hobby 
 *
 * The followings are the available model relations:
 * @property City $city
 * @property District $district
 * @property Province $province
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, province_id, city_id, district_id', 'numerical', 'integerOnly'=>true),
			array('username, hobby', 'length', 'max'=>20),
			array('password, name', 'length', 'max'=>100),
			array('gender', 'length', 'max'=>1),
			array('birthday, address', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, name, birthday, gender, province_id, city_id, district_id, address, hobby', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'district' => array(self::BELONGS_TO, 'District', 'district_id'),
			'province' => array(self::BELONGS_TO, 'Province', 'province_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'name' => 'Name',
			'birthday' => 'Birthday',
			'gender' => 'Gender',
			'province_id' => 'Province',
			'city_id' => 'City',
			'district_id' => 'District',
			'address' => 'Address',
			'hobby' => 'Hobby',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('district_id',$this->district_id);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('hobby',$this->hobby,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        /*@author Mr_Khoai91
         */
        public function encryptPassword($password) {
            return md5($password);
        }
        public function isValiPassword($password)
        {
            return $this->encryptPassword($password) === $this->password;
        }
}