<?php

/**
 * This is the model class for table "param".
 *
 * The followings are the available columns in table 'param':
 * @property integer $id
 * @property integer $parent
 * @property string $param_name
 * @property string $tipe
 * @property string $grup
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Data[] $datas
 * @property Item[] $items
 */
class Param extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Param the static model class
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
		return 'param';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent, status', 'numerical', 'integerOnly'=>true),
			array('param_name, tipe, grup', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent, param_name, tipe, grup, status', 'safe', 'on'=>'search'),
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
                    'data' => array(self::HAS_ONE, 'Data', 'param_id'),
                    'items' => array(self::HAS_MANY, 'Item', 'param_id'),
                    'children' => array(self::HAS_MANY, 'Param', 'parent'),
                    'parent' => array(self::BELONGS_TO, 'Param', 'parent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent' => 'Parent',
			'param_name' => 'Param Name',
			'tipe' => 'Tipe',
			'grup' => 'Grup',
			'status' => 'Status',
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
		$criteria->compare('parent',$this->parent);
		$criteria->compare('param_name',$this->param_name,true);
		$criteria->compare('tipe',$this->tipe,true);
		$criteria->compare('grup',$this->grup,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}