<?php

/**
 * This is the model class for table "data".
 *
 * The followings are the available columns in table 'data':
 * @property integer $id
 * @property integer $item_id
 * @property integer $param_id
 * @property integer $period_id
 * @property string $year
 * @property string $dttm_input
 * @property string $dttm_update
 * @property integer $user_input
 * @property integer $user_update
 * @property integer $status
 * @property string $value1
 * @property string $value2
 * @property string $value3
 *
 * The followings are the available model relations:
 * @property Item $item
 * @property Param $param
 * @property Period $period
 */
class Data extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Data the static model class
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
		return 'data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, param_id, period_id, user_input, user_update, status', 'numerical', 'integerOnly'=>true),
			array('year', 'length', 'max'=>4),
			array('value1, value2, value3', 'length', 'max'=>45),
			array('dttm_input, dttm_update', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_id, param_id, period_id, year, dttm_input, dttm_update, user_input, user_update, status, value1, value2, value3', 'safe', 'on'=>'search'),
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
			'item' => array(self::BELONGS_TO, 'Item', 'item_id'),
			'param' => array(self::BELONGS_TO, 'Param', 'param_id'),
			'period' => array(self::BELONGS_TO, 'Period', 'period_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'item_id' => 'Item',
			'param_id' => 'Param',
			'period_id' => 'Period',
			'year' => 'Year',
			'dttm_input' => 'Dttm Input',
			'dttm_update' => 'Dttm Update',
			'user_input' => 'User Input',
			'user_update' => 'User Update',
			'status' => 'Status',
			'value1' => 'Value1',
			'value2' => 'Value2',
			'value3' => 'Value3',
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
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('param_id',$this->param_id);
		$criteria->compare('period_id',$this->period_id);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('dttm_input',$this->dttm_input,true);
		$criteria->compare('dttm_update',$this->dttm_update,true);
		$criteria->compare('user_input',$this->user_input);
		$criteria->compare('user_update',$this->user_update);
		$criteria->compare('status',$this->status);
		$criteria->compare('value1',$this->value1,true);
		$criteria->compare('value2',$this->value2,true);
		$criteria->compare('value3',$this->value3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave() {
            if ($this->isNewRecord) 
                $this->dttm_input = new CDbExpression('NOW()');
            else
                $this->dttm_update = new CDbExpression('NOW()');
            return parent::beforeSave();
        }
}